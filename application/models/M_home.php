<?php
class M_home extends CI_Model{
  function __construct() {
    parent::__construct();
  }

  function getMainCategory($categoryID) {
    $this->db->select('*');
    $this->db->from('m_category');
    $this->db->where('ID', $categoryID);

    $query = $this->db->get();

    return $query;
  }

  function getSubcategory($subCategory) {
    $this->db->select('*');
    $this->db->from('m_category');
    $this->db->where('LINK', $subCategory);

    $query = $this->db->get();

    return $query;
  }

  function sidebar(){
    $sql_cats = "SELECT A.ID, A.NAME, (SELECT COUNT(ID)
                                       FROM `m_category`
                                       WHERE `m_category`.PARENT = A.ID) as TOTAL_SUB
                 FROM `m_category` as A
                 WHERE A.`PARENT`='0' AND A.`LEVEL`='0'
                 ORDER BY A.`ORDER_NO` ASC";
    $query_cats = $this->db->query($sql_cats);
	}

	function update_rules($rules_id,$data){
		$this->db->where('rules_id', $rules_id);
		$this->db->update('g_rules', $data);
	}


	function data_gender(){
		$gender = $this->db->query("SELECT * FROM m_gender");
		return $gender;
    }
}
