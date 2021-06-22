<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_main extends CI_Model
{

    public function select_contact()
    {
        $this->db->select('*');
        $this->db->from('g_contact');

        $query = $this->db->get();

        return $query;
    }

    public function select_about()
    {
        $this->db->select('*');
        $this->db->from('g_our_company');

        $query = $this->db->get();

        return $query;
    }

    public function select_vision()
    {
        $this->db->select('*');
        $this->db->from('g_vision');

        $query = $this->db->get();

        return $query;
    }

    public function select_mission()
    {
        $this->db->select('*');
        $this->db->from('g_mission');

        $query = $this->db->get();

        return $query;
    }

    public function all_product()
    {
        $this->db->select('*');
        $this->db->from('v_gm_product');

        $query = $this->db->get();

        return $query;
    }

    public function katalog_product_home()
    {
        $this->db->select('*');
        $this->db->from('v_gm_product_details');
        $this->db->limit(6);

        $query = $this->db->get();

        return $query;
    }


    public function select_product($searchID)
    {
        $this->db->select('*');
        $this->db->from('v_gm_product');
        $this->db->where('ID', $searchID);

        $query = $this->db->get();

        return $query;
    }

    public function search_product($searchQuery)
    {
        $this->db->select('*');
        $this->db->from('v_gm_product');
        $this->db->where('TYPE_ID', $searchQuery);

        $query = $this->db->get();

        return $query;
    }

    public function search_prod_category($searchQuery, $searchCategory)
    {
        $this->db->select('*');
        $this->db->from('v_gm_product');
        $this->db->where('TYPE_ID', $searchQuery);
        $this->db->where('CATEGORY_ID', $searchCategory);

        $query = $this->db->get();

        return $query;
    }

    public function related_product_image($searchID)
    {
        $this->db->select('*');
        $this->db->from('gm_image');
        $this->db->where('PRODUCT_ID', $searchID);

        $query = $this->db->get();

        return $query;
    }
}
