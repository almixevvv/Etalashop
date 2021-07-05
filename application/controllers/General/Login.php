<?php if (!defined("BASEPATH")) exit("Hack Attempt");

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
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

		if (isset($userData['EMAIL'])) {
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

		$queryEmail = $this->api->getGeneralData('g_member', 'EMAIL', $email);

		if ($queryEmail->num_rows() == 0) {
			$this->session->set_flashdata('no_email', true);

			if ($this->input->get('refer') != null) {
				redirect(site_url('login?refer=' . $this->input->get('refer')));
			} else {
				redirect(site_url('login'));
			}
		} else {

			//1. Ambil salt dari DB untuk di compare sama password input
			$userSalt = $queryEmail->row()->SALT;
			$checkPassword  = password_verify($password . $userSalt, $queryEmail->row()->PASSWORD);
			//EoL 1

			//2. Cek passwordnya bener atau salah
			if ($checkPassword) {
				//2.1 Kalo passwordnya bener, masuk kesini 

				if ($queryEmail->row()->STATUS == 'ACTIVE') {
					//2.1.1 Kalau emailnya udah di verified, masuk kesini
					$dataSess = array(
						'FIRST_NAME' 	=> $queryEmail->row()->FIRST_NAME,
						'LAST_NAME' 	=> $queryEmail->row()->LAST_NAME,
						'PHONE' 		=> $queryEmail->row()->PHONE,
						'EMAIL' 		=> $queryEmail->row()->EMAIL,
						'ADDRESS' 		=> $queryEmail->row()->ADDRESS,
						'COUNTRY' 		=> $queryEmail->row()->COUNTRY,
						'PROVINCE' 		=> $queryEmail->row()->PROVINCE,
						'USERID' 		=> $queryEmail->row()->ID,
						'ZIP' 			=> $queryEmail->row()->ZIP,
						'IMAGE'			=> $queryEmail->row()->IMAGE,
						'LOGGED_IN'		=> TRUE
					);

					$this->session->set_userdata('user_data', $dataSess);

					if ($this->input->get('refer') != null) {
						redirect(site_url('login?refer=' . $this->input->get('refer')));
					} else {
						redirect(site_url('login'));
					}
					//EoL 2.1.1
				} else {
					//2.1.2 Kalo emailnya belom di verified, masuk kesini
					$this->session->set_flashdata('not_active', true);
					if ($this->input->get('refer') != null) {
						redirect(site_url('login?refer=' . $this->input->get('refer')));
					} else {
						redirect(site_url('login'));
					}
					//EoL 2.1.2
				}
				//EoL 2.1.1

				//EoL 2.1
			} else {
				//2.2 Kalo passwordnya salah, masuk kesini
				$this->session->set_flashdata('wrong_pass', true);
				$this->session->set_flashdata('email', $email);

				if ($this->input->get('refer') != null) {
					redirect(site_url('login?refer=' . $this->input->get('refer')));
				} else {
					redirect(site_url('login'));
				}
				//EoL 2.2
			}
			//EoL 2
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
