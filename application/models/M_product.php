<?php

Class M_product extends CI_Model {

  //GENERATE RANDOM PRODUCT LINK
  function generateLink(){
    $this->db->select('LINK');
    $this->db->from('m_category');
    $this->db->where('LINK IS NOT NULL');
    $this->db->order_by('RAND()');
    $this->db->limit(1);

    $query = $this->db->get();

    return $query->result();
	}

  //GET MARGIN PARAMETER FOR PRICING
  function getMarginPrice() {

    $this->db->select('*');
    $this->db->from('g_convert');
    $this->db->where('STATUS', 'CURRENT');

    $query = $this->db->get()->row()->VALUE;

    return $query;

  }

  //GET CONVERT PRICE
  function getConvertRate() {

    $this->db->select('*');
    $this->db->from('g_rate');
    $this->db->where('STATUS', 'CURRENT');

    $query = $this->db->get()->row()->VALUE;

    return $query;
  }

}
