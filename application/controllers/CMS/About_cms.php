<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class About_cms extends CI_Controller
{

	public function index()
	{
		$this->load->model("M_cms");
		$this->load->helper('form');
		$page = 'about';
		if (!file_exists(APPPATH . '/views/pages-cms/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}

		$data['page'] = 'About Us';
		$data['about'] = $this->M_cms->select_about();
		$data['sess_data'] 		= $this->session->userdata('cms_sess');

		$data['new_order'] = $this->M_cms->select_order_new();
		$data['unview_order'] = $this->M_cms->select_order_unview();

		$this->load->view('templates-cms/header', $data);
		$this->load->view('templates-cms/navbar');
		$this->load->view('pages-cms/about', $data);
		$this->load->view('templates-cms/footer');
	}
}
