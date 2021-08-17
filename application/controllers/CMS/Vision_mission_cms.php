<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Vision_mission_cms extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $data['title'] = 'Vision & Mission';
        $data['page'] = 'Vision & Mission';
        $data['sess_data']         = $this->session->userdata('cms_sess');

        $module = $this->cms->module_check("USER", $this->session->userdata('GROUP_ID'));

        if ($module->num_rows() > 0) {

            $session = array(
                'ROLE' => $module->row()->ROLE
            );

            $this->session->set_userdata($session);
        }

        $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/frame_side');
        $this->load->view('templates-cms/navbar');

        $role = $this->session->userdata('ROLE');

        if (stripos($role, "VIEW;") === false) {
            $data['user'] = "empty";
            $this->session->set_flashdata('perm_err', true);
        } else {
            $data['details'] = $this->cms->getGeneralList('g_company_details');

            $this->load->view('pages-cms/vision_mission', $data);
        }

        $this->load->view('templates-cms/footer');
    }

    public function getEditVision()
    {

        // $this->output->enable_profiler(TRUE);
        // echo 'masuk';
        // $this->load->helper('form');

        $data['title'] = 'Edit Vision';

        $data['page'] = 'Edit Vision';

        $id = $this->input->get('id');
        $this->load->model('M_cms', 'cms');
        $data['vision'] = $this->cms->singleVision($id);

        $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/frame_side');
        $this->load->view('templates-cms/navbar');
        $this->load->view('pages-cms/edit_vision', $data);
        $this->load->view('templates-cms/footer');
    }

    public function getEditMission()
    {

        // $this->output->enable_profiler(TRUE);
        // echo 'masuk';
        // $this->load->helper('form');

        $data['title'] = 'Edit Vision';

        $data['page'] = 'Edit Vision';

        $id = $this->input->get('id');
        $this->load->model('M_cms', 'cms');
        $data['mission'] = $this->cms->singleMission($id);

        $this->load->view('templates-cms/header', $data);
        $this->load->view('templates-cms/frame_side');
        $this->load->view('templates-cms/navbar');
        $this->load->view('pages-cms/edit_mission', $data);
        $this->load->view('templates-cms/footer');
    }

    public function updateVision()
    {

        // date_default_timezone_set('Asia/Jakarta');
        // $this->output->enable_profiler(TRUE);
        // $this->load->helper('form');
        // echo "masuk";
        $this->load->model('M_cms', 'cms');

        $rec_id = $this->input->post('txt_rec');
        $desc = $this->input->post('txt_desc');

        $this->cms->update_vision($rec_id, $desc);

        redirect('cms/vision_mission');
    }

    public function updateMission()
    {

        // date_default_timezone_set('Asia/Jakarta');
        // $this->output->enable_profiler(TRUE);
        // $this->load->helper('form');
        // echo "masuk";
        $this->load->model('M_cms', 'cms');

        $rec_id = $this->input->post('txt_rec');
        $desc = $this->input->post('txt_desc');

        $this->cms->update_mission($rec_id, $desc);

        redirect('cms/vision_mission');
    }


    public function deleteContact()
    {

        // $this->output->enable_profiler(TRUE);

        $this->load->model('M_cms', 'cms');

        $orderNo = $this->input->post('orderNo');
        $this->cms->delete_contact($orderNo);
    }
}
