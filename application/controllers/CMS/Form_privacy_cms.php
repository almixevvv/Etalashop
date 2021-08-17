<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Form_privacy_cms extends CI_Controller
{
	function Form_privacy_cms()
	{
		parent::__construct();
		$this->load->model("M_cms");
	}

	public function index()
	{

		$id = $this->input->get('id', TRUE);
		$data['edit'] = $this->M_cms->select_privacy_detail($id);


		$page = 'form_privacy';
		if (!file_exists(APPPATH . '/views/pages-cms/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		$data['title'] = "Form_privacy_cms";
		$data['sess_data'] 		= $this->session->userdata('cms_sess');

		$this->load->view('pages-cms/' . $page, $data);
	}

	function update()
	{
		//$this->output->enable_profiler(TRUE);
		$text = $this->input->post('text-privasi');

		$result = $this->M_cms->update_privacy($text);

		redirect(site_url('cms/privacy'));
	}
	// function update_term(){
	// 	$id=$this->input->get('id', TRUE);
	// 	$data['edit']=$this->M_cms->select_term_detail($id);


	// 	$page = 'Form_term';
	// 		if ( ! file_exists(APPPATH.'/views/pages-cms/'.$page.'.php'))
	//        {
	// 		// Whoops, we don't have a page for that!
	// 		show_404();
	//        }
	// 	$data['title'] = "Form_term_cms";
	// 	$this->load->view('pages-cms/'.$page, $data);
	// }
}
