<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Margin extends CI_Controller
{
    public function index()
    {

        $page = 'margin_parameter';
        if (!file_exists(APPPATH . '/views/pages-cms/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = 'Batas Parameter';

        $this->load->model('M_cms', 'cms');
        $this->load->helper('form');
        $location = $this->session->userdata('location');

        $data['page'] = 'Batas Parameter';
        if ($location == "ALL") {
            $data['margin'] = $this->cms->select_margin();
        } else {
            $data['margin'] = $this->cms->select_margin_location($location);
        }

        $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/frame_side');
        $this->load->view('templates-cms/navbar');
        $this->load->view('pages-cms/margin_parameter', $data);
        $this->load->view('templates-cms/footer');
    }

    public function getAddMargin()
    {
        $this->load->helper('form');
        $data['location'] = $this->cms->select_location();
        $this->load->view('pages-cms/modal-add-parameter', $data);
    }

    function addMargin()
    {

        //date_default_timezone_set('Asia/Jakarta');

        $this->load->model('M_cms', 'cms');
        // $data['location'] = $this->cms->select_location();
        $loc = $this->input->post('margin_loc');
        $bawah = $this->input->post('margin_bawah');
        $atas = $this->input->post('margin_atas');
        $InsertData = $this->cms->add_margin($loc, $bawah, $atas);

        $this->session->set_userdata($session);

        redirect('margin_parameter');
    }


    public function getEditMargin()
    {
        $this->load->helper('form');
        $id = $this->input->get('id');
        $this->load->model('M_cms', 'cms');
        $data['margin'] = $this->cms->singleMargin($id);
        $this->load->view('pages-cms/modal-edit-parameter', $data);
    }
    public function updateMargin()
    {

        //date_default_timezone_set('Asia/Jakarta');

        $this->load->model('M_cms', 'cms');
        $id = $this->input->post('id');
        $loc = $this->input->post('margin_loc');
        $bawah = $this->input->post('margin_bawah');
        $atas = $this->input->post('margin_atas');

        $this->cms->update_margin($id, $loc, $bawah, $atas);

        redirect('margin_parameter');
    }
    function deleteMargin()
    {
        $this->load->model('M_cms', 'cms');

        $id = $this->input->post('deleteMargin');
        $this->cms->delete_margin($id, 'G_MARGIN');
        redirect('margin_parameter');
    }
}
