<?php if (!defined("BASEPATH")) exit("Hack Attempt");

class News extends CI_Controller
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
        $data['title'] = 'News | Growrich Indonesia';
        $data['page'] = 'News | Growrich Indonesia';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/news');
        $this->load->view('templates/footer');
    }

    public function news_detail()
    {
        $data['title'] = 'Lorem Ipsum | Growrich Indonesia';
        $data['page'] = 'Lorem Ipsum | Growrich Indonesia';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/news_detail');
        $this->load->view('templates/footer');
    }
}