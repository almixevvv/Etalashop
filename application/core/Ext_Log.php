<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 *
	 * Switch Debug to Info
	 *
	 */
	class Ext_Log extends CI_Log 
	{
	   var $_levels    = array('ERROR' => '1', 'INFO' => '2',  'DEBUG' => '3', 'ALL' => '4');
	}