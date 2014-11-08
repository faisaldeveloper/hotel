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
$result = ReservationInfo::model()->findAll("chkin_status='N' and (reservation_status = '1' || reservation_status = '3') and chkin_date between '$from_date1' and '$to_date1' and branch_id = $branch_id");
$total_record = count($result);
	
	
	 
 ?>
<style>
@media screen{
.container_mce{	
	font-size:9px;
	width:1070px;	
}
}
@media print{
.container_mce{	
	font-size:9px !important;
	width:1070px;	
}
}
</style>
 
<div class="container_mce">
    <table  width="100%" border="0">
<!--
  <tr>
    <td rowspan="3">&nbsp;</td>
    <td rowspan="3"><img src="<?php //echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php //echo $hotel_logo_image;?>" height="98px" width="75px" /></td>
    <td colspan="3" align="center">&nbsp;<font size="+2"><strong><?php //echo ucwords($hotel_title); ?></strong></font></td>
    
    <td rowspan="3"><strong>Date</strong></td>
    <td rowspan="3"><?php //echo date('j F, Y H:i:s');?></td>
  </tr>
-->
  <tr>   
    <td colspan="3" align="center" style="font-size: 12px;"><strong>RESERVATION REPORT</strong></td>    
  </tr>
  <tr>      
    <td colspan="3" align="center" style="font-size: 10px;"><strong><?php echo $showdate; ?></strong></td>   
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
  <table width="100%" border="0">
    <tr>
      <td><strong>Conf#</strong></td>
      <td align="left"><strong>Guest Name</strong></td>
      <td align="left"><strong>Comapny</strong></td>      
      <td align="left"><strong>Room Type</strong></td>
      <td align="left"><strong>Rate</strong></td>
      <td align="left"><strong>Arrival</strong></td>
      <td align="left"><strong>Check Out</strong></td>      
      
      <td align="left"><strong>Flight</strong></td>      
      <td align="left"><strong>Remarks</strong></td>
    </tr>
    <?php
    foreach($result as $row){
		$i++;
	$res_id = $row['reservation_id'];
	 $res_type = $row['res_type'];
	 $company_id = $row['company_id'];
	 		$company=Company::model()->findAll("comp_id =$company_id");
						foreach($company as $comp){
						$company_name = $comp['comp_name'];
						}
		
		
	
	 $chkin_date = $row['chkin_date'];
	 $chkout_date = $row['chkout_date'];
	 
	 $total_days = $row['total_days'];
	 
	 $pick_service = $row['pick_service'];
	 $flight_name = $row['flight_name'];
	 		
			if($pick_service=='Y'){
			$pickup = "Yes";
			if(!empty($flight_id))
			$p_flight_info = Flights::model()->findAll("flight_id=$flight_name");
			 foreach($p_flight_info as $p_flight_info){
				 $p_flight_name = $p_flight_info['flight_name'];
				 }
				 $flight_time = $row['flight_time'];
			}else{
				$p_flight_name = "";
				$flight_time = "";
				$pickup = "No";
				}
	 
	 
	 
	 
	 
	 $client_salutation_id = $row['client_salutation_id'];
	 	
				$saluations = 	Salutation::model()->findAll("salutation_id=$client_salutation_id");
				foreach($saluations as $s){
					$salutation_name = $s['salutation_name'];
					}
	 
	 $client_name = $row['client_name'];
	 $client_address = $row['client_address'];
	 $client_country_id = $row['client_country_id'];
	 $client_mobile = $row['client_mobile'];
	 
	 $client_phone = $row['client_phone'];
	 $client_email = $row['client_email'];
	 $client_remarks = $row['client_remarks'];
	 $room_charges = $row['room_charges'];
	 $discount = $row['discount'];
	 $gst = $row['gst'];
	 $advance = $row['advance'];	
	
	$room_type = HmsRoomType::model()->find("room_type_id =".$row['room_type'])->room_name;
	$room_charges = $row['room_charges'];
	?>
    <tr class="text">
      <td align="left"><?php echo $res_id;?></td>
      <td align="left"><?php echo $salutation_name.ucwords($client_name);?></td>
      <td align="left"><?php echo $company_name;?></td>      
	<td align="left"><?php echo $room_type;?></td>
	<td align="left"><?php echo $room_charges;?></td>
     <td align="left"><?php echo date("d/m/y",strtotime($chkin_date));?></td>
      <td align="left"><?php echo date("d/m/y",strtotime($chkout_date));?></td>      
      
      <td align="left"><?php echo $p_flight_name;?></td>      
      <td align="left"><?php echo $client_remarks;?></td>
    </tr>
    <?php } ?>
  </table>
  
<div style="margin-top:30px;"></div>
 <?php
  	$total_guest = Yii::app()->db->createCommand("select SUM(total_person) from hms_checkin_info where chkout_status = 'N' and branch_id = $branch_id")->queryScalar();
	?>
    
    <table width="20%" border="0" align="left">
	<tr>
        <td>&nbsp;</td>
        <td><strong>TOTALRESERVATION(S) :</strong></td>
        <td><?php echo $i;?></td>   
      
    </table>
   
     
 <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>
