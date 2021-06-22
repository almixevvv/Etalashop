<?php
class M_reset extends CI_Model{

	function __construct() {
		parent::__construct();
	}

	function getResetStatus($email, $id) {

		$this->db->select('*');
		$this->db->from('g_reset_password');
		$this->db->where('USER_EMAIL', $email);
		$this->db->where('RESET_ID', $id);

		$query = $this->db->get();

		return $query->result();

	}

	function getResetDetails($email) {

		$this->db->select('*');
		$this->db->from('g_reset_password');
		$this->db->whre('USER_EMAIL', $email);

		$query = $this->db->get();

		return $query;

	}

	function checkPassword($email, $password) {

		$this->db->select('*');
		$this->db->from('g_member');
		$this->db->where('EMAIL', $email);
		$this->db->where('PASSWORD', $password);

		$query = $this->db->get();

		return $query;

	}

	function updatePassword($email, $data) {

		$this->db->where('EMAIL', $email);
		$this->db->update('g_member', $data);

	}

	function updateResetStatus($email, $id, $data) {

		$this->db->where('USER_EMAIL', $email);
		$this->db->where('RESET_ID', $id);
		$this->db->update('g_reset_password', $data);

	}

}
