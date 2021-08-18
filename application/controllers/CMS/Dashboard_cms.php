<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Dashboard_cms extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $data['title']          = 'Dashboard';
        $data['page']           = 'Dashboard';

        $data['products']       = $this->cms->getGeneralList('v_gm_product_details');
        $data['types']          = $this->cms->getGeneralList('gm_product_type');
        $data['categories']     = $this->cms->getGeneralList('gm_product_category');

        $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/frame_side', $data);
        $this->load->view('templates-cms/navbar');
        $this->load->view('pages-cms/dashboard', $data);
        $this->load->view('templates-cms/footer');
    }
}
