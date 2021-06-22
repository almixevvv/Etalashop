<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Faq_cms extends CI_Controller {

	public function index(){
		$this->load->model("M_cms");
		$this->load->helper('form');
		//$this->output->enable_profiler(TRUE);
		$page = 'faq';
		        if ( ! file_exists(APPPATH.'/views/pages-cms/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
		
		//$this->output->enable_profiler(TRUE);


		$data['page'] = 'Faq';
		$data['faq'] = $this->M_cms->select_faq();
	    
	    $data['new_order'] = $this->M_cms->select_order_new();
		$data['unview_order'] = $this->M_cms->select_order_unview();

	    $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/navbar');
        $this->load->view('pages-cms/faq', $data);
        $this->load->view('templates-cms/footer');
	}
}