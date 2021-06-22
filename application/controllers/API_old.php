<?php defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class API extends REST_Controller
{

	public function __construct()
	{

		parent::__construct();

		$this->load->model('M_api', 'api');
		$this->load->model('M_user', 'user');
		$this->load->model('M_cart', 'carts');
		$this->load->model('M_category', 'category');
		$this->load->model('M_profile', 'profile');
		$this->load->model('M_reset', 'reset');
		$this->load->model('M_pages', 'pages');
		$this->load->library('email');
		$this->load->library('incube');
		$this->load->library('upload');
		// $this->output->enable_profiler(TRUE);

		//DEBUG LAST QUERY
		// echo $this->db->last_query();

	}

	public function howto_get()
	{
		$data = $this->pages->HowTo();
		foreach ($data->result() as $content);

		$this->response([
			'status' 	=> 'ok',
			'code' 		=> REST_Controller::HTTP_ACCEPTED,
			'item'      => $content->CONTENT,
		], REST_Controller::HTTP_ACCEPTED);
	}

	public function terms_get()
	{

		$data = $this->pages->Terms();
		foreach ($data->result() as $content);

		$this->response([
			'status' 	=> 'ok',
			'code' 		=> REST_Controller::HTTP_ACCEPTED,
			'item'      => $content->CONTENT,
		], REST_Controller::HTTP_ACCEPTED);
	}

	public function index_get()
	{

		$this->response([
			'status' => 'error',
			'message' => 'api path error',
			'code' => REST_Controller::HTTP_NOT_FOUND
		], REST_Controller::HTTP_NOT_FOUND);
	}

	//CUSTOM HOME PAGE
	public function home_get()
	{

		$randomPage 		= mt_rand(1, 500);
		$pageSize   		= $this->input->get('pageSize');
		$pageCounter 		= $this->input->get('page');
		$counter    		= 0;
		$marginParameter 	= $this->product->getMarginPrice();
		$convertRate		= $this->product->getConvertRate();

		if ($pageSize != null) {
			$url = "http://en.yiwugo.com/ywg/productlist.html?account=Wien.suh@gmail.com&pageSize=" . $pageSize . "&cpage=" . $randomPage;
		} else {
			$url = "http://en.yiwugo.com/ywg/productlist.html?account=Wien.suh@gmail.com&pageSize=" . $pageSize . "&cpage=" . $pageCounter;
		}

		//set your own error handler before the call
		set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context) {
			throw new ErrorException($err_msg, 0, $err_severity, $err_file, $err_line);
		}, E_WARNING);

		try {
			$json 	= file_get_contents($url);
			$obj = json_decode($json, true);
		} catch (Exception $e) {
			// echo 'Error Caught';
			$obj = $e;
		}

		//restore the previous error handler
		restore_error_handler();

		if (!is_array($obj)) {
			$this->response([
				'status' 	=> 'ok',
				'pageSize' 	=> 0,
				'code' 		=> REST_Controller::HTTP_ACCEPTED,
				'item'      => new \stdClass(),
			], REST_Controller::HTTP_ACCEPTED);
		} else {

			$result = array();

			foreach ($obj['prslist'] as $list) {

				//Use custom library for Image Formating
				$newPath = $this->incube->replaceLink($list['picture2']);

				$result[$counter]['ID'] 			= strval($list['id']);
				$result[$counter]['TITLE']			= $list['title'];
				$result[$counter]['PICTURE']		= $newPath . $list['picture2'];
				// $result[$counter]['ORIGINAL_PRICE']	= $list['sellPrice'];
				$result[$counter]['START_QUANTITY'] = strval($list['startNumber']);

				if ($list['priceType'] == '0') {
					$result[$counter]['PRICE']			= 'Price Negotiable';
				} else {
					$price = $this->incube->setPrice($convertRate, $marginParameter, $list['sellPrice']);
					// $result[$counter]['PRICE']			= number_format($price, 2, '.', ',');
					$result[$counter]['PRICE']			= strval($price);
				}

				$counter++;
			}

			$jsonResult = json_encode($result);

			if ($jsonResult == null) {
				$this->response([
					'status' 	=> 'ok',
					'pageSize' 	=> $pageSize,
					'code' 		=> REST_Controller::HTTP_ACCEPTED,
					'item'      => new \stdClass(),
				], REST_Controller::HTTP_ACCEPTED);
			} else {
				$this->response([
					'status' 	=> 'ok',
					'pageSize' 	=> $pageSize,
					'url'		=> "http://en.yiwugo.com/ywg/productlist.html?account=Wien.suh@gmail.com&pageSize=" . $pageSize . "&cpage=" . $randomPage,
					'code' 		=> REST_Controller::HTTP_ACCEPTED,
					'item'      => json_decode($jsonResult, true),
				], REST_Controller::HTTP_ACCEPTED);
			}
		}
	}

	//SEARCH CUSTOM PAGE
	public function search_get()
	{

		$counter    		= 0;
		$pageSize   		= $this->input->get('pageSize');
		$searchQuery 		= $this->input->get('query');
		$marginParameter 	= $this->product->getMarginPrice();
		$convertRate		= $this->product->getConvertRate();

		$json 	= file_get_contents("https://en.yiwugo.com/ywg/productlist.html?account=Wien.suh@gmail.com&q=" . $searchQuery . "&pageSize=" . $pageSize . "&cpage=" . $this->input->get('page'));
		$obj 	= json_decode($json, true);

		$result = array();

		if ($obj['prslist'] == null) {

			$this->response([
				'status' 		=> 'ok',
				'pageSize' 		=> $pageSize,
				'searchQuery'	=> $searchQuery,
				'code' 			=> REST_Controller::HTTP_ACCEPTED,
				'item'      	=> new \stdClass(),
			], REST_Controller::HTTP_ACCEPTED);
		} else {

			foreach ($obj['prslist'] as $list) {

				//Use custom library for Image Formating
				$newPath = $this->incube->replaceLink($list['picture2']);

				$result[$counter]['ID'] 			= $list['id'];
				$result[$counter]['TITLE']			= $list['title'];
				$result[$counter]['PICTURE']		= $newPath . $list['picture2'];
				// $result[$counter]['ORIGINAL_PRICE']	= $list['sellPrice'];
				$result[$counter]['START_QUANTITY'] = strval($list['startNumber']);

				if ($list['priceType'] == '0') {
					$result[$counter]['PRICE']			= 'Price Negotiable';
				} else {
					$price = $this->incube->setPrice($convertRate, $marginParameter, $list['sellPrice']);
					// $result[$counter]['PRICE']			= number_format($price, 2, '.', ',');
					$result[$counter]['PRICE']			= strval($price);
				}

				$counter++;
			}

			$jsonResult = json_encode($result);

			$this->response([
				'status' 		=> 'ok',
				'pageSize' 		=> $pageSize,
				'searchQuery'	=> $searchQuery,
				'code' 			=> REST_Controller::HTTP_ACCEPTED,
				'item'      	=> json_decode($jsonResult, true),
			], REST_Controller::HTTP_ACCEPTED);
		}
	}

	//Get Product From Category
	public function categoryProduct_get()
	{
		$pageSize    = $this->input->get('pageSize');
		$categoryID  = $this->input->get('category');
		$pageCounter = $this->input->get('page');
		$counter     = 0;
		$marginParameter 	= $this->product->getMarginPrice();
		$convertRate		= $this->product->getConvertRate();

		$json 	= file_get_contents("http://en.yiwugo.com/ywg/productlist.html?account=Wien.suh@gmail.com&s=" . $categoryID . "&pageSize=" . $pageSize . "&cpage=" . $pageCounter);
		$obj 	= json_decode($json, true);

		$result = array();

		if ($obj['prslist'] == null) {

			$this->response([
				'status' 		=> 'ok',
				'pageSize' 		=> $pageSize,
				'categoryID'	=> $categoryID,
				'code' 			=> REST_Controller::HTTP_ACCEPTED,
				'item'      	=> new \stdClass(),
			], REST_Controller::HTTP_ACCEPTED);
		} else {

			foreach ($obj['prslist'] as $list) {

				//Use custom library for Image Formating
				$newPath = $this->incube->replaceLink($list['picture2']);

				$result[$counter]['ID'] 			= $list['id'];
				$result[$counter]['TITLE']			= $list['title'];
				$result[$counter]['PICTURE']		= $newPath . $list['picture2'];
				// $result[$counter]['ORIGINAL_PRICE']	= $list['sellPrice'];
				$result[$counter]['START_QUANTITY'] = strval($list['startNumber']);

				if ($list['priceType'] == '0') {
					$result[$counter]['PRICE']			= 'Price Negotiable';
				} else {
					$price = $this->incube->setPrice($convertRate, $marginParameter, $list['sellPrice']);
					// $result[$counter]['PRICE']			= number_format($price, 2, '.', ',');
					$result[$counter]['PRICE']			= strval($price);
				}

				$counter++;
			}

			$jsonResult = json_encode($result);

			$this->response([
				'status' 		=> 'ok',
				'pageSize' 		=> $pageSize,
				'categoryID'	=> $categoryID,
				'code' 			=> REST_Controller::HTTP_ACCEPTED,
				'item'      	=> json_decode($jsonResult, true),
			], REST_Controller::HTTP_ACCEPTED);
		}
	}

	//Get Product Detail
	public function product_get()
	{

		$id			= $this->input->get('id');
		$counter 	= 0;
		$picCounter = 0;
		$finalUrl   = 'http://en.yiwugo.com/ywg/productdetail.html?account=Wien.suh@gmail.com&productId=' . $id;
		$marginParameter 	= $this->product->getMarginPrice();
		$convertRate		= $this->product->getConvertRate();

		$json 	= file_get_contents($finalUrl);
		$obj 	= json_decode($json, true);

		if (isset($obj['tip'])) {

			$this->response([
				'status' 		=> 'error',
				'code' 			=> REST_Controller::HTTP_ACCEPTED,
				'item'      	=> new \stdClass(),
			], REST_Controller::HTTP_ACCEPTED);
		} else {

			$productForApp['TITLE'] 	= ucwords($obj['detail']['productForApp']['title']);
			$productForApp['MATRIC']	= ucwords($this->incube->changeItemMatric($obj['detail']['productForApp']['matrisingular']));
			$productForApp['DETAILS']	= ucwords($obj['detail']['productForApp']['introduction']);
			$estWeight 					= $obj['detail']['productForApp']['weightetc'];

			//FIX FOR IMAGE
			if ($obj['detail']['sdiProductsPicList'] == null) {

				$picCounter = 1;

				if (isset($obj['detail']['productForApp']['picture']) && strlen($obj['detail']['productForApp']['picture']) > 5) {
					//Use custom library for Image Formating
					$newPath = $this->incube->replaceLink($obj['detail']['productForApp']['picture']);
					$productForApp['PICTURE_LIST'][]['PICTURE'] = $newPath . $obj['detail']['productForApp']['picture'];
					$productForApp['MAIN_PICTURE'] = $newPath . $obj['detail']['productForApp']['picture'];
					$picCounter++;
				} else {
					//$productForApp['PICTURE_LIST'][]['PICTURE'] = '';
					$picCounter++;
				}

				//TMP COUNTER FOR THIS LOOP ONLY, WHILE PICCOUNTER IS ONLY ADDED IF THE ABOVE RUNS
				for ($tmpCounter = 1; $tmpCounter <= 5; $tmpCounter++) {
					if (isset($obj['detail']['productForApp']['picture' . $tmpCounter]) && strlen($obj['detail']['productForApp']['picture' . $tmpCounter]) > 5) {
						//Use custom library for Image Formating
						$newPath = $this->incube->replaceLink($obj['detail']['productForApp']['picture' . $tmpCounter]);
						$productForApp['PICTURE_LIST'][]['PICTURE'] = $newPath . $obj['detail']['productForApp']['picture' . $tmpCounter];
						$productForApp['MAIN_PICTURE'] = $newPath . $obj['detail']['productForApp']['picture' . $tmpCounter];
					} else {
						//$productForApp['PICTURE_LIST'][]['PICTURE'] = '';
					}
					$picCounter++;
				}

				// $out = array_values($image);
				// $jsonEncode = json_encode($out);
			} else {

				$picCounter = 1;

				foreach ($obj['detail']['sdiProductsPicList'] as $picture) {

					if (isset($picture['picture']) && strlen($picture['picture']) > 5) {
						//Use custom library for Image Formating
						$newPath = $this->incube->replaceLink($picture['picture']);
						$productForApp['PICTURE_LIST'][]['PICTURE'] = $newPath . $picture['picture'];
						$productForApp['MAIN_PICTURE'] = $newPath . $picture['picture'];
						$picCounter++;
					} else {
						//$productForApp['PICTURE_LIST'][]['PICTURE'] = '';
						$picCounter++;
					}

					//TMP COUNTER FOR THIS LOOP ONLY, WHILE PICCOUNTER IS ONLY ADDED IF THE ABOVE RUNS
					for ($tmpCounter = 1; $tmpCounter <= 5; $tmpCounter++) {
						if (isset($picture['picture' . $tmpCounter]) && strlen($picture['picture' . $tmpCounter]) > 5) {
							//Use custom library for Image Formating
							$newPath = $this->incube->replaceLink($picture['picture' . $tmpCounter]);
							$productForApp['PICTURE_LIST'][]['PICTURE'] = $newPath . $picture['picture' . $tmpCounter];
							$productForApp['MAIN_PICTURE'] = $newPath . $picture['picture' . $tmpCounter];
						} else {
							//$productForApp['PICTURE_LIST'][]['PICTURE'] = '';
						}
						$picCounter++;
					}
				}

				// $out = array_values($image);
				// $jsonEncode = json_encode($out);
			}

			//CREATE PRICE LIST
			if ($obj['detail']['sdiProductsPriceList'] == null) {

				//Check if the price is appropriate
				if ($this->incube->priceEmpty($obj['detail']['productForApp']['sellPrice'])) {
					$productForApp['PRICE'][$counter]['PRICE'] = 'Price Negotiable';
					$productForApp['PRICE'][$counter]['STARTING_QUANTITY'] = '1';
					$productForApp['PRICE'][$counter]['ENDING_QUANTITY'] = '';
					$productForApp['PRICE'][$counter]['FLAG'] = 'No EXW Price';

					$startingPrice 		= '0';
					$startingQuantity 	= '1';
				} else {
					$price = $this->incube->setPrice($convertRate, $marginParameter, $obj['detail']['productForApp']['sellPrice']);
					// $productForApp['PRICE']['STARTING_PRICE'] = number_format($price, 2, '.', ',');
					$productForApp['PRICE'][$counter]['PRICE'] = strval($price);
					$productForApp['PRICE'][$counter]['STARTING_QUANTITY'] = '1';
					$productForApp['PRICE'][$counter]['FLAG'] = 'No EXW Price';
					$productForApp['PRICE'][$counter]['ENDING_QUANTITY'] = '';

					$startingPrice 		= $price;
					$startingQuantity 	= '1';
				}
			} else {

				//Loop through each price
				foreach ($obj['detail']['sdiProductsPriceList'] as $priceList) {

					$price = $this->incube->setPrice($convertRate, $marginParameter, $priceList['sellPrice']);

					$productForApp['PRICE'][$counter]['PRICE'] 				= strval($price);
					$productForApp['PRICE'][$counter]['STARTING_QUANTITY'] 	= strval($priceList['startNumber']);
					$productForApp['PRICE'][$counter]['FLAG'] = 'EXW Price Exist';

					if ($priceList['endNumber'] == 0) {
						$productForApp['PRICE'][$counter]['ENDING_QUANTITY'] 	= 'Above ' . $priceList['startNumber'];
					} else {
						$productForApp['PRICE'][$counter]['ENDING_QUANTITY'] 	= strval($priceList['endNumber']);
					}

					//$productForApp['PRICE'][$counter]['PRICE'] 					= number_format($price, 2, '.', ',');
					if ($priceList['endNumber'] == 0) {
						$startingQuantity = $priceList['startNumber'];
						$startingPrice = $price;
					} else if ($priceList['endNumber'] == 1) {
						$startingQuantity = $priceList['startNumber'];
						$startingPrice = $price;
					} else if ($priceList['startNumber'] < $priceList['endNumber']) {
						$startingQuantity = $priceList['startNumber'];
						$startingPrice = $price;
					}

					$counter++;
				}
			}

			// $productForApp['PICTURE_LIST'] = json_decode($jsonEncode);

			$jsonResult = json_encode($productForApp);

			$this->response([
				'status' 			=> 'ok',
				'productID' 		=> $id,
				'minimumOrder'		=> strval($startingQuantity),
				'startingPrice'		=> strval($startingPrice),
				'matrics'			=> $productForApp['MATRIC'],
				'estimated_weight'  => $estWeight,
				'code' 				=> REST_Controller::HTTP_ACCEPTED,
				'item'      		=> json_decode($jsonResult, true),
			], REST_Controller::HTTP_ACCEPTED);
		}
	}

	//Get Correct Pricing
	public function pricing_get()
	{

		$productID = $this->input->get('id');
		$quantity  = $this->input->get('quantity');
		$marginParameter 	= $this->product->getMarginPrice();
		$convertRate		= $this->product->getConvertRate();

		$finalUrl = 'http://en.yiwugo.com/ywg/productdetail.html?account=Wien.suh@gmail.com&productId=' . $productID;

		$json 	= file_get_contents($finalUrl);
		$obj 	= json_decode($json, true);

		if (isset($obj['tip'])) {

			$this->response([
				'status' 		=> 'error',
				'code' 			=> REST_Controller::HTTP_BAD_REQUEST,
				'item'      	=> new \stdClass(),
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {

			if ($obj['detail']['sdiProductsPriceList'] == null) {

				//Check if the price is appropriate
				if ($this->incube->priceEmpty($obj['detail']['productForApp']['sellPrice'])) {
					$startingPrice 		= 'Price Negotiable';
				} else {
					$price = $this->incube->setPrice($convertRate, $marginParameter, $obj['detail']['productForApp']['sellPrice']);
					$startingPrice 		= $price;
				}

				$this->response([
					'status' => 'ok',
					'price'	 => strval($startingPrice),
					'startingQuantity'	=> 'none',
					'endingQUantity'	=> 'none',
					'code' 				=> REST_Controller::HTTP_OK,
				], REST_Controller::HTTP_OK);
			} else {
				//Get the Pricing from Library
				$newPricing = $this->incube->getCorrectPrice($convertRate, $marginParameter, $quantity, $obj['detail']['sdiProductsPriceList']);

				if (!$newPricing) {
					$this->response([
						'status' 	=> 'error',
						'message'	=> 'quantity error',
						'code' 		=> REST_Controller::HTTP_BAD_REQUEST,
					], REST_Controller::HTTP_BAD_REQUEST);
				} else {
					$this->response([
						'status' 			=> 'ok',
						'price'	 			=> strval($newPricing['price']),
						'startingQuantity'	=> strval($newPricing['start']),
						'endingQUantity'	=> strval($newPricing['end']),
						'code' 				=> REST_Controller::HTTP_OK,
					], REST_Controller::HTTP_OK);
				}
			}
		}
	}

	//GET MESSAGE
	public function message_get()
	{

		$orderID 	 	= $this->input->get('id');
		$messageData 	= $this->profile->getOrderMessages($orderID);
		$messageSender  = $this->profile->getMessageSender($orderID);
		$counter 	 	= 0;

		foreach ($messageSender->result() as $detail);

		if ($messageData->num_rows() > 0) {

			foreach ($messageData->result() as $data) {

				$message[$counter] = array(
					'SENDER' 			=> $data->SENDER_ID,
					'MESSAGE'			=> $data->MESSAGE,
					'MESSAGE_TIME'		=> $data->MESSAGE_TIME,
					'USER_READ_FLAG'	=> $data->USER_READ_FLAG,
					'ADMIN_READ_FLAG'	=> $data->ADMIN_READ_FLAG
				);

				$counter++;
			}

			$encode = json_encode($message);

			$this->response([
				'status' 		=> 'ok',
				'message' 		=> $messageData->num_rows() . ' messages found',
				'code' 			=> REST_Controller::HTTP_ACCEPTED,
				'sender_email'	=> $detail->MEMBER_EMAIL,
				'message_data' 	=> json_decode($encode)
			], REST_Controller::HTTP_ACCEPTED);
		} else {

			$this->response([
				'status' 		=> 'ok',
				'message' 		=> '0',
				'code' 			=> REST_Controller::HTTP_ACCEPTED,
				'sender_email'	=> '',
				'message_data' 	=> $tmpData = array()
			], REST_Controller::HTTP_ACCEPTED);
		}

		// echo $this->db->last_query();

	}

	//SEND MESSAGE
	public function message_post()
	{
		$data = array(
			'SENDER_ID' 		=> 'CUSTOMER',
			'ORDER_ID' 			=> $this->input->post('orderID'),
			'MESSAGE' 			=> $this->input->post('message'),
			'MESSAGE_TIME' 		=> date('Y-m-d H:m:s'),
			'USER_READ_FLAG' 	=> '0',
			'ADMIN_READ_FLAG' 	=> '1'
		);

		if ($this->profile->sendMessages($data)) {
			$this->response([
				'status' 		=> 'ok',
				'message' 		=> 'message send',
				'code' 			=> REST_Controller::HTTP_ACCEPTED
			], REST_Controller::HTTP_ACCEPTED);
		} else {
			$this->response([
				'status' 		=> 'error',
				'message' 		=> 'message not sending',
				'code' 			=> REST_Controller::HTTP_BAD_REQUEST
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function profile_get()
	{

		$query = $this->user->getMemberData($this->input->get('email'));

		if ($query->num_rows() > 0) {

			foreach ($query->result() as $data) {

				$dataSess = array(
					'FIRST_NAME' 		=> $data->FIRST_NAME,
					'LAST_NAME' 		=> $data->LAST_NAME,
					'PHONE' 			=> $data->PHONE,
					'PROFILE_PICTURE'	=> $data->IMAGE,
					'EMAIL' 			=> $data->EMAIL,
					'ADDRESS' 			=> $data->ADDRESS,
					'COUNTRY' 			=> $data->COUNTRY,
					'PROVINCE' 			=> $data->PROVINCE,
					'USERID' 			=> $data->ID,
					'ZIP' 				=> $data->ZIP,
					'IMAGE'				=> $data->IMAGE
				);

				$decode = json_encode($dataSess);
			}

			$this->response([
				'status' 		=> 'ok',
				'message' 		=> 'member found',
				'code' 			=> REST_Controller::HTTP_ACCEPTED,
				'data'			=> json_decode($decode)
			], REST_Controller::HTTP_ACCEPTED);
		} else {
			$this->response([
				'status' 		=> 'error',
				'message' 		=> 'no member data',
				'code' 			=> REST_Controller::HTTP_BAD_REQUEST,
				'data'			=> new \stdClass(),
			], REST_Controller::HTTP_BAD_REQUEST);
		}

		// echo $this->db->last_query();
	}

	public function finishorder_post()
	{
		$checkStatus = $this->profile->getFinishedStatus($this->input->post('orderID'));

		if ($checkStatus->num_rows() != 0) {
			foreach ($checkStatus->result() as $status);
			if ($status->STATUS == 'PAID') {
				$this->profile->finishOrder($this->input->post('orderID'));

				$this->response([
					'status' 		=> 'ok',
					'message' 		=> 'transaction finished',
					'code' 			=> REST_Controller::HTTP_ACCEPTED,
				], REST_Controller::HTTP_ACCEPTED);
			} else if ($status->STATUS == 'DONE') {
				$this->response([
					'status' 		=> 'error',
					'message' 		=> 'transaction already done',
					'code' 			=> REST_Controller::HTTP_BAD_REQUEST,
				], REST_Controller::HTTP_BAD_REQUEST);
			} else {
				$this->response([
					'status' 		=> 'error',
					'message' 		=> 'transaction must be in paid status',
					'code' 			=> REST_Controller::HTTP_BAD_REQUEST,
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		} else {
			$this->response([
				'status' 		=> 'error',
				'message' 		=> 'no transaction found',
				'code' 			=> REST_Controller::HTTP_BAD_REQUEST,
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	//UPDATE MEMBER PHONE AND ADDRESS
	public function profileupdate_post()
	{
		$idQuery = $this->user->getMemberbyID($this->input->post('userID'));
		if ($idQuery->num_rows() > 0) {

			if (isset($_FILES['profileImage'])) {
				$config['upload_path'] 		= './img/picture/';
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['file_name'] 		= $this->input->post('userID');
				$config['overwrite']		= TRUE;

				$this->upload->initialize($config);

				$path = $_FILES['profileImage']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);

				$defaultPath = base_url('/img/order/' . $this->input->post('userID') . '.' . $ext);

				if (!$this->upload->do_upload('profileImage')) {
					$this->response([
						'status' 		=> 'error',
						'message' 		=> 'upload process error',
						'code' 			=> REST_Controller::HTTP_BAD_REQUEST,
					], REST_Controller::HTTP_BAD_REQUEST);
				}
			} else {
				$defaultPath = null;
			}

			$data = array(
				'ADDRESS' 		=> $this->input->post('address1'),
				'ADDRESS_2'  	=> $this->input->post('address2'),
				'COUNTRY' 		=> $this->input->post('country'),
				'PROVINCE' 		=> $this->input->post('province'),
				'ZIP' 			=> $this->input->post('zip'),
				'PHONE' 		=> $this->input->post('phone'),
				'IMAGE'			=> $defaultPath
			);

			$query = $this->profile->updateDetails($this->input->post('userID'), $data);

			if ($query) {
				$this->response([
					'status' 		=> 'ok',
					'message' 		=> 'profile updated',
					// 'query'			=> $this->db->last_query(),
					'code' 			=> REST_Controller::HTTP_ACCEPTED
				], REST_Controller::HTTP_ACCEPTED);
			} else {
				$this->response([
					'status' 		=> 'error',
					'message' 		=> 'update error',
					'code' 			=> REST_Controller::HTTP_BAD_REQUEST
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		} else {
			$this->response([
				'status' 		=> 'error',
				'message' 		=> 'no user found',
				'code' 			=> REST_Controller::HTTP_BAD_REQUEST
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	//UPDATE MEMBER PASSWORD
	public function reset_post()
	{

		$regularEmail = $this->input->post('email');

		$queryResult = $this->user->checkExistingEmail($regularEmail);

		if ($queryResult->num_rows() < 0) {
			$this->response([
				'status' 		=> 'error',
				'message' 		=> 'email not found',
				'code' 			=> REST_Controller::HTTP_BAD_REQUEST
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			$id = date('y-m-d-h-m-s');

			$hashID = sha1($id);

			$resetData = array(
				'USER_EMAIL'   => $regularEmail,
				'RESET_ID'    => $hashID,
				'RESET_DATE'	=> $id,
				'RESET_STATUS' => 'ACTIVE'
			);

			$config['protocol']    = 'smtp';
			$config['smtp_host']   = 'mail.kikikuku.com';
			$config['smtp_user']   = 'admin@kikikuku.com';
			$config['smtp_pass']   = 'yMiBWEq=H+NN';
			$config['smtp_port']   = 587;
			$config['charset']     = 'utf-8';
			$config['newline']     = "\r\n";
			$config['wordwrap']    = TRUE;
			$config['mailtype']    = 'html';

			$this->email->initialize($config);

			$this->email->from('admin@kikikuku.com', 'Kikikuku Team');
			$this->email->to($regularEmail);
			$this->email->set_mailtype('html');

			$message = $this->load->view('email-template/reset-password', $resetData, true);

			$this->email->subject('Please confirm your email address');
			$this->email->message($message);

			if ($this->email->send()) {
				$this->user->sentResetPassword($resetData);

				$this->response([
					'status' 		=> 'ok',
					'message' 		=> 'reset email sent',
					'code' 			=> REST_Controller::HTTP_ACCEPTED
				], REST_Controller::HTTP_ACCEPTED);
			} else {
				$this->response([
					'status' 		=> 'error',
					'message' 		=> 'email cannot be send',
					'code' 			=> REST_Controller::HTTP_BAD_GATEWAY
				], REST_Controller::HTTP_BAD_GATEWAY);
			}
		}
	}



	//UPLOAD PAYMENT PROOF
	// public function payment_post()
	// {
	// 	$messageData = $this->profile->getPaymentProcess($this->input->post('orderID'));

	// 	if ($messageData->num_rows() > 0) {

	// 		$config['upload_path'] 		= './img/order/';
	// 		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
	// 		$config['file_name'] 		= $this->input->post('orderID');

	// 		$this->load->library('upload', $config);

	// 		//GET THE FILE EXTENSION FOR SAVING THE DATA TO DATABASE
	// 		$path = $_FILES['paymentImage']['name'];
	// 		$ext = pathinfo($path, PATHINFO_EXTENSION);

	// 		$defaultPath = '/img/order/' . $this->input->post('orderID') . '.' . $ext;

	// 		if (!$this->upload->do_upload('paymentImage')) {

	// 			$this->response([
	// 				'status' 		=> 'error',
	// 				'message' 		=> 'payment process error',
	// 				'code' 			=> REST_Controller::HTTP_BAD_REQUEST
	// 			], REST_Controller::HTTP_BAD_REQUEST);
	// 		} else {

	// 			$data = array(
	// 				'ORDER_ID'        => $this->input->post('orderID'),
	// 				'ACCOUNT_NAME'    => $this->input->post('accountName'),
	// 				'ACCOUNT_NUMBER'  => $this->input->post('accountNumber'),
	// 				'ACCOUNT_BANK'    => $this->input->post('bankName'),
	// 				'PAYMENT_AMOUNT'  => $this->input->post('paymentAmount'),
	// 				'PAYMENT_DATE'    => date('Y-m-d H:m:s'),
	// 				'PAYMENT_IMAGE'   => $defaultPath,
	// 				'FLAG'            => '1'
	// 			);

	// 			$query1 = $this->profile->insertImageData($data);
	// 			$query2 = $this->profile->updatePaymentStatus($this->input->post('orderID'));

	// 			if ($query1 && $query2) {
	// 				$this->response([
	// 					'status' 		=> 'ok',
	// 					'message' 		=> 'payment process completed',
	// 					'code' 			=> REST_Controller::HTTP_ACCEPTED,
	// 				], REST_Controller::HTTP_ACCEPTED);
	// 			} else {
	// 				$this->response([
	// 					'status' 		=> 'error',
	// 					'message' 		=> 'payment process not completed',
	// 					'code' 			=> REST_Controller::HTTP_BAD_GATEWAY,
	// 				], REST_Controller::HTTP_BAD_GATEWAY);
	// 			}

	// 			// echo $this->db->last_query();

	// 		}
	// 	} else {
	// 		$this->response([
	// 			'status' 		=> 'error',
	// 			'message' 		=> 'invalid order ID',
	// 			'code' 			=> REST_Controller::HTTP_BAD_REQUEST
	// 		], REST_Controller::HTTP_BAD_REQUEST);
	// 	}
	// } 

	public function saveCardData_post()
	{
		$cardNumber     = $this->input->post('number');
		$cardExpMonth   = $this->input->post('expmonth');
		$cardExpYear    = $this->input->post('expyear');

		$midClientKey	= 'SB-Mid-client-vspx1jtt782dSdFs';

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/card/register?" . 'card_number=' . $cardNumber . '&card_exp_month=' . $cardExpMonth . '&card_exp_year=' . $cardExpYear . '&client_key=' . $midClientKey,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Accept: application/json",
				"Content-Type: application/json",
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$convertJson 	= json_decode($response, true);

		if ($convertJson['status_code'] == '400') {

			$this->response([
				'status' 		=> 'error',
				'message' 		=> $convertJson['validation_messages'],
				'result'		=> 'payment process started',
				'code' 			=> REST_Controller::HTTP_ACCEPTED
			], REST_Controller::HTTP_ACCEPTED);
		} else {
			$this->response([
				'status' 		=> 'success',
				'message' 		=> $convertJson,
				'result'		=> 'payment process started',
				'code' 			=> REST_Controller::HTTP_ACCEPTED
			], REST_Controller::HTTP_ACCEPTED);
		}
	}

	public function chargeCardData_post()
	{
		$detailsQuery = $this->profile->getOrderDetails($this->input->post('orderID'));
		$queryUser    = $this->profile->getDetailFromOrderNo($this->input->post('orderID'));
		$detailCounter = 0;
		$finalPrice = 0;

		foreach ($queryUser->result() as $master) {

			$billingName = explode(" ", $master->MEMBER_NAME, 2);

			$billingArray = array(
				'first_name'	=> (isset($billingName[0]) ? $billingName[0] : ''),
				'last_name'		=> (isset($billingName[1]) ? $billingName[1] : ''),
				'email'			=> $master->MEMBER_EMAIL,
				'phone'			=> $master->MEMBER_PHONE,
				'address'		=> $master->ADDRESSO_1 . ' ' . $master->ADDRESSO_2,
				'city'			=> $master->STATE
			);

			$shippingArray = array(
				'first_name'	=> $master->FIRST_NAME,
				'last_name'		=> $master->LAST_NAME,
				'email'			=> $master->EMAIL,
				'phone'			=> $master->PHONE,
				'address'		=> $master->ADDRESS_2 . ' ' . $master->ADDRESS_2,
				'city'			=> $master->PROVINCE,
				'postal_code'	=> $master->ZIP,
				'country_code'	=> 'IDN'
			);

			$jsonBilling  = json_encode($billingArray);
			$jsonShipping = json_encode($shippingArray);

			$customerDetails = array(
				'first_name'		=> $master->FIRST_NAME,
				'last_name'			=> $master->LAST_NAME,
				'email'				=> $master->MEMBER_EMAIL,
				'phone'				=> $master->MEMBER_PHONE,
				'billing_address'	=> json_decode($jsonBilling),
				'shipping_address'	=> json_decode($jsonShipping)
			);
		}

		$customerDecode = json_encode($customerDetails);

		foreach ($detailsQuery->result() as $detail) {

			$tmpArray[$detailCounter++] = array(
				'id'			=> $detail->PRODUCT_ID,
				'price'			=> round($detail->PRODUCT_FINAL_PRICE),
				'quantity'		=> $detail->PRODUCT_QUANTITY,
				'name'			=> substr($detail->PRODUCT_NAME, 0, 50),
				'brand'			=> 'Kikikuku',
				'merchant_name'	=> 'Kikikuku'
			);

			$finalPrice = $finalPrice + round($detail->PRODUCT_FINAL_PRICE);
			$detailDecode = json_encode($tmpArray);
		}

		$randomSalt = md5(uniqid(rand(), true));
		$salt = substr($randomSalt, 0, PAYMENT_KEY_LENGTH);

		$transDetails = array(
			'order_id'		=> $this->input->post('orderID') . '-' . $salt,
			'gross_amount'	=> round($master->AMOUNT),
		);

		$transDecode = json_encode($transDetails);

		$callbackDetails = array(
			'finish'	=> base_url('API/completePayment?process=payment&status=complete&key=c549303dcef12a687e9077a21e1a51fb67851efb')
		);

		$callbackDecode = json_encode($callbackDetails);

		$expiredDetail = array(
			'start_time'	=> date('Y-m-d H:m:s') . ' +0700',
			'unit'			=> "hour",
			'duration'		=> 1
		);

		$expiredDecode = json_encode($expiredDetail);

		$mainArray = array(
			"payment_type"			=> 'credit_card',
			"transaction_details"   => json_decode($transDecode),
			"credit_card"			=> array(
				"token_id"			=> $this->input->post('token')
			),
			"item_details"     		=> json_decode($detailDecode),
			"customer_details"      => json_decode($customerDecode),
			"callbacks"				=> json_decode($callbackDecode),
			"enabled_payments"		=> json_decode($transDecode),
			"expiry"				=> json_decode($expiredDecode),
		);

		// echo $finalPrice;
		$mainDecode = json_encode($mainArray);

		// DEBUG DATA
		// $this->response([
		// 	'status' 		=> 'success',
		// 	'message' 		=> json_decode($mainDecode),
		// 	'result'		=> 'payment process started',
		// 	'code' 			=> REST_Controller::HTTP_ACCEPTED
		// ], REST_Controller::HTTP_ACCEPTED);

		$authString = base64_encode('SB-Mid-server-dnzrb0MnkTKZDxEJ5v5w203I:');

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/charge",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $mainDecode,
			CURLOPT_HTTPHEADER => array(
				"Authorization: Basic " . $authString,
				"Content-Type: application/json"
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$convertJson = json_decode($response, true);

		$this->response([
			'status' 		=> 'success',
			'message' 		=> $convertJson,
			'result'		=> 'payment process started',
			'code' 			=> REST_Controller::HTTP_ACCEPTED
		], REST_Controller::HTTP_ACCEPTED);
	}

	public function startPayment_post()
	{
		$detailsQuery = $this->profile->getOrderDetails($this->input->post('orderID'));
		$queryUser    = $this->profile->getDetailFromOrderNo($this->input->post('orderID'));
		$detailCounter = 0;
		$finalPrice = 0;

		foreach ($queryUser->result() as $master) {

			$billingName = explode(" ", $master->MEMBER_NAME, 2);

			$billingArray = array(
				'first_name'	=> (isset($billingName[0]) ? $billingName[0] : ''),
				'last_name'		=> (isset($billingName[1]) ? $billingName[1] : ''),
				'email'			=> $master->MEMBER_EMAIL,
				'phone'			=> $master->MEMBER_PHONE,
				'address'		=> $master->ADDRESSO_1 . ' ' . $master->ADDRESSO_2,
				'city'			=> $master->STATE
			);

			$shippingArray = array(
				'first_name'	=> $master->FIRST_NAME,
				'last_name'		=> $master->LAST_NAME,
				'email'			=> $master->EMAIL,
				'phone'			=> $master->PHONE,
				'address'		=> $master->ADDRESS_2 . ' ' . $master->ADDRESS_2,
				'city'			=> $master->PROVINCE,
				'postal_code'	=> $master->ZIP,
				'country_code'	=> 'IDN'
			);

			$jsonBilling  = json_encode($billingArray);
			$jsonShipping = json_encode($shippingArray);

			$customerDetails = array(
				'first_name'		=> $master->FIRST_NAME,
				'last_name'			=> $master->LAST_NAME,
				'email'				=> $master->MEMBER_EMAIL,
				'phone'				=> $master->MEMBER_PHONE,
				'billing_address'	=> json_decode($jsonBilling),
				'shipping_address'	=> json_decode($jsonShipping)
			);
		}

		$customerDecode = json_encode($customerDetails);

		foreach ($detailsQuery->result() as $detail) {

			$tmpArray[$detailCounter++] = array(
				'id'			=> $detail->PRODUCT_ID,
				'price'			=> round($detail->PRODUCT_FINAL_PRICE),
				'quantity'		=> $detail->PRODUCT_QUANTITY,
				'name'			=> substr($detail->PRODUCT_NAME, 0, 50),
				'brand'			=> 'Kikikuku',
				'merchant_name'	=> 'Kikikuku'
			);

			$finalPrice = $finalPrice + round($detail->PRODUCT_FINAL_PRICE);
			$detailDecode = json_encode($tmpArray);
		}

		$randomSalt = md5(uniqid(rand(), true));
		$salt = substr($randomSalt, 0, PAYMENT_KEY_LENGTH);

		$transDetails = array(
			'order_id'		=> $this->input->post('orderID') . '-' . $salt,
			'gross_amount'	=> round($master->AMOUNT),
		);

		$transDecode = json_encode($transDetails);

		$callbackDetails = array(
			'finish'	=> base_url('API/completePayment?process=payment&status=complete&key=c549303dcef12a687e9077a21e1a51fb67851efb')
		);

		$callbackDecode = json_encode($callbackDetails);

		$expiredDetail = array(
			'start_time'	=> date('Y-m-d H:m:s') . ' +0700',
			'unit'			=> "hour",
			'duration'		=> 1
		);

		$expiredDecode = json_encode($expiredDetail);

		$serverKey = 'SB-Mid-server-dnzrb0MnkTKZDxEJ5v5w203I';
		$authString = base64_encode($serverKey . ':');

		$mainArray = array(
			"transaction_details"   => json_decode($transDecode),
			"item_details"     		=> json_decode($detailDecode),
			"customer_details"      => json_decode($customerDecode),
			"callbacks"				=> json_decode($callbackDecode),
			"enabled_payments"		=> json_decode($transDecode),
			"expiry"				=> json_decode($expiredDecode),
		);

		// echo $finalPrice;
		$mainDecode = json_encode($mainArray);

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://app.sandbox.midtrans.com/snap/v1/transactions",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $mainDecode,
			CURLOPT_HTTPHEADER => array(
				"Authorization: Basic " . $authString,
				"Content-Type: application/json"
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$convertJson = json_decode($response, true);

		$this->response([
			'status' 		=> 'success',
			'message' 		=> $convertJson,
			'result'		=> 'payment process started',
			'code' 			=> REST_Controller::HTTP_ACCEPTED
		], REST_Controller::HTTP_ACCEPTED);
	}

	//TRANSACTION STATUS 
	public function transaction_get()
	{
		$email 			= $this->input->get('email');
		$status 		= $this->input->get('status_order');
		$counterMaster 	= 0;

		if ($status != null) {
			$transData 	= $this->profile->getOrderMasterData($email, $status);
		} else {
			$transData 	= $this->profile->getAllOrderMasterData($email);
		}

		if ($transData->num_rows() > 0) {
			$masterArr  = array();
			foreach ($transData->result() as $data) {

				$counterDetail 	= 0;
				$details = $this->profile->getOrderHistoryDetails($email, $data->ORDER_NO);

				$transArr 	= array();

				foreach ($details->result() as $detail) {

					if ($detail->PRODUCT_NAME != null) {
						$productName 	= $detail->PRODUCT_NAME;
						$productImage 	= $detail->PRODUCT_IMAGE;
					} else {
						$productName 	= '';
						$productImage 	= '';
					}

					if ($detail->PRODUCT_FINAL_PRICE != null) {
						$finalPrice = $detail->PRODUCT_FINAL_PRICE;
					} else {
						$finalPrice = '';
					}

					if ($detail->PRODUCT_QUANTITY != null) {
						$finalQty = $detail->PRODUCT_QUANTITY;
					} else {
						$finalQty = '';
					}

					if ($detail->PRODUCT_NOTES != null) {
						$finalNotes = $detail->PRODUCT_NOTES;
					} else {
						$finalNotes = '';
					}

					if ($detail->TOTAL_ORDER != null) {
						$totalOrder = $detail->TOTAL_ORDER;
					} else {
						$totalOrder = '';
					}

					$transArr[$counterDetail] = array(
						'product_name' 		=> $productName,
						'product_image' 	=> $productImage,
						'product_price' 	=> $finalPrice,
						'product_quantity' 	=> $finalQty,
						'product_notes' 	=> $finalNotes,
						'product_total' 	=> $totalOrder,
					);

					$counterDetail++;
					$detailDecode = json_encode($transArr);
				}

				if ($data->ORDER_DATE != null) {
					$orderDate = $data->ORDER_DATE;
				} else {
					$orderDate = '';
				}

				if ($data->ORDER_NO != null) {
					$orderNo = $data->ORDER_NO;
				} else {
					$orderNo = '';
				}

				if ($data->AMOUNT != null) {
					$orderAmount = $data->AMOUNT;
				} else {
					$orderAmount = '';
				}

				if ($data->STATUS_ORDER != null) {
					$orderStatus = $data->STATUS_ORDER;
				} else {
					$orderStatus = '';
				}

				if ($data->TOTAL_POSTAGE != null) {
					$orderPostage = $data->TOTAL_POSTAGE;
				} else {
					$orderPostage = '';
				}


				$masterArr[$counterMaster] = array(
					'order_date'    	=> $orderDate,
					'order_no'	    	=> $orderNo,
					'order_total'   	=> $orderAmount,
					'order_status'  	=> $orderStatus,
					'order_shipping' 	=> $orderPostage,
					'order_detail' 		=> json_decode($detailDecode)
				);

				$counterMaster++;
			}

			$transDecode = json_encode($masterArr);

			$this->response([
				'status' 		=> 'ok',
				'message' 		=> $transData->num_rows() . ' transaction found',
				'code' 			=> REST_Controller::HTTP_ACCEPTED,
				'transaction' 	=> json_decode($transDecode)
			], REST_Controller::HTTP_ACCEPTED);
		} else {

			$this->response([
				'status' 		=> 'ok',
				'message' 		=> new \stdClass(),
				'code' 			=> REST_Controller::HTTP_ACCEPTED,
				'transaction' 	=> '0'
			], REST_Controller::HTTP_ACCEPTED);
		}
	}

	//DEBUG GET ALL MEMBER
	public function register_get()
	{

		$data = $this->api->getMembers()->result();
		$count = $this->api->getMembers()->num_rows();

		$this->response([
			'status' => 'success',
			'total' => $count,
			'message' => $data
		], REST_Controller::HTTP_ACCEPTED);
	}

	//REGISTER USER
	public function register_post()
	{

		/* POST API PARAMETER */
		$fName 		= $this->input->post('firstName');
		$lName 		= $this->input->post('lastName');
		$phone 		= $this->input->post('phone');
		$email 		= $this->input->post('email');
		$country 	= $this->input->post('country');
		$address1 	= $this->input->post('address1');
		$address2 	= $this->input->post('address2');
		$password   = $this->input->post('password');
		$zip 		= $this->input->post('zip');
		/* FORMAT BUAT TANGGAL HARUS STRING DD/MM/YYYY */
		$date 		= $this->input->post('birthdate');
		$state 		= $this->input->post('province');
		$type 		= $this->input->post('type');

		//CHECK IF THE EMAIL IS ALREADY REGISTERED OR NOT
		$checkEmail = $this->api->checkExistingEmail($email);

		if ($checkEmail->num_rows() > 0) {

			$this->response([
				'status' 		=> 'error',
				'message' 		=> 'user already exists',
				'code' 			=> REST_Controller::HTTP_BAD_REQUEST
			], REST_Controller::HTTP_BAD_REQUEST);
		} else if ($fName == null || $lName == null || $phone == null || $email == null || $country == null || $address1 == null || $address2 == null || $password == null || $state == null || $zip == null) {
			$this->response([
				'status' 		=> 'error',
				'message' 		=> 'cannot use empty value',
				'code' 			=> REST_Controller::HTTP_BAD_REQUEST
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {

			$hashPassword = sha1($password);
			$hashEmail = sha1($email);

			$formatDate = strtotime($date);

			$data = array(
				'FIRST_NAME' 	=> $fName,
				'LAST_NAME' 	=> $lName,
				'JOIN_DATE' 	=> date("Y/m/d h:i:s"),
				'BIRTH_DATE' 	=> date('Y-m-d', $formatDate),
				'PHONE' 		=> $phone,
				'ADDRESS' 		=> $address1,
				'ADDRESS_2' 	=> $address2,
				'COUNTRY' 		=> $country,
				'PROVINCE' 		=> $state,
				'ZIP' 			=> $zip,
				'EMAIL' 		=> $email,
				'PASSWORD' 		=> $hashPassword,
				'STATUS' 		=> 'PENDING',
				'HASH' 			=> $hashEmail,
				'MEMBER_TYPE'	=> $type
			);

			$query = $this->api->insertMember($data);

			if (!$query) {

				$data['email'] = $email;
				$data['hash'] = sha1($email);

				//Disable this for debug only
				//$this->load->view('email-template/verification-email', $data);
				$config['smtp_user']   = 'admin@kikikuku.com';
				$config['smtp_pass']   = 'nOX-D8NlrF#Z';
				$config['smtp_port']   = 25;
				$config['charset']     = 'utf-8';
				$config['wordwrap']    = TRUE;
				$config['mailtype']    = 'html';

				$this->email->initialize($config);

				$this->email->from('admin@kikikuku.com', 'Kikikuku Team');
				$this->email->to($email);
				$this->email->set_mailtype('html');

				$message = $this->load->view('email-template/verification-email', $data, true);

				$this->email->subject('Please confirm your email address');
				$this->email->message($message);

				$this->email->send();

				$this->response([
					'status' 	=> 'success',
					'message' 	=> 'registration successful',
					'code' 		=> REST_Controller::HTTP_ACCEPTED
				], REST_Controller::HTTP_ACCEPTED);
			} else {
				$this->response([
					'status' 	=> 'success',
					'message' 	=> 'registration successful',
					'code' 		=> REST_Controller::HTTP_ACCEPTED
				], REST_Controller::HTTP_ACCEPTED);
			}
		}
	}

	public function checkEmail_post()
	{

		$email  	= $this->input->post('email');
		$checkEmail = $this->api->checkExistingEmail($email);

		if ($checkEmail->num_rows() > 0) {

			$this->response([
				'status' 		=> 'success',
				'message' 		=> 'user already exists',
				'result'		=> 'user found',
				'code' 			=> REST_Controller::HTTP_ACCEPTED
			], REST_Controller::HTTP_ACCEPTED);
		} else {

			$this->response([
				'status' 		=> 'success',
				'message' 		=> 'no user found, register now',
				'result'		=> 'register user',
				'code' 			=> REST_Controller::HTTP_BAD_REQUEST
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function convert_get()
	{

		// AUTH_STRING = Base64("VT-server-Cpo03kYDOc0cNUKgt6hnLkKg:")
	}


	public function login_post()
	{
		$email = trim($this->input->post('email'));
		$password = $this->input->post('password');
		$loginType = $this->input->post('type');

		if ($loginType == '1') {

			$userQuery = $this->user->getMemberData($email);
			if ($userQuery->num_rows() == 0) {

				$this->response([
					'status' 	=> 'error',
					'message' 	=> "no account found",
					'code' 		=> REST_Controller::HTTP_BAD_REQUEST,
					'user_data' => new \stdClass(),
				], REST_Controller::HTTP_BAD_REQUEST);
			} else {

				foreach ($userQuery->result() as $data) {
					$dataSess = array(
						'FIRST_NAME' => $data->FIRST_NAME,
						'LAST_NAME' => $data->LAST_NAME,
						'PHONE' => $data->PHONE,
						'EMAIL' => $data->EMAIL,
						'ADDRESS' => $data->ADDRESS,
						'ADDRESS_2'  => $data->ADDRESS_2,
						'COUNTRY' => $data->COUNTRY,
						'PROVINCE' => $data->PROVINCE,
						'USERID' => $data->ID,
						'ZIP' => $data->ZIP,
						'LOGGED_IN' => TRUE,
						'TYPE'  => $data->MEMBER_TYPE
					);
				}

				$encode = json_encode($dataSess);

				$this->response([
					'status' 	=> 'success',
					'message' 	=> "success login with google",
					'code' 		=> REST_Controller::HTTP_ACCEPTED,
					'user_data' => json_decode($encode),
				], REST_Controller::HTTP_ACCEPTED);
			}
		} else if ($loginType == '2') {

			if (strlen($password) == 0) {
				$this->response([
					'status' 	=> 'error',
					'message' 	=> "password cannot be empty",
					'code' 		=> REST_Controller::HTTP_BAD_REQUEST,
					'user_data' => new \stdClass(),
				], REST_Controller::HTTP_BAD_REQUEST);
			} else {

				//Check if password is correct
				$checkPassword = $this->user->checkPassword($email, $password);

				if ($checkPassword->num_rows() == 0) {
					$this->response([
						'status'   => 'error',
						'message'   => "wrong password",
						'code'     => REST_Controller::HTTP_BAD_REQUEST,
						'user_data' => new \stdClass(),
					], REST_Controller::HTTP_BAD_REQUEST);
				} else {

					$checkVerified = $this->user->checkVerified($email);

					if ($checkVerified->num_rows() == 0) {

						$this->response([
							'status'   => 'error',
							'message'   => "this account is not verified",
							'code'     => REST_Controller::HTTP_BAD_REQUEST,
							'user_data' => new \stdClass(),
						], REST_Controller::HTTP_BAD_REQUEST);
					} else {
						foreach ($checkPassword->result() as $data) {

							$dataSess = array(
								'FIRST_NAME' => $data->FIRST_NAME,
								'LAST_NAME' => $data->LAST_NAME,
								'PHONE' => $data->PHONE,
								'EMAIL' => $data->EMAIL,
								'ADDRESS' => $data->ADDRESS,
								'ADDRESS_2'  => $data->ADDRESS_2,
								'COUNTRY' => $data->COUNTRY,
								'PROVINCE' => $data->PROVINCE,
								'USERID' => $data->ID,
								'ZIP' => $data->ZIP,
								'LOGGED_IN' => TRUE,
								'TYPE'  => $data->MEMBER_TYPE
							);
						}

						$encode = json_encode($dataSess);

						$this->response([
							'status'   => 'ok',
							'message'   => "user found",
							'code'     => REST_Controller::HTTP_ACCEPTED,
							'user_data' => json_decode($encode),
						], REST_Controller::HTTP_ACCEPTED);
					}
				}
			}
		} else {
			$this->response([
				'status' 	=> 'error',
				'message' 	=> "invalid login type",
				'code' 		=> REST_Controller::HTTP_BAD_REQUEST,
				'user_data' => new \stdClass(),
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	//Add item to cart
	public function cart_post()
	{
		$finalUrl   = file_get_contents('http://en.yiwugo.com/ywg/productdetail.html?account=Wien.suh@gmail.com&productId=' . $this->input->post('product-id'));
		$obj 		= json_decode($finalUrl, true);

		$totalQty = 0;
		$hashID = sha1($this->input->post('product-buyer'));

		$itemArray = array(
			'CART_ID' 			=> $hashID,
			'PRODUCT_ID' 		=> $this->input->post('product-id'),
			'PRODUCT_QUANTITY' 	=> $this->input->post('quantity'),
			'PRODUCT_PRICE' 	=> $this->input->post('product-price'),
			'PRODUCT_NAME' 		=> $this->input->post('product-name'),
			'PRODUCT_NOTES' 	=> $this->input->post('customer-notes'),
			'PRODUCT_IMAGES' 	=> $this->input->post('product-images'),
			'PRODUCT_BUYER' 	=> $this->input->post('product-buyer')
		);

		if ($this->input->post('product-name') == null) {
			$this->response([
				'status' 	=> 'error',
				'message' 	=> 'product name cannot be empty',
				'code' 		=> REST_Controller::HTTP_BAD_REQUEST
			], REST_Controller::HTTP_BAD_REQUEST);
		} else if ($this->input->post('quantity') == null) {
			$this->response([
				'status' 	=> 'error',
				'message' 	=> 'quantity cannot be empty',
				'code' 		=> REST_Controller::HTTP_BAD_REQUEST
			], REST_Controller::HTTP_BAD_REQUEST);
		} else if ($this->input->post('product-id') == null) {
			$this->response([
				'status' 	=> 'error',
				'message' 	=> 'product id cannot be empty',
				'code' 		=> REST_Controller::HTTP_BAD_REQUEST
			], REST_Controller::HTTP_BAD_REQUEST);
		} else if ($this->input->post('quantity') <= 0) {
			$this->response([
				'status' 	=> 'error',
				'message' 	=> 'quantity cannot be 0 or lower',
				'code' 		=> REST_Controller::HTTP_BAD_REQUEST
			], REST_Controller::HTTP_BAD_REQUEST);
		} else if ($this->input->post('product-price') == null) {
			$this->response([
				'status' 	=> 'error',
				'message' 	=> 'price cannot be empty',
				'code' 		=> REST_Controller::HTTP_BAD_REQUEST
			], REST_Controller::HTTP_BAD_REQUEST);
		} else if ($this->input->post('product-buyer') == null) {
			$this->response([
				'status' 	=> 'error',
				'message' 	=> 'product buyer cannot be empty',
				'code' 		=> REST_Controller::HTTP_BAD_REQUEST
			], REST_Controller::HTTP_BAD_REQUEST);
		} else if ($obj == null) {
			$this->response([
				'status' 	=> 'error',
				'message' 	=> 'invalid product id',
				'code' 		=> REST_Controller::HTTP_BAD_REQUEST
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {

			//CHECK IF THE ITEM IS EXIST OR NOT
			$itemResult = $this->carts->getItemInfo($this->input->post('product-id'), $this->input->post('product-buyer'));

			if ($itemResult->num_rows() > 0) {

				//DO SOMETHING ELSE
				$currentQty = $itemResult->result()[0]->PRODUCT_QUANTITY;
				$totalQty = $currentQty + $this->input->post('quantity');

				$dataArray = array(
					'PRODUCT_QUANTITY' => $totalQty
				);

				// UPDATE QUANTITY
				$this->carts->updateCartQuantity($dataArray, $this->input->post('product-buyer'), $this->input->post('product-id'));

				$this->response([
					'status' 	=> 'ok',
					'message' 	=> 'cart quantity updated',
					'code' 		=> REST_Controller::HTTP_ACCEPTED
				], REST_Controller::HTTP_ACCEPTED);
			} else {
				$this->carts->insertCartData($itemArray);

				$this->response([
					'status' 	=> 'ok',
					'message' 	=> 'cart inserted',
					'code' 		=> REST_Controller::HTTP_ACCEPTED
				], REST_Controller::HTTP_ACCEPTED);
			}
		}
	}

	//Delete the items
	public function deletecart_post()
	{

		$hashTrans 	= sha1($this->input->post('product-buyer'));
		$productID	= $this->input->post('product-id');

		$queryDelete = $this->carts->deleteCartsAPI($hashTrans, $productID);

		if ($queryDelete) {
			$this->response([
				'status' 	=> 'ok',
				'message' 	=> 'item deleted',
				'code' 		=> REST_Controller::HTTP_OK,
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> 'error',
				'message' 	=> 'item cannot be deleted',
				'code' 		=> REST_Controller::HTTP_BAD_REQUEST,
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	//Update the cart content
	public function updatecart_post()
	{

		$productID 		= $this->input->post('product-id');
		$productBuyer 	= $this->input->post('product-buyer');
		$newQty			= $this->input->post('product-quantity');
		$newNotes		= $this->input->post('product-notes');

		$updateArray = array(
			'PRODUCT_QUANTITY'	=> $newQty,
			'PRODUCT_NOTES'		=> $newNotes
		);

		$updateQuery = $this->carts->updateCartContents($productID, $productBuyer, $updateArray);

		if ($updateQuery) {
			$this->response([
				'status' 	=> 'ok',
				'message' 	=> 'item updated',
				'code' 		=> REST_Controller::HTTP_ACCEPTED,
			], REST_Controller::HTTP_ACCEPTED);
		} else {
			$this->response([
				'status' 	=> 'error',
				'message' 	=> 'item not updated',
				'code' 		=> REST_Controller::HTTP_BAD_REQUEST,
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	//Get the cart content based from email and trans date
	public function cart_get()
	{

		$data = array();

		$hashTrans = sha1($this->input->get('email'));
		$result = $this->carts->displayCart($hashTrans);
		$count = $result->result_array();

		for ($i = 0; $i < count($count); $i++) {

			$finalUrl   = file_get_contents('http://en.yiwugo.com/ywg/productdetail.html?account=Wien.suh@gmail.com&productId=' . $count[$i]['PRODUCT_ID']);
			$obj 		= json_decode($finalUrl, true);

			$data[$i]['prod_id'] 		= $count[$i]['PRODUCT_ID'];
			$data[$i]['quantity'] 		= $count[$i]['PRODUCT_QUANTITY'];
			$data[$i]['prod_image'] 	= $count[$i]['PRODUCT_IMAGES'];
			$data[$i]['price'] 			= $count[$i]['PRODUCT_PRICE'];
			$data[$i]['prod_name'] 		= $count[$i]['PRODUCT_NAME'];
			$data[$i]['notes'] 			= $count[$i]['PRODUCT_NOTES'];
			$data[$i]['email'] 			= $count[$i]['PRODUCT_BUYER'];
			$data[$i]['weight']			= $obj['detail']['productForApp']['weightetc'];

			$flag = $count[$i]['CART_FLAG'];
		}

		$json = json_encode($data);

		if (count($count) > 0) {
			$this->response([
				'status' 	=> 'ok',
				'message' 	=> $result->num_rows() . ' cart item found',
				'cart_id'	=> $hashTrans,
				'cart_flag' => $flag,
				'code' 		=> REST_Controller::HTTP_ACCEPTED,
				'item'      => json_decode($json, true),
			], REST_Controller::HTTP_ACCEPTED);
		} else {
			$this->response([
				'status' 	=> 'ok',
				'message' 	=> 'no cart history found',
				'code' 		=> REST_Controller::HTTP_OK,
				'item'      => $tmpEmpty = array(),
			], REST_Controller::HTTP_OK);
		}
	}

	//Get category
	public function category_get()
	{
		$parentArray	= array();
		$parent 		= $this->category->getParentCategory();
		$parentCounter  = 0;

		if ($this->input->get('category') == null || $this->input->get('category') == '') {
			$parent = $this->category->getParentCategory();
		} else {
			$parent = $this->category->getSingleCategory($this->input->get('category'));
		}

		foreach ($parent->result() as $parents) {

			$childArray 	= array();

			$childCounter 	= 0;
			$childs 		= $this->category->getChildCategory($parents->ID);

			foreach ($childs->result() as $child) {

				$childName 	= $child->NAME;
				$childID	= $child->LINK;

				$childArray[$childCounter] = array(
					'CHILD_NAME'	=> $childName,
					'CHILD_ID'		=> $childID
				);

				$childCounter++;
				$detailDecode = json_encode($childArray);
			}

			$parentArray[$parentCounter] = array(
				'NAME' 		=> $parents->NAME,
				'ID'		=> $parents->ID,
				'PARENT'	=> $parents->PARENT,
				'PICTURE'	=> $parents->PICTURE,
				'CHILD'		=> json_decode($detailDecode)
			);

			$parentCounter++;
		}

		$json = json_encode($parentArray);

		$this->response([
			'status' 		=> 'ok',
			'message' 		=> 'category list',
			'code' 			=> REST_Controller::HTTP_OK,
			'category_list'	=> json_decode($json, true)
		], REST_Controller::HTTP_OK);
	}

	//Create Inquiry
	public function inquiry_post()
	{

		$json = file_get_contents('php://input');
		$parse = json_decode($json);

		$inquiryData = array();
		$itemData	 = array();
		$counter     = 1;
		$genID       = $this->carts->generateID();

		$emailQuery = $this->api->checkExistingEmail($parse->member_email);

		if ($emailQuery->num_rows() == 0) {
			$this->response([
				'status' 		=> 'ok',
				'message' 		=> "invalid user email",
				'code' 			=> REST_Controller::HTTP_BAD_REQUEST,
			], REST_Controller::HTTP_BAD_REQUEST);
		}

		if ($parse->member_id == null || $parse->total_price == null || $parse->member_name == null || $parse->member_email == null || $parse->member_phone == null || $parse->member_address_1 == null || $parse->member_address_2 == null || $parse->member_country == null || $parse->member_zip == null || $parse->member_state == null) {

			$this->response([
				'status' 		=> 'error',
				'message' 		=> "data cannot be empty",
				'code' 			=> REST_Controller::HTTP_BAD_REQUEST,
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {

			$inquiryData['ORDER_NO'] 		 = $genID;
			$inquiryData['ORDER_DATE'] 		 = date('Y-m-d h:i:s');
			$inquiryData['MEMBER_ID'] 		 = $parse->member_id;
			$inquiryData['TOTAL_ORDER']  	 = $parse->total_price;
			$inquiryData['MEMBER_NAME'] 	 = $parse->member_name;
			$inquiryData['MEMBER_EMAIL'] 	 = $parse->member_email;
			$inquiryData['MEMBER_PHONE'] 	 = $parse->member_phone;
			$inquiryData['ADDRESS_1'] 		 = $parse->member_address_1;
			$inquiryData['ADDRESS_2'] 	 	 = $parse->member_address_2;
			$inquiryData['COUNTRY'] 	 	 = $parse->member_country;
			$inquiryData['ZIP'] 		 	 = $parse->member_zip;
			$inquiryData['STATE'] 	 		 = $parse->member_state;
			$inquiryData['STATUS'] 	 		 = 'NEW ORDER';
			$inquiryData['UPDATED'] 	 	 = date('Y-m-d h:i:s');
			$inquiryData['SAVE_FLAG'] 	 	 = 0;

			foreach ($parse->items as $item) {

				$itemData['FLAG']			= '1';
				$itemData['ORDER_NO']		= $genID;
				$itemData['PROD_NAME']		= $item->prod_name;
				$itemData['PROD_IMAGE']		= $item->prod_image;
				$itemData['PROD_ID']		= $item->prod_id;
				$itemData['QUANTITY']		= $item->quantity;
				$itemData['WEIGHT']			= $item->weight;
				$itemData['PRICE']			= $item->price;
				$itemData['FINAL_PRICE']	= $item->final_price;
				$itemData['POSTAGE']		= '0';
				$itemData['NOTES']			= $item->notes;

				$hashTrans = sha1($parse->member_email);
				$productID = $item->prod_id;

				$this->carts->updateCartFlag($productID, $hashTrans);
				$this->carts->insertOrderDetail($itemData);

				$counter++;
			}
		}

		$emailQuery = $this->api->checkExistingEmail($inquiryData['MEMBER_EMAIL']);

		if ($emailQuery->num_rows() > 0) {

			$json  = json_encode($inquiryData);
			$items = json_encode($itemData);

			$query1 = $this->carts->insertMasterData($inquiryData);

			if ($query1) {
				$this->response([
					'status' 		=> 'ok',
					'message' 		=> "data inserted",
					'generated_id'	=> $genID,
					'code' 			=> REST_Controller::HTTP_ACCEPTED,
				], REST_Controller::HTTP_ACCEPTED);
			} else {

				$this->response([
					'status' 		=> 'error',
					'message' 		=> "data not inserted",
					'code' 			=> REST_Controller::HTTP_BAD_REQUEST,
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		} else {

			$this->response([
				'status' 		=> 'error',
				'message' 		=> "email does not exist",
				'code' 			=> REST_Controller::HTTP_BAD_REQUEST,
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	//Get Margin Parameter
	public function margin_get()
	{

		$margin 	= $this->api->getMarginParam();
		$convert 	= $this->api->getConvertRate();

		$this->response([
			'status' 		=> 'ok',
			'message' 		=> "current margin value",
			'code' 			=> REST_Controller::HTTP_ACCEPTED,
			'margin_param'	=> $margin,
			'convert_rate'  => $convert,
		], REST_Controller::HTTP_ACCEPTED);
	}

	//Get all user inquiry
	public function inquiry_get()
	{
	}

	//Verified Account
	public function verification_get()
	{

		$hash = $this->input->get('hash');
		$email = $this->input->get('email');

		$query = $this->api->verifyMember($hash);

		if ($query->num_rows() > 0) {

			$update = $this->api->updateStatus($email);

			if ($update) {
				//Account Verified
				$this->response([
					'status' 	=> 'success',
					'message' 	=> 'account verified',
					'code' 		=> REST_Controller::HTTP_ACCEPTED
				], REST_Controller::HTTP_ACCEPTED);
			} else {
				//Verification Error
				$this->response([
					'status' 	=> 'error',
					'message' 	=> 'bad request',
					'code' 		=> REST_Controller::HTTP_BAD_REQUEST
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		} else {
			//Account already verified
			$this->response([
				'status' 	=> 'verified',
				'message' 	=> 'this account is already verified',
				'code' 		=> REST_Controller::HTTP_ACCEPTED
			], REST_Controller::HTTP_ACCEPTED);
		}
	}
}
