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
//echo "--".$company_id;

if(isset($_GET['d1']) && isset($_GET['d2'])){
$from_date1 = $_GET['d1'];
$to_date1 = $_GET['d2'];	
}

if(isset($from_date1) and isset($to_date1)){	
$showdate="<br/> From:".date("d/m/y" ,strtotime($from_date1))." \t TO: " .date("d/m/y", strtotime($to_date1));	
}


$result = Company::model()->find(" comp_id = $company_id");
$company_name = $result->comp_name;
$comp_address = $result->comp_address;
$comp_phone = $result->comp_phone;
?>
 
 
 
<div class="container_mce">
  <table width="100%" border="0">  
  <tr>
    <td colspan="3" align="center" style="font-size:12px"><strong>COMPANY WISE SALE REPORT</strong></td>   
  </tr>
  
  <tr>    
    <td colspan="3" align="center" style="font-size:10px"><strong> <?php echo $showdate; ?></strong></td>  
  </tr> 
  <tr>    
    <td colspan="3" align="center"><strong>Company Wise Report: <?php echo $company_name; ?></strong></td>
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
  <table width="100%" border="0">
    <tr>      
      <td width="5%" align="left"><strong>Room</strong></td>
      <td width="8%" align="left"><strong>Folio No</strong></td>     
      <td width="13%" align="left"><strong>Guest Name</strong></td>
      <td width="10%" align="left"><strong>Check-In</strong></td>  
      <td width="12%" align="left"><strong>Check-Out</strong></td>
      <td width="7%" align="left"><strong>Nights</strong></td>      
      <td width="9%" align="right"><strong>Room Rate</strong></td>
      <td width="10%" align="right"><strong>Room Charges</strong></td>
      <td width="10%" align="right"><strong>Other Charges</strong></td>
      <td width="11%" align="right"><strong>Total</strong></td>
      
       <td width="5%">&nbsp; </td>   
    </tr>
    <?php	  $i=0; $rm_total = 0; $other_total = 0; $g_total =0; $g_nights =0;
	$guest=CheckinInfo::model()->findAll("chkin_date between '$from_date1' and '$to_date1' AND guest_company_id =".$company_id." order by chkin_id");	
	  foreach($guest as $row){
		  $i++;		 		 		  	 	
		  $guest_name = GuestInfo::model()->find("guest_id = ".$row['guest_id'])->guest_name;
		  $room_no = RoomMaster::model()->find("mst_room_id =".$row['room_id'])->mst_room_name;		
		 
		  $chkin_id = $row['chkin_id']; 		 
		  $nights = $row['total_days']; 		
		  $checkin_date = $row['chkin_date']; 	
		  $checkout_date = $row['chkout_date'];
		  $rate = $row['rate']; 
		  
		  $room_charges = getCharges($chkin_id);
		  $rm_total +=$room_charges[0];
		  $other_total +=$room_charges[1];
		  $g_total +=$room_charges[2];	  	
		  $g_nights +=$nights; 
	?>
    <tr class="text">      
       <td align="left"><?php echo $room_no; ?></td>
       <td align="left"><?php echo $chkin_id;?></td>   
       <td align="left"><?php echo strtoupper(strtolower($guest_name));?></td>
       <td align="left"><?php echo date('d/m/y',strtotime($checkin_date)); ?></td>
       <td align="left"><?php echo date('d/m/y',strtotime($checkout_date)); ?></td>
       <td align="left"><?php echo $nights;?></td>
       
       
       <td align="right"><?php echo number_format($rate, 2);?></td>
       <td align="right"><?php echo number_format($room_charges[0], 2); ?></td>
       <td align="right"><?php echo number_format($room_charges[1], 2); ?></td>
       <td align="right"><?php echo number_format($room_charges[2], 2); ?></td>
        <td>&nbsp; </td>  
    </tr>
    <?php } ?>
     <tr class="text" style="background-color:#CCC; border:solid 1px;">      
       <td colspan="5" align="center"><b>Grand Total</b></td>  
       <td align="left"><b><?php echo $g_nights;?> Nights</b></td>    
        <td>&nbsp; </td> 
       <td align="right" style="font-weight:bold"><?php echo number_format($rm_total, 2);?></td>       
       <td align="right" style="font-weight:bold"><?php echo number_format($other_total, 2); ?></td>
       <td align="right" style="font-weight:bold"><?php echo number_format($g_total, 2); ?></td>
        <td>&nbsp; </td>  
    </tr>
    
  </table>
  <div style="clear:both"></div>
 
  
  <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>


<?php 
function getCharges($chkin_id){

$total = array();
$sql_room = "select SUM(debit) from hms_guest_ledger where (service_id = 1 OR service_id = 2 OR service_id = 21) AND chkin_id = $chkin_id";
$total_room = Yii::app()->db->createCommand($sql_room)->queryScalar();

$sql_other = "select SUM(debit) from hms_guest_ledger where service_id != 1 AND service_id != 2 AND service_id != 21 AND chkin_id = $chkin_id";
$total_other = Yii::app()->db->createCommand($sql_other)->queryScalar();

array_push($total, $total_room);
array_push($total, $total_other);
array_push($total, ($total_room + $total_other));

return $total;

	
}
?>
