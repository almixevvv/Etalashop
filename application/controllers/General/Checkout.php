<?php defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$sessionData 			= $this->session->user_data;
		$data['sectionName'] 	= 'Checkout';

		//LOAD THE PAGE AS NORMAL
		if ($sessionData['USERID'] == null) {
			$this->session->set_flashdata('cart', 'no_user');
			redirect(base_url('login?refer=cart/checkout'));
		}

		$data['userEmail'] = $sessionData['EMAIL'];
		$data['userID']    = $sessionData['USERID'];
		$data['saveFlag']  = $this->profiles->getMemberDetails($sessionData['EMAIL']);
		$data['userData']  = $sessionData;

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/cart/checkout', $data);
		$this->load->view('templates/footer');
	}

	public function checkoutProcess()
	{
		$userData 		= $this->session->user_data;
		$memberID      	= $userData['USERID'];
		$hashEmail		= sha1($userData['EMAIL']);
		$genID          = $this->carts->generateID();
		$orderID		= sha1($this->incube->generateID('20'));

		$subtotal 		= 0;
		$curPrice 		= 0;
		$curWeight      = 0;
		$totalWeight    = 0;
		$weightPrice	= 0;

		//Calculate Total Item Price
		$carts  = $this->carts->displayCart($hashEmail);

		//1. Calculate the price for all items
		foreach ($carts->result() as $items) {

			//1.1. Calculate the item price
			$subtotal 	= $subtotal + ($items->PRODUCT_PRICE == null ? 0 : $items->PRODUCT_PRICE);
			//EoL 1.1

			//1.1.1 Calculate the item weight
			$curWeight   = $items->WEIGHT * $items->PRODUCT_QUANTITY;
			$totalWeight = $totalWeight + $curWeight;
			//EoL 1.1.1

			//1.1.2 Calculate the weight cost 
			$weightPrice = $totalWeight * WEIGHT_PRICE;
			//EoL 1.1.2
		}
		//EoL 1

		//2. Insert transaction to database
		$this->db->trans_start();

		$data = array(
			'ORDER_NO'     	=> $genID,
			'ORDER_ID'		=> $orderID,
			'ORDER_DATE'   	=> date('Y-m-d h:i:s'),
			'MEMBER_ID'    	=> $memberID,
			'MEMBER_NAME'  	=> $this->input->post('txt-name'),
			'MEMBER_PHONE' 	=> $this->input->post('txt-phone'),
			'MEMBER_EMAIL' 	=> $this->input->post('txt-email'),
			'TOTAL_ORDER'  	=> $subtotal,
			'TOTAL_POSTAGE'	=> $weightPrice,
			'STATUS'       	=> 'NEW ORDER',
			'ADDRESS_1'    	=> $this->input->post('txt-address-1'),
			'ADDRESS_2'    	=> $this->input->post('txt-address-2'),
			'COUNTRY'      	=> $this->input->post('txt-country'),
			'ZIP'          	=> $this->input->post('txt-zip'),
			'STATE'        	=> $this->input->post('txt-state'),
			'SAVE_FLAG'	   	=> ($this->input->post('save-info') == 'on' ? 1 : 0)
		);

		$this->api->insertGeneralData('g_order_master', $data);

		//2.1 Loop data for inserting to order detail
		foreach ($carts->result() as $carts) {
			//2.1.1 Get items detail
			$queryProduct = $this->api->getGeneralData('v_g_products', 'PRODUCT_ID', $carts->PRODUCT_ID);
			//EoL 2.1.1

			//2.1.2 Calculate the item weight & price
			$curWeight   = $carts->WEIGHT * $carts->PRODUCT_QUANTITY;
			$curPrice    = $curWeight * WEIGHT_PRICE;
			//EoL 2.1.2

			$finalPrice = $carts->PRODUCT_PRICE + $curPrice;

			$details = array(
				'FLAG'            => (substr($carts->PRODUCT_ID, 1, 1) != 'P' ? '1' : '2'),
				'ORDER_NO'        => $genID,
				'ORDER_ID'	      => $orderID,
				'PROD_ID'         => $carts->PRODUCT_ID,
				'PROD_IMAGE'	  => $queryProduct->row()->IMAGES1,
				'PROD_NAME'		  => $queryProduct->row()->PRODUCT_NAME,
				'QUANTITY'        => $carts->PRODUCT_QUANTITY,
				'WEIGHT'          => $carts->WEIGHT,
				'PRICE'           => ($carts->PRODUCT_PRICE == null ? 0 : $carts->PRODUCT_PRICE),
				'FINAL_PRICE'     => $finalPrice,
				'POSTAGE'         => $curPrice,
				'NOTES'           => $carts->PRODUCT_NOTES
			);

			$this->api->insertGeneralData('g_order_detail', $details);

			//2.1.3 Delete the items from cart 
			$this->carts->updateCartFlag($hashEmail);
			//EoL 2.1.3
		}
		//EoL 2.1
		$this->db->trans_complete();
		//EoL 2

		//3. Validate the data
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('inquiry', 'failed');
			redirect(base_url());
		} else {
			$this->db->trans_commit();
			$this->session->set_flashdata('inquiry', 'created');
			redirect(base_url());
		}
		//EoL 3
	}

	public function postPaymentProcess()
	{
		$this->load->model('M_profile', 'profile');

		$data['sectionName'] = 'Checkout';

		// header('Content-Type: application/json');

		if ($this->input->get('status') == 'cancel') {

			$data['header'] = 'Transaction Canceled';
			$data['message'] = 'You transaction has been canceled';

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('pages/profile/finishPayment', $data);
			$this->load->view('templates/footer');
			// echo json_encode([
			// 	'status'    => 'error',
			// 	'result'	=> 'payment cancel',
			// 	'code'      => 200
			// ]);
		} else if ($this->input->get('status') == 'error') {

			$data['header'] = 'Transaction Failed';
			$data['message'] = 'Something went wrong while processing your transaction, please try again later';

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('pages/profile/finishPayment', $data);
			$this->load->view('templates/footer');
			// echo json_encode([
			// 	'status'    => 'error',
			// 	'result'	=> 'payment error',
			// 	'url'			=> base_url('profile/transaction?payment=error'),
			// 	'code'      => 200
			// ]);
		} else {
			$paymentID = explode("-",  $this->input->get('order_id'));
			$queryFinish = $this->profile->updatePaymentStatus($paymentID[0], 'PAID');

			if (!$queryFinish) {

				$data['header'] = 'Transaction Failed';
				$data['message'] = 'Something wrong while processing your transaction, please try again later';

				$this->load->view('templates/header', $data);
				$this->load->view('templates/navbar');
				$this->load->view('pages/profile/finishPayment', $data);
				$this->load->view('templates/footer');
				// echo json_encode([
				// 	'status'    => 'error',
				// 	'type'      => 'payment query error',
				// 	'code'      => 200
				// ]);
			} else {

				$data['header'] = 'Transaction Complete';
				$data['message'] = 'You transaction is complete, thank you for shopping with us';

				$this->load->view('templates/header', $data);
				$this->load->view('templates/navbar');
				$this->load->view('pages/profile/finishPayment', $data);
				$this->load->view('templates/footer');
				// echo json_encode([
				// 	'status'    => 'success',
				// 	'type'      => 'payment complete',
				// 	'code'      => 200
				// ]);
			}
		}
	}

	public function generateID()
	{
		$genID = $this->carts->generateID();

		echo $genID;
	}
}
