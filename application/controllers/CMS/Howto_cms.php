<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Howto_cms extends CI_Controller {

	public function index(){
		$this->load->model("M_cms");
		$this->load->helper('form');
		$page = 'howto';
		        if ( ! file_exists(APPPATH.'/views/pages-cms/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

		$data['page'] = 'How To';
		$data['howto'] = $this->M_cms->select_howto();
	    
	    $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/navbar');
        $this->load->view('pages-cms/howto', $data);
        $this->load->view('templates-cms/footer');
	}
}