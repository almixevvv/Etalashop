<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Form_abo_cms extends CI_Controller
{
	function Form_abo_cms()
	{
		parent::__construct();
		$this->load->model("M_cms");
	}

	public function index()
	{

		$id = $this->input->get('id', TRUE);
		$data['edit'] = $this->M_cms->select_about_detail($id);
		$data['sess_data'] 		= $this->session->userdata('cms_sess');

		$page = 'form_abo';
		if (!file_exists(APPPATH . '/views/pages-cms/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		$data['title'] = "Form_abo_cms";

		$this->load->view('pages-cms/' . $page, $data);
	}

	function update()
	{
		$text = $this->input->post('text-aboutt');
		$result = $this->M_cms->update_about($text);
		redirect(site_url('cms/about'));
	}
}
