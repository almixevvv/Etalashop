<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Margin_cms extends CI_Controller {
	public function index(){
		$page = 'margin';
		if ( ! file_exists(APPPATH.'/views/pages-cms/'.$page.'.php')){ show_404(); }

		$data['title'] = 'Margin & Rate';

		$this->load->model('M_cms', 'cms');
		$this->load->helper('form');
		
		$data['content'] = $this->cms->select_margin();
		$data['rate'] = $this->cms->select_rate();
		$data['page'] = 'Margin & Rate';

		$data['new_order'] = $this->cms->select_order_new();
		$data['unview_order'] = $this->cms->select_order_unview();


        $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/navbar');
        $this->load->view('pages-cms/margin');
        $this->load->view('templates-cms/footer');
	}

	public function getMargin() {

		// $this->output->enable_profiler(TRUE);
		// echo 'masuk';
		$this->load->helper('form');

		$id = $this->input->get('id');

		$this->load->model('M_cms', 'cms');

		$data['margin'] = $this->cms->singleMargin($id);

 		$this->load->view('pages-cms/modal-margin', $data);
	}

	public function getRate() {

		// $this->output->enable_profiler(TRUE);
		// echo 'masuk';
		$this->load->helper('form');

		$id = $this->input->get('id');

		$this->load->model('M_cms', 'cms');

		$data['rate'] = $this->cms->singleRate($id);

 		$this->load->view('pages-cms/modal-rate', $data);
	}

	public function getAddMargin() {

		// $this->output->enable_profiler(TRUE);
		// echo 'masuk';
		$this->load->helper('form');

		// $this->load->model('M_cms', 'cms');

 		$this->load->view('pages-cms/modal-addmargin');
	}

	public function getAddRate() {

		// $this->output->enable_profiler(TRUE);
		// echo 'masuk';
		$this->load->helper('form');

		// $this->load->model('M_cms', 'cms');

 		$this->load->view('pages-cms/modal-addrate');
	}

	public function updateMargin(){

		//SET JAM DAN TANGGAL JADI INDONESIA
		date_default_timezone_set('Asia/Jakarta');

		// $this->output->enable_profiler(TRUE);
		// echo "masuk";
		$this->load->model('M_cms', 'cms');

		$recID = $this ->input->post('margin_rec');
		$id = $this->input->post('margin_id');
		$value = $this->input->post('margin_value');
		$description = $this->input->post('margin_desc');
		$updated = date('Y-m-d H:i:s');
		//$updated = $this->input->post('margin_updated');
		// $quantity = $this->input->post('txt_quantity');

		$this->cms->updateMargin($recID, $id, $value, $updated, $description);
		$this->session->set_flashdata('updatemargin', 'updatemargin');

		redirect('cms/margin');
	}

	public function updateRate(){

		//SET JAM DAN TANGGAL JADI INDONESIA
		date_default_timezone_set('Asia/Jakarta');

		// $this->output->enable_profiler(TRUE);
		// echo "masuk";
		$this->load->model('M_cms', 'cms');

		$recID = $this ->input->post('rate_rec');
		$id = $this->input->post('rate_id');
		$value = $this->input->post('rate_value');
		$description = $this->input->post('rate_desc');
		$updated = date('Y-m-d H:i:s');
		//$updated = $this->input->post('margin_updated');
		// $quantity = $this->input->post('txt_quantity');

		$this->cms->updateRate($recID, $id, $value, $updated, $description);
		$this->session->set_flashdata('updaterate', 'updaterate');

		redirect('cms/margin');
	}

	public function addMargin(){

		// $this->output->enable_profiler(TRUE);
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('upload');

		$this->load->model('M_cms', 'cms');

		// $recID = $this ->input->post('margin_rec');
		$id = $this->input->post('margin_id');
		$value = $this->input->post('margin_value');
		$description = $this->input->post('margin_desc');
		$created = date('Y-m-d H:i:s');

		$data = array(
				'REC_ID' => '',
                'ID'  => $id,
                'VALUE' => $value,
                'CREATED_TIME' => $created,
                'UPDATED_TIME' => '',
                'UPDATED_BY' => 'ADMIN',
                'STATUS' => 'CURRENT',
                'DESCRIPTION' => $description
            );
        var_dump($data);

        //UPDATE PREVIOUS DATA
        $this->cms->updateStatus();

		$this->cms->insert_margin($data);
		$this->session->set_flashdata('addmargin', 'addmargin');


		redirect('cms/margin');
	}

	public function addRate(){

		// $this->output->enable_profiler(TRUE);
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('upload');

		$this->load->model('M_cms', 'cms');

		// $recID = $this ->input->post('margin_rec');
		$id = $this->input->post('rate_id');
		$value = $this->input->post('rate_value');
		$description = $this->input->post('rate_desc');
		$created = date('Y-m-d H:i:s');

		$data = array(
				'REC_ID' => '',
                'ID'  => $id,
                'VALUE' => $value,
                'CREATED_TIME' => $created,
                'UPDATED_TIME' => '',
                'UPDATED_BY' => 'ADMIN',
                'STATUS' => 'CURRENT',
                'DESCRIPTION' => $description
            );
        var_dump($data);

        //UPDATE PREVIOUS DATA
        $this->cms->updateStatusRate();

		$this->cms->insert_rate($data);

		$this->session->set_flashdata('addrate', 'addrate');


		redirect('cms/margin');
	}

	public function setAsCurrent(){

		// $this->output->enable_profiler(TRUE);
		$this->load->library('upload');

		$this->load->model('M_cms', 'cms');
		$recID = $this->input->post('hiddenREC');


		// $recID = $this ->input->post('margin_rec');
		// $id = $this->input->post('margin_id');
		// $value = $this->input->post('margin_value');
		// $description = $this->input->post('margin_desc');
		// $created = date('Y-m-d H:i:s');


        //UPDATE PREVIOUS DATA
        $this->cms->updateStatus();
		$this->cms->set_as_current($recID);
        

		// redirect('cms/margin');
	}

	public function setAsCurrentRate(){

		// $this->output->enable_profiler(TRUE);
		$this->load->library('upload');

		$this->load->model('M_cms', 'cms');
		$recID = $this->input->post('hiddenREC');


		// $recID = $this ->input->post('margin_rec');
		// $id = $this->input->post('margin_id');
		// $value = $this->input->post('margin_value');
		// $description = $this->input->post('margin_desc');
		// $created = date('Y-m-d H:i:s');


        //UPDATE PREVIOUS DATA
        $this->cms->updateStatusRate();
		$this->cms->set_as_current_rate($recID);
        

		// redirect('cms/margin');
	}

	public function deleteMargin(){

		// $this->output->enable_profiler(TRUE);

		$this->load->model('M_cms', 'cms');
		
		$recID = $this->input->post('hiddenREC');
		$this->cms->delete_margin($recID, 'g_convert');

		// redirect('cms/margin');
	}

	public function deleteRate(){

		// $this->output->enable_profiler(TRUE);

		$this->load->model('M_cms', 'cms');
		
		$recID = $this->input->post('hiddenREC');
		$this->cms->delete_rate($recID, 'g_rate');

		// redirect('cms/margin');
	}
}
?>
