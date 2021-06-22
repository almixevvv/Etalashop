<?php if (!defined("BASEPATH")) exit("Hack Attempt");

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		require_once 'vendor/autoload.php';
		// $this->output->enable_profiler(TRUE);
		$this->load->model('M_user', 'user');

		/* LOAD CUSTOM GOOGLE LIBRARY */
		$this->load->library('incube');
	}

	public function index()
	{

		$data['sectionName'] = 'Login';
		$userData = $this->session->user_data;

		$redirectURI 	= base_url('social');
		$clientID 		= '859433678871-anflub2jg6a0jh61ud0rrvbere0ls29d.apps.googleusercontent.com';
		$clientSecret 	= 'LowDirwZ6Xrwde0jDG-kt-L3';

		$client 		= new Google_Client();
		$client->setClientId($clientID);
		$client->setClientSecret($clientSecret);
		$client->setRedirectUri($redirectURI);

		$client->addScope('email');
		$client->addScope('profile');

		$data['googleURL'] = $client->createAuthUrl();

		if ($userData['EMAIL'] != null) {
			redirect('home');
		} else {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('pages/account-registration/login', $data);
			$this->load->view('templates/footer');
		}
	}

	public function social()
	{
		$redirectURI 	= base_url('social');
		$clientID 		= '859433678871-anflub2jg6a0jh61ud0rrvbere0ls29d.apps.googleusercontent.com';
		$clientSecret 	= 'LowDirwZ6Xrwde0jDG-kt-L3';

		$client 		= new Google_Client();
		$client->setClientId($clientID);
		$client->setClientSecret($clientSecret);
		$client->setRedirectUri($redirectURI);

		$client->addScope('email');
		$client->addScope('profile');

		$data['googleURL'] = $client->createAuthUrl();

		if (isset($_GET['code'])) {
			$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

			if (isset($token['access_token'])) {
				$client->setAccessToken($token['access_token']);

				// get profile info
				$google_oauth = new Google_Service_Oauth2($client);
				$google_account_info = $google_oauth->userinfo_v2_me->get();

				$this->session->set_userdata('google_email', $google_account_info['email']);
				$this->session->set_userdata('google_picture', $google_account_info['picture']);
				$this->session->set_userdata('google_familyName', $google_account_info['familyName']);
				$this->session->set_userdata('google_givenName', $google_account_info['givenName']);
				$this->session->set_userdata('google_id', $google_account_info['id']);

				redirect('register?referal=google&rid=' . $google_account_info['id']);
			} else {
				$this->session->set_flashdata('google_expired', true);
				redirect('login');
			}
		}
	}

	public function login_user()
	{

		$email = $this->input->post('txt-email');
		$password = $this->input->post('txt-password');

		$hashPassword = sha1($password);

		$checkEmail = $this->user->checkExistingEmail($email);

		//Check if email exists
		if ($checkEmail->num_rows() == 0) {
			$this->session->set_flashdata('no_email', true);

			if ($this->input->get('refer') != null) {
				redirect(site_url('login?refer=' . $this->input->get('refer')));
			} else {
				redirect(site_url('login'));
			}
		} else {

			//Check if password is correct
			$checkPassword = $this->user->checkPassword($email, $hashPassword);

			if ($checkPassword->num_rows() < 1) {
				$this->session->set_flashdata('wrong_pass', true);
				$this->session->set_flashdata('email', $email);

				if ($this->input->get('refer') != null) {
					redirect(site_url('login?refer=' . $this->input->get('refer')));
				} else {
					redirect(site_url('login'));
				}
			} else if ($checkPassword->num_rows() >= 1) {
				//Check if account already verified
				$checkVerified = $this->user->checkVerified($email);

				if ($checkVerified->num_rows() < 1) {
					$this->session->set_flashdata('not_active', true);

					if ($this->input->get('refer') != null) {
						redirect(site_url('login?refer=' . $this->input->get('refer')));
					} else {
						redirect(site_url('login'));
					}
				} else {

					foreach ($checkPassword->result() as $data) {

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
					}

					$this->session->set_userdata('user_data', $dataSess);

					//CHECK USER PREVIOUS PAGE
					if ($this->input->get('refer') != null) {
						redirect(site_url($this->input->get('refer')));
					} else {
						redirect(base_url('home'));
					}
				}
			}
		}
	}

	function logout()
	{
		if ($this->incube->logoutAccount()) {
			redirect(base_url('home'));
		}
	}

	function forgot_password()
	{

		$data['sectionName'] = 'Reset Password';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/account-registration/forgot_password');
		$this->load->view('templates/footer');
	}

	function completeResetPassword()
	{

		$data['sectionName'] = 'Reset Password';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/account-registration/reset_success');
		$this->load->view('templates/footer');
	}
}
