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

if(isset($from_date1) and isset($to_date1)){	
$showdate="<br/> From:".date("d/m/y" ,strtotime($from_date1))." \t TO: " .date("d/m/y", strtotime($to_date1));	
}
?>
 
<div class="container_mce">
	 <table width="100%" border="0"> 
  <tr>
    <td colspan="3" align="center" style="font-size: 12px;"><strong>Group Reservation Report</strong></td>   
  </tr>  
  <tr>    
    <td colspan="3" align="center" style="font-size: 10px;"><strong><?php echo $showdate; ?></strong></td>    
  </tr>
</table>

 
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
  <table width="100%" border="0">
    <tr>
       <td><strong>Sr#</strong></td>
      
      <td align="left"><strong>Comapny</strong></td >   
      <td align="left"><strong>Contact Person</strong></td>
       <td align="left"><strong>Mobile No</strong></td>
      
      <td align="left"><strong>Check In</strong></td>
      <td align="left"><strong>Check Out</strong></td>
     
      <td align="left"><strong>Room Type</strong></td>     
       <td align="left"><strong>Total</strong></td>
    </tr>
    <?php
	
	
//$result = ReservationInfo::model()->findAll(" res_type='G' and chkin_status='N' and reservation_status != '2' and chkin_date between '$from_date1' and '$to_date1' and branch_id = $branch_id group by group_name");


$sql = "select ri.*, count(ri.reservation_id) AS total From hms_reservation_info ri where res_type='G' and chkin_status='N' and reservation_status != '2' and chkin_date between '$from_date1' and '$to_date1' and  branch_id = $branch_id GROUP BY group_name HAVING COUNT(ri.reservation_id) > 2";
$result = Yii::app()->db->createCommand($sql)->query();
$total_record = count($result);
	
    foreach($result as $rs){
			$i++;
	 		$res_type = $rs['res_type'];		 		
			$to_person = $rs['to_person'];
			$group_name = $rs['group_name'];						
			$companyname=Company::model()->find("comp_id=".$rs['company_id'])->comp_name;		 				
			$address=$rs['client_address'];
			$phone=$rs['client_mobile'];
			$chkin_date=$rs['chkin_date'];
			$chkout_date=$rs['chkout_date'];
			$room_type = HmsRoomType::model()->find("room_type_id = " . $rs['room_type'])->room_name;
			$pickup=$rs['pick_service'];
			$total=$rs['total'];
	
	?>
    <tr >
      <td align="left"><?php echo $i;?></td>      
      <td align="left"><?php echo $companyname;?></td>
      <td align="left"><?php echo ucwords(strtolower($to_person));?></td>      
      <td align="left"><?php echo $phone;?></td>      
      <td align="left"><?php echo date("d/m/y",strtotime($chkin_date));?></td>
      <td align="left"><?php echo date("d/m/y",strtotime($chkout_date));?></td>     
      <td align="left"><?php echo $room_type;?></td>      
      <td align="left"><?php echo $total." Rooms";?></td>
    </tr>
    <?php } ?>
  </table>
  <div style="clear:both"></div>
  
  <p align="right" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
  
</div>
