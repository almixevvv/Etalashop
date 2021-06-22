<?php
class M_category extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function getParentCategory()
	{

		$this->db->select('*');
		$this->db->from('m_category');
		$this->db->where('PARENT', '0');
		$this->db->where('LEVEL', '0');
		$this->db->order_by('ORDER_NO', 'ASC');

		$query = $this->db->get();

		return $query;
	}

	function getSingleCategory($id)
	{

		$this->db->select('*');
		$this->db->from('m_category');
		$this->db->where('ID', $id);

		$query = $this->db->get();

		return $query;
	}

	function getChildCategory($parentID)
	{

		$this->db->select('ID, NAME, LINK');
		$this->db->from('m_category');
		$this->db->where('PARENT', $parentID);
		$this->db->where('LEVEL', '1');
		$this->db->order_by('ORDER_NO', 'ASC');

		$query = $this->db->get();

		return $query;
	}
}
