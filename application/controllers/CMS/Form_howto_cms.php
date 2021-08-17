<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Form_howto_cms extends CI_Controller
{
	function Form_howto_cms()
	{
		parent::__construct();
		$this->load->model("M_cms");
	}

	public function index()
	{

		$id = $this->input->get('id', TRUE);
		$data['edit'] = $this->M_cms->select_howto_detail($id);


		$page = 'form_abo';
		if (!file_exists(APPPATH . '/views/pages-cms/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		$data['title'] = "Form_abo_cms";
		$data['sess_data'] 		= $this->session->userdata('cms_sess');

		$this->load->view('pages-cms/' . $page, $data);
	}

	function update()
	{
		$text = $this->input->post('text-howto');
		$result = $this->M_cms->update_howto($text);
		redirect(site_url('cms/howto'));
	}
}
