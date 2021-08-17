<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Form_banner_cms extends CI_Controller
{
	function Form_banner_cms()
	{
		parent::__construct();
		$this->load->model("M_cms");
	}

	public function index()
	{

		$id = $this->input->get('id', TRUE);
		$data['edit'] = $this->M_cms->select_banner_detail($id);


		$page = 'form_banner';
		if (!file_exists(APPPATH . '/views/pages-cms/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		$data['title'] = "Form_banner_cms";
		$data['sess_data'] 		= $this->session->userdata('cms_sess');

		$this->load->view('pages-cms/' . $page, $data);
	}

	function update()
	{
		$text = $this->input->post('text-banner');

		$result = $this->M_cms->update_banenr($text);

		redirect(site_url('cms/banner'));
		// $id = $this->input->post("id",TRUE);

		// $banner = $this->input->post("banner",TRUE);
		// $result=$this->M_cms->update_banner($id,$banner);
		// $url='../cms/banner';
		// 	echo '<script>self.parent.location.href="'.$url.'";</script>';

	}
}
