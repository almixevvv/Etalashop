<?php

Class M_pages extends CI_Model {


  function  Banner()
  {
      //$this->db->set('join_date', 'NOW()', FALSE);
   $this->db->from('g_banner');

   $this->db->order_by("ORDER_NO","asc");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }


  }
   function  BannerOrder($order)
  {
      //$this->db->set('join_date', 'NOW()', FALSE);
   $this->db->from('g_banner');
     $this->db->where('ORDER_NO',$order);
   $this->db->order_by("ORDER_NO","asc");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }


  }


  function  CountBanner() {
      //$this->db->set('join_date', 'NOW()', FALSE);
   $this->db->from('g_banner');

   $this->db->order_by("ORDER_NO","asc");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }


  }

  function  HowTo() {
    
    $this->db->select('*');
    $this->db->from('g_howto');

    $query = $this->db->get();

    return $query;
    
  }

  function  ContactUs() {

    $this->db->select('*');
    $this->db->from('g_contactus');

    $query = $this->db->get();

    return $query; 
    
  }

    function Faq() {

      $this->db->select('*');
      $this->db->from('g_faq');
      $this->db->order_by("REC_ID","asc");

      $query = $this->db->get();

      return $query;

    }

    function Terms() {

      $this->db->select('*');
      $this->db->from('g_terms');
      $this->db->where('REC_ID', '1');
      $this->db->order_by("REC_ID");

      $query = $this->db->get();
      
      return $query;

    }

    function Privacy() {

      $this->db->select('*');
      $this->db->from('g_privacy');
      $this->db->order_by("REC_ID","asc");

      $query = $this->db->get();

      return $query;

    }

    function  AboutUs() {

      $this->db->select('*');
      $this->db->from('g_about');
      $this->db->order_by("REC_ID","asc");

      $query = $this->db->get();

      return $query;

  }

  function addContactUs($name,$email,$phone,$comment) {
    $data = array('NAME' => $name,'EMAIL' => $email,'PHONE' => $phone,'MESSAGE' => $comment,  'FLAG'=>'NEW'

     );
    $insert = $this->db->insert('g_message', $data);
    return $insert;
  }

}
