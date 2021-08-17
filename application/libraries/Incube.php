<?php defined('BASEPATH') or exit('No direct script access allowed');

class Incube
{

	public function __construct()
	{

		$this->CI = &get_instance();
		$this->CI->load->model('M_product', 'product');
	}

	public function basicAuth()
	{
		if (!isset($_GET['key']) || strlen($_GET['key']) == 0) {

			$msg = array(
				'code'      => 401,
				'status'    => 200,
				'message'   => 'invalid user',
			);
			return json_encode($msg);
			exit; // Be safe and ensure no other content is returned.
		}

		if ($_GET['key'] == API_KEY) {
			$msg = array(
				'code'      => 200,
				'status'    => 200,
				'message'   => 'access granted',
			);

			return json_encode($msg);
		} else {
			$msg = array(
				'code'      => 401,
				'status'    => 200,
				'message'   => 'incorrect key',
			);


			return json_encode($msg);
		}
	}

	public function generateID($length)
	{
		$randomSalt = md5(uniqid(rand(), true));
		$salt = substr($randomSalt, 0, $length);

		return $salt;
	}

	public function replaceLink($url)
	{

		if ((substr($url, 0, 1) == '/' && (substr($url, 6, 1) == '/')) ||
			(substr($url, 0, 1) == 'i' && (substr($url, 4, 1) == '/')) ||
			(substr($url, 0, 1) == 'i' && (substr($url, 6, 1) == '0')) ||
			(substr($url, 0, 1) == '/' && (substr($url, 5, 1) == '/'))
		) {
			$newPath = 'http://img1.yiwugou.com/';
		} else if ((substr($url, 0, 1) == '/' && (substr($url, 6, 1) != '/')) ||
			(substr($url, 1, 1) != 'i' && (substr($url, 6, 1) != '/'))
		) {
			$newPath = 'http://img1.yiwugou.com/i000';
		} else if (substr($url, 0, 4) == 'http') {
			$newPath = '';
		}
		return $newPath;
	}

	public function setPrice($convertRate, $marginParameter, $sellPrice)
	{

		//FORMAT THE PRICE 
		$initialPrice =  $sellPrice / 100;

		//Times the price to the convert rate
		$convertPrice = $initialPrice * $convertRate;

		//Get margin parameter
		$marginPrice = $convertPrice * $marginParameter;

		//Set the final price
		$finalPrice = $convertPrice + $marginPrice;

		//Round the Price
		$price = ceil($finalPrice);

		return $price;
	}

	public function getCorrectPrice($convertRate, $marginParameter, $items, $productList)
	{

		//Item Quantity
		$totalItems = $items;
		$data = array();

		//Loop through each pricelist for correct value
		foreach ($productList as $quantity) {

			if ($quantity['endNumber'] == 0 || $quantity['endNumber'] == 1 || ($quantity['startNumber'] > $quantity['endNumber'])) {
				$finalQty = $quantity['startNumber'] + 999999;
			} else {
				$finalQty = $quantity['endNumber'];
			}

			if ($totalItems >= $quantity['startNumber'] && $totalItems <= $finalQty) {

				$data['price'] 		= $this->setPrice($convertRate, $marginParameter, $quantity['sellPrice']);
				$data['start']		= $quantity['startNumber'];
				$data['end']		= $quantity['endNumber'];
			}
		}

		return $data;
	}

	public function changeItemMatric($matrics)
	{

		//CONVERT THE QUANTITY IF IT'S CHINESE SYMBOL
		if ($matrics == '个') {
			$matric = 'Pcs';
		} else if ($matrics == '套') {
			$matric = 'Set';
		} else {
			$matric = $matrics;
		}

		return $matric;
	}

	public function priceNotEmpty($paramOne)
	{

		if (strlen($paramOne) <= 7 || $paramOne != 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getProductList($data)
	{
		$curl = curl_init();

		$urlEndpoint = 'http://app.yiwugo.com/product/2016product/alllisttest.htm?password=wien.suh@gmail.com';
		$params = $data;

		$finalUrl = $urlEndpoint . '&' . http_build_query($params);

		curl_setopt_array($curl, array(
			CURLOPT_URL => $finalUrl,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);

		curl_close($curl);

		return json_decode($response);
	}

	public function getProductDetails($data)
	{
		$curl = curl_init();

		$urlEndpoint = 'http://app.yiwugo.com/product/2016product/onetest.htm?password=wien.suh@gmail.com';
		$params = array(
			'key'	=> $data
		);

		$finalUrl = $urlEndpoint . '&' . http_build_query($params);

		curl_setopt_array($curl, array(
			CURLOPT_URL => $finalUrl,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);

		curl_close($curl);

		return json_decode($response);
	}

	public function priceEmpty($paramOne)
	{

		if (strlen($paramOne) >= 7 || strlen($paramOne) == 0 || $paramOne == 0) {
			return true;
		} else {
			return false;
		}
	}

	public function loginAccount($data)
	{

		$dataSess = array(
			'FIRST_NAME' 	=> $data->FIRST_NAME,
			'LAST_NAME' 	=> $data->LAST_NAME,
			'PHONE' 		=> $data->PHONE,
			'EMAIL' 		=> $data->EMAIL,
			'ADDRESS' 		=> $data->ADDRESS,
			'COUNTRY' 		=> $data->COUNTRY,
			'PROVINCE' 		=> $data->PROVINCE,
			'USERID' 		=> $data->ID,
			'ZIP' 			=> $data->ZIP,
			'IMAGE'			=> $data->IMAGE,
			'LOGGED_IN'		=> TRUE
		);

		$this->CI->session->set_userdata('user_data', $dataSess);
	}

	public function logoutAccount()
	{

		$this->CI->session->unset_userdata('user_data');
		return true;
	}
}
