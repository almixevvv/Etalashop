<?php
Class M_appointment extends CI_Model {
	
	
	function getDetailApp($app_id){
	    $query = 
	    $this->db->query("SELECT a.date, a.time, a.address, a.appointment, 
	    	a.appointment_name, a.date_appointment, a.phone_appointment,
	    	 a.booking_status, a.note, a.total_order, a.mua_id, b.first_name, b.last_name, a.booking_code 
			FROM `g_appointment` a 
			left outer join g_mua b on b.mua_id = a.mua_id
			WHERE a.`appointment_id`='$app_id'");

	    if ($query->num_rows() > 0) {
	       return $query->result();
	    }else return null;
	  
	}
	
	  function getDetailAppService($booking_code){
	    
		$this->db->from('g_booking');
		$this->db->where('booking_code', $booking_code);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}else return null;

	  }
	function data_appointment(){    
		$mua_id = $this->session->userdata('mua_id');
		$appointment = $this->db->query("SELECT * FROM v_transaksi WHERE mua_id='$mua_id' ORDER BY date_appointment DESC");
		return $appointment;
    }
    function data_upcoming(){    
		$mua_id = $this->session->userdata('mua_id');
		$appointment = $this->db->query("SELECT * FROM v_transaksi WHERE mua_id='$mua_id' ORDER BY date_appointment DESC");
		return $appointment;
    }
	
	function data_appointment_table(){    
		$mua_id = $this->session->userdata('mua_id');
		$appointment_table = $this->db->query("SELECT * FROM g_appointment where mua_id='$mua_id' and ( date(`date_appointment`) >= date(now()) ) ");
		return $appointment_table;
    }
    function data_upcoming_table(){    
		$mua_id = $this->session->userdata('mua_id');
		$appointment_table = $this->db->query("SELECT * FROM g_appointment where  booking_status='NEW' and mua_id='$mua_id' and ( date(`date_appointment`) >= date(now()) )");
		return $appointment_table;
    }
	
	function data_count_appointment(){    
		$mua_id = $this->session->userdata('mua_id');
		$count_appointment = $this->db->query("SELECT DISTINCT mua_id,
			(SELECT COUNT(`appointment_id`) FROM `g_appointment` where mua_id='$mua_id'  and ( date(`date_appointment`) >= date(now()) ) ) `COUNT_HISTORY`,
			(SELECT COUNT(`appointment_id`) FROM `g_appointment` where mua_id='$mua_id' AND `booking_status`='NEW'  and ( date(`date_appointment`) >= date(now()) ) ) `COUNT_UPCOMING` 
			FROM `g_appointment` WHERE mua_id='$mua_id'");
		return $count_appointment;
    }
    function update_appointment($appointment_id,$data){    
		$this->db->where("appointment_id",$appointment_id);
		$this->db->update("g_appointment",$data);
    }
	
	
function getlastappointment() {
		$this->db->from("g_appointment");
		$this->db->order_by("appointment_id","desc");
        $this->db->limit(1);

        $query = $this->db->get();

    if($query->num_rows() > 0)
{

    $appointment_id= $query->first_row()->appointment_id;
	 return $appointment_id;

}
else
{

   $appointment_id='0';
   
   return $appointment_id;
}
    }


	
	
	function insert_appointment($user_id,$customer_name,$customer_address,$mua_id,$address_appointment,$full_date,$time,$note,$appointment,$type,$fix_total_amount,$rowcount,$details,$longitude,$latitude,$details,$currentdate,$new_appointment_id){
	
		
		//var_dump($new_member_id);
		// $this->db->set('appointment_id', $new_appointment_id, TRUE);
		// $this->db->set('booking_code', $new_appointment_id, TRUE);
		
		$customer_phone = "-";
		
		$result_m = $this->db->query("INSERT INTO g_appointment (appointment_id,username,date,time,address,appointment,appointment_name,date_appointment,address_appointment,phone_appointment,booking_status,booking_code,note,mua_id,type,total_order,longitude,latitude) 
			VALUES ('$new_appointment_id','$user_id','$full_date','$time','$customer_address',
			'$appointment','$customer_name','$currentdate','$address_appointment','$customer_phone','NEW',
			'$new_appointment_id','$note','$mua_id','$type','$fix_total_amount','$longitude','$latitude')");

		for ($i = 0; $i < count($details); $i++) {
		// for ($i = 0; $i < $rowcount; $i++) {
			$result_m=$this->db->query("INSERT INTO g_booking 
				VALUES ('$new_appointment_id','".$details[$i]['cart_service_name']."','".$details[$i]['cart_service_qty']."','".$details[$i]['cart_service_price']."','0')");
		}		
		return $result_m;	
	}
		
	function newappointment($customer_id,$date,$time,$customer_address,$appointment,$customer_name,$address_appointment,$customer_phone,$note,$mua_id,$type)
	{
	
	$appointment_id= $this->getlastappointment();
	if ($appointment_id=='0'){
				$last_appointment_id=1;
			}else{

				$last_appointment_id=intval(substr($appointment_id, -6))+1;
			}
			

	$new_appointment_id = "A".date("ym").str_pad(strval($last_appointment_id), 6, "0", STR_PAD_LEFT);

	//var_dump($new_member_id);
	$this->db->set('appointment_id', $new_appointment_id, TRUE);
	$this->db->set('booking_code', $new_appointment_id, TRUE);

	
	
	$result=$this->db->insert('g_appointment', array('username'=>$customer_id,												
												// 'date'=>$date,
												// 'time'=>$time,
												 'address'=>$customer_address,												 
												 'appointment'=>'appointment',
												 'appointment_name'=>$customer_name,
												 'address_appointment'=>$address_appointment,
												 'phone_appointment'=>$customer_phone,
												 'note'=>$note,
												 'mua_id'=>$mua_id,
												 'type'=>'appointment'
												 		));
														
	$result=$this->db->insert('g_booking', array('booking_code'=>$new_appointment_id,												
											
												 'service'=>'Hair Style',												 
												 'price'=>'20000',
												 'discount'=>'0'
												 		));
														
														$result=$this->db->insert('g_booking', array('booking_code'=>$new_appointment_id,												
											
												 'service'=>'Make Up',												 
												 'price'=>'50000',
												 'discount'=>'0'
												 		));

			if($result)
			{
			return true;	
			}
			else
			{
				return false;
			}

	
		
	}
	
	function getHistoryAppointment($username)
  {
     // $this->db->select('booking_status,mua_id,DATE_FORMAT(date_appointment,\'%d %b %Y\') as date_appointment');

$query = $this->db->query("SELECT booking_status,concat(b.first_name,' ',b.last_name) as mua_id, a.appointment_id,DATE_FORMAT(date_appointment,'%d %b %Y') as date_appointment FROM g_appointment a left join g_mua b on a.mua_id=b.mua_id WHERE a.username='".$username."' ORDER BY a.date_appointment DESC");


  
         return $query->result();
		 
		 
   
  }
  
	function check_date($newStart,$mua_id){

		$this->db->from('g_appointment');
		$this->db->where('date', $newStart);
		$this->db->where('mua_id', $mua_id);
		$this->db->where('type', 'Not Available');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}else return null;

	} 
	function check_date_id($app_id){

		$this->db->from('g_appointment');
		$this->db->where('appointment_id', $app_id);
		$this->db->where('type', 'Not Available');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}else return null;

	} 
	function SetNotAvailable($newStart,$mua_id){
	    
		$appointment_id = $this->getlastappointment();
		if ($appointment_id =='0'){
			$last_appointment_id=1;
		}else{
			$last_appointment_id=intval(substr($appointment_id, -6))+1;
		}
		$new_appointment_id = "A".date("ym").str_pad(strval($last_appointment_id), 6, "0", STR_PAD_LEFT);
		$array = array(
			'appointment_id' => $new_appointment_id,
			'username' => null,
			'date' => $newStart,
			'time' => '00:00:00',
			'address' => 'Not Available',
			'appointment' => 'Not Available',
			'appointment_name' => 'Not Available',
			// 'date_appointment' => 'Not Available',
			'address_appointment' => 'Not Available',
			'note' => 'Not Available',
			'type' => 'Not Available',
			'mua_id' => $mua_id,
			);
		return $result = $this->db->insert('g_appointment', $array);

	}
	
    function UnAvailable($app_id){    
		$this->db->where("appointment_id",$app_id);
		$this->db->delete("g_appointment");
    }
	
	
	
}

?>