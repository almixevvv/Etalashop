<?php if(!defined('BASEPATH')) exit("Hack attempt?");

class Ext_Model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	/*
	 * 	fetch single row from database
	 * 
	 * 	@return	array
	 */


	protected function fetch_single_row($sql, $bind_value = FALSE, $dbcache = FALSE){
		//if($dbcache) $this->db->cache_on();
		
		$query = ($bind_value) ? $this->db->query($sql,$bind_value) : $this->db->query($sql);
		if ($query->num_rows() == 0) return NULL;
		else return $query->row_array();		
	}
	
	/*
	 * 	fetch multi row from database
	 *	
	 * 	@return	array : array of array
	 */
	protected function fetch_multi_row($sql, $bind_value = FALSE, $dbcache = FALSE){
		//if($dbcache) $this->db->cache_on();
		
		$query = ($bind_value) ? $this->db->query($sql,$bind_value) : $this->db->query($sql);
		
		if ($query->num_rows() == 0) return NULL;
		return $query->result_array();
	}
		
	/*
	 * 	Execute DML (insert, update, delete)
	 *	
	 * 	@return	int : number of affected rows
	 */
	protected function execute_dml($sql, $bind_value = FALSE){
		$query = ($bind_value) ? $this->db->query($sql,$bind_value) : $this->db->query($sql);
		
		return $this->db->affected_rows();
	}
	
	/*
	 * 	Determine command type 
	 *	
	 * 	@return	string : (select, insert, update, delete)
	 */
	protected function type_command($command)
	{
		$result = explode(' ', trim($command));
		return  strtolower($result[0]);
	}
}