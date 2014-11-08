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
$from_date1 = $_POST[from_date];
$to_date1 = $_POST[to_date];
	  //$_SESSION['gst_show'] = 'to do';
$sval = Yii::app()->session['taxcontrol'];
if(isset($sval) && $sval=='ON') $gst_show = " AND gst_show > 0";
else $gst_show = "";
	 
///////// start of guest ledger info
$gl_res = GuestLedger::model()->findAll("c_date='$from_date1' AND room_status !='O'");
////////// end of code
//$result = ReservationInfo::model()->findAll("chkin_status='N' and reservation_status = '1' and chkin_date between '$from_date1' and '$to_date1' and branch_id = $branch_id");
$checkin =CheckinInfo::model()->findAll("chkout_status ='Y' ". $gst_show ." and branch_id = $branch_id ORDER BY room_id");
/*$gl_res = GuestLedger::model()->findAll("c_date='$from_date1' AND room_status !='O' group by chkin_id");
$total_record = count($gl_res);*/
	//echo "--bb-".$total_record; 
 ?>
 
<div class="container_mce">
  <table width="100%" border="0">
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
    <td colspan="3" align="center" style="font-size: 12px;"><strong>GUEST HISTORY REPORT</strong></td>    
  </tr>
  <tr>
    <td colspan="3" align="center"><strong><!--LONG STAYING IN-HOUSE REPORT--></strong></td> 
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
  <table width="100%" border="0">
    <tr>
     <td><strong>Sr#</strong></td>
       <td align="left"><strong>Room #</strong></td>
       <td align="left"><strong>Folio</strong></td>       
       <td align="left"><strong>Guest Name</strong></td>
       <td align="left"><strong>Room Type</strong></td>
       <td align="left"><strong>Company</strong></td> 
       <td align="left"><strong>Rate</strong></td>
       <td align="left"><strong>Nights</strong></td>
       <td align="left"><strong>Check-In</strong></td>
       <td align="left"><strong>Check-Out</strong></td>
         
    </tr>
    <?php
    foreach($checkin as $row){
		$i++;		
		$room_name = RoomMaster::model()->find("mst_room_id=". $row['room_id'])->mst_room_name;
		
		$guest_folio = $row['chkin_id'];
		$guestid=$row['guest_id'];
		$guest=GuestInfo::model()->find("guest_id=$guestid");
		$guestname=$guest->guest_name;	
		$room_type = HmsRoomType::model()->find("room_type_id=". $row['room_type'])->room_name;
		
		$company_id = $row['guest_company_id'];
	 	$company=Company::model()->findAll("comp_id =$company_id");
						foreach($company as $comp){
						$company_name = $comp['comp_name'];
						}	
	 	$rate=$row['rate'];	
		$total_nights=$row['total_days'];
		$chkin_date = $row['chkin_date'];		
		$chkout_date = $row['chkout_date'];
	
	?>
    <tr class="text">
      <td align="left"><?php echo $i;?></td>
       <td align="left"><?php echo $room_name;?></td>
        <td align="left"><?php echo $guest_folio;?></td>
        <td align="left"><?php echo strtoupper(strtolower($guestname)); ?></td>
        <td align="left"><?php echo $room_type; ?></td>
         <td align="left"><?php echo $company_name;?></td>
         <td align="left"><?php echo $rate;?></td>
          <td align="left"><?php echo $total_nights;?></td>
         <td align="left"><?php echo date("d/m/y",strtotime($chkin_date));?></td>
       <td align="left"><?php echo date("d/m/y",strtotime($chkout_date));?></td>
     
    </tr>
    <?php } ?>
  </table>
  <div style="clear:both"></div>
    
  <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>