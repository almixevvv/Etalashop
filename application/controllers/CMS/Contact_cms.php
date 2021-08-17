<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Contact_cms extends CI_Controller
{

	public function index()
	{
		$this->load->model("M_cms");
		$this->load->helper('form');
		$page = 'contact';
		if (!file_exists(APPPATH . '/views/pages-cms/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}

		//$this->output->enable_profiler(TRUE);


		$data['page'] = 'Contact Us';
		$data['content'] = $this->M_cms->select_contact();
		$data['sess_data'] 		= $this->session->userdata('cms_sess');

		$data['new_order'] = $this->M_cms->select_order_new();
		$data['unview_order'] = $this->M_cms->select_order_unview();

		$this->load->view('templates-cms/header', $data);
		$this->load->view('templates-cms/navbar');
		$this->load->view('pages-cms/contact', $data);
		$this->load->view('templates-cms/footer');
	}

	public function getContact()
	{

		// $this->output->enable_profiler(TRUE);
		// echo 'masuk';
		$this->load->helper('form');

		$id = $this->input->get('id');

		$this->load->model('M_cms', 'cms');

		$data['contact'] = $this->cms->select_contact_detail($id);

		$this->load->view('pages-cms/modal-contact', $data);
	}
}
