<?php
$user_id = yii::app()->user->id;
$user_info = User::model()->findAll("id=$user_id");
 foreach($user_info as $u_info){
	 $user_name = $u_info['username'];
	 }
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
if(isset($from_date1)and isset($to_date1)){
	$showdate= "<br/> From  ".date("d/m/Y H:i", strtotime($from_date1)). "\t TO:".date("d/m/Y H:i", strtotime($to_date1));
	}
//$_SESSION['gst_show'] = 'to do';
$sval = Yii::app()->session['taxcontrol'];
if(isset($sval) && $sval=='ON') $gst_show = " AND gst_show > 0";
else $gst_show = "";
$from_date1 = $data['from_date'];
$to_date1 = $data['to_date'];
$checkin =CheckinInfo::model()->findAll("drop_service ='Y' and flight_name!=''  and  chkout_date between '$from_date1' and '$to_date1' and branch_id = $branch_id ");
?>
 
<div class="container_mce">
  <table width="100%" border="0">  
  <tr>   
    <td colspan="3" align="center" style="font-size: 12px;"><strong>GUEST DROPOFF REPORT</strong></td>    
  </tr>
  <tr>      
    <td colspan="3" align="center" style="font-size: 10px;"><strong><?php echo $showdate; ?></strong></td>   
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
  <table width="100%" border="0">
    <tr>
      <td><strong>Sr#</strong></td>
      <td align="left"><strong>Room No</strong></td>
      <td align="left"><strong>Guest Name</strong></td>
      <td align="left"><strong>Comapny</strong></td>
      <td align="left"><strong>Mobile</strong></td>                 
      <td align="left"><strong>Flight</strong></td>
      <td align="left"><strong>Time</strong></td>
      <td align="left"><strong>Date</strong></td>     
    </tr>
    <?php
    foreach($checkin as $row){
		$i++;				
		$guest=GuestInfo::model()->find("guest_id=". $row['guest_id']);
		$guest_name=$guest->guest_name;
		$guest_mobile=$guest->guest_mobile;
		$guest_phone=$guest->guest_phone;		
		
		$flight_name = "";	
		if(!empty($row['flight_name']))$flight_name = Flights::model()->find("flight_id= ". $row['flight_name'])->flight_name;		
		$flight_time=$row['flight_time'];
		$check_out = date("d/m/y", strtotime($row['chkout_date']));		
	 	$company_name=Company::model()->find("comp_id =". $row['guest_company_id'])->comp_name;
		$room_name = RoomMaster::model()->find("mst_room_id=". $row['room_id'])->mst_room_name;
					
	?>
    <tr class="text">
      <td align="left"><?php echo $i;?></td>
      <td align="left"><?php echo $room_name;?></td> 
      <td align="left"><?php echo strtoupper($guest_name);?></td>
      <td align="left"><?php echo $company_name;?></td> 
      <td align="left"><?php echo $guest_mobile;?></td>             
      <td align="left"><?php echo $flight_name;?></td>
      <td align="left"><?php echo $flight_time;?></td>
       <td align="left"><?php echo $check_out;?></td>
    </tr>
    <?php } ?>
  </table>
 <div style="clear:both"></div>
 
  <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>