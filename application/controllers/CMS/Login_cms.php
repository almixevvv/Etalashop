<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Login_cms extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        if ($this->session->has_userdata('LOGIN_STAT')) {
            redirect(base_url('cms/dashboard'));
        }

        $data['page'] = "Login";
        $this->load->view('pages-cms/login', $data);
    }

    public function login_process_cms()
    {
        $ID = $this->input->post('txt-username');
        $PASS = $this->input->post('txt-password');
        $checkUsername = $this->cms->checkUsername($ID);

        //check if username exist
        if ($checkUsername->num_rows() > 0) {

            //Get the salt
            $userSalt = $checkUsername->row()->SALT;

            //Hash Section
            $checkPassword  = password_verify($PASS . $userSalt, $checkUsername->row()->PASS);

            if ($checkPassword) {

                $session = array(
                    'ID'            => $checkUsername->row()->ID,
                    'USERNAME'      => $checkUsername->row()->NAME,
                    'GROUP_ID'      => $checkUsername->row()->GROUP_ID,
                    'LOGIN_STAT'    => 'ACTIVE'
                );

                $this->session->set_userdata($session);
                redirect('cms/dashboard');
            } else {

                $this->session->set_flashdata('errMsg', array(
                    'ERR_TYPE'  => 'PASSWORD',
                    'MESSAGE'   => 'Kesalahan pada Username/Password'
                ));

                redirect(base_url('cms'));
            }
        } else {

            $this->session->set_flashdata('errMsg', array(
                'ERR_TYPE'  => 'USERNAME',
                'MESSAGE'   => 'Username tidak ditemukan'
            ));

            redirect(base_url('cms'));
        }
    }

    public function getPassword()
    {
        $this->load->view('pages-cms/edit_password');
    }

    public function updatePassword()
    {
        $id = $this->session->userdata('ID');
        $email = $this->session->userdata('EMAIL');
        $pass = $this->input->post("new_pass");
        $rec_id = $this->session->userdata('REC_ID');
        // $randomSalt = md5(uniqid(rand(), true));
        // $salt = substr($randomSalt, 0, MAX_SALT_LENGTH);
        // $hashPassword = hash('sha256', $pass . $salt);
        $this->cms->changePassword($pass, $id);
        redirect('cms/dashboard');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('cms');
    }
}
