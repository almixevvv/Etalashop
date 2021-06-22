<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class User_cms extends CI_Controller {
	public function index(){

		$data['title'] = 'User Account';

		$this->load->model('M_cms', 'cms');
		$this->load->helper('form');
		
		$data['page'] = 'User Account';

		$data['content'] = $this->cms->select_user();

		$data['new_order'] = $this->cms->select_order_new();
		$data['unview_order'] = $this->cms->select_order_unview();

  		$this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/navbar');
        $this->load->view('pages-cms/user_account');
        $this->load->view('templates-cms/footer');
	}

	public function getAccount() {

		//$this->output->enable_profiler(TRUE);
		// echo 'masuk';
		$this->load->helper('form');

		$id = $this->input->get('id');

		$this->load->model('M_cms');

		$data['content'] = $this->M_cms->singleUser($id);
		$data['group'] = $this->M_cms->select_group();

 		$this->load->view('pages-cms/modal-edit-user', $data);
 		//exit;
	}

	public function updateAccount(){

		// $this->output->enable_profiler(TRUE);
		// echo "masuk";
		$this->load->model('M_cms', 'cms');

		$hidden_id = $this->input->post('hidden_id');

		$name = $this->input->post('acc_name');
		$group = $this->input->post('acc_group');
		$status = $this->input->post('acc_status');

		$this->cms->updateUser($hidden_id, $name, $group, $status);
		$this->session->set_flashdata('updateuser', 'updateuser');

		redirect('cms/user');
	}

	public function getAddAccount() {
		// $this->output->enable_profiler(TRUE);
		// echo 'masuk';
		$this->load->helper('form');

		$this->load->model('M_cms');
		$data['group'] = $this->M_cms->select_group();

 		$this->load->view('pages-cms/modal-add-account',$data);
	}

	public function addAccount(){

		// $this->output->enable_profiler(TRUE);
		$this->load->library('upload');

		$this->load->model('M_cms');

		$id = $this->input->post('acc_id');
		$name = $this->input->post('acc_name');
		$group = $this->input->post('acc_group');
		$password = $this->input->post('acc_password');
		$status = $this->input->post('acc_status');

		$hashPassword = sha1($password);

		$data = array(
            'ID'  => $id,
            'NAME' => $name,
            'GROUP_ID' => $group,
            'PASS' => $hashPassword,
            'STATUS' => $status
        );

        //UPDATE PREVIOUS DATA

		$this->M_cms->addUser($data);
		$this->session->set_flashdata('adduser', 'adduser');

		redirect('cms/user');
	}

	public function deleteAccount(){

		$this->output->enable_profiler(TRUE);

		$this->load->model('M_cms');
		
		$recID = $this->input->post('id');
		
		$this->M_cms->delete_user($recID, 's_user');

		// redirect('cms/margin');
	}
	
}
?>
