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

            //2.1 Tampilin data secara random
            $this->db->select('*')
                ->from('g_product_master')
                ->order_by('RAND()')
                ->limit(5);

            $queryProduct = $this->db->get();

            foreach ($queryProduct->result() as $result) {

                $this->db->select('*')
                    ->from('g_product_quantity')
                    ->where('PRODUCT_ID', $result->PRODUCT_ID)
                    ->order_by('QUANTITY_MIN')
                    ->limit(1);

                $queryQuantity = $this->db->get();

                $this->db->select('*')
                    ->from('g_product_images')
                    ->where('PRODUCT_ID', $result->PRODUCT_ID);

                $queryImages = $this->db->get();

                $productList[] = array(
                    'ID'                => $result->PRODUCT_ID,
                    'TITLE'             => $result->PRODUCT_NAME,
                    'PICTURE'           => base_url('assets/uploads/products/' . $queryImages->row()->IMAGES1),
                    'START_QUANTITY'    => $queryQuantity->row()->QUANTITY_MIN,
                    'PRICE'             => $queryQuantity->row()->QUANTITY_PRICE
                );
            }
            //EoL 2.1

            $productTitle        = $data['dataproduct']->row()->PRODUCT_NAME;
            $data['recomended']  = $productList;
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
