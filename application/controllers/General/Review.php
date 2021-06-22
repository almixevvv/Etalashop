<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Review extends CI_Controller {
		function Review(){
			parent::__construct();

		}
        public function view($page = 'review')
        {
		
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
		

        $data['title'] = ucfirst($page); // Capitalize the first letter
		
		$this->load->model('M_review');
        $data['review'] = $this->M_review->data_review()->result();
		
		$this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
		
		
		
        }
		
		
		
	}
?>