<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Banner_cms extends CI_Controller {
    
	public function index(){
		$page = 'banner';
		if ( ! file_exists(APPPATH.'/views/pages-cms/'.$page.'.php')){ show_404(); }
		
		$data['title'] = 'Banner List';

		$this->load->model('M_cms', 'cms');
		
		$data['content'] = $this->cms->select_banner();
		$data['page'] = 'Banner List';
		$data['sess_data'] 		= $this->session->userdata('cms_sess');

		$data['new_order'] = $this->cms->select_order_new();
		$data['unview_order'] = $this->cms->select_order_unview();		
		
        $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/navbar');
        $this->load->view('pages-cms/banner');
        $this->load->view('templates-cms/footer');
	}

	public function add_banner()
	{
    	$this->output->enable_profiler(TRUE);
    
    	$this->load->library('upload');
	  
	  	$type      	= $this->input->post('txtType'); 
      	$linkto		= $this->input->post('txtLinkTo'); 
      	$orderno 	= $this->input->post('txtOrderNo'); 
      	$flag	 	= $this->input->post('txtFlag'); 
      	$desc	 	= $this->input->post('txtBanDetail'); 
 
		$defaultPath	= '/assets/banner-img/' . $_FILES['fileBanImage']['name'];
		$ext 			= pathinfo($_FILES['fileBanImage']['name'], PATHINFO_EXTENSION);

		$new_name 		= sha1($_FILES['fileBanImage']['name'] . date('YmdHis')); 
		$file  			= $defaultPath; 

		$config['upload_path']   = './assets/banner-img/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['file_name']     = $new_name;

		$fileBanImage = $new_name . "." . $ext; 

		$this->upload->initialize($config);

		if (!$this->upload->do_upload('fileBanImage')) {
			echo $this->upload->display_errors();
		} else {
			
			$data   = array
	        (
	        	'TYPE'        	=> "MAIN",
	        	'LINK_TYPE' 	=> $type,
	        	'LINKTO'    	=> $linkto,
	        	'BANNER_IMAGE'  => $fileBanImage,
	        	'ORDER_NO'		=> $orderno,
	        	'DESCRIPTION'	=> $desc,
	        	'CREATED'      	=> date('Y-m-d h:i:s'),
	        	'UPDATED'       => date('Y-m-d h:i:s'), 
	        	'USER_ID'       => "admin"
	      );
	 		
	 	  $this->load->model('M_cms');
	      $this->M_cms->AddBanner($data,'g_banner');   
	      redirect('cms/banner');
		}


	      
 
	}
}
