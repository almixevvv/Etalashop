<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Services extends CI_Controller {
		function Services(){
			parent::__construct();

		}
        public function view($page = 'services')
        {
		
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
		

        $data['title'] = ucfirst($page); // Capitalize the first letter
		
		$this->load->model('M_service');
        $data['service'] = $this->M_service->data_service()->result();
		
		$this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
		
		
		
        }
		
		public function insert_service(){
			$data = array(
				'services' => $this->input->post('service',TRUE),
				'price' => $this->input->post('price',TRUE),
				'description' => $this->input->post('description',TRUE),
				'tag' => $this->input->post('tag',TRUE),
				'mua_id' => $this->session->userdata('mua_id'),
			);
			$this->load->model('M_service');
			$this->M_service->insert_service($data);
			
			redirect(site_url('services'));
			
		}
		
		public function update_service(){
			
			$service_id= $this->input->post('service_id');
			$data = array(
				'services' => $this->input->post('service',TRUE),
				'price' => $this->input->post('price',TRUE),
				'description' => $this->input->post('description',TRUE),
				'tag' => $this->input->post('tag',TRUE),
				'mua_id' => $this->session->userdata('mua_id'),
			);
			$this->load->model('M_service');
			$this->M_service->update_service($service_id,$data);
			
			redirect(site_url('services'));
			
		}
		
		public function delete_service(){
			
			$service_id= $this->uri->segment(2);
			$this->load->model('M_service');
			$this->M_service->delete_service($service_id);
			
			redirect(site_url('services'));
			
		}
		
		
		
	}
?>