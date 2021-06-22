<?php class M_user extends CI_Model
{

	function checkExistingEmail($email)
	{

		$this->db->select('EMAIL');
		$this->db->from('g_member');
		$this->db->where('EMAIL', $email);

		$query = $this->db->get();

		return $query;
	}

	function getMemberData($email)
	{

		$this->db->select('*');
		$this->db->from('g_member');
		$this->db->where('EMAIL', $email);

		$query = $this->db->get();

		return $query;
	}

	function getMemberbyID($id)
	{

		$this->db->select('*');
		$this->db->from('g_member');
		$this->db->where('ID', $id);

		$query = $this->db->get();

		return $query;
	}

	function sentResetPassword($data)
	{

		$this->db->insert('g_reset_password', $data);
	}

	function checkPassword($email, $password)
	{

		$this->db->select('*');
		$this->db->from('g_member');
		$this->db->where('PASSWORD', $password);
		$this->db->where('EMAIL', $email);

		$query = $this->db->get();

		return $query;
	}

	function checkVerified($email)
	{

		$this->db->select('STATUS');
		$this->db->from('g_member');
		$this->db->where('EMAIL', $email);
		$this->db->where('STATUS', 'ACTIVE');

		$query = $this->db->get();

		return $query;
	}

	function getResetStatus($email)
	{

		$this->db->select('*');
		$this->db->from('g_reset_password');
		$this->db->where('USER_EMAIL', $email);

		$query = $this->db->get();

		return $query;
	}

	function registration($data)
	{

		if ($this->db->insert('g_member', $data)) {
			return true;
		} else {
			return false;
		}
	}

	function verifyAccount($hash)
	{

		$this->db->select('*');
		$this->db->from('g_member');
		$this->db->where('HASH', $hash);
		$this->db->where('STATUS', 'PENDING');

		$query = $this->db->get();

		return $query;
	}

	function updateStatus($email)
	{

		$this->db->set('STATUS', 'ACTIVE');
		$this->db->where('EMAIL', $email);

		if ($this->db->update('g_member')) {
			return true;
		} else {
			return false;
		}
	}
}
