<?php if(!defined("BASEPATH")) exit("Hack Attempt");

  class PaymentProcess extends CI_Controller {

    public function __construct() {

      parent::__construct();
			$this->output->enable_profiler(TRUE);
			$this->load->library('session');
			$this->load->helper('form');
			$this->load->model('M_profile', 'profile');
			date_default_timezone_set('Asia/Jakarta');

		}

    public function manualProcess() {

      $orderID = $this->input->post('payment-order-value');

      $config['upload_path'] = './img/order/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['file_name'] = $orderID;

      $this->load->library('upload', $config);

      //GET THE FILE EXTENSION FOR SAVING THE DATA TO DATABASE
      $path = $_FILES['uReceipt']['name'];
      $ext = pathinfo($path, PATHINFO_EXTENSION);

      $defaultPath = '/img/order/'.$orderID.'.'.$ext;

      if ( !$this->upload->do_upload('uReceipt')) {
        $this->session->set_flashdata('upload', 'error');
        redirect('order/confirmation');
      } else {
        $data = array(
          'ORDER_ID'        => $orderID,
          'ACCOUNT_NAME'    => $this->input->post('uAccountName'),
          'ACCOUNT_NUMBER'  => $this->input->post('uAccountNumber'),
          'ACCOUNT_BANK'    => $this->input->post('uBankName'),
          'PAYMENT_AMOUNT'  => $this->input->post('uAccountPayment'),
          'PAYMENT_DATE'    => date('Y-m-d H:m:s'),
          'PAYMENT_IMAGE'   => $defaultPath,
          'FLAG'            => '1'
        );

        $this->profile->insertImageData($data);
        $this->profile->updatePaymentStatus($orderID);

        // redirect('home?inquiry=paid');
      }

		}

    public function confirmationPage() {

      $this->load->view('templates/header');
      $this->load->view('templates/navbar');
      $this->load->view('pages/profile/transaction_confirm');
      $this->load->view('templates/footer');

    }




  }
