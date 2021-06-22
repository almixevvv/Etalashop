<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Register extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
 
		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('M_user', 'user');
		$this->load->helper('form');
		$this->load->library('email');

		// $this->output->enable_profiler(TRUE);
	}

	public function index()
	{

		$data['sectionName'] = 'Register';

		if ($this->input->get('rid') != null) {

			$flashData = $this->session->userdata();
			$data['socialData']  = array(
				'email'		=> $flashData['google_email'],
				'picture'	=> $flashData['google_picture'],
				'lastName'	=> $flashData['google_familyName'],
				'firstName'	=> $flashData['google_givenName'],
				'id'		=> $flashData['google_id']
			);
		}

		if (isset($flashData)) {

			$user = $this->user->getMemberData($flashData['google_email']);

			if ($user->num_rows() == 0) {
				$this->load->view('templates/header', $data);
				$this->load->view('templates/navbar');
				$this->load->view('pages/account-registration/register', $data);
				$this->load->view('templates/footer');
			} else {
				foreach ($user->result() as $detail);

				$googleArray = array('google_email', 'google_picture', 'google_familyName', 'google_givenName', 'google_id');
				$this->session->unset_userdata($googleArray);
				$this->incube->loginAccount($detail);
				redirect('home');
			}
		} else {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('pages/account-registration/register');
			$this->load->view('templates/footer');
		}
	}

	public function checkExistingEmail()
	{

		$userEmail = $this->input->get('email');

		$userQuery = $this->user->checkExistingEmail($userEmail);

		if ($userQuery->num_rows() > 0) {
			echo "existing";
		} else {
			echo "false";
		}
	}

	public function input()
	{
		$userImage 	= $this->input->post('uImage');
		$fName 		= $this->input->post('uFirstName');
		$lName 		= $this->input->post('uLastName');
		$phone 		= $this->input->post('uPhone');
		$email 		= $this->input->post('uEmail');
		$country 	= $this->input->post('uCountry');
		$address1 	= $this->input->post('uAddress1');
		$address2 	= $this->input->post('uAddress2');
		$password 	= $this->input->post('uPass');
		$state 		= $this->input->post('uProvince');
		$zip 		= $this->input->post('uZip');
		$date 		= $this->input->post('uBirthdate');

		$googleData = $this->session->userdata();
		$this->session->unset_userdata($googleData);

		if (isset($userImage)) {
			$filename = str_replace(".", "_", $this->input->post('uEmail'));
			$filename .= '.jpg';
			$fileLoc = FCPATH . '/img/picture/';
			$fullDirectory = $fileLoc . '/' . $filename;
			copy($this->input->post('uImage'), $fullDirectory);
			$saveDirectory = base_url('/img/picture/' . $filename);
			$memberType = 1;
		} else {
			$fullDirectory = null;
			$saveDirectory = null;
			$memberType = 0;
		}

		$hashPassword = sha1($password);
		$hashEmail = sha1($email);

		$formatDate = strtotime($date);

		$data = array(
			'FIRST_NAME' 	=> $fName,
			'LAST_NAME' 	=> $lName,
			'MEMBER_TYPE'	=> $memberType,
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
			'IMAGE'			=> $saveDirectory
		);

		$query = $this->user->registration($data);

		if ($query) {
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

			if ($this->email->send()) {
				$this->session->set_flashdata('verification', 'pending');
				redirect(base_url('home'));
			}
		} else {
			$this->session->set_flashdata('verification', 'error');
			redirect(base_url('home'));
		}  
		redirect(base_url('home'));
	}

	public function verification()
	{

		$hash = $this->input->get('key');
		$email = $this->input->get('email');

		$emailHash = sha1($email);

		$query = $this->user->verifyAccount($emailHash);

		if ($query->num_rows() > 0) {
			$update = $this->user->updateStatus($email);
			if ($update) {
				//Account verified
				echo 'success';
			} else {
				echo 'error';
			}
		} else {
			echo 'verified';
		}
	}
}
