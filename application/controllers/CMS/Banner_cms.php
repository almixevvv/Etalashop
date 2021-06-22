<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Banner_cms extends CI_Controller {
	public function index(){
		$page = 'banner';
		if ( ! file_exists(APPPATH.'/views/pages-cms/'.$page.'.php')){ show_404(); }
		
		$data['title'] = 'Banner List';

		$this->load->model('M_cms', 'cms');
		
		$data['content'] = $this->cms->select_banner();
		$data['page'] = 'Banner List';

		$data['new_order'] = $this->cms->select_order_new();
		$data['unview_order'] = $this->cms->select_order_unview();		
		
        $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/navbar');
        $this->load->view('pages-cms/banner');
        $this->load->view('templates-cms/footer');
	}
}
?>