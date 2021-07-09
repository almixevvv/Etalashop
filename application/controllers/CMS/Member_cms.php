<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Member_cms extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$data['title'] 		= 'Member List';
		$data['content'] 	= $this->api->getGeneralList('g_member');
		$data['page'] 		= 'Member List';
		$data['sess_data'] 	= $this->session->userdata('cms_sess');

		$data['new_order'] 		= $this->cms->select_order_new();
		$data['unview_order'] 	= $this->cms->select_order_unview();

		$this->load->view('templates-cms/header', $data);
		$this->load->view('templates-cms/navbar');
		$this->load->view('pages-cms/member');
		$this->load->view('templates-cms/footer');
	}

	public function getMember()
	{
		// $this->output->enable_profiler(TRUE);
		// echo 'masuk';
		$this->load->helper('form');

		$id = $this->input->get('id');

		$this->load->model('M_cms', 'cms');

		$data['member'] = $this->cms->singleMember($id);

		$this->load->view('pages-cms/modal-member', $data);
	}

	public function updateMember()
	{

		// $this->output->enable_profiler(TRUE);
		// echo "masuk";
		$this->load->model('M_cms', 'cms');

		$id = $this->input->post('member_id');
		$email = $this->input->post('member_email');
		$phone = $this->input->post('member_phone');
		$add1 = $this->input->post('member_add1');
		$add2 = $this->input->post('member_add2');
		$country = $this->input->post('member_country');
		$province = $this->input->post('member_province');
		// $quantity = $this->input->post('txt_quantity');

		$this->cms->updateMember($id, $email, $phone, $add1, $add2, $country, $province);
		$this->session->set_flashdata('updatemember', 'updatemember');

		redirect('cms/member');
	}

	public function resetPassword()
	{

		//$this->output->enable_profiler(TRUE);
		$this->load->model('M_cms', 'cms');

		$id = $this->input->post('id');
		$pass = $this->input->post('hiddenPass');

		$this->cms->updatePass($id, $pass);
		// redirect('cms/member');
	}

	public function deleteMember()
	{

		// $this->output->enable_profiler(TRUE);

		$this->load->model('M_cms', 'cms');

		$id = $this->input->post('id');
		$this->cms->delete_member($id, 'g_member');

		// redirect('cms/member');
	}
}
