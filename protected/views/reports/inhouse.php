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
	 
	  $total_rooms = Yii::app()->db->createCommand("select count(mst_room_id) from hms_room_master where branch_id = $branch_id")->queryScalar();
	
	//occupied
	$total_occupied = Yii::app()->db->createCommand("select count(mst_room_id) from hms_room_master where mst_room_status = 'O' and branch_id = $branch_id")->queryScalar();
	$total_vacent = $total_rooms - $total_occupied;
	
	$total_guest = Yii::app()->db->createCommand("select SUM(total_person) from hms_checkin_info where chkout_status = 'N' and branch_id = $branch_id")->queryScalar();
	
	//dirty
	$total_dirty = Yii::app()->db->createCommand("select count(mst_room_id) from hms_room_master where mst_room_status = 'D' and branch_id = $branch_id")->queryScalar();
	
	//availabe
	$total_availabe = 61 ; $total_rooms - ($total_occupied+$total_dirty); //Yii::app()->db->createCommand("select count(mst_room_id) from hms_room_master where mst_room_status = 'V' and branch_id = $branch_id")->queryScalar();
	
	
	 $percent_occupied = number_format((($total_occupied *100) / $total_rooms),2) ; 
	 $percent_availabe = number_format((($total_availabe *100) / $total_rooms),2) ; 
	 $percent_dirty = number_format((($total_dirty *100) / $total_rooms),2) ; 	 
 ?>
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
    <td colspan="3" align="center" style="font-size:12px"><strong>HOTEL CROWN PLAZA ISLAMABAD</strong></td>   
  </tr>
  <tr>
    <td colspan="3" align="center" style="font-size:12px"><strong>GUEST IN-HOUSE REPORT</strong></td>    
  </tr>
 
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
<table width="100%" border="0" align="center">
      <tr>
       <!-- <td><strong>Sr#</strong></td>
         <td><strong>Folio#</strong></td>-->
        <td><strong>Room#</strong></td>
        <td><strong>Guest Name</strong></td>
        <td align="center"><strong>Person</strong></td>
        <td><strong>Company</strong></td>
        <td><strong>Nationality</strong></td>
        <td><strong>Check In</strong></td>
        <td><strong>Check Out</strong></td>
      <!--  <td><strong>Rate</strong></td>
        <td><strong>GST</strong></td>
        <td><strong>Bed Tax</strong></td> -->
      </tr>
      <?php	
      $chkin_info = CheckinInfo::model()->findAll("branch_id = $branch_id and chkout_status = 'N' order by room_id");
 foreach($chkin_info as $rs){
	 $i++;
	 $guest_id = $rs['guest_id'];
	 $chkin_date = $rs['chkin_date'];
	 $chkout_date = $rs['chkout_date'];	
	 $room_name=RoomMaster::model()->find("mst_room_id	= ".$room=$rs['room_id'])->mst_room_name;	 
	 $chkin_id = $rs['chkin_id'];
	 $rate = $rs['rate'];
	 $bed_tax = $rs['bed_tax'];
	 if($bed_tax == 'Y'){
	 $total_person = $rs['total_person'];
	 }else{	 $total_person = 0; }
	 
	 $gst = $rs['gst'];
	 if($gst == 'Y'){
		 	$Service_gst =ServiceGst::model()->findAll("gst_service_id  = 1 and branch_id = $branch_id");
		 				foreach($Service_gst as $sgst){
						$gst_percent = $sgst['gst_percent'];
						}
			$gst_amount = $rate * $gst_percent / 100;			
		 }else{
			 $gst_amount = 0;
			 }
			 
	 $guest_company_id = $rs['guest_company_id'];
	 $company=Company::model()->findAll("comp_id =$guest_company_id");
						foreach($company as $comp){
						$company_name = $comp['comp_name'];
						}
	 
	 	$guest_info = 	GuestInfo::model()->findAll("guest_id=$guest_id");
	 	foreach($guest_info as $r){
			$guest_country_id = $r['guest_country_id'];
					$country = 	Country::model()->findAll("country_id =$guest_country_id");
					foreach($country as $c){
					$country_name = $c['country_name'];
					}
			$salutation_id = $r['guest_salutation_id'];
				$saluations = 	Salutation::model()->findAll("salutation_id=$salutation_id");
				foreach($saluations as $s){
					$salutation_name = $s['salutation_name'];
					}
			
			$guest_name = $r['guest_name'];
		}
		
		$persons = $rs['total_person'];
		
		$total_rate = $total_rate + $rate;
		$total_gst += $gst_amount;
		$total_BedTax += $total_person; 
	
	  ?>
      <tr>
       <!-- <td align="center" valign="top"><?php //echo $i;?></td>
         <td align="center" valign="top"><?php //echo  $chkin_id;?></td>-->
        <td align="left" ><?php echo $room_name;?></td>
        <td><?php echo $salutation_name.strtoupper($guest_name);?></td>
        <td align="center"><?php echo $persons;?></td>
        <td><?php echo $company_name;?></td>
        <td><?php echo $country_name;?></td>
        <td><?php echo date("d/m/y",strtotime($chkin_date));?></td>
        <td><?php echo date("d/m/y",strtotime($chkout_date));?></td>
       <!-- <td><?php echo number_format($rate,0);?></td>
        <td><?php echo number_format($gst_amount,0);?></td>
        <td><?php echo $total_person;?></td> -->
    </tr>
      <?php
 	}
	  ?>
  </table>
  
  
  
   <br />
    <?php
  	$total_guest = Yii::app()->db->createCommand("select SUM(total_person) from hms_checkin_info where chkout_status = 'N' and branch_id = $branch_id")->queryScalar();
	
	$sql = "select count(gi.guest_id) AS foreigners From hms_checkin_info ci LEFT JOIN hms_guest_info gi ON ci.guest_id = gi.guest_id WHERE ci.chkout_status = 'N' AND gi.guest_country_id > 1 and branch_id = $branch_id";
	
	$foreigners = Yii::app()->db->createCommand($sql)->queryScalar();
	
	$foreigner_rooms;

	?>
    
    <table width="75%" border="0" align="left">
	<tr>
        <td>&nbsp;</td>
        <td><strong>OCCUPIED ROOM(S) :</strong></td>
        <td><?php echo $total_occupied;?></td>
        <td width="160">&nbsp;</td>
        <td><strong>TOTAL GUEST(S) :</strong></td>
	<td>&nbsp;<?php echo $total_guest;?></td>
      </tr>
	<tr>
        <td>&nbsp;</td>
        <td><strong>AVAILABLE ROOM(S) :</strong></td>
        <td><?php echo $total_availabe;?></td>
        <td></td>
        <td><strong>FOREIGNER ROOM(S) :</strong></td>
	<td>&nbsp;<?php echo $foreigner_rooms;?></td>
      </tr>
	<tr>
        <td>&nbsp;</td>
        <td><strong>OCCUPANCY %:</strong></td>
        <td><?php echo $percent_occupied;?></td>
        <td></td>
	<td><strong>FOREIGNER GUEST(S) :</strong></td>
	<td>&nbsp;<?php echo $foreigners;?></td>
        
      </tr>
     
      
    </table>
   
   <div style="clear:both"></div>  
  <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>
