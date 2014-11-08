<?php
$user_id = yii::app()->user->id;
$user_info = User::model()->findAll("id=$user_id");
foreach($user_info as $u_info){	 $user_name = $u_info['username'];	 }
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

$sql = "select cy.comp_name from hms_checkin_info ci LEFT JOIN hms_company_info cy ON ci.guest_company_id = cy.comp_id where ci.chkout_status='N' and cy.comp_name LIKE '$criteria%'";
$comp_name = Yii::app()->db->createCommand($sql)->queryScalar();
 ?>
 
<div class="container_mce">
  <table width="100%" border="0"> 
  <tr>
    <td colspan="3" align="center" style="font-size: 12px;"><strong>GROUP IN-HOUSE REPORT</strong></td>   
  </tr>  
  <tr>    
    <td colspan="3" align="center" style="font-size: 10px;"><strong>COMPANY - <?php echo strtoupper($comp_name); ?></strong></td>    
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
  <table width="100%" border="0">
    <tr>       
      <td align="left"><strong>Room</strong></td>
      <td align="left"><strong>Guest Name</strong></td>      
      <td align="left"><strong>Person</strong></td>         
      <td align="left"><strong>Nationality</strong></td>
      <td align="left"><strong>Arrival</strong></td>
      <td align="left"><strong>Departure</strong></td>      
    </tr>
    <?php
	  $sql = "select ci.* FROM hms_checkin_info ci LEFT JOIN hms_guest_info gi ON ci.guest_id = gi.guest_id LEFT JOIN hms_company_info comp_in ON ci.guest_company_id = comp_in.comp_id where ci.chkout_status='N' AND ci.gst_show > 0 and comp_in.comp_name LIKE '%$criteria%' and ci.branch_id = $branch_id Order BY ci.guest_company_id";
	 //echo $sql;
	  $result = Yii::app()->db->createCommand($sql)->query();
	
	$total_guests =0;
	$total_record = count($result);	
    foreach($result as $ch){
		$i++;	
		//$reserv_id= $row['reservation_id'];
		//$group_name= $row['group_name'];
		/////////////////////////////////////////
		//$chk=CheckinInfo::model()->findAll("reservation_id=$reserv_id order by room_id");		
		//foreach ($chk as $ch){
			$guest_company_id=$ch['guest_company_id'];
			$company_name=Company::model()->find("comp_id	= $guest_company_id")->comp_name;	
			$room=$ch['room_id'];
	 		$room_name=RoomMaster::model()->find("mst_room_id	= $room")->mst_room_name;	 		
	  		$total_person = $ch['total_person'];
			$total_guests += $total_person;
	 		$guest_id = $ch['guest_id'];
	 		$chkin_date = $ch['chkin_date'];
	 		$chkout_date = $ch['chkout_date'];	 		
			$guest_info = 	GuestInfo::model()->findAll("guest_id=$guest_id");	 		
				foreach($guest_info as $r){				
					$guest_name = $r['guest_name'];
					$guest_contact=$r['guest_mobile'];				
					$country_name = 	Country::model()->find("country_id =". $r['guest_country_id'])->country_name;			
					$salutation_name = 	Salutation::model()->find("salutation_id=".$r['guest_salutation_id'])->salutation_name;				
				}			
			//}
	?>
    <tr >       
      <td><?php echo  $room_name;?></td>
      <td><?php echo $salutation_name.strtoupper($guest_name);?></td>      
      <td><?php echo $total_person;?></td>
      <td><?php echo $country_name;?></td>
      <td><?php echo date("d/m/y",strtotime($chkin_date));?></td>
      <td><?php echo date("d/m/y",strtotime( $chkout_date));?></td>    
    </tr>
    <?php } ?>
  </table>
  <div style="clear:both"></div>
<p><strong>Total Rooms: <?php echo $i;?></strong></p> 
<p><strong>Total Guests: <?php echo $total_guests;?></strong></p> 
  
   <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>