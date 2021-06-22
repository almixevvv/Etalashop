<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Term extends CI_Controller {
		function Term(){
			parent::__construct();
			$this->load->model("M_cms");

		}
        public function view($page = 'term')
        {
		
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
			$data['terms'] = $this->M_cms->select_terms();
			$this->load->view('pages/'.$page, $data);
        }
		

		
	}
?>