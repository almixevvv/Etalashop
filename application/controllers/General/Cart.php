<?php defined('BASEPATH') or exit('No direct script access allowed');
class Cart extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('M_product', 'product');
		$this->load->model('M_cart', 'carts');
		$this->load->library('incube');

		// $this->output->enable_profiler(TRUE);
	}

	public function mycart()
	{

		$randomPage = mt_rand(1, 500);

		$cartArray = array();

		$url  		= file_get_contents("http://en.yiwugo.com/ywg/productlist.html?account=Wien.suh@gmail.com&s=1001105&pageSize=5&cpage=" . $randomPage);
		$obj 		= json_decode($url, TRUE);

		$hashEmail  = sha1($this->session->EMAIL);

		$data['recomended'] 	 = $obj;
		$data['productName'] 	 = 'Shopping Cart';
		$userData 				 = $this->session->user_data;

		$hashEmail = sha1($userData['EMAIL']);

		$data['marginParameter'] = $this->product->getMarginPrice();
		$data['convertRate'] 	 = $this->product->getConvertRate();
		$data['items']		 	 = $this->carts->displayCart($hashEmail);

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

		if ($userData['EMAIL'] == null) {

			//Temporarely Save Item to Database
			$itemArray = array(
				'prod_id' 		=> $this->input->post('product-id'),
				'prod_qty' 		=> $this->input->post('quantity'),
				'prod_name' 	=> $this->input->post('product-name'),
				'prod_price' 	=> $this->input->post('product-price'),
				'prod_notes' 	=> $this->input->post('customer-notes'),
				'prod_image'	=> $this->input->post('hidden-images')
			);

			$this->session->set_userdata('cart_items', $itemArray);
			$this->session->set_flashdata('cart', 'no_user');

			redirect(base_url('login?refer=addcart'));
		} else {
			if ($this->session->has_userdata('cart_items')) {

				$userData 	= $this->session->user_data;
				$tmpItems 	= $this->session->cart_items;
				$hashID 	= sha1($userData['EMAIL']);

				$itemArray = array(
					'CART_ID' 			=> $hashID,
					'PRODUCT_ID' 		=> $tmpItems['prod_id'],
					'PRODUCT_QUANTITY' 	=> $tmpItems['prod_qty'],
					'PRODUCT_PRICE' 	=> $tmpItems['prod_price'],
					'PRODUCT_NOTES' 	=> $tmpItems['prod_notes'],
					'PRODUCT_NAME'		=> $tmpItems['prod_name'],
					'PRODUCT_IMAGES'	=> $tmpItems['prod_image'],
					'PRODUCT_BUYER'		=> $userData['EMAIL'],
					'CART_FLAG'			=> '0'
				);

				$this->carts->insertCartData($itemArray);
				$this->session->unset_userdata('cart_items');
				redirect('mycart');
			} else {
				$hashID 	= sha1($userData['EMAIL']);

				$itemArray = array(
					'CART_ID' 			=> $hashID,
					'PRODUCT_ID' 		=> $this->input->post('product-id'),
					'PRODUCT_QUANTITY' 	=> $this->input->post('quantity'),
					'PRODUCT_PRICE' 	=> $this->input->post('product-price'),
					'PRODUCT_NOTES' 	=> $this->input->post('customer-notes'),
					'PRODUCT_IMAGES'	=> $this->input->post('hidden-images'),
					'PRODUCT_NAME'	  	=> $this->input->post('product-name'),
					'PRODUCT_BUYER'		=> $userData['EMAIL'],
					'CART_FLAG'			=> '0'
				);

				//CHECK IF ITEM IS PREVIOUSLY EXISTING
				$itemResult = $this->carts->getItemInfo($this->input->post('product-id'), $userData['EMAIL']);

				if ($itemResult->num_rows() > 0) {

					//DO SOMETHING ELSE
					$currentQty = $itemResult->result()[0]->PRODUCT_QUANTITY;
					$totalQty = $currentQty + $this->input->post('quantity');

					$dataArray = array(
						'PRODUCT_QUANTITY' => $totalQty
					);

					//UPDATE QUANTITY
					$this->carts->updateCartQuantity($dataArray, $userData['EMAIL'], $this->input->post('product-id'));
				} else {
					//CREATE THE ORDER
					$this->carts->insertCartData($itemArray);
				}

				redirect('mycart');
			}
		}
	}

	public function removeCartItem()
	{

		$getRowID = $this->input->get('rowid');
		$getBuyer = $this->input->get('buyer');

		if ($this->carts->deleteItem($getRowID, $getBuyer)) {
			return true;
		} else {
			return false;
		}
	}

	public function sendOrderDetails()
	{

		$this->load->view('email-template/order-created');
	}
}
