<?php if (!defined("BASEPATH")) exit("Hack Attempt");

class Contact extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler(TRUE);
        $this->load->model('M_main', 'main');
        $this->load->helper('form');
    }

    public function index()
    {
        $data['title'] = 'Contact | Growrich Indonesia';
        $data['page'] = 'Contact | Growrich Indonesia';

        $data['contact'] = $this->main->select_contact();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/contact');
        $this->load->view('templates/footer');
    }
}