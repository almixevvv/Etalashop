<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Group_cms extends CI_Controller {
	public function index(){
		// $this->incube->module_check($_SESSION["user_group"], 'User');

		$data['title'] = 'User Group';

		$this->load->model('M_cms', 'cms');
		$this->load->helper('form');
		// $this->load->library('incube');
		
		
		$data['page'] = 'User Group';

		$data['content'] = $this->cms->select_group();

		$data['new_order'] = $this->cms->select_order_new();
		$data['unview_order'] = $this->cms->select_order_unview();

  		$this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/navbar');
        $this->load->view('pages-cms/user_group');
        $this->load->view('templates-cms/footer');
	}

	public function getGroup() {

		//$this->output->enable_profiler(TRUE);
		// echo 'masuk';
		$this->load->helper('form');

		$id = $this->input->get('id');

		$this->load->model('M_cms');

		$data['content'] = $this->M_cms->singleGroup($id);
		// $data['group'] = $this->M_cms->select_group();
 		$this->load->view('pages-cms/modal-edit-group', $data);
 		//exit;
	}
	
	public function updateGroup(){

		// $this->output->enable_profiler(TRUE);
		// echo "masuk";
		$this->load->model('M_cms', 'cms');

		$hidden_id = $this->input->post('hidden_id');

		// $id = $this->input->post('group_id');
		$name = $this->input->post('group_name');
		$desc = $this->input->post('group_desc');

		$this->cms->updateUserGroup($hidden_id, $name, $desc);
		$this->cms->deleteGroupapp($hidden_id);

		$query=$this->cms->selectAppl();
		foreach ($query->result() as $key) {
			$role = "";
			$id=$this->input->post($key->ID);

			if (isset($id)){
				foreach ($this->input->post($key->ID) as $arr){
				$role = $role.$arr."; ";
				}		
			}
			if ($role!=""){
				//echo"disini";
				//echo $key->ID;
				$this->cms->InsertGroupAppl($hidden_id,$key->ID,$role);
			}
				//	echo $sql;
		}

		$this->session->set_flashdata('updategroup', 'updategroup');
		redirect('cms/group');
	}

	public function getAddGroup() {
		// $this->output->enable_profiler(TRUE);
		// echo 'masuk';
		$this->load->helper('form');

		// $this->load->model('M_cms');
		// $data['group'] = $this->M_cms->select_group();

 		$this->load->view('pages-cms/modal-add-group');
	}

	public function addGroup(){

		// $this->output->enable_profiler(TRUE);
		$this->load->library('upload');

		$this->load->model('M_cms');

		$id = $this->input->post('group_id');
		$name = $this->input->post('group_name');
		$desc = $this->input->post('group_desc');

		// $hashPassword = sha1($password);

		$data = array(
                'ID'  => $id,
                'NAME' => $name,
                'DESCRIPTION' => $desc,
            );

        //UPDATE PREVIOUS DATA

		$this->M_cms->addGroup($data);
		$idx = $this->input->post('group_id');

		//---- insert hak akses

		$this->M_cms->deleteGroupapp($idx);

		$query=$this->M_cms->selectAppl();
		foreach ($query->result() as $key) {
			$role = "";
			$id=$this->input->post($key->ID);

			if (isset($id)){
				foreach ($this->input->post($key->ID) as $arr){
				$role = $role.$arr."; ";
				}		
			}
			if ($role!=""){
				//echo "disini";
				$this->M_cms->InsertGroupAppl($idx,$key->ID,$role);
			}
				//	echo $sql;
		}
		//exit;
		$this->session->set_flashdata('addgroup', 'addgroup');
		redirect('cms/group');
	}

	public function deleteGroup(){

		// $this->output->enable_profiler(TRUE);

		$this->load->model('M_cms');
		
		$recID = $this->input->post('id');
		$this->M_cms->delete_group($recID, 's_group');
		$this->M_cms->delete_group_appl($recID, 's_group_appl');

		// redirect('cms/margin');
	}
}
?>
