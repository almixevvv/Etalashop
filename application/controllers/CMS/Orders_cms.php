<?php if (!defined("BASEPATH")) exit("Hack Attempt");

class Orders_cms extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$dataSess = $this->session->userdata('cms_sess');

		if (!isset($dataSess)) {
			redirect('cms');
		}


		$data['page'] 				= 'Order Management';
		$data['sess_data'] 			= $this->session->userdata('cms_sess');

		$data['content'] 			= $this->cms->select_order();
		$data['new_order'] 			= $this->cms->select_order_new();
		$data['updated_order'] 		= $this->cms->select_order_updated();
		$data['confirmed_order'] 	= $this->cms->select_order_confirmed();
		$data['paid_order'] 		= $this->cms->select_order_paid();
		$data['unview_order'] 		= $this->cms->select_order_unview();

		$this->load->view('templates-cms/header', $data);
		$this->load->view('templates-cms/navbar');
		$this->load->view('pages-cms/order_management', $data);
		$this->load->view('templates-cms/footer');
	}



	public function status()

	{

		$data['page'] = 'ORDER MANAGEMENT';
		//GET THE PARAMETER FOR QUERY
		$searchQuery = $this->input->get('query');
		// $emailQuery  = $this->input->get('id');
		// $userEmail	 = $this->session->userdata('EMAIL');

		//SET EACH PARAMETER TO MATCH THE DATABASE
		if ($searchQuery == 'new') {
			$searchQuery = 'NEW ORDER';
			$data['content'] = $this->cms->getOrderMasterDataFromQuery($searchQuery);
		} elseif ($searchQuery == 'all') {
			$data['content'] = $this->cms->select_order();
		} else {
			strtolower($searchQuery);
			$data['content'] = $this->cms->getOrderMasterDataFromQuery($searchQuery);
		}

		$data['new_order'] = $this->cms->select_order_new();
		$data['updated_order'] = $this->cms->select_order_updated();
		$data['confirmed_order'] = $this->cms->select_order_confirmed();
		$data['paid_order'] = $this->cms->select_order_paid();
		$data['unview_order'] = $this->cms->select_order_unview();

		// $data['userHistory'] = $this->cms->getOrderHistoryFromQuery($searchQuery);
		// $data['content'] = $this->cms->getOrderMasterDataFromQuery($searchQuery);
		// $data['userEmail'] = $this->session->userdata('EMAIL');

		$this->load->view('templates-cms/header', $data);
		$this->load->view('templates-cms/navbar');
		$this->load->view('pages-cms/order_management', $data);
		$this->load->view('templates-cms/footer');
	}

	public function getPayment()
	{
		$id = $this->input->get('id');

		$data['payment'] = $this->cms->singlePayment($id);
		$this->load->view('pages-cms/modal-checkpayment', $data);
	}



	public function updateOrder()
	{
		$orderNo = $this->input->get('order-no');
		$status = $this->input->get('order-status');
		$prevstatus = $this->input->get('prev_status');
		$finalPrice = $this->input->get('final_price');
		$importCost = $this->input->get('import_cost');
		$spc_instruction = $this->input->get('spc_instruction');
		$internal_notes = $this->input->get('internal_notes');
		$updated = date('Y-m-d H:i:s');

		// $quantity = $this->input->post('txt_quantity');
		$counter = $this->input->get('loop-counter');

		for ($i = 1; $i < $counter; $i++) {
			// echo 'hiyaiyahiay'.' '.$i;
			$currentPrice = $this->input->get('final_price_' . $i);
			$currentID = $this->input->get('product_name_' . $i);
			$currentQuantity = $this->input->get('txt_quantity_' . $i);

			$this->cms->updateFinalPrice($currentID, $currentPrice, $currentQuantity);
			// echo 'satu beres';
		}

		$this->cms->updateOrderStatus($orderNo, $status, $importCost, $updated, $spc_instruction, $internal_notes);

		// $this->load-> AutoSendInvoice($orderNo);
		if ($status == 'UPDATED' && $prevstatus == 'NEW ORDER') {
			$this->AutoSendInvoice($orderNo);
		}

		redirect('cms/orders');
	}



	public function adminSendMessages()
	{
		$ORDER_ID = $this->input->post('id');
		$message = $this->input->post('message');

		$data = array(
			'SENDER_ID' => 'ADMIN',
			'ORDER_ID' => $ORDER_ID,
			'MESSAGE' => $message,
			'MESSAGE_TIME' => date('Y-m-d H:m:s'),
			'USER_READ_FLAG' => '0',
			'ADMIN_READ_FLAG' => '0'
		);

		$this->profile->sendMessages($data);
	}



	public function confirmPayment()
	{
		// $this->output->enable_profiler(TRUE);
		// echo "masuk";

		$id = $this->input->post('hiddenid');
		//$updated = $this->input->post('margin_updated');
		// $quantity = $this->input->post('txt_quantity');

		$this->cms->confirmStatus($id);
		redirect('cms/orders');
	}

	public function invoice()
	{
		$orderNo = $this->input->get('id');

		$data['details'] = $this->cms->singleOrder($orderNo);
		$this->load->view('email-template/invoice', $data);
	}



	public function sendInvoice()
	{
		$orderNo = $this->input->post('email-order-no');
		$emailAddress = $this->input->post('email-sender');

		$data['details'] = $this->cms->singleOrder($orderNo);

		$this->cms->updateFlagInvoce($orderNo);
		$this->load->library('email');

		$config['protocol']    = 'smtp';
		$config['smtp_host']   = 'mail.etalashop.com';
		$config['smtp_user']   = 'admin@etalashop.com';
		$config['smtp_pass']   = '^DNDfCfS)Ox!';
		$config['smtp_port']   = 465;
		$config['charset']     = 'utf-8';
		$config['wordwrap']    = TRUE;
		$config['mailtype']    = 'html';

		$this->email->initialize($config);

		$this->email->from('admin@etalashop.com', 'Etalashop Team');
		$this->email->to($emailAddress);
		$this->email->set_mailtype('html');

		$message = $this->load->view('email-template/invoice-email', $data, true);

		$this->email->subject('Your Order Invoice - ' . $orderNo);
		$this->email->message($message);
		$this->email->send();

		print_r($this->email->print_debugger());

		redirect(base_url('cms/orders'));
	}



	public function AutoSendInvoice($orderNo)
	{
		$data['details'] = $this->cms->singleOrder($orderNo);

		$email = $this->cms->singleOrder($orderNo);
		$dataEmail = $email->result();
		$emailAddress = $dataEmail[0]->MEMBER_EMAIL;

		$this->cms->updateFlagInvoce($orderNo);

		$this->load->library('email');

		$config['protocol']    = 'smtp';
		$config['smtp_host']   = 'mail.kikikuku.com';
		$config['smtp_user']   = 'admin@kikikuku.com';
		$config['smtp_pass']   = 'nOX-D8NlrF#Z';
		$config['smtp_port']   = 25;
		$config['charset']     = 'utf-8';
		$config['wordwrap']    = TRUE;
		$config['mailtype']    = 'html';

		$this->email->initialize($config);

		$this->email->from('admin@kikikuku.com', 'Kikikuku Team');
		$this->email->to($emailAddress);
		$this->email->set_mailtype('html');

		$message = $this->load->view('email-template/invoice-email', $data, true);

		$this->email->subject('Your Order Invoice - ' . $orderNo);
		$this->email->message($message);
		$this->email->send();

		if ($this->email->send()) {
			return true;
		} else {
			return false;
		}
		// redirect(base_url('cms/orders'));

	}

	public function getDetails()
	{
		header('Content-Type: application/json');

		$orderID = $this->input->get('id');

		// $this->output->enable_profiler(TRUE);

		$queryMaster   = $this->api->getGeneralData('v_g_order_master', 'ORDER_ID', $orderID);

		if ($queryMaster->num_rows() >= 1) {

			$getData = array(
				'order_no'			=> $queryMaster->row()->ORDER_NO,
				'order_id'			=> $queryMaster->row()->ORDER_ID,
				'order_query'		=> $queryMaster->row()->SPC_INSTRUCTION,
				'order_date'		=> date('Y-m-d h:i', strtotime($queryMaster->row()->ORDER_DATE)),
				'order_status'		=> $queryMaster->row()->ORDER_STATUS,
				'order_updated'		=> $queryMaster->row()->UPDATED,
				'member_name'		=> $queryMaster->row()->FIRST_NAME . ' ' . $queryMaster->row()->LAST_NAME,
				'member_mobile'		=> $queryMaster->row()->PHONE,
				'member_address'	=> $queryMaster->row()->ADDRESS,
				'member_address2'	=> $queryMaster->row()->ADDRESS_2,
				'member_country'	=> $queryMaster->row()->COUNTRY,
				'member_province'	=> $queryMaster->row()->PROVINCE,
				'member_zip'		=> $queryMaster->row()->ZIP,
				'member_email'		=> $queryMaster->row()->EMAIL,
				'shipping_name'		=> $queryMaster->row()->MEMBER_NAME,
				'shipping_mobile'	=> $queryMaster->row()->MEMBER_PHONE,
				'shipping_address'	=> $queryMaster->row()->ADDRESSO_1,
				'shipping_address2'	=> $queryMaster->row()->ADDRESSO_2,
				'shipping_country'	=> $queryMaster->row()->COUNTRY_ORDER,
				'shipping_province'	=> $queryMaster->row()->STATE,
				'shipping_zip'		=> $queryMaster->row()->ZIP_ORDER,
				'shipping_email'	=> $queryMaster->row()->MEMBER_EMAIL,
				'total_order'		=> number_format($queryMaster->row()->TOTAL_ORDER, 2, ',', '.'),
				'total_postage'		=> number_format($queryMaster->row()->TOTAL_POSTAGE, 2, ',', '.'),
				'amount'			=> number_format(($queryMaster->row()->TOTAL_ORDER + $queryMaster->row()->TOTAL_POSTAGE), 2, ',', '.')
			);

			$queryDetails = $this->api->getGeneralData('v_g_orders', 'ORDER_ID', $orderID);

			foreach ($queryDetails->result() as $detail) {

				$getDetails[] = array(
					'product_name'		=> $detail->PRODUCT_NAME,
					'product_id'		=> $detail->PRODUCT_ID,
					'product_image'		=> base_url('assets/uploads/products/' . $detail->PRODUCT_IMAGE),
					'product_quantity'	=> number_format($detail->PRODUCT_QUANTITY),
					'product_weight'	=> number_format($detail->PRODUCT_WEIGHT, 2, ',', '.'),
					'product_price'		=> number_format($detail->PRODUCT_PRICE, 2, ',', '.'),
					'product_final'		=> number_format($detail->PRODUCT_FINAL_PRICE, 2, ',', '.'),
					'product_postage'	=> number_format($detail->PRODUCT_POSTAGE, 2, ',', '.'),
					'product_notes'		=> $detail->PRODUCT_NOTES,
				);
			}

			$detailEncode = json_encode($getDetails);

			$msg = array(
				'status'    => 'success',
				'code'      =>  200,
				'message'   => array(
					'data'		=> $getData,
					'details'	=> json_decode($detailEncode)
				),
			);


			$updateData = array(
				'VIEW_FLAG'	=> '1'
			);

			$this->api->updateGeneralData('g_order_master', 'ORDER_ID', $orderID, $updateData);
		} else {

			$msg = array(
				'status'    => 'invalid_data',
				'code'      =>  204,
				'message'   => 'order not found',
			);
		}

		echo json_encode($msg);
	}

	public function deleteOrder()
	{
		header('Content-Type: application/json');


		$orderNo = $this->input->post('orderNo');

		$queryMaster = $this->api->getGeneralData('g_order_master', 'ORDER_NO', $orderNo);
		$queryMaster = $this->api->getGeneralData('g_order_detail', 'ORDER_NO', $orderNo);

		//1. Cek datanya ada atau engga
		if ($queryMaster->num_rows() >= 1 && $queryMaster->num_rows() >= 1) {

			$this->db->trans_begin();

			$this->api->deleteGeneralData('g_order_master', 'ORDER_NO', $orderNo);
			$this->api->deleteGeneralData('g_order_detail', 'ORDER_NO', $orderNo);

			//1.1 Kalau misalnya ada yang salah pas hapus data
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();

				$msg = array(
					'status'    => 'data_error',
					'code'      =>  504,
					'message'   => 'cannot complete process',
				);
			}
			//EoL 1.1

			//1.2 Kalau misalnya berhasil hapus
			else {
				$this->db->trans_commit();

				$msg = array(
					'status'    => 'success',
					'code'      =>  200,
					'message'   => 'process completed',
				);
			}
			//EoL 1.2
		}
		//EoL 1

		//2. Kalau datanya ga ada, balikin error message
		else {
			$msg = array(
				'status'    => 'invalid_data',
				'code'      =>  204,
				'message'   => 'order not found',
			);
		}
		//EoL 2

		echo json_encode($msg);
	}
}
