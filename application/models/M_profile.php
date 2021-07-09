<?php
class M_profile extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function getMemberDetails($email)
	{

		$this->db->select('*');
		$this->db->from('g_order_master');
		$this->db->where('MEMBER_EMAIL', $email);
		$this->db->limit(1);
		$this->db->order_by('REC_ID', 'DESC');

		$query = $this->db->get();

		return $query;
	}

	function getMemberfromID($id)
	{

		$this->db->select('*');
		$this->db->from('g_member');
		$this->db->where('ID', $id);

		$query = $this->db->get();

		return $query;
	}

	function updateDetails($id, $data)
	{

		$this->db->where('ID', $id);
		$this->db->update('g_member', $data);

		return true;
	}

	function updateAddress($id, $data)
	{

		$this->db->where('ID', $id);
		$this->db->update('g_member', $data);

		return true;
	}

	function updatePhoto($id, $defaultPath)
	{

		$data = array(
			'IMAGE' => $defaultPath
		);

		$this->db->where('ID', $id);
		$this->db->update('g_member', $data);
	}

	function updatePhone($id, $data)
	{

		$this->db->where('ID', $id);
		$this->db->update('g_member', $data);

		return true;
	}

	function insert_rules($data)
	{
		$this->db->insert('g_rules', $data);
	}

	function getOrderDetails($id)
	{
		$this->db->select('*');
		$this->db->from('v_g_orders');
		$this->db->where('ORDER_NO', $id);

		$query = $this->db->get();

		return $query;
	}

	function getOrderHistory($email)
	{

		$this->db->select('*');
		$this->db->from('v_g_orders');
		$this->db->where('MEMBER_EMAIL', $email);

		$query = $this->db->get();

		return $query;
	}

	function getMessageSender($orderID)
	{
		$this->db->select('MEMBER_EMAIL');
		$this->db->from('g_order_master');
		$this->db->where('ORDER_NO', $orderID);

		$query = $this->db->get();

		return $query;
	}

	function getOrderHistoryDetails($email, $orderID)
	{

		$this->db->select('*');
		$this->db->from('v_g_orders');
		$this->db->where('MEMBER_EMAIL', $email);
		$this->db->where('ORDER_NO', $orderID);

		$query = $this->db->get();

		return $query;
	}

	function getDetailFromOrderNo($orderID)
	{
		$this->db->select('*');
		$this->db->from('v_g_order_master');
		$this->db->where('ORDER_NO', $orderID);

		$query = $this->db->get();

		return $query;
	}

	function getAllOrderMasterData($email)
	{
		$this->db->select('*');
		$this->db->from('v_g_order_master');
		$this->db->where('MEMBER_EMAIL', $email);
		$this->db->order_by('ORDER_DATE', 'DESC');

		$query = $this->db->get();

		return $query;
	}

	function getOrderMasterData($email, $status)
	{

		$this->db->select('*');
		$this->db->from('v_g_order_master');
		$this->db->where('MEMBER_EMAIL', $email);
		$this->db->where('STATUS_ORDER', $status);
		$this->db->order_by('ORDER_DATE', 'DESC');

		$query = $this->db->get();

		return $query;
	}

	function getOrderMessages($orderID)
	{

		$this->db->select('*');
		$this->db->from('g_message');
		$this->db->where('ORDER_ID', $orderID);
		$this->db->order_by('MESSAGE_TIME', 'ASC');

		$query = $this->db->get();

		return $query;
	}

	function sendMessages($data)
	{

		$query = $this->db->insert('g_message', $data);

		return $query;
	}

	function insertPaymentProcess($data)
	{
		$query = $this->db->insert('g_confirm_payment', $data);

		return $query;
	}

	function getPaymentProcess($orderID)
	{

		$data = array(
			'STATUS' 	=> 'UPDATED'
		);

		$this->db->select('*');
		$this->db->from('g_order_master');
		$this->db->where('STATUS', 'UPDATED');

		$query = $this->db->get();

		return $query;
	}

	function updatePaymentStatus($orderID, $status)
	{

		$data = array(
			'STATUS' => $status
		);

		$this->db->where('ORDER_NO', $orderID);
		$query = $this->db->update('g_order_master', $data);

		return $query;
	}

	function finishOrder($orderID)
	{
		$data = array(
			'STATUS' => 'DONE'
		);

		$this->db->where('ORDER_NO', $orderID);
		$query = $this->db->update('g_order_master', $data);

		return $query;
	}

	function getFinishedStatus($orderID)
	{
		$this->db->select('*');
		$this->db->from('g_order_master');
		$this->db->where('ORDER_NO', $orderID);

		$query = $this->db->get();

		return $query;
	}

	function getOrderHistoryFromQuery($email, $query)
	{

		$this->db->select('*');
		$this->db->from('v_g_orders');
		$this->db->where('MEMBER_EMAIL', $email);
		$this->db->where('ORDER_STATUS', $query);

		$query = $this->db->get();

		return $query;
	}

	function getOrderMasterDataFromQuery($email, $query)
	{

		$this->db->select('*');
		$this->db->from('v_g_order_master');
		$this->db->where('MEMBER_EMAIL', $email);
		$this->db->where('STATUS_ORDER', $query);
		$this->db->order_by('ORDER_DATE', 'DESC');

		$query = $this->db->get();

		return $query;
	}
}
