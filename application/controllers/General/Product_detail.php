<?php if (!defined("BASEPATH")) exit("Hack Attempt");  
class Product_detail extends CI_Controller 
{

    public function view()
    {
        $this->load->helper('form');
        $this->load->library('incube');
        $this->load->model('M_product', 'product');
        $this->load->model('M_cms', 'cms');

        // $this->output->enable_profiler(TRUE);
        $id = $this->input->get('id');

        // $data['dataproduct']            = $this->incube->getProductDetails($id);
         
        $data['dataproduct']            = $this->cms->getGeneralData('v_g_products','PRODUCT_ID',$id);
        $data['priceList']              = array();
        // $data['recomended']             = $this->incube->getProductList($queryArray);;
        $data['imageCounter']           = 1;
        $data['imageCounterMobile']     = 1;
        $data['countProduct']           = 1;

        if($data['dataproduct']->num_rows() == 0) {

              //THERE IS NO DATA FOR THIS
            $data['productName'] = 'Product not Available';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('pages/products/empty_product', $data);
            $this->load->view('templates/footer', $data);

        } else { 
            $productTitle = $data['dataproduct']->row()->PRODUCT_NAME;
            
            // foreach ($dataproduct->result() as $key);
            //  $productTitle = $key->PRODUCT_NAME;

            //Product Name
            if (strlen($productTitle) > 20) {
                $data['productName'] = ucwords(substr($productTitle, 0, 20));
            } else {
                $data['productName'] = ucwords($productTitle);
            }

            //THERE IS A DATA FOR THIS PRODUCT
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('pages/products/product_detail', $data);
            $this->load->view('templates/footer', $data);
        }
    }
}
