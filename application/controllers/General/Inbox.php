<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Inbox extends CI_Controller {
		function Inbox(){
			parent::__construct();
		$this->load->library('session');
		}
        public function view($page = 'inbox')
        {
		
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
		

        $data['title'] = ucfirst($page); // Capitalize the first letter
		
		$this->load->model('M_mail');
        $data['mail'] = $this->M_mail->data_mail()->result();
		
		$this->load->model('M_mail');
        $data['count_inbox'] = $this->M_mail->data_count_inbox()->result();
		
		$this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
		
		
		
        }
		
		public function insert_contact(){
			$data = array(
				'name' => $this->input->post('name',TRUE),
				'email' => $this->input->post('email',TRUE),
				'phone' => $this->input->post('phone',TRUE),
				'comment' => $this->input->post('comment',TRUE),
				'mua_id' => $this->session->userdata('mua_id'),
			);
			$this->load->model('M_contact');
			$this->M_contact->insert_contact($data);
			$sess_array = array(
				    'inbox' => 1,
                );
			$this->session->set_userdata($sess_array);
			redirect(site_url('inbox'));
			
		}
		
		
		
	}
?>