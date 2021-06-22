<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Account extends CI_Controller {
	public function view(){
		$page = 'account';
	    if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){ show_404(); }

		$this->load->model('M_user');
		$id = $this->session->userdata("USERID");
		$data['account'] = $this->M_user->loginbyid($id);
		$data['province'] = $this->M_user->slc_prov();
		$data['city'] = $this->M_user->slc_city("");
        
        $this->load->view('templates/header.php', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer.php', $data);
    }
    function chg_pwd_view(){
		$page = 'change_pass';
	    if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){ show_404(); }

		$this->load->model('M_user');
		$id = $this->session->userdata("USERID");
		$data['account'] = $this->M_user->loginbyid($id);
		$data['province'] = $this->M_user->slc_prov();
		$data['city'] = $this->M_user->slc_city("");
        
        $this->load->view('templates/header.php', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer.php', $data);
    }
	public function insert_payment(){
		$data = array(
			'bank_name' => $this->input->post('bank_name',TRUE),
			'no_rekening' => $this->input->post('no_rekening',TRUE),
			'atas_nama' => $this->input->post('atas_nama',TRUE),
			'mua_id' => $this->session->userdata('mua_id'),
		);
		$this->load->model('M_account');
		$this->M_account->insert_payment($data);
		
		redirect(site_url('account'));
		
	}
	
	public function update_payment(){
		
		$payment_id= $this->input->post('payment_id');
		$data = array(
			'bank_name' => $this->input->post('bank_name',TRUE),
			'no_rekening' => $this->input->post('no_rekening',TRUE),
			'atas_nama' => $this->input->post('atas_nama',TRUE),
			'mua_id' => $this->session->userdata('mua_id'),
		);
		$this->load->model('M_account');
		$this->M_account->update_payment($payment_id,$data);
		
		redirect(site_url('account'));
		
	}
	
	function check_database() {
        //Field validation succeeded.  Validate against database
		$this->load->model('M_user');
        $email = $this->input->post('email');
        $pwd = $this->input->post('password');
        $password_nonen = $this->input->post('password');
		$new_password = $this->input->post('new_password');
		$password = sha1($pwd);
		

        //query the database
        $result = $this->M_user->login($email, $password);

        if ($result) {
			$this->update_password($new_password);
			} else {
			 $sess_array = array(
				'valid' => 'not_valid',
			 );
			 $this->session->set_userdata($sess_array);
			 redirect(site_url('account'));

        }
    }
	function upd_account_p() {
		$this->load->model('M_user');
		$id = $this->session->userdata("USERID");
        $nm = $this->input->post('txt_name');
        $birth = $this->input->post('txt_birth_date');
        $gen = $this->input->post('slc_gender');
        $bank = $this->input->post('slc_bank');
        $rec = $this->input->post('txt_no_rec');
        $phone = $this->input->post('txt_phone');
        $prov = $this->input->post('slc_prov');
        $city = $this->input->post('slc_city');
        $address = $this->input->post('txta_fulladdress');
        $result = $this->M_user->upd_account($id, $nm, $birth, $gen, $bank, $rec, $phone, $prov, $city, $address);
		$this->session->unset_userdata('CEKALERT_UPD_ACCOUNT');
        if ($result) {
			$sess_array = array( 'CEKALERT_UPD_ACCOUNT' => 'SUCCESS');
		} else {
			$sess_array = array('CEKALERT_UPD_ACCOUNT' => 'UNSUCCESS');
        }
		$this->session->set_userdata($sess_array);
		redirect(site_url('account'));
    }
		
	function upd_password_p(){
		$this->load->model('M_user');
		$id= $this->session->userdata('USERID');
        $old_pwd = $this->input->post('txt_current_pwd');
        $npwd = $this->input->post('txt_new_pwd');
        $password = sha1($npwd);

		$this->session->unset_userdata('CEKALERT_UPD_PASSWORD');
		$result = $this->M_user->upd_pwd_account($id,$password);
		if ($result) {
			$sess_array = array( 'CEKALERT_UPD_PASSWORD' => 'SUCCESS');
		} else {
			$sess_array = array('CEKALERT_UPD_PASSWORD' => 'UNSUCCESS');
        }
		$this->session->set_userdata($sess_array);
		redirect(site_url('change_pass'));
	}
	
}
?>