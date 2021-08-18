<?php
Class M_logo extends CI_Model
{
	function __constuct()
	{
		parent::__constuct();  // Call the Model constructor 
		loader::database();    // Connect to current database setting.
	}
	
	function update_session() {    
	$query=$this->db->query("SELECT * FROM g_mua WHERE mua_id='".$this->session->userdata('mua_id')."'");	
        if ($query->num_rows() == 1) {
            return $query;
        } else {
            return false;
        }
    }
	
}
 
?>
