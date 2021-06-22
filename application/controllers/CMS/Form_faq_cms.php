<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Form_faq_cms extends CI_Controller {
	function Form_faq_cms(){
		parent::__construct();
		$this->load->model("M_cms");
		
	}
	
	public function index(){
		
		$id=$this->input->get('id', TRUE);
		$data['edit']=$this->M_cms->select_faq_detail($id);
		
		
		$page = 'form_faq_cms';
			if ( ! file_exists(APPPATH.'/views/pages-cms/'.$page.'.php'))
        {
			// Whoops, we don't have a page for that!
			show_404();
        }
		$data['title'] = "Form_faq_cms";
		$this->load->view('pages-cms/'.$page, $data);
	}
	
	function update(){
		$text = $this->input->post('text-faq');

		$result=$this->M_cms->update_faq($text);

		redirect(site_url('cms/faq'));
		
	}
}