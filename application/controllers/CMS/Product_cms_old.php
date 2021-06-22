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

        $data['new_order'] = $this->cms->select_order_new();
        $data['unview_order'] = $this->cms->select_order_unview();

        $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/navbar');
        $this->load->view('pages-cms/product', $data);
        $this->load->view('templates-cms/footer');
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
