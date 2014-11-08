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
	 
///////// start of guest ledger info
$from_date1 = $data['from_date'];
$to_date1 = $data['to_date'];
if(isset($from_date1)and isset($to_date1)){
	$showdate="<br/> From:  ".date("d/m/y H:i", strtotime($from_date1))."\t TO:  ".date("d/m/y H:i", strtotime($to_date1));
	}
	
//$_SESSION['gst_show'] = 'to do';
$sval = Yii::app()->session['taxcontrol'];
if(isset($sval) && $sval=='ON') $gst_show = " AND gst_show > 0";
else $gst_show = "";
$checkin =CheckinInfo::model()->findAll("chkout_status ='Y' ". $gst_show ."  and  chkout_date between '$from_date1' and '$to_date1' and branch_id = $branch_id  ORDER BY room_id");
$total_record=count($checkin);
////
////// end of code
 ?>
 
<div class="container_mce">
	<table  width="100%" border="0" style="margin-top:0px">
	<tr>
    <td colspan="3" align="center"><strong>GUEST IN-HOUSE REPORT </strong></td>    
  </tr>  
  <tr>    
    <td colspan="3" align="center"><strong><?php echo $showdate; ?></strong></td>   
  </tr>  
</table>

  
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
  <table width="100%" border="0">
    <tr>
      <td><strong>Sr#</strong></td>
      <td  align="left"><strong>Folio No</strong></td>     
      <td  align="left"><strong>Room No</strong></td>      
      <td align="left"><strong>Guest Name</strong></td>
      <td  align="left"><strong>Comapny</strong></td>
      <td  align="left"><strong>Rate</strong></td>
      <td  align="left"><strong>Mode Of Paymant</strong></td> 
      <td  align="left"><strong>Check-In</strong></td>
      <td  align="left"><strong>Check-Out</strong></td>
    </tr>
    <?php
    foreach($checkin as $row){
		$i++;
		$guest_id= $row['guest_id'];		
		$guest_mobile = "";
		$guest_phone= "";
		$chkin_id= $row['chkin_id'];
		
		
		$room_name=RoomMaster::model()->find("mst_room_id	= ".$room=$row['room_id'])->mst_room_name;	 
		$guest=GuestInfo::model()->find("guest_id=$guest_id");
		$guestname=$guest->guest_name;
		$guest_mobile=$guest->guest_mobile;
		$guest_phone=$guest->guest_phone;	
		
	 	$company_name = Company::model()->find("comp_id =".$row['guest_company_id'])->comp_name;					
		$chkin_date = $row['chkin_date'];		
		$chkout_date = $row['chkout_date'];	 		 
	 	$total_days = $row['total_days'];	
		$rate = $row['rate'];	
		
		
		$sql_max = "select MAX(id) from hms_guest_ledger where chkin_id = $chkin_id";
	 	$max_id = Yii::app()->db->createCommand($sql_max)->queryScalar();	
		if(!empty($max_id)){
		$sql = "select cash_paid, credit_card, btc from hms_guest_ledger where id = $max_id";
	 	$gl_res = Yii::app()->db->createCommand($sql)->queryRow(); 
			$cash_paid = $gl_res['cash_paid'];
			$credit_card = $gl_res['credit_card'];
			$btc = $gl_res['btc'];
		} 				
		$mop2 ='';
		if($cash_paid ==1){ $mop2 = "Cash"; }
		else if($credit_card ==1){$mop2 = "Credit Card";}
		else if($btc ==3){$mop2 = "BTC";}
		else {$mop2 = '';}//$max_id;}
		
		
		
		$guest_folio_no = $row['guest_folio_no'];
	 	$gst_folio_no = $row['gst_show'];	 
	 	if(empty($gst_show))	{ $folio_no =  $guest_folio_no; }
	 	else $folio_no = $gst_folio_no; 
		
		$folio_no = str_pad((int) $folio_no,"5","0",STR_PAD_LEFT);	
	
	?>
    <tr class="text">
     <td  align="left"><?php echo $i;?></td>
     <td align="left"><?php echo $folio_no;?></td>
      <td align="left"><?php echo $room_name;?></td>
      
      <td  align="left"><?php echo strtoupper(strtolower($guestname));?></td>
      <td  align="left"><?php echo $company_name;?></td>
      <td  align="left"><?php echo $rate; ?></td>
      <td  align="left"><?php echo $mop2; ?></td>
      <td  align="left"><?php echo date("d/m/y",strtotime($chkin_date));?></td>
      <td  align="left"><?php echo date("d/m/y",strtotime($chkout_date));?></td>      
    </tr>
    <?php } ?>
  </table>
  <div style="clear:both"></div>
  <p><strong>Total Checkouts: <?php echo $total_record;?></strong></p>  
   <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>