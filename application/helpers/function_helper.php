<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Number Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/number_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Formats a numbers as bytes, based on size, and adds the appropriate suffix
 *
 * @access	public
 * @param	mixed	// will be cast as int
 * @return	string
 */
 //get discount code
if( !function_exists('get_month_name'))
{
	function get_month_name($month)
	{
		if($month==1)
		{
			return 'January';
		}
		else if($month==2)
		{
			return 'February';
		}
		else if($month==3)
		{
			return 'March';
		}
		else if($month==4)
		{
			return 'April';
		}
		else if($month==5)
		{
			return 'May';
		}
		else if($month==6)
		{
			return 'Juny';
		}
		else if($month==7)
		{
			return 'July';
		}
		else if($month==8)
		{
			return 'August';
		}
		else if($month==9)
		{
			return 'September';
		}
		else if($month==10)
		{
			return 'October';
		}
		else if($month==11)
		{
			return 'November';
		}
		else if($month==12)
		{
			return 'December';
		}
	}
}

if ( ! function_exists('get_downline'))
{
    function get_downline($parent)
    {	
		$q="select * from `client_tb` where `year_id`='".esc($parent)."' and `active`=1 order by id";
        $client=mysql_query($q);
        if($client){
			while ($list = mysql_fetch_assoc($client)){
					echo '<li>';
					echo  $list['name'];  
					echo '</li>';	
			}
		}
    }   
}
 
if ( ! function_exists('find'))
{
	function find($coloumn,$id,$table)
	{
		$result=mysql_fetch_assoc(mysql_query('select '.$coloumn.' from '.$table.' where id='.$id.''));
		return $result[$coloumn];
	}	
}
if ( ! function_exists('image'))
{
	function image($client_id)
	{
		$result=mysql_fetch_assoc(mysql_query('select * from client_picture_tb where `client_id`='.$client_id.''));
		if ($result)return 1;
		else return 0;
//		return $result['module_id'];
	}	
}
if ( ! function_exists('get_images'))
{
	function get_images($id)
	{
		$result=mysql_fetch_assoc(mysql_query('select `picture` from product_photo_tb where product_id='.$id.' AND main=1'));
		return $result['picture'];
	}	
} 
if ( ! function_exists('get_banner'))
{
	function get_banner($id)
	{
		$result=mysql_fetch_assoc(mysql_query('select `picture` from banner_tb where `id`='.$id.' AND `status`=1'));
		return $result['picture'];
	}	
} 
if ( ! function_exists('get_main_gallery_images'))
{
	function get_main_gallery_images($id)
	{
		$result=mysql_fetch_assoc(mysql_query('select `photo` from photo_tb where gallery_id='.$id.' and main=1'));
		return $result['photo'];
	}	
}

if ( ! function_exists('last_id'))
{
	function last_id($table)
	{
		$result=mysql_fetch_assoc(mysql_query('select id from '.$table.' order by id desc'));
		return $result['id'];
	}	
}

if ( ! function_exists('last_precedence_gallery'))
{
	function last_precedence_gallery($gallery_id)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from photo_tb where gallery_id = '.$gallery_id.' order by precedence desc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('first_precedence_gallery'))
{
	function first_precedence_gallery($gallery_id)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from photo_tb where gallery_id = '.$gallery_id.' order by precedence asc'));
		return $result['precedence'];
	}	
}


if ( ! function_exists('last_precedence'))
{
	function last_precedence($table)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' order by precedence desc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('first_precedence'))
{
	function first_precedence($table)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' order by precedence asc'));
		return $result['precedence'];
	}	
}


if ( ! function_exists('alert'))
{
	function alert($content)
	{
		echo "<script language='javascript'>alert('$content');</script>";
	}
	
}


if ( ! function_exists('display_date'))
{
	function display_date($date)
	{
		if($date!="0000-00-00")
		{
		$y=substr($date,0,4);
		$m=substr($date,5,2);
		$d=substr($date,8,2);
		$date_format=date("d M y",mktime(0,0,0,$m,$d,$y));
		}
		else
		{
		$date_format="-";
		}	
		return $date_format;
	}
}

if ( ! function_exists('display_date_full'))
{
	function display_date_full($date)
	{
		if($date!="0000-00-00 00:00:00")
		{
		$y=substr($date,0,4);
		$m=substr($date,5,2);
		$d=substr($date,8,2);
		$h=substr($date,11,2);
		$min=substr($date,14,2);
		$s=substr($date,17,2);
	
		$date_format=date("d M y, H:i",mktime($h,$min,$s,$m,$d,$y));
		
		}
		else
		{
		$date_format="-";
		}	
		return $date_format;
	}
}


if ( ! function_exists('display_date_admin'))
{
	function display_date_admin($date)
	{
		if($date!="0000-00-00")
		{
		$y=substr($date,0,4);
		$m=substr($date,5,2);
		$d=substr($date,8,2);
		$date_format=date("d-M-Y",mktime(0,0,0,$m,$d,$y));
		}
		else
		{
		$date_format="-";
		}	
		
		return $date_format;
	}
}

if ( ! function_exists('display_date_full_admin'))
{
	function display_date_full_admin($date)
	{
		if($date!="0000-00-00 00:00:00")
		{
		$y=substr($date,0,4);
		$m=substr($date,5,2);
		$d=substr($date,8,2);
		$h=substr($date,11,2);
		$min=substr($date,14,2);
		$s=substr($date,17,2);
		$date_format=date("d-M-Y H:i",mktime($h,$min,$s,$m,$d,$y));
		}
		else
		{
		$date_format="-";
		}	
		
		return $date_format;
	}
}

if ( ! function_exists('money'))
{
	function money($input)
	{
		return 'Rp. '.number_format($input, '0', ',', '.').',-';
		
	}

}

if ( ! function_exists('format_tanggal'))
{
	function format_tanggal($date)
	{
		$tanggal = strtotime($date);
		$hari = date("D", $tanggal);
		$bulan = date("M", $tanggal);
		$jam = date("H", $tanggal);
		$menit = date("i", $tanggal);
		
		//hari
		if ($hari == "Mon") {
			$hari = "Senin";
		}
		else if ($hari == "Tue") {
			$hari = "Selasa";
		}
		else if ($hari == "Wed") {
			$hari = "Rabu";
		}
		else if ($hari == "Thu") {
			$hari = "Kamis";
		}
		else if ($hari == "Fri") {
			$hari = "Jumat";
		}
		else if ($hari == "Sat") {
			$hari = "Sabtu";
		}
		else if ($hari == "Sun") {
			$hari = "Minggu";
		}
		
		//bulan'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
		if ($bulan == "Jan"){
			$bulan = "Januari";
		}
		else if($bulan == "Feb") {
			$bulan = "Februari";
		}
		else if($bulan == "Mar") {
			$bulan = "Maret";
		}
		else if($bulan == "Apr") {
			$bulan = "April";
		}
		else if($bulan == "May") {
			$bulan = "Mei";
		}
		else if($bulan == "Jun") {
			$bulan = "Juni";
		}
		else if($bulan == "Jul") {
			$bulan = "Juli";
		}
		else if($bulan == "Aug") {
			$bulan = "Agustus";
		}
		else if($bulan == "Sep") {
			$bulan = "September";
		}
		else if($bulan == "Oct") {
			$bulan = "Oktober";
		}
		else if($bulan == "Nov") {
			$bulan = "November";
		}
		else if($bulan == "Dec") {
			$bulan = "Desember";
		}
		
		$mix_all = $hari.", ".date("j", $tanggal)." ".$bulan." ".date("Y", $tanggal)." - ".$jam.".".$menit;
		
		return $mix_all;
	}	
}

if ( ! function_exists('curPageURL'))
{
	function curPageURL() {
 		$pageURL = 'http';
 		$pageURL .= "://";
 		if ($_SERVER["SERVER_PORT"] != "80") {
  			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 		} else {
  			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 		}
 	return $pageURL;
	}
}

if ( ! function_exists('esc')) //alias: mysql_real_escape_string()
{
	function esc($string)
	{
		$result=$string;
		return $result;
	}	
}

if ( ! function_exists('createRandomPassword'))
{
	function createRandomPassword()
	{
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;
		
		while ($i <= 7) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
	return $pass;
	}	
}
if ( ! function_exists('getSizeImage'))
{	function getSizeImage ($image)
    {
        $imgData = getimagesize($image);
        $retval['width'] = $imgData[0];
        $retval['height'] = $imgData[1];
        $retval['mime'] = $imgData['mime'];
        return $retval;
    }
}
/* End of file number_helper.php */
/* Location: ./system/helpers/number_helper.php */
?>