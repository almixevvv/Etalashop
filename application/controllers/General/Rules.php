<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Rules extends CI_Controller {
		function Rules(){
			parent::__construct();

		}
        public function view($page = 'rules')
        {
		
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
		

        $data['title'] = ucfirst($page); // Capitalize the first letter
		
		$this->load->model('M_rules');
        $data['rules'] = $this->M_rules->data_rules()->result();
		
		$this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
		
		
		
        }
		
		public function update_rules(){
			
			$rules_id= $this->input->post('rules_id');
			if(empty($rules_id)){
				$data = array(
					'rules' => $this->input->post('rules',TRUE),
					'mua_id' => $this->session->userdata('mua_id'),
				);
				$this->load->model('M_rules');
				$this->M_rules->insert_rules($data);
			}else{
				$data = array(
					'rules' => $this->input->post('rules',TRUE),
					'mua_id' => $this->session->userdata('mua_id'),
				);
				$this->load->model('M_rules');
				$this->M_rules->update_rules($rules_id,$data);
			}
			
			redirect(site_url('rules'));
			
		}
		
	}
?>