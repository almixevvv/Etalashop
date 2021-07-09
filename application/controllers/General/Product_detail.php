<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Product_detail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler(TRUE);
    }

    public function view()
    {
        $data['dataproduct'] = $this->api->getGeneralData('v_g_products', 'PRODUCT_ID', $this->input->get('id'));

        //1. Kalo ga ada data
        if ($data['dataproduct']->num_rows() == 0) {
            $data['productName'] = 'Product not Available';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('pages/products/empty_product', $data);
            $this->load->view('templates/footer', $data);
        } else {
            //2. Kalo ada data
            $productTitle = $data['dataproduct']->row()->PRODUCT_NAME;
            $data['productName'] =  ucwords($productTitle);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('pages/products/product_detail', $data);
            $this->load->view('templates/footer', $data);
            //EoL 2
        }
        //EoL 1
    }
}
