<?php
class M_order_history extends CI_Model{
function __construct() {
parent::__construct();
}
	function insert_payment($data){
		$this->db->insert('g_payment', $data);
	}
	
	function update_payment($payment_id,$data){
		$this->db->where('payment_id', $payment_id);
		$this->db->update('g_payment', $data);
	}
	
	function update_password($mua_id,$data){
		$this->db->where('mua_id', $mua_id);
		$this->db->update('g_mua', $data);
	}
	
	function data_payment(){    
		$payment = $this->db->query("SELECT * FROM g_payment where mua_id='".$this->session->userdata('mua_id')."'");
		return $payment;
    }
	
	function data_transaksi(){    
		$transaksi = $this->db->query("SELECT * FROM g_appointment where mua_id='".$this->session->userdata('mua_id')."'");
		return $transaksi;
    }
	
	function data_detail_transaksi(){    
		$transaksi = $this->db->query("SELECT * FROM g_appointment where mua_id='".$this->session->userdata('mua_id')."'");
		return $transaksi;
    }
}
?>