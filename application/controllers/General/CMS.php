<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class CMS extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->model('M_cms', 'cms');

		// $this->output->enable_profiler(TRUE);
	}

	public function index()
	{

		$data['page'] = "LOGIN";

		if ($this->session->userdata('name') == null) {

			$this->load->view('templates-cms/header', $data);
			$this->load->view('pages-cms/login');
			$this->load->view('templates-cms/footer');
		} else {

			redirect('cms/dashboard');
		}
	}

	public function logout()
	{

		$this->session->unset_userdata('name');
		$this->session->unset_userdata('user_group');

		redirect('cms/login');
	}

	public function login_process()
	{

		$email = $this->input->post('txt-username');
		$password = $this->input->post('txt-password');

		$hashPassword = sha1($password);

		$checkUsername = $this->cms->checkUsername($email);

		//Check if username exist
		if ($checkUsername->num_rows() > 0) {
			//Check if password match
			$query = $this->cms->cms_login($email, $hashPassword);
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$session = array(
						'name' => $data->NAME,
						'user_group' => $data->GROUP_ID
					);

					$this->session->set_userdata($session);
				}
				redirect('cms/dashboard');
			} else {
				$this->session->set_flashdata('no_password', true);
				redirect(site_url('cms/login'));
			}
		} else {
			$this->session->set_flashdata('no_email', true);
			redirect(site_url('cms/login'));
		}
	}

	public function dashboard()
	{

		$data['page'] = "Dashboard";

		$data['new_order'] = $this->cms->select_order_new();
		$data['unview_order'] = $this->cms->select_order_unview();

		$this->load->view('templates-cms/header', $data);
		$this->load->view('templates-cms/navbar');
		$this->load->view('pages-cms/dashboard');
		$this->load->view('templates-cms/footer');
	}
}
