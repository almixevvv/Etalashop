<?php class M_api extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getGeneralListGroup($table, $group)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->group_by($group);

		$query = $this->db->get();

		return $query;
	}

	public function getGeneralListOrderedLimit($table, $field, $query, $limit)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($field, $query);
		$this->db->limit($limit);
		$query = $this->db->get();

		return $query;
	}


	public function getGeneralListOrdered($table, $field, $query)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($field, $query);

		$query = $this->db->get();

		return $query;
	}

	public function getGeneralList($table)
	{
		$this->db->select('*');
		$this->db->from($table);

		$query = $this->db->get();

		return $query;
	}

	public function getGeneralData($table, $field, $query)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($field, $query);

		$query = $this->db->get();

		return $query;
	}

	public function getSpecificData($table, $field, $query, $field2, $query2)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($field, $query);
		$this->db->where($field2, $query2);

		$query = $this->db->get();

		return $query;
	}

	public function deleteGeneralData($table, $field, $query)
	{
		$this->db->where($field, $query);
		$query = $this->db->delete($table);

		return $query;
	}

	public function updateGeneralData($table, $field, $query, $data)
	{
		$this->db->where($field, $query);
		$query = $this->db->update($table, $data);

		return $query;
	}

	public function insertGeneralData($table, $data)
	{
		$query = $this->db->insert($table, $data);

		return $query;
	}

	//INSERT MEMBER DATA
	function insertMember($data)
	{
		$query = $this->db->insert('g_member', $data);

		return $query;
	}

	//GET CURRENT MARGIN PARAMETER
	function getMarginParam()
	{

		$this->db->select('*');
		$this->db->from('g_convert');
		$this->db->where('STATUS', 'CURRENT');

		$query = $this->db->get()->row()->VALUE;

		return $query;
	}

	//GET CURRENT CONVERT RATE
	function getConvertRate()
	{

		$this->db->select('*');
		$this->db->from('g_rate');
		$this->db->where('STATUS', 'CURRENT');

		$query = $this->db->get()->row()->VALUE;

		return $query;
	}


	//CHECK IF THE ACCOUNT IS ALREADY VERIFIED OR NOT
	function verifyMember($hash)
	{

		$this->db->select('*');
		$this->db->from('g_member');
		$this->db->where('HASH', $hash);
		$this->db->where('STATUS', 'PENDING');

		$query = $this->db->get();

		return $query;
	}

	//UPDATE USER STATUS TO VERIFY
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

	//CHECK IF THE EMAIL IS ALREADY USED
	function checkExistingEmail($email)
	{

		$this->db->select('*');
		$this->db->from('g_member');
		$this->db->where('EMAIL', $email);

		$query = $this->db->get();

		return $query;
	}

	//DEBUG API GET MEMBER
	function getMembers()
	{

		$this->db->select('*');
		$this->db->from('g_member');

		$query = $this->db->get();

		return $query;
	}

	//DEBUG API GET THE KEY
	function getKey($key)
	{

		$this->db->select('*');
		$this->db->from('s_api');
		$this->db->where('API_KEY', $key);

		$query = $this->db->get();

		return $query;
	}
}
