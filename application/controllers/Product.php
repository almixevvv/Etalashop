<?php if (!defined("BASEPATH")) exit("Hack Attempt");

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $data['title'] = 'Product | Growrich Indonesia';
        $data['page'] = 'Product | Growrich Indonesia';

        $data['product']  = $this->cms->getGeneralList('v_gm_product_details');
        $data['division'] = $this->cms->getGeneralListOrdered('gm_product_type', 'ORDER', 'ASC');
        $data['category'] = $this->cms->getGeneralListOrdered('gm_product_category', 'ORDER', 'ASC');

        $data['display'] = "display:none;";
        $this->load->view('templates/header', $data);
        $this->load->view('pages/product', $data);
        $this->load->view('templates/footer');
    }

    public function product_detail()
    {
        $data['title']  = 'Product Details | Growrich Indonesia';
        $data['page']   = 'Product Details | Growrich Indonesia';

        $data['product']        = $this->cms->getGeneralData('v_gm_product_details', 'ID', $this->input->get('code'));
        $data['images']         = $this->cms->getGeneralData('v_gm_product_images', 'ID', $this->input->get('code'));

        $this->load->view('templates/header', $data);
        $this->load->view('pages/product_detail', $data);
        $this->load->view('templates/footer');
    }

    public function filter()
    {
        $data['title'] = 'Product | Growrich Indonesia';
        $data['page'] = 'Product | Growrich Indonesia';
        //GET THE PARAMETER FOR QUERY
        $data['display'] = "display:block;";

        $data['division'] = $this->cms->getGeneralListOrdered('gm_product_type', 'ORDER', 'ASC');
        $data['category'] = $this->cms->getGeneralListOrdered('gm_product_category', 'ORDER', 'ASC');

        if ($this->input->get('market') != null) {
            $data['product']  = $this->cms->getGeneralData('v_gm_product_details', 'TYPE_ID', $this->input->get('market'));
        } else if ($this->input->get('category') != null) {
            $data['product']  = $this->cms->getGeneralData('v_gm_product_details', 'CATEGORY_ID', $this->input->get('category'));
        } else {
            $data['product']  = $this->cms->getGeneralList('v_gm_product_details');
        }


        $this->load->view('templates/header', $data);
        $this->load->view('pages/product', $data);
        $this->load->view('templates/footer');
    }
}
