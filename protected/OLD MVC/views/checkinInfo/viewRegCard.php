<?php
$chkin_id =  $_REQUEST['id'];
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
$result = CheckinInfo::model()->findAll("chkin_id=$chkin_id and branch_id = $branch_id");
foreach($result as $row){
	 $guest_id = $row['guest_id'];
	 		$guest_info = 	GuestInfo::model()->findAll("guest_id=$guest_id");
	 		foreach($guest_info as $r){			
				$salutation_name = 	Salutation::model()->find("salutation_id=". $r['guest_salutation_id'])->salutation_name;			
				$guest_name = $r['guest_name'];
				$guest_address = $r['guest_address'];
				$guest_phone = $r['guest_phone'];
				$guest_mobile = $r['guest_mobile'];			
				$identity_name = Identity::model()->find("identity_id =". $r['guest_identity_id'])->identity_description;
				$guest_identity_no = $r['guest_identity_no'];	
				$guest_identity_issu = $r['guest_identity_issu'];
				$guest_identity_expire = $r['guest_identiy_expire'];		
				$country_name = Country::model()->find("country_id =". $r['guest_country_id'])->country_name;				
				$guest_dob = $r['guest_dob'];			
			}	 
	 
	 $reservation_id = $row['reservation_id'];
	 $chkin_date = $row['chkin_date'];
	 $chkout_date = $row['chkout_date'];	
	 $drop_service = $row['drop_service'];
	 $flight_name = $row['flight_name'];
	 $flight_time = $row['flight_time'];
	 $total_days = $row['total_days'];
	 
	 $cash = $row['cash'];
	 $debit_card = $row['debit_card'];
	 $credit_card = $row['credit_card'];
	 $btc = $row['btc'];
	 
	 if($cash=="Y") $payment_mode .= "Cash";
	 if($debit_card=="Y") $payment_mode .= "/DC";
	 if($credit_card=="Y") $payment_mode .= "/CC";
	 if($btc=="Y") $payment_mode .= "/BTC";
	
	
	 $room_type = HmsRoomType::model()->find("room_type_id =".$row['room_type'])->room_name;	
	 $room_name=RoomMaster::model()->find("mst_room_id =".$row['room_name'])->mst_room_name;	
	 $company_name=Company::model()->find("comp_id =". $row['guest_company_id'])->comp_name;
	 
	 $total_person = $row['total_person'];
	 $total_charges = $row['total_charges'];
	 $amount_paid = $row['amount_paid'];
	 $chkin_user_id = $row['chkin_user_id'];
	 $chkin_id = $row['chkin_id'];
	 $comming_from = $row['comming_from'];
	 $next_destination = $row['next_destination'];
	 $rate = $row['rate'];
	 $gst = $row['gst'];
	 	if($gst=='Y'){$wgst = "With GST";}else{$wgst="Without GST";}
	 $bed_tax = $row['bed_tax']; 
	 
	 $guest_folio_no = $row['guest_folio_no'];
	 $guest_folio_no = str_pad((int)$guest_folio_no,"4","0",STR_PAD_LEFT);
	  $reg_no = $row['reg_no']; 	 
}
 ?>
 
<div class="container_mce">
  <table width="100%" border="0">
  <tr>
    <td rowspan="3">&nbsp;</td>
    <td rowspan="3"><img src="<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php echo $hotel_logo_image;?>" height="98px" width="75px" /></td>
    <td align="center">&nbsp;<font size="+2"><strong><?php echo ucwords($hotel_title); ?></strong></font></td>
    
    <td><strong>Date</strong></td>
    <td><?php echo date('j F, Y H:i:s');?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><strong><?php echo ucwords($branch_address); ?></strong></td>
    <td><?php echo "<font size=\"-1\" color=\"#000066;\"><b>Folio/Reg No: ".$guest_folio_no."/".$reg_no."</b></font>"; ?></td>
  </tr>
  <tr>    
    <td colspan="2" align="center"><strong>Guest Registration Card</strong></td>  
    <td></td> 
  </tr>
