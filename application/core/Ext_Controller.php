<?php if(!defined('BASEPATH')) exit("Hack attempt?");

class Ext_Controller extends CI_Controller{

	function __construct()
    {
        parent::__construct();
        // do some stuff
        
    }

	public function sendEmail(){
		$this->load->model('others_model');


		$this->form_validation->set_rules('tbx_name', 'Name', 'required');
		$this->form_validation->set_rules('tbx_email', 'Email', 'required');
		$this->form_validation->set_rules('tbx_phone', 'Phone', 'required');
		$this->form_validation->set_rules('tbx_subject', 'Subject', 'required');
		$this->form_validation->set_rules('tbx_message', 'Message', 'required');
		$this->form_validation->set_rules('tbx_captcha', 'Security Code', 'required');
		$redirect = $this->input->post('hdn_redirect');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('errorSendEmail', validation_errors());
			redirect($redirect."#messagebox", 'refresh');
		}
		else{



			$this->load->model('captcha_model');

			// Delete old captcha
			$this->captcha_model->DeleteOldCaptcha();

			// Validate
			$isCaptchaValid = $this->captcha_model->ValidateCaptcha(
				$this->input->post('tbx_captcha')
			);

			if (!$isCaptchaValid){
				$this->session->set_flashdata(
					'errorSendEmail'
					, 'Wrong Captcha');
				redirect($redirect."#messagebox", 'refresh');
			}

			//insert to db region
			$data = array(
				'name'=>$this->input->post('tbx_name'),
				'phone'=>$this->input->post('tbx_phone'),
				'email'=>$this->input->post('tbx_email'),
				'subject'=>$this->input->post('tbx_subject'),
				'message'=>$this->input->post('tbx_message'),
				'datein'=>date("Y-m-d H:i:s"),
				'userin'=>'Contact Form'
			);

			if($this->others_model->add_message($data))
			{
			}
			else
			{
				$this->session->set_flashdata('errorSendEmail', 'System errors. Please try again later.');
				redirect($redirect."#messagebox", 'refresh');
			}
			//end of insert to db region

			$config['charset'] = 'iso-8859-1';
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from(
				$this->input->post('tbx_email'),
				$this->input->post('tbx_name')
			);
			$this->email->to(
				'marketing@wintec.co.id'
			);
			$this->email->subject(
				$this->input->post('tbx_subject')
			);
			$this->email->message("");


			$resultSend = $this->email->send();

			if (!$resultSend){
				// Error message
				$msg = $this->email->print_debugger();
				$this->session->set_flashdata('errorSendEmail', $msg);
				redirect($redirect."#messagebox", 'refresh');
			}
			else{
				// Success
				$msg = 'Success send email.';
				$this->session->set_flashdata('msgSendEmail', $msg);
				redirect($redirect."#messagebox", 'refresh');
			}
		}
	}
}
?>