<?php
class M_order_history extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function insert_payment($data)
	{
		$this->db->insert('g_payment', $data);
	}

	function update_payment($payment_id, $data)
	{
		$this->db->where('payment_id', $payment_id);
		$this->db->update('g_payment', $data);
	}
}
