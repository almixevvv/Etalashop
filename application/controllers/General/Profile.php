<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}

	public function transaction()
	{
		$userData 	 = $this->session->user_data;

		$loginStatus = $userData['LOGGED_IN'];
		$userEmail 	 = $userData['EMAIL'];

		if ($loginStatus == false) {
			$this->session->set_flashdata('cart', 'no_user');
			redirect(base_url('login?refer=profile/transaction'));
		}

		$data['productName'] 	 = 'Transaction History';

		if ($this->input->get('transaction') == null) {
			$data['masterData'] = $this->profiles->getAllOrderMasterData($userEmail);
		} else {
			$status = $this->input->get('transaction');

			if ($status == 'created') {
				$status = 'NEW ORDER';
			}

			$data['masterData'] = $this->profiles->getOrderMasterData($userEmail, $status);
		}

		$data['userHistory'] = $this->profiles->getOrderHistory($userEmail);
		$data['userEmail'] 	 = $this->session->userdata('EMAIL');
		$data['counter']	 = 1;

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/profile/transaction', $data);
		$this->load->view('templates/footer');
	}

	public function myprofile()
	{

		$data['productName'] 	 = 'My Profile';

		$userData 	 = $this->session->user_data;

		$loginStatus = $userData['LOGGED_IN'];
		$userEmail 	 = $userData['EMAIL'];

		if ($loginStatus == false) {
			$this->session->set_flashdata('cart', 'no_user');
			redirect(base_url('login?refer=profile/transaction'));
		}

		$data['memberDetails'] = $this->user->getMemberData($userEmail);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/profile/profile', $data);
		$this->load->view('templates/footer');
	}

	public function getMessages()
	{

		$orderID = $this->input->get('id');

		$data['message'] = $this->profile->getOrderMessages($orderID);
		$data['transID'] = $orderID;

		$this->load->view('pages/modal/modal-message', $data);
	}

	public function changePassword()
	{

		$userData = $this->session->userdata('user_data');

		$data['memberDetails'] = $this->api->getGeneralData('g_member', 'EMAIL', $userData['EMAIL']);

		if (isset($userData)) {
			$this->load->view('pages/modal/modal-password', $data);
		} else {
			$this->load->view('pages/home');
		}
	}

	public function updatePassword()
	{
		$userData 			= $this->session->userdata('user_data');
		$old_password		= $this->input->post('old_password');
		$new_password 		= $this->input->post('new_password');
		$confirm_password	= $this->input->post('confirm_password');

		// DATA BUAT DEBUG
		// $old_password = 'Abc123';
		// $new_password = 'nasipadanglovers';
		// $confirm_password = 'nasipadanglovers';

		$queryEmail = $this->api->getGeneralData('g_member', 'EMAIL', $userData['EMAIL']);

		$userSalt   = $queryEmail->row()->SALT;
		$checkPassword  = password_verify($old_password . $userSalt, $queryEmail->row()->PASSWORD);

		//1. Cek password lama, sama atau engga
		if (!$checkPassword) {

			// echo 'kesini 1';
			//1.1 Password lama beda
			$this->session->set_flashdata('password', 'different');
			redirect('profile/myprofile');
			//EoL 1.1
		}
		//EoL 1

		//2. Kalo password sama confirm password, lanjutin prosesnya
		else if ($new_password == $confirm_password) {

			// echo '2';

			//3.1 Generate salt baru
			$salt = sha1($this->incube->generateID('10'));
			//EoL 3.1

			//3.2 Encrypt password baru
			$passHash = password_hash($new_password . $salt, PASSWORD_BCRYPT, array('cost' => 12));

			$data = array(
				'PASSWORD' 	=> $passHash,
				'SALT' 		=> $salt
			);
			//EoL 3.2

			//3.3 Save data baru ke database
			$query = $this->api->updateGeneralData('g_member', 'REC_ID', $userData['REC_ID'], $data);

			if ($query) {
				$this->session->set_flashdata('password', 'success');
				redirect('profile/myprofile');
			} else {
				$this->session->set_flashdata('password', 'unknown_error');
				redirect('profile/myprofile');
			}
			//EoL 3.3

		}
		//EoL 2

		//3. Kalo password lamanya bener, lanjut
		else if ($old_password != $new_password) {

			// echo '3';
			//3.1 Lempar error kalo passwordnya ga sama
			$this->session->set_flashdata('password', 'different');
			redirect('profile/myprofile');
			//EoL 3.1

		}
		//EoL 3

		//4. Kalo ada sesuatu yang salah
		else {

			echo '4';
			//4.1 Lempar error message kalo ada error yang ga kita tahu
			$this->session->set_flashdata('password', 'unknown_error');
			redirect('profile/myprofile');
			//EoL 4.1

		}
		//EoL 4
	}

	public function changePhone()
	{

		$userData = $this->session->userdata('user_data');

		$data['memberDetails'] = $this->api->getGeneralData('g_member', 'EMAIL', $userData['EMAIL']);

		if (isset($userData)) {
			$this->load->view('pages/modal/modal-phone', $data);
		} else {
			$this->load->view('pages/home');
		}
	}

	public function updatePhone()
	{

		$id 	= $this->input->post('id');

		$data = array(
			'PHONE' => $this->input->post('phone'),
		);

		$query = $this->profiles->updatePhone($id, $data);

		if ($query) {
			$this->session->set_flashdata('phone', 'success');
			redirect('profile/myprofile');
		}
	}

	public function changePhoto()
	{
		$userData = $this->session->userdata('user_data');

		$data['memberDetails'] = $this->api->getGeneralData('g_member', 'EMAIL', $userData['EMAIL']);

		if (isset($userData)) {
			$this->load->view('pages/modal/modal-photo', $data);
		} else {
			$this->load->view('pages/home');
		}
	}

	public function updatePhoto()
	{
		$this->load->helper('form');
		$this->load->library('upload');

		$defaultPath = '/assets/images/member-img/' . $_FILES['file_name']['name'];
		$ext = pathinfo($_FILES['file_name']['name'], PATHINFO_EXTENSION);

		$new_name = sha1($_FILES['file_name']['name'] . date('YmdHis'));
		$id = $this->input->post('id');
		$file  = $defaultPath;



		$config['upload_path']   = './assets/images/member-img/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']      = 2048;
		$config['file_name']     = $new_name;


		$file_name = $new_name . "." . $ext;
		$this->profiles->updatePhoto($id, $file_name);

		$this->upload->initialize($config);

		if (!$this->upload->do_upload('file_name')) {
			//echo $this->upload->display_errors();
			$this->session->set_flashdata('photo', 'danger');
			redirect('profile/myprofile'); 
		} else {
			$uploadFile = $this->upload->data();

			$sessQuery = $this->session->userdata('user_data');
			$sessQuery['IMAGE'] = $uploadFile['file_name'];

			$this->session->set_userdata('user_data', $sessQuery);

			redirect('profile/myprofile');
			//$this->set('showModal',true);
		}
	}

	public function changeAddress()
	{
		$userData = $this->session->userdata('user_data');

		$data['memberDetails'] = $this->api->getGeneralData('g_member', 'EMAIL', $userData['EMAIL']);

		if (isset($userData)) {
			$this->load->view('pages/modal/modal-address', $data);
		} else {
			$this->load->view('pages/home');
		}
	}

	public function updateAddress()
	{

		$id	= $this->input->post('id');

		$data = array(
			'ADDRESS' 		=> $this->input->post('add1'),
			'ADDRESS_2'  	=> $this->input->post('add2'),
			'COUNTRY' 		=> $this->input->post('country'),
			'PROVINCE' 		=> $this->input->post('province'),
			'ZIP' 			=> $this->input->post('zip'),
		);

		$query = $this->profiles->updateAddress($id, $data);

		if ($query) {
			$this->session->set_flashdata('address', 'success');
			redirect('profile/myprofile');
		}
	}

	public function customerSendMessages()
	{

		$customerID 	= $this->input->get('sender');
		$transactionID 	= $this->input->get('id');
		$message 		= $this->input->get('message');

		$data = array(
			'SENDER_ID' 		=> 'CUSTOMER',
			'ORDER_ID' 			=> $transactionID,
			'MESSAGE' 			=> $message,
			'MESSAGE_TIME' 		=> date('Y-m-d H:m:s'),
			'USER_READ_FLAG' 	=> '0',
			'ADMIN_READ_FLAG' 	=> '1'
		);

		$this->profile->sendMessages($data);
	}

	public function orderPayment()
	{

		$data['productName'] 	= 'Transaction Payment';

		$data['orderID'] 		= $this->input->post('orderID');
		$data['orderTotal'] 	= $this->input->post('orderTotal');
		$data['transactionID'] 	= $this->input->post('transactionID');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/profile/payment', $data);
		$this->load->view('templates/footer');
	}

	public function manualVerification()
	{

		$data['productName'] 	= 'Transaction Payment';

		$userData 	= $this->session->trans_items;

		if ($userData['orderID'] == null) {
			$data['orderID'] 		= $this->input->post('orderID');
			$data['orderTotal'] 	= $this->input->post('orderTotal');
			$data['transactionID'] 	= $this->input->post('transactionID');

			$transSession = array(
				'ORDER_ID'		=> $this->input->post('orderID'),
				'ORDER_TOTAL'	=> $this->input->post('orderTotal'),
				'TRANS_ID'		=> $this->input->post('transactionID')
			);

			$this->session->set_userdata('trans_items', $transSession);
		} else {
			$data['orderID'] 		= $userData['orderID'];
			$data['orderTotal'] 	= $userData['orderTotal'];
			$data['transactionID'] 	= $userData['transactionID'];
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/profile/payment_process', $data);
		$this->load->view('templates/footer');
	}

	public function finishOrder()
	{
		$orderID = $this->input->post('id');

		if ($this->profile->finishOrder($orderID)) {
			echo 'order closed';
		} else {
			echo 'something is wrong';
		}
	}

	public function history()
	{

		//GET THE PARAMETER FOR QUERY
		$searchQuery = $this->input->get('query');
		$emailQuery  = $this->input->get('id');
		$userEmail	 = $this->session->userdata('EMAIL');

		//SET EACH PARAMETER TO MATCH THE DATABASE
		if ($searchQuery == 'created') {
			$searchQuery = 'NEW ORDER';
		} else {
			strtolower($searchQuery);
		}

		$data['userHistory'] = $this->profile->getOrderHistoryFromQuery($emailQuery, $searchQuery);
		$data['masterData'] = $this->profile->getOrderMasterDataFromQuery($emailQuery, $searchQuery);
		$data['userEmail'] = $this->session->userdata('EMAIL');

		$this->load->view('templates/header');
		$this->load->view('templates/navbar');
		$this->load->view('pages/profile/transaction', $data);
		$this->load->view('templates/footer');
	}
}
