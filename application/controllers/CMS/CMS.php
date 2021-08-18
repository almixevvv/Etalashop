<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class CMS extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}

	public function index()
	{

		$data['page'] = "LOGIN";

		$dataSess = $this->session->userdata('cms_sess');

		if (!isset($dataSess)) {
			$this->load->view('templates-cms/header', $data);
			$this->load->view('pages-cms/login');
			$this->load->view('templates-cms/footer');
		} else {
			redirect('cms/dashboard');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('cms_sess');

		redirect('cms/login');
	}

	public function login_process()
	{
		$email 		= $this->input->post('txt-username');
		$password 	= $this->input->post('txt-password');


		// DEBUG PURPOSE ONLY
		// $salt = sha1($this->incube->generateID('10'));
		// $passHash = password_hash($password . $salt, PASSWORD_BCRYPT, array('cost' => 12));

		// echo $salt;
		// echo '</br>';
		// echo $passHash;

		// $checkPassword  = password_verify('Abc123cd0aa65e51bc50c47c26cfb2acc577c7e726125d', '$2y$12$Lqhj.ZejwOtdqnnDybKOpeGoKXzFoVlZMgJ69llW2Rrc8fBvMh5.u');

		// echo '</br>';
		// var_dump($checkPassword);
		// EoL DEBUG PURPOSE ONLY

		//1. Cek ada user atau engga
		$queryEmail = $this->api->getGeneralData('s_user', 'ID', $email);

		if ($queryEmail->num_rows() == 0) {
			$this->session->set_flashdata('no_email', true);
			redirect(site_url('cms/login'));
		}
		//EoL 1

		//2. Kalau ada, lanjut
		else if ($queryEmail->num_rows() == 1) {


			//2.1 Ambil salt user
			$salt = $queryEmail->row()->SALT;
			//EoL 2.1

			//2.2 Cek passwordnya sama atau engga
			$checkPassword  = password_verify($password . $salt, $queryEmail->row()->PASS);
			//EoL 2.2


			//2.3 Kalo passwordnya beda, tolak
			if (!$checkPassword) {
				$this->session->set_flashdata('no_password', true);
				redirect(site_url('cms/login'));
			}
			//EoL 2.3

			//2.4 Kalo passwordnya sama, lanjut
			else {
				$session = array(
					'user_name' 	=> $queryEmail->row()->NAME,
					'user_id'		=> $queryEmail->row()->ID,
					'user_group' 	=> $queryEmail->row()->GROUP_ID,
					'status'		=> 'ACTIVE'
				);

				$this->session->set_userdata('cms_sess', $session);
				redirect('cms/dashboard');
			}
			//EoL 2.4
		}
		//EoL 2

		//3. Catch unknown error
		else {
			$this->session->set_flashdata('unknown_error', true);
			redirect(site_url('cms/login'));
		}
		//EoL 3
	}

	public function dashboard()
	{
		$data['page'] = "Dashboard";

		$data['sess_data'] 		= $this->session->userdata('cms_sess');
		$data['new_order'] 		= $this->cms->select_order_new();
		$data['unview_order'] 	= $this->cms->select_order_unview();
		$data['order_status']	= $this->api->getGeneralList('v_g_order_status');

		$this->load->view('templates-cms/header', $data);
		$this->load->view('templates-cms/navbar');
		$this->load->view('pages-cms/dashboard');
		$this->load->view('templates-cms/footer');
	}
}
