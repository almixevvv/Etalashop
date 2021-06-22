<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Product extends CI_Controller {
	public function view(){
		$page = 'product';
	    if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){ show_404(); }
		$category = $this->input->get('cid');
		$bycid = $this->input->get('bycid');
		$sort = $this->input->get('sort');
		$order = $this->input->get('order');
		$perpage = $this->input->get('page');
		$offset = $this->input->get('ofs');

		$filter = array('category' => $category,'bycid' => $bycid,'sort'=> $sort,'order'=> $order ,'offset'=> $offset );
		$data['dataproduct']=$this->M_product->getProduct($filter,$perpage);

		
		$id_user = $this->session->userdata("USERID");
		$data['province'] = $this->M_user->slc_prov();
		$data['city'] = $this->M_user->slc_city("");
        
        $this->load->view('templates/header.php', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer.php', $data);
    }
}
?>