<?php if (!defined("BASEPATH")) exit("Hack Attempt");

class About extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $data['title'] = 'Our Company | Growrich Indonesia';
        $data['page'] = 'Our Company | Growrich Indonesia';

        $data['about'] = $this->cms->getGeneralData('g_company_details', 'TYPE', 'OUR_COMPANY');

        $this->load->view('templates/header', $data);
        $this->load->view('pages/about');
        $this->load->view('templates/footer');
    }

    public function vision_mission()
    {
        $data['title'] = 'Vision & Mission | Growrich Indonesia';
        $data['page'] = 'Vision & Mission | Growrich Indonesia';

        $data['about'] = $this->cms->getGeneralList('g_company_details');

        $this->load->view('templates/header', $data);
        $this->load->view('pages/vision_mission');
        $this->load->view('templates/footer');
    }
}