</table>
 <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
<table width="100%" border="0">
  <tr>
    <td ><strong>Guest Name:</strong></td>
    <td colspan="5" class="mytd"><?php echo ucwords($guest_name);?></td>
    </tr>
  <tr>
    <td><strong>Company:</strong></td>
    <td colspan="5" class="mytd"><?php echo $company_name;?></td>
    </tr>
  <tr>
    <td><strong>Address:</strong></td>
    <td colspan="5" class="mytd"><?php echo ucwords($guest_address);?></td>
    </tr>
  <tr>
    <td><strong><?php echo $identity_name;?></strong></td>
    <td colspan="1" class="mytd"><?php echo $guest_identity_no;?></td>
    <td ><strong>Issue Date:</strong></td>
    <td class="mytd"><?php echo $guest_identity_issu;?></td>
    <td ><strong>Expiry Date:</strong></td>
    <td class="mytd"><?php echo $guest_identity_expire;?></td>
  </tr>
  <tr>
    <td><strong>Nationality</strong></td>
    <td  colspan="1" class="mytd"><?php echo $country_name;?></td>
    <td ><strong>Profession:</strong></td>
    <td  class="mytd">&nbsp;</td>
    <td ><strong>Date of Birth:</strong></td>
    <td class="mytd"><?php
	if(strtotime($guest_dob) > 500)
	 echo date("d/m/y",strtotime($guest_dob));
	 else echo "N/A";
	 
	 ?></td>
  </tr>
  <tr>
    <td><strong>Arrival Date:</strong></td>
    <td  class="mytd"><?php echo date('F j, Y H:i', strtotime($chkin_date));?></td>
    <td ><strong>Departure Date:</strong></td>
    <td class="mytd"><?php echo date('F j, Y H:i', strtotime($chkout_date));?></td>
    <td><strong>Stay:</strong></td>
     <td><?php echo $total_days; ?> &nbsp;&nbsp; Night(s)</td>
    </tr>
</table>
 <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
 <br />
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td><strong>Mobile #:</strong></td>
    <td class="mytd"><?php echo $guest_mobile;?></td>
  </tr>
  <tr>
    <td><strong>Payment Mode:</strong></td>
    <td colspan="2"><?php echo $payment_mode;?></td>
    <td><strong>Office #:</strong></td>
    <td class="mytd">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Advance Payment:</strong></td>
    <td class="mytd">&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>Newspaper:</strong></td>
    <td class="mytd">&nbsp;</td>
  </tr>
</table>
 <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
<br />
<table width="100%" class="tblstyle">
  <tr>
  	<td >&nbsp; </td>
    <td><strong>Room Number</strong></td>
    <td ><strong>Room Type</strong></td>
    <td ><strong>Total Persons</strong></td>
    <td><strong>Rate</strong></td>
    <td ><strong>Res #</strong></td>
    <td ><strong>Checkout Time</strong></td>
    <td ><strong>Check-In By</strong></td>
  </tr>
  <tr>
  	<td>&nbsp; </td>
    <td align="left"><?php echo $room_name;?></td>
    <td align="left"><?php echo $room_type;?></td>
    <td><?php echo $total_person;?></td>
    <td><?php echo $rate." + GST";?></td>
    <td><?php echo $reservation_id;?></td>
    <td>12:00 Noon</td>
    <td><?php echo $user_name;?></td>
  </tr>
</table>
<br />
<p align="center"><b>* Safe Deposite boxes are available at the Front Office Cashier. Management regrets to accept any liability for valuables left in your room unattended.</b></p>
<table width="100%" border="0">
  <tr>
    <td ><strong>Signature Duty Manager</strong></td>
    <td ><strong>_____________________</strong></td>
    <td><strong>Signatire Guest</strong></td>
    <td ><strong>_______________________</strong></td>
  </tr>
</table> 
    
   <p align="right"  style="padding-right:10px;"> <input type="button" value="Print" onclick="javascript: window.print() " />    </p>
  
</div>