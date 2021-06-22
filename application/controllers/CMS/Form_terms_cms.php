<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Form_terms_cms extends CI_Controller {
	function Form_terms_cms(){
		parent::__construct();
		$this->load->model("M_cms");
		
	}
	
	public function index(){
		
		$id=$this->input->get('id', TRUE);
		$data['edit']=$this->M_cms->select_terms_detail($id);
		
		
		$page = 'form_terms';
			if ( ! file_exists(APPPATH.'/views/pages-cms/'.$page.'.php'))
        {
			// Whoops, we don't have a page for that!
			show_404();
        }
		$data['title'] = "Form_terms_cms";
		$this->load->view('pages-cms/'.$page, $data);
	}
	
	function update(){
		//echo 'mashoook pak';
		$this->load->model('M_cms', 'cms');

		$text = $this->input->post('text-terms');
		$id = $this->input->post('rec_id');

		$this->cms->update_terms($text,$id);

		redirect(site_url('cms/terms'));
		// $id = $this->input->post("id",TRUE);
		
		// $terms = $this->input->post("term",TRUE);
		// $result=$this->M_cms->update_terms($id,$terms);
		// $url='../cms/terms';
		// 	echo '<script>self.parent.location.href="'.$url.'";</script>';
		
	}
}