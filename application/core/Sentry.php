<?php if (!defined('BASEPATH')) exit('Hack Attempt?');

class Sentry
{
	var $CI;

	function Sentry(){
		$this->CI =& get_instance();
	}

	function user_is_logged_in() {				
		if($this->CI->session)
		{
			if ($this->CI->session->userdata('user_is_logged_in')) return TRUE;
			else return FALSE;
		}
		else{
			return FALSE;
		}
	}
	
	function user_id() {
		if($this->user_is_logged_in()) {
			return $this->CI->session->userdata('user_id');
		}
		else {
			return 0;
		}
	}
	
	function user_full_name()
	{
		if($this->user_is_logged_in()) {
			return $this->CI->session->userdata('user_full_name');
		}
		else{
			return '0';
		}
	}

	/*====================================================================================================================*/
	
	function admin_is_logged_in() {				
		if($this->CI->session)
		{
			if ($this->CI->session->userdata('admin_logged_in')) return TRUE;
			else return FALSE;
		}
		else{
			return FALSE;
		}
	}
	
	function get_admin_id()
	{
		if($this->admin_is_logged_in()) {
			return $this->CI->session->userdata('admin_id');
		}
		else{
			return '0';
		}
	}
	
	function get_admin_fullname()
	{
		if($this->admin_is_logged_in()) {
			return $this->CI->session->userdata('admin_fullname');
		}
		else{
			return '0';
		}
	}
	
	function get_admin_username()
	{
		if($this->admin_is_logged_in()) {
			return $this->CI->session->userdata('admin_username');
		}
		else{
			return '0';
		}
	}
}
?>