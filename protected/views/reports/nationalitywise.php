<?php
$branch_id = yii::app()->user->branch_id;	 
$branch_info = HmsBranches::model()->findAll("branch_id=$branch_id");
 foreach($branch_info as $b_info){
	 $branch_address = $b_info['branch_address'];
	 $branch_phone = $b_info['branch_phone'];
	 $branch_fax = $b_info['branch_fax'];
	 $branch_email = $b_info['branch_email'];
	 $hotel_id = $b_info['hotel_id'];	 		
			$hotel_info = HotelTitle::model()->findAll("id=$hotel_id");
 			foreach($hotel_info as $h_info){
	 		$hotel_title = $h_info['title'];
			$hotel_website = $h_info['website'];
			$hotel_logo_image = $h_info['logo_image'];
	 		}
	 }	 
$branch_address .= "<br> Phone: $branch_phone Fax: $branch_fax <br> email: $branch_email";	 
//print_r($data);
$from_date1 = $data['from_date'];
$to_date1 = $data['to_date'];
$criteria = $data['criteria'];
if(isset($from_date1)and isset($to_date1)){
	$showdate= "<br/> From  ".date("d/m/Y H:i", strtotime($from_date1)). "\t TO:".date("d/m/Y H:i", strtotime($to_date1));
	}
	
//$_SESSION['gst_show'] = 'to do';
$sval = Yii::app()->session['taxcontrol'];
if(isset($sval) && $sval=='ON') $gst_show = " AND ci.gst_show > 0";
else $gst_show = "";
//echo "---".$gst_show;
 ?>
 
 
<div class="container_mce">
  <table  width="100%" border="0">
 
  <tr>    
    <td colspan="3" align="center"><strong>HOTEL CROWN PLAZA ISLAMABAD</strong></td>    
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>Nationality Wise Report</strong></td>    
  </tr>
  <tr>    
    <td colspan="3" align="center"><strong>  <?php echo $showdate; ?></strong></td>
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
<table width="100%" border="0" align="center">
      <tr>
       <td><strong>Sr#</strong></td>
       <td><strong>Room</strong></td>       
        <td><strong>Guest Name</strong></td>
        <td><strong>Nationality</strong></td>
        <td><strong>Company</strong></td>   
       <!-- <td><strong>Identity Doc</strong></td>   -->          
        <td><strong>Identity No</strong></td>
       <!-- <td><strong>Status</strong></td>-->
        <td><strong>Check-In</strong></td>
        <td><strong>Check-Out</strong></td>
      
      </tr>
      <?php
	  
	   $sql = "Select ci.*, gi.*, c.country_name
			From hms_checkin_info ci
			Left join hms_guest_info gi
			On ci.guest_id = gi.guest_id 
			Left join country c
			On gi.guest_country_id = c.country_id
			where "; 
 		$sql .=" c.country_name LIKE '%$criteria%' AND ci.branch_id = $branch_id ".$gst_show . " AND  chkin_date between '$from_date1' AND '$to_date1' order by ci.room_id"; 
		//echo $sql;
 $chkin_info = Yii::app()->db->createCommand($sql)->query();      
	  
 foreach($chkin_info as $rs){
	 $i++;
	 $chkin_id = $rs['chkin_id'];
	 
	 $sql_min = "select MIN(id) from hms_guest_ledger where chkin_id = $chkin_id";
	 $min_id = Yii::app()->db->createCommand($sql_min)->queryScalar();
	 $sql_min = "select c_date from hms_guest_ledger where id = $min_id";
	 $chkin_date_time = Yii::app()->db->createCommand($sql_min)->queryScalar();
	 $chkin_time = explode(" ",$chkin_date_time);
	 $a = explode(":", $chkin_time[1]);
	 $chkin_time = $a[0].":".$a[1];
	 
	 $chkout_time = '';
	 if($rs['chkout_status']=='Y'){
	 $sql_max = "select MAX(id) from hms_guest_ledger where chkin_id = $chkin_id";
	 $max_id = Yii::app()->db->createCommand($sql_max)->queryScalar();
	 $sql_max = "select c_date from hms_guest_ledger where id = $max_id";
	 $chkout_date_time = Yii::app()->db->createCommand($sql_max)->queryScalar();
	 $chkout_time = explode(" ",$chkout_date_time);
	 $a = explode(":", $chkout_time[1]);
	 $chkout_time = $a[0].":".$a[1];
	 
	 }
	 
	 $guest_id = $rs['guest_id'];
	 $chkin_date = $rs['chkin_date'];
	 $chkout_date = $rs['chkout_date'];
	 
	 $guest_folio_no = $row['guest_folio_no'];
	 $gst_folio_no = $row['gst_show'];	 
	 if(empty($gst_show))	{ $folio_no =  $guest_folio_no; }
	 else $folio_no = $gst_folio_no;	
	 
	 $chkout_status = $rs['chkout_status'];
	 if($chkout_status=='Y') $chkout_status = "Checked Out";
	 if($chkout_status=='N') $chkout_status = "Checked In";	 	 
	 $room_name=RoomMaster::model()->find("mst_room_id	= ". $rs['room_id'])->mst_room_name;	  
	 $rate = $rs['rate'];
	 $bed_tax = $rs['bed_tax'];
	 if($bed_tax == 'Y'){ $total_person = $rs['total_person']; }
	 else{		 $total_person = 0;	 }	 
	 $gst = $rs['gst'];
	 if($gst == 'Y'){
		 	$gst_percent =ServiceGst::model()->find("gst_service_id  = 1 and branch_id = $branch_id")->gst_percent;		 				
			$gst_amount = $rate * $gst_percent / 100;			
		 }else{	 $gst_amount = 0;	 }			 
	
	    $company_name = Company::model()->find("comp_id = ".$rs['guest_company_id'])->comp_name;	 
	 	$guest_info = 	GuestInfo::model()->findAll("guest_id=$guest_id");
	 	foreach($guest_info as $r){
			$guest_id=$r['guest_identity_id'];
			$identity_des=Identity::model()->find("identity_id=$guest_id")->identity_description;			
			$guest_identity=$r['guest_identity_no'];
			$guest_country_id = $r['guest_country_id'];			
			$country_name = 	Country::model()->find("country_id =$guest_country_id")->country_name;			
			$salutation_name = 	Salutation::model()->find("salutation_id=".$r['guest_salutation_id'])->salutation_name;
			//$guest_name = $r['guest_name'];
		}	
		$guest_name = $rs['guest_name'];	
		$persons = $rs['total_person'];		
		$total_rate = $total_rate + $rate;
		$total_gst += $gst_amount;
		$total_BedTax += $total_person; 
	
	  ?>
      <tr>
      	<td><?php echo $i;?></td>
        <td> <?php echo $room_name;?></td>             
        <td><?php echo $salutation_name.strtoupper(strtolower($guest_name));?></td> 
        <td><?php echo $country_name; ?></td>         
        <td><?php echo $company_name;?></td>
       <!-- <td><?php //echo $identity_des;?></td>-->
        <td><?php  echo str_replace("_"," ",$guest_identity);?></td>
         <!--<td><?php //echo $chkout_status;?></td>-->
        <td><?php echo date("d/m/y",strtotime($chkin_date)) ." ". $chkin_time;?></td>
        <td><?php echo date("d/m/y",strtotime($chkout_date))." ". $chkout_time;?></td>       
    </tr>
      <?php
 	}
	  ?>
  </table>
   
  <div style="clear:both"></div>  
   
 <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>