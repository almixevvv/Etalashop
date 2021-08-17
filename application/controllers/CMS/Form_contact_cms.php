<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Form_contact_cms extends CI_Controller
{
	function Form_contact_cms()
	{
		parent::__construct();
		$this->load->model("M_cms");
	}

	public function index()
	{

		$id = $this->input->get('id', TRUE);
		$data['edit'] = $this->M_cms->select_contact_detail($id);


		$page = 'form_contact';
		if (!file_exists(APPPATH . '/views/pages-cms/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		$data['title'] = "Form_contact_cms";
		$data['sess_data'] 		= $this->session->userdata('cms_sess');

		$this->load->view('pages-cms/' . $page, $data);
	}

	function update()
	{
		$id = $this->input->post('contact_id');
		$title = $this->input->post('contact_title');
		$desc = $this->input->post('contact_desc');

		$result = $this->M_cms->update_contact($id, $title, $desc);

		redirect(site_url('cms/contact'));
	}
}
