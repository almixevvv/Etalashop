<?php defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();

		$this->load->model('M_product', 'product');
		$this->load->model('M_profile', 'profiles');
		$this->load->model('M_cart', 'carts');
		// $this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$userData 			 = $this->session->user_data;
		$data['sectionName'] = 'Checkout';
		$member_id 			 = $userData['USERID'];

		//LOAD THE PAGE AS NORMAL
		if ($member_id == null) {
			$this->session->set_flashdata('cart', 'no_user');
			redirect(base_url('login?refer=cart/checkout'));
		}

		//CHECK IF USER REQUESTED THE DATA TO BE SAVED
		$saveFlag = $this->profiles->getMemberDetails($userData['EMAIL']);

		$sessionData = $this->session->user_data;

		$data['userEmail'] = $sessionData['EMAIL'];
		$data['userID'] = $sessionData['USERID'];

		if ($saveFlag->result()[0]->SAVE_FLAG == 1) {

			//FORWARD THE DATA TO THE PAGE
			$data['userData'] = $saveFlag->result()[0];

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('pages/cart/checkout', $data);
			$this->load->view('templates/footer');
		} else {

			//LOAD THE DATA AS NORMAL
			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('pages/cart/checkout', $data);
			$this->load->view('templates/footer');
		}
	}

	public function checkoutProcess()
	{

		if ($this->input->post('save-info') == 'on') {
			$saveFlag = 1;
		} else {
			$saveFlag = 0;
		}

		$userData 		= $this->session->user_data;
		$memberID      	= $userData['USERID'];
		$hashEmail		= sha1($userData['EMAIL']);
		$genID          = $this->carts->generateID();

		$subqty 		= 0;
		$subtotal 		= 0;
		$curPrice 		= 0;

		//Calculate Total Item Price
		$carts  = $this->carts->displayCart($hashEmail);

		foreach ($carts->result() as $items) {

			$curPrice 	= $items->PRODUCT_QUANTITY * $items->PRODUCT_PRICE;
			$subqty 	= $subqty + $items->PRODUCT_QUANTITY;
			$subtotal 	= $subtotal + $curPrice;
		}

		$data = array(
			'ORDER_NO'     => $genID,
			'ORDER_DATE'   => date('Y-m-d h:i:s'),
			'MEMBER_ID'    => $memberID,
			'MEMBER_NAME'  => $this->input->post('txt-name'),
			'MEMBER_PHONE' => $this->input->post('txt-phone'),
			'MEMBER_EMAIL' => $this->input->post('txt-email'),
			'TOTAL_ORDER'  => $subtotal,
			'STATUS'       => 'NEW ORDER',
			'UPDATED'	   => date('Y-m-d h:i:s'),
			'ADDRESS_1'    => $this->input->post('txt-address-1'),
			'ADDRESS_2'    => $this->input->post('txt-address-2'),
			'COUNTRY'      => $this->input->post('txt-country'),
			'ZIP'          => $this->input->post('txt-zip'),
			'STATE'        => $this->input->post('txt-state'),
			'SAVE_FLAG'	   => $saveFlag
		);

		$this->carts->insertMasterData($data);

		foreach ($carts->result() as $carts) {

			if (substr($carts->PRODUCT_ID, 1, 1) != 'P') {
				$flag = '1';
			} else {
				$flag = '2';
			}

			$details = array(
				'FLAG'            => $flag,
				'ORDER_NO'        => $genID,
				'PROD_ID'         => $carts->PRODUCT_ID,
				'PROD_IMAGE'	  => $carts->PRODUCT_IMAGES,
				'PROD_NAME'		  => $carts->PRODUCT_NAME,
				'QUANTITY'        => $carts->PRODUCT_QUANTITY,
				'WEIGHT'          => '0',
				'PRICE'           => $carts->PRODUCT_PRICE,
				'FINAL_PRICE'     => $carts->PRODUCT_PRICE,
				'POSTAGE'         => 0.00,
				'NOTES'           => $carts->PRODUCT_NOTES
			);

			$this->carts->insertOrderDetail($details);

			//DELETE THE ITEM FROM THE CART
			// $deleteCart = $this->carts->deleteCarts($carts->REC_ID);
			$deleteCart = $this->carts->updateCartFlag($carts->PRODUCT_ID, $carts->REC_ID);
		}

		if ($deleteCart) {
			$this->session->set_flashdata('inquiry', 'created');
			redirect(base_url());
		} else {
			$this->session->set_flashdata('inquiry', 'failed');
			redirect(base_url());
		}
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

	public function getMemberData()
	{
		$email = $this->input->post('email');

		$userData = $this->profiles->getMemberDetails($email);

		header("Content-Type: application/json");
		echo json_encode($userData->result());
	}

	public function generateID()
	{
		$genID = $this->carts->generateID();

		echo $genID;
	}
}
