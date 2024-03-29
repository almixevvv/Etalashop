<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Register extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$data['sectionName'] = 'Register';

		if ($this->input->get('rid') != null) {

			$flashData = $this->session->userdata();
			$data['socialData']  = array(
				'email'		=> $flashData['google_email'],
				'picture'	=> $flashData['google_picture'],
				'lastName'	=> $flashData['google_familyName'],
				'firstName'	=> $flashData['google_givenName'],
				'id'		=> $flashData['google_id']
			);
		}

		if (isset($flashData)) {

			$user = $this->user->getMemberData($flashData['google_email']);

			if ($user->num_rows() == 0) {
				$this->load->view('templates/header', $data);
				$this->load->view('templates/navbar');
				$this->load->view('pages/account-registration/register', $data);
				$this->load->view('templates/footer');
			} else {
				foreach ($user->result() as $detail);

				$googleArray = array('google_email', 'google_picture', 'google_familyName', 'google_givenName', 'google_id');
				$this->session->unset_userdata($googleArray);
				$this->incube->loginAccount($detail);
				redirect('home');
			}
		} else {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('pages/account-registration/register');
			$this->load->view('templates/footer');
		}
	}

	public function checkExistingEmail()
	{
		// $this->output->enable_profiler(TRUE);
		header('Content-Type: application/json');

		$userEmail = $this->input->get('email');

		$this->db->select('*')
			->from('g_member')
			->where('EMAIL', $userEmail);

		$userQuery = $this->db->get();

		if ($userQuery->num_rows() == 0) {
			echo json_encode(array(
				'code'		=> 204,
				'message'	=> 0,
				'status'	=> true
			));
		} else {
			echo json_encode(array(
				'code'		=> 200,
				'message'	=> $userQuery->num_rows(),
				'status'	=> false
			));
		}
	}

	public function verification()
	{
		// $this->output->enable_profiler(TRUE);
		// header('Content-Type: application/json');

		$email 		= $this->input->get('email');
		$emailHash 	= sha1($email);

		$this->db->select('*')
			->from('g_member')
			->where('HASH', $emailHash);

		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			echo json_encode(array(
				'code'		=> 204,
				'message'	=> 'invalid hash'
			));

			$this->session->set_flashdata('verification', 'invalid');
			redirect(base_url('home'));

			return;
		} else {

			if ($query->row()->STATUS == 'ACTIVE') {
				echo json_encode(array(
					'code'		=> 202,
					'message'	=> 'already activated'
				));

				$this->session->set_flashdata('verification', 'existing');
				redirect(base_url('home'));

				return;
			} else {
				$update = $this->user->updateStatus($email);

				if ($update) {
					echo json_encode(array(
						'code'		=> 200,
						'message'	=> 'successful'
					));

					$this->session->set_flashdata('verification', 'success');
					redirect(base_url('home'));
				} else {
					echo json_encode(array(
						'code'		=> 400,
						'message'	=> 'unkown error'
					));

					$this->session->set_flashdata('verification', 'db_error');
					redirect(base_url('home'));
				}
			}
		}
	}

	public function resendEmail()
	{
		$data['email'] = $this->input->get('email');
		$data['hash'] = sha1($this->input->get('email'));

		//Disable this for debug only
		//$this->load->view('email-template/verification-email', $data);
		$config['smtp_user']   = 'admin@etalashop.com';
		$config['smtp_pass']   = 'rV#qMNCdt,W!';
		$config['smtp_port']   = 25;
		$config['charset']     = 'utf-8';
		$config['wordwrap']    = TRUE;
		$config['mailtype']    = 'html';

		$this->email->initialize($config);

		$this->email->from('admin@etalashop.com', 'Etalashop Admin');
		$this->email->to($this->input->get('email'));
		$this->email->set_mailtype('html');

		$message = $this->load->view('email-template/verification-email', $data, true);

		$this->email->subject('Please confirm your email address');
		$this->email->message($message);

		$this->email->send();

		header('Content-Type: application/json');

		echo json_encode(array(
			'status'    => 'ok',
			'code'      => 200,
			'message'   => 'incomplete api parameter',
		));
	}

	public function input()
	{
		$googleData = $this->session->userdata();
		$this->session->unset_userdata($googleData);

		if (isset($userImage)) {
			$filename = str_replace(".", "_", $this->input->post('uEmail'));
			$filename .= '.jpg';
			$fileLoc = FCPATH . '/img/picture/';
			$fullDirectory = $fileLoc . '/' . $filename;
			copy($this->input->post('uImage'), $fullDirectory);
			$saveDirectory = base_url('/img/picture/' . $filename);
			$memberType = 1;
		} else {
			$fullDirectory = null;
			$saveDirectory = null;
			$memberType = 0;
		}

		$email = $this->input->post('uEmail');
		$password = $this->input->post('uPass');

		$hashEmail = sha1($email);

		$salt = sha1($this->incube->generateID('10'));

		$passHash = password_hash($password . $salt, PASSWORD_BCRYPT, array('cost' => 12));


		$data = array(
			'REC_ID'		=> $this->incube->generateID('10'),
			'MEMBER_TYPE'	=> $memberType,
			'FIRST_NAME' 	=> $this->input->post('uFirstName'),
			'LAST_NAME' 	=> $this->input->post('uLastName'),
			'JOIN_DATE' 	=> date("Y-m-d h:i:s"),
			'BIRTH_DATE' 	=> date('y-m-d', strtotime($this->input->post('uBirthdate'))),
			'PHONE' 		=> $this->input->post('uPhone'),
			'ADDRESS' 		=> $this->input->post('uAddress1'),
			'ADDRESS_2' 	=> $this->input->post('uAddress2'),
			'COUNTRY' 		=> $this->input->post('uCountry'),
			'PROVINCE' 		=> $this->input->post('uProvince'),
			'ZIP' 			=> $this->input->post('uZip'),
			'EMAIL' 		=> $this->input->post('uEmail'),
			'PASSWORD' 		=> $passHash,
			'SALT'			=> $salt,
			'STATUS' 		=> 'PENDING',
			'HASH' 			=> $hashEmail,
			'IMAGE'			=> $saveDirectory
		);

		$query = $this->api->insertGeneralData('g_member', $data);

		if ($query) {
			$data['email'] = $email;
			$data['hash'] = sha1($email);

			//Disable this for debug only
			//$this->load->view('email-template/verification-email', $data);
			$config['smtp_user']   = 'admin@etalashop.com';
			$config['smtp_pass']   = 'rV#qMNCdt,W!';
			$config['smtp_port']   = 25;
			$config['charset']     = 'utf-8';
			$config['wordwrap']    = TRUE;
			$config['mailtype']    = 'html';

			$this->email->initialize($config);

			$this->email->from('admin@etalashop.com', 'Etalashop Admin');
			$this->email->to($email);
			$this->email->set_mailtype('html');

			$message = $this->load->view('email-template/verification-email', $data, true);

			$this->email->subject('Please confirm your email address');
			$this->email->message($message);

			if ($this->email->send()) {
				$this->session->set_flashdata('verification', 'pending');
				redirect(base_url('home'));
			}
		} else {
			$this->session->set_flashdata('verification', 'error');
			redirect(base_url('home'));
		}
	}
}
