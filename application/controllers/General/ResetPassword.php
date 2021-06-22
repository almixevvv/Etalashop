<?php if(!defined("BASEPATH")) exit("Hack Attempt");

class ResetPassword extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->output->enable_profiler(TRUE);

		$this->load->model('M_reset', 'reset');
		$this->load->model('M_user', 'user');

		$this->load->library('email');
		$this->load->helper('form');

		date_default_timezone_set('Asia/Jakarta');
	}

  	public function index() {

		$data['RESET_EMAIL'] = $this->input->get('email');
		$data['RESET_DATA']  = $this->reset->getResetStatus($data['RESET_EMAIL'], $this->input->get('key'));
		$data['productName'] = 'Reset Password';

		//Save the url to session
		$this->session->set_userdata('KEY', $this->input->get('key'));
		$this->session->set_userdata('EMAIL', $this->input->get('email')); 

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/account-registration/reset_password', $data);
  		$this->load->view('templates/footer');

	}

	public function sendPasswordReset() {

		$regularEmail = $this->input->post('reset-email');
		$queryResult = $this->user->checkExistingEmail($regularEmail);

		if($queryResult->num_rows() == 0) {
			
			$this->session->set_flashdata('error', 'no_email');
			redirect(base_url('profile/forgot_password'));
		} else {

			$id = date('y-m-d-h-m-s');

			$hashID = sha1($id);

			$resetData = array(

				'USER_EMAIL'   	=> $regularEmail,
				'RESET_ID'    	=> $hashID,
				'RESET_DATE'	=> $id,
				'RESET_STATUS' 	=> 'ACTIVE'

			);

			$config['protocol']    = 'smtp';
			$config['smtp_host']   = 'mail.kikikuku.com';
			$config['smtp_user']   = 'admin@kikikuku.com';
			$config['smtp_pass']   = 'yMiBWEq=H+NN';
			$config['smtp_port']   = 587;
			$config['charset']     = 'utf-8';
			$config['newline']     = "\r\n";
			$config['wordwrap']    = TRUE;
			$config['mailtype']    = 'html';

			$this->email->initialize($config);

			$this->email->from('admin@kikikuku.com', 'Kikikuku Team');
			$this->email->to($regularEmail);
			$this->email->set_mailtype('html');

			$message = $this->load->view('email-template/reset-password', $resetData, true);

			$this->email->subject('Please confirm your email address');
			$this->email->message($message);

			// print_r($this->email->print_debugger());

			if($this->email->send()) {
				$this->user->sentResetPassword($resetData);
				$this->session->set_flashdata('success', 'email_send');
				redirect(base_url('login'));
			} else {
				$this->session->set_flashdata('error', 'email_send');
				redirect(base_url('profile/forgot_password'));
			}

		}

	}


	function resetPasswordProcess() {

		$resetEmail = $this->input->post('input-email');
		$password   = $this->input->post('uPass');
		$key 		= $this->session->KEY;
		$email 		= $this->session->EMAIL;

		$hash = sha1($password);

		$queryCheckPass = $this->reset->checkPassword($resetEmail, $hash);

		if($queryCheckPass->num_rows() > 0) {
			$this->session->set_flashdata('error', 'password');
			redirect(base_url('profile/reset?email='.$email.'&key='.$key));
		} else {
			$data = array(
				'RESET_STATUS' => 'FINISHED'
			);

			$password = array(
				'PASSWORD' => $hash
			);

			$this->session->set_flashdata('success', 'password');
			$this->reset->updatePassword($resetEmail, $password);
			$this->reset->updateResetStatus($resetEmail, $key, $data);

			redirect(base_url('login'));
		}

	}

}
