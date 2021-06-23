<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Product_cms extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $data['title'] = 'Product';
        $data['page'] = 'Product';

        $data['new_order']      = $this->cms->select_order_new();
        $data['unview_order']   = $this->cms->select_order_unview();
        $data['product_master'] = $this->cms->getGeneralListGroup('v_g_products', 'PRODUCT_ID');

        $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/navbar');
        $this->load->view('pages-cms/product', $data);
        $this->load->view('templates-cms/footer');
    }

    public function get_product_detail()
    {
        $getQty = $this->cms->getGeneralData('v_g_products', 'PRODUCT_ID', $this->input->post('idproduct'));

        echo '
            <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label><b>IMAGES</b></label>
                    <div class="row">
                        <div class="col-12">
                            <img src=' . (strpos($getQty->row()->IMAGES1, 'http') === false ? base_url('assets/uploads/products/' . $getQty->row()->IMAGES1) : $getQty->row()->IMAGES1) . ' class="img-responsive" style="width:100%; max-height: 300px">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <img src=' . (strpos($getQty->row()->IMAGES2, 'http') === false ? base_url('assets/uploads/products/' . $getQty->row()->IMAGES2) : $getQty->row()->IMAGES2) . ' class="img-responsive" style="width:100%; max-height: 300px">
                        </div>
                        <div class="col-4">
                            <img src=' . (strpos($getQty->row()->IMAGES3, 'http') === false ? base_url('assets/uploads/products/' . $getQty->row()->IMAGES3) : $getQty->row()->IMAGES3) . ' class="img-responsive" style="width:100%; max-height: 300px">
                        </div>
                        <div class="col-4">
                        
                            <img src=' . (strpos($getQty->row()->IMAGES4, 'http') === false ? base_url('assets/uploads/products/' . $getQty->row()->IMAGES4) : $getQty->row()->IMAGES4) . ' class="img-responsive" style="width:100%; max-height: 300px">
                        </div>
                    </div> 
                  </div>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-12">
                      <label><b>Product ID</b></label> <br>
                      <p>' . $getQty->row()->PRODUCT_ID . '</p>
                      <hr>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <label><b>SKU</b></label> <br>
                      <p>' . $getQty->row()->SKU . '</p>
                      <hr>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <label><b>Name</b></label> <br>
                       <p>' . $getQty->row()->PRODUCT_NAME . '</p>
                       <hr>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <label><b>Category</b></label>
                      <p>' . $getQty->row()->CATEGORY_NAME . '</p>
                       <hr>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <label><b>Weight (Kg)</b></label>
                      <p>' . (!isset($getQty->row()->WEIGHT) ? '-' : $getQty->row()->WEIGHT) . '</p>
                       <hr>
                    </div>
                  </div> ';

        echo   '<div class="row">
                    <div class="col-12">
                      <label><b>Price</b></label>
                      <table class="table">
                        <tr>
                            <td>Min</td>
                            <td>Maks</td>
                            <td>Price</td>
                        </tr>';
        foreach ($getQty->result() as $dataPrice) {
            $price = (int)$dataPrice->QUANTITY_PRICE;
            echo        '<tr>
                            <td>' . $dataPrice->QUANTITY_MIN . '</td> 
                            <td>' . $dataPrice->QUANTITY_MAX . '</td> 
                            <td>' . number_format($price, 0) . '</td> 
                        </tr>
                        ';
        }
        echo   '</table>
                    <hr>
                    </div>
                  </div>';

        echo '<div class="row">
                    <div class="col-12">
                      <label><b>Description</b></label>
                      <p>' . $getQty->row()->PRODUCT_DETAIL . '</p>
                      <hr>
                    </div>
                  </div> 
                  </div>
                </div>';
    }

    public function add_product()
    {
        //Check if category
        $queryCheck = $this->cms->getGeneralData('m_category', 'DESCRIPTION', $this->input->post('txtPRODCategory'));

        if ($queryCheck->num_rows() == 0) {
            //Invalid category ID
            $this->session->set_flashdata('errorInvalidID', true);
            redirect(base_url('cms/products'));
        } else {
            $this->db->trans_start();

            //1. Upload master data
            $masterData = array(
                'SKU'               => $this->input->post('txtPRODSKU'),
                'WEIGHT'            => $this->input->post('txtPRODWeight'),
                'PRODUCT_NAME'      => $this->input->post('txtPRODName'),
                'PRODUCT_DETAIL'    => $this->input->post('txtPRODDetail'),
                'PRODUCT_ID'        => $this->input->post('txtPRODID'),
                'CATEGORY'          => $queryCheck->row()->LINK,
                'CREATED'           => date('Y-m-d h:i:s'),
                'STATUS'            => 'ACTIVE',
            );

            $this->cms->insertGeneralData('g_product_master', $masterData);
            //EoL Upload master data

            //2. Upload multiple quantities
            $arrPrice = $this->input->post('txtQUANPrice');
            $arrMin = $this->input->post('txtQUANMin');
            $arrMax = $this->input->post('txtQUANMax');

            $qtyCount = count($arrPrice);

            for ($i = 0; $i < $qtyCount; $i++) {

                $qtyData = array(
                    'PRODUCT_ID'        => $this->input->post('txtPRODID'),
                    'QUANTITY_MIN'      => $arrMin[$i],
                    'QUANTITY_MAX'      => $arrMax[$i],
                    'CREATED'           => date('Y-m-d h:i:s'),
                    'CREATED'           => '',
                );

                $this->cms->insertGeneralData('g_product_quantity', $qtyData);
            }
            //EoL Upload Multiple Quantity

            //3. Upload Multiple Images
            $imageArr   = array();
            $files = $_FILES;
            $imageCount = count($_FILES['filePRODImage']['name']);

            for ($i = 0; $i < $imageCount; $i++) {

                $_FILES['filePRODImage']['name']         = $files['filePRODImage']['name'][$i];
                $_FILES['filePRODImage']['type']         = $files['filePRODImage']['type'][$i];
                $_FILES['filePRODImage']['tmp_name']     = $files['filePRODImage']['tmp_name'][$i];
                $_FILES['filePRODImage']['error']         = $files['filePRODImage']['error'][$i];
                $_FILES['filePRODImage']['size']         = $files['filePRODImage']['size'][$i];

                $config['upload_path']          = './assets/uploads/products/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['overwrite']            = true;
                $config['encrypt_name']         = true;

                $this->load->library('upload', $config);

                $this->upload->do_upload('filePRODImage');
                $data = $this->upload->data();

                $imageArr[] = array(
                    'IMAGES'          => $data['file_name'],
                    'ORDER'           => $i
                );
            }

            $imageData = array(
                'PRODUCT_ID'        => $this->input->post('txtPRODID'),
                'IMAGES1'           => (isset($imageArr[0]['IMAGES']) ? $imageArr[0]['IMAGES'] : ''),
                'IMAGES2'           => (isset($imageArr[1]['IMAGES']) ? $imageArr[1]['IMAGES'] : ''),
                'IMAGES3'           => (isset($imageArr[2]['IMAGES']) ? $imageArr[2]['IMAGES'] : ''),
                'IMAGES4'           => (isset($imageArr[3]['IMAGES']) ? $imageArr[3]['IMAGES'] : ''),
                'CREATED'           => date('Y-m-d h:i:s'),
            );

            $this->cms->insertGeneralData('g_product_images', $imageData);
            //EoL Upload Multiple Images

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('inputError', '1');

                redirect(base_url('cms/products'));
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('inputError', '0');

                redirect(base_url('cms/products'));
            }
        }
    }

    public function edit_product()
    {
        $queryCheck = $this->cms->getGeneralData('m_category', 'DESCRIPTION', $this->input->post('editPRODCategory'));

        if ($queryCheck->num_rows() == 0) {
            //Invalid Category
            // $this->session->set_flashdata('errorInvalidID', true);
            // redirect(base_url('cms/products'));
        } else {
            $this->db->trans_start();

            //1. Update master data
            $masterData = array(
                'SKU'               => $this->input->post('editPRODSKU'),
                'WEIGHT'            => $this->input->post('editPRODWeight'),
                'PRODUCT_NAME'      => $this->input->post('editPRODName'),
                'CATEGORY'          => $queryCheck->row()->LINK,
                'UPDATED'           => date('Y-m-d h:i:s'),
                'STATUS'            => 'ACTIVE',
                'PRODUCT_DETAIL'    => $this->input->post('editPRODDetail'),
                'USER_ID'           => $this->session->userdata('id')
            );

            $this->cms->updateGeneralData('g_product_master', 'PRODUCT_ID', $this->input->post('editPRODID'),  $masterData);
            //EoL 1

            //2. Update Images 
            if (isset($_FILES['editfilePRODImage'])) {
                //2.1 Only run the function if image exist
                $imageArr   = array();
                $files = $_FILES;
                $imageCount = count($_FILES['editfilePRODImage']['name']);

                for ($i = 0; $i < $imageCount; $i++) {

                    $_FILES['editfilePRODImage']['name']        = $files['editfilePRODImage']['name'][$i];
                    $_FILES['editfilePRODImage']['type']        = $files['editfilePRODImage']['type'][$i];
                    $_FILES['editfilePRODImage']['tmp_name']    = $files['editfilePRODImage']['tmp_name'][$i];
                    $_FILES['editfilePRODImage']['error']       = $files['editfilePRODImage']['error'][$i];
                    $_FILES['editfilePRODImage']['size']        = $files['editfilePRODImage']['size'][$i];

                    $config['upload_path']          = './assets/uploads/products/';
                    $config['allowed_types']        = 'gif|jpg|png|jpeg|JPG|PNG';
                    $config['overwrite']            = true;
                    $config['encrypt_name']         = true;

                    $this->load->library('upload', $config);

                    $this->upload->do_upload('editfilePRODImage');
                    $data = $this->upload->data();

                    // $error = array('error' => $this->upload->display_errors());
                    // var_dump($error);

                    $imageArr[] = array(
                        'IMAGES'          => $data['file_name'],
                        'ORDER'           => $i
                    );
                }

                $imageData = array(
                    'IMAGES1'           => (isset($imageArr[0]['IMAGES']) ? $imageArr[0]['IMAGES'] : ''),
                    'IMAGES2'           => (isset($imageArr[1]['IMAGES']) ? $imageArr[1]['IMAGES'] : ''),
                    'IMAGES3'           => (isset($imageArr[2]['IMAGES']) ? $imageArr[2]['IMAGES'] : ''),
                    'IMAGES4'           => (isset($imageArr[3]['IMAGES']) ? $imageArr[3]['IMAGES'] : ''),
                    'CREATED'           => date('Y-m-d h:i:s'),
                );

                $this->cms->updateGeneralData('g_product_images', 'PRODUCT_ID', $this->input->post('editPRODID'),  $imageData);
                //EoL 2.1
            }
            //EoL 2

            //3. Edit Product Quantity
            $arrPrice   = $this->input->post('editQUANPrice');
            $arrMin     = $this->input->post('editQUANMin');
            $arrMax     = $this->input->post('editQUANMax');

            $qtyCount = count($arrPrice);

            $this->cms->deleteGeneralData('g_product_quantity', 'PRODUCT_ID', $this->input->post('editPRODID'));

            for ($i = 0; $i < $qtyCount; $i++) {

                $qtyData = array(
                    'PRODUCT_ID'        => $this->input->post('editPRODID'),
                    'QUANTITY_MIN'      => $arrMin[$i],
                    'QUANTITY_MAX'      => $arrMax[$i],
                    'CREATED'           => date('Y-m-d h:i:s'),
                    'UPDATED'           => date('Y-m-d h:i:s'),
                );

                $this->cms->insertGeneralData('g_product_quantity', $qtyData);
            }
            //EoL 3

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('inputError', '1');

                redirect(base_url('cms/products'));
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('inputError', '0');

                redirect(base_url('cms/products'));
            }
        }
    }

    public function updateProduct()
    {
        // $this->output->enable_profiler(TRUE);

        // $id = $this->input->post('editPRODID');
        // $this->M_cms->updateGeneralData('g_product_master', 'PRODUCT_ID', $id,  $masterData);
        // redirect(base_url('cms/products'));
    }
    public function delete_product()
    {
        $id_product = $this->input->get('id');

        $this->cms->deleteGeneralData('g_product_master', 'PRODUCT_ID', $id_product);
        $this->cms->deleteGeneralData('g_product_images', 'PRODUCT_ID', $id_product);
        $this->cms->deleteGeneralData('g_product_quantity', 'PRODUCT_ID', $id_product);

        redirect(base_url('cms/products'));
    }
}
