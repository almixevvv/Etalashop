<?php defined('BASEPATH') or exit('No direct script access allowed');
class Cart extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}

	public function mycart()
	{
		$randomPage = mt_rand(1, 500);
		$cartArray = array();

		$hashEmail  = sha1($this->session->EMAIL);

		$data['productName'] 	 = 'Shopping Cart';
		$userData 				 = $this->session->user_data;

		$hashEmail = sha1($userData['EMAIL']);

		$data['marginParameter'] = $this->product->getMarginPrice();
		$data['convertRate'] 	 = $this->product->getConvertRate();
		$data['items']		 	 = $this->carts->displayCart($hashEmail);
		$data['row']			 = $data['items']->num_rows();
		$data['i']				 = 0;
		$data['subtotal']		 = 0;
		$data['subqty']		 	 = 0;
		$data['subWeight']		 = 0;
		$data['totalWeight']	 = 0;
		$data['totalPrice']	 	 = 0;
		$data['weightPrice']	 = 0;

		if ($userData['EMAIL'] != null) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('pages/cart/mycart', $data);
			$this->load->view('templates/footer');
		} else {
			$this->session->set_flashdata('cart', 'no_user');
			redirect(base_url('login?refer=mycart'));
		}
	}

	public function addtocart()
	{
		$userData 	= $this->session->user_data;

		if (!isset($userData['EMAIL'])) {
			//1.1 Simpen dulu datanya sementara di database, terus redirect ke halaman login
			$itemArray = array(
				'prod_id' 		=> $this->input->post('product-id'),
				'prod_qty' 		=> $this->input->post('quantity'),
				'prod_name' 	=> $this->input->post('product-name'),
				'prod_notes' 	=> $this->input->post('customer-notes'),
			);

			$this->session->set_userdata('cart_items', $itemArray);
			$this->session->set_flashdata('cart', 'no_user');

			redirect(base_url('login?refer=addcart'));
			//EoL 1.1
		}
		//EoL 1

		//2. Kalo ada yang login
		else {
			//2.1 Kalo ada cart item di session, simpen ke database
			if ($this->session->has_userdata('cart_items')) {

				$userData 	= $this->session->user_data;
				$tmpItems 	= $this->session->cart_items;
				$hashID 	= sha1($userData['EMAIL']);

				$itemArray = array(
					'CART_ID' 			=> $hashID,
					'PRODUCT_ID' 		=> $tmpItems['prod_id'],
					'PRODUCT_QUANTITY' 	=> $tmpItems['prod_qty'],
					'PRODUCT_NOTES' 	=> $tmpItems['prod_notes'],
					'PRODUCT_NAME'		=> $tmpItems['prod_name'],
					'PRODUCT_BUYER'		=> $userData['EMAIL'],
					'CART_FLAG'			=> '0'
				);

				$this->carts->insertCartData($itemArray);
				$this->session->unset_userdata('cart_items');
				// redirect('mycart');
			}
			//EoL 2.1

			//2.2 Kalo ga ada item di session
			else {
				$hashID 	= sha1($userData['EMAIL']);


				//URUTAN STATUS BARU
				//PAS CHECKOUT LANGSUNG MODAL BAYAR

				//URUTAN YANG BARU
				// NEW ORDER (PAID)
				// CONFIRMED
				// SENT - DI UPDATE ETALASHOP
				// RECEIVED - DI UPDATE MEMBER
				// CLOSED/CANCELED


				$itemArray = array(
					'CART_ID' 			=> $hashID,
					'PRODUCT_ID' 		=> $this->input->post('product-id'),
					'PRODUCT_QUANTITY' 	=> $this->input->post('quantity'),
					'PRODUCT_NOTES' 	=> $this->input->post('customer-notes'),
					'PRODUCT_NAME'	  	=> $this->input->post('product-name'),
					'PRODUCT_BUYER'		=> $userData['EMAIL'],
					'CART_FLAG'			=> '0'
				);

				//2.2.1 Cek apa itemnya udah ada di database atau belom, kalo udah ada; quantity-nya ditambahin
				$itemResult = $this->carts->getItemInfo($this->input->post('product-id'), $userData['EMAIL']);

				if ($itemResult->num_rows() > 0) {

					$currentQty = $itemResult->result()[0]->PRODUCT_QUANTITY;
					$totalQty = $currentQty + $this->input->post('quantity');

					$dataArray = array(
						'PRODUCT_QUANTITY' => $totalQty
					);

					$this->carts->updateCartQuantity($dataArray, $userData['EMAIL'], $this->input->post('product-id'));
				} else {
					$this->carts->insertCartData($itemArray);
				}
				//EoL 2.2.1

				redirect('mycart');
			}
			//EoL 2.2
		}
		//EoL 2
	}

	public function removeCartItem()
	{

		$productID = $this->input->get('rowid');
		$productBuyer = $this->input->get('buyer');

		if ($this->carts->deleteItem($productID, $productBuyer)) {
			return true;
		} else {
			return false;
		}
		//exit;
	}

	public function sendOrderDetails()
	{

		$this->load->view('email-template/order-created');
	}
}
