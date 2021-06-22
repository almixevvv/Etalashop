<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Product_cms extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler(TRUE);
        $this->load->model('M_pages');
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
                $this->session->set_flashdata('inputError', true);

                redirect(base_url('cms/products'));
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('inputError', false);

                redirect(base_url('cms/products'));
            }
        }
    }

    public function getProductCategories()
    {
        $data['title']      = 'Product Categories';
        $data['page']       = 'Product Categories';

        $module = $this->cms->module_check("CATEGORY", $this->session->userdata('GROUP_ID'));

        if ($module->num_rows() > 0) {

            $session = array(
                'ROLE' => $module->row()->ROLE
            );

            $this->session->set_userdata($session);
        }

        $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/frame_side');
        $this->load->view('templates-cms/navbar');

        if (stripos($this->session->userdata('ROLE'), "VIEW;") === false) {
            $data['user'] = "empty";
            $this->session->set_flashdata('perm_err', true);
        } else {
            $data['categories'] = $this->cms->select_category();
            $this->load->view('pages-cms/product_categories', $data);
        }

        $this->load->view('templates-cms/footer');
    }




    public function getProductTypes()
    {
        $data['title'] = 'Product Markets';
        $data['page'] = 'Product Markets';

        $module = $this->cms->module_check("TYPES", $this->session->userdata('GROUP_ID'));

        if ($module->num_rows() > 0) {

            $session = array(
                'ROLE' => $module->row()->ROLE
            );

            $this->session->set_userdata($session);
        }

        $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/frame_side');
        $this->load->view('templates-cms/navbar');

        if (stripos($this->session->userdata('ROLE'), "VIEW;") === false) {
            $data['user'] = "empty";
            $this->session->set_flashdata('perm_err', true);
        } else {
            $data['types'] = $this->cms->select_division();
            $this->load->view('pages-cms/product_types', $data);
        }

        $this->load->view('templates-cms/footer');
    }

    public function getEditProduct()
    {

        // $this->output->enable_profiler(TRUE);
        // echo 'masuk';
        // $this->load->helper('form');

        $data['title'] = 'Edit Product';

        $data['page'] = 'Edit Product';

        $id = $this->input->get('id');
        $this->load->model('M_cms', 'cms');
        $data['product'] = $this->cms->singleProduct($id);
        $data['division'] = $this->cms->select_division();
        $data['category'] = $this->cms->select_category();

        $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/frame_side');
        $this->load->view('templates-cms/navbar');
        $this->load->view('pages-cms/edit_product', $data);
        $this->load->view('templates-cms/footer');
    }

    public function updateProduct()
    {

        // date_default_timezone_set('Asia/Jakarta');
        // $this->output->enable_profiler(TRUE);
        // $this->load->helper('form');
        // echo "masuk";
        $this->load->model('M_cms', 'cms');

        $id = $this->input->post('txt_rec');
        $name = $this->input->post('txt_name');
        $division = $this->input->post('txt_division');
        $category = $this->input->post('txt_category');
        $desc = $this->input->post('txt_desc');

        $this->cms->update_product($id, $name, $division, $category, $desc);

        redirect('cms/product');
    }
}
