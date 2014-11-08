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
 ?>
 
 
<div class="container_mce">
  <table  width="100%" border="0">
  <tr>
    <td rowspan="3">&nbsp;</td>
    <td rowspan="3"><img src="<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php echo $hotel_logo_image;?>" height="98px" width="75px" /></td>
    <td colspan="3" align="center">&nbsp;<font size="+2"><strong><?php echo ucwords($hotel_title); ?></strong></font></td>
    
    <td rowspan="3"><strong>Date</strong></td>
    <td rowspan="3"><?php echo date('j F, Y H:i:s');?></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong><?php echo ucwords($branch_address); ?></strong></td>
  </tr>
  <tr>    
    <td colspan="3" align="center"><strong>Daily Inhouse Report</strong></td>
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
<table width="100%" border="1" align="center">
      <tr>
        <td><strong>Sr#</strong></td>
        <td><strong>Room#</strong></td>
        <td><strong>Guest Name</strong></td>
        <td><strong>Person</strong></td>
        <td><strong>Company</strong></td>
        <td><strong>Nationality</strong></td>
        <td><strong>Check In</strong></td>
        <td><strong>Check Out</strong></td>
      
      </tr>
      <?php
      $chkin_info = CheckinInfo::model()->findAll("branch_id = $branch_id and chkout_status = 'N' order by room_id");
 foreach($chkin_info as $rs){
	 $i++;
	 $guest_id = $rs['guest_id'];
	 $chkin_date = $rs['chkin_date'];
	 $chkout_date = $rs['chkout_date'];
	 $room_name = $rs['room_name'];
	 $rate = $rs['rate'];
	 $bed_tax = $rs['bed_tax'];
	 if($bed_tax == 'Y'){
	 $total_person = $rs['total_person'];
	 }else{
		 $total_person = 0;
	 }
	 
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
        <td align="center" valign="top"><?php echo $i;?></td>
        <td align="center" valign="top"><?php echo $room_name;?></td>
        <td><?php echo $salutation_name.ucwords($guest_name);?></td>
        <td align="center"><?php echo $persons;?></td>
        <td><?php echo $company_name;?></td>
        <td><?php echo $country_name;?></td>
        <td><?php echo date("d/m/y",strtotime($chkin_date));?></td>
        <td><?php echo date("d/m/y",strtotime($chkout_date));?></td>
       
    </tr>
      <?php
 	}
	  ?>
  </table>
    <table width="100%" border="0" align="center">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong>Total</strong></td>
        <td><strong><?php echo number_format($total_rate,0);?></strong></td>
        <td><strong><?php echo number_format($total_gst,0);?></strong></td>
        <td><strong><?php echo $total_BedTax;?></strong></td>
      </tr>
  </table>
    <hr />
    <?php
    $total_rooms = Yii::app()->db->createCommand("select count(mst_room_id) from hms_room_master where branch_id = $branch_id")->queryScalar();
	$total_occupied = Yii::app()->db->createCommand("select count(mst_room_id) from hms_room_master where mst_room_status = 'O' and branch_id = $branch_id")->queryScalar();
	$total_vacent = $total_rooms - $total_occupied;
	
	$total_guest = Yii::app()->db->createCommand("select SUM(total_person) from hms_checkin_info where chkout_status = 'N' and branch_id = $branch_id")->queryScalar();
	?>
    
    <table width="100%" border="0" align="left">
      <tr>
        <td>&nbsp;</td>
        <td><strong>TOTAL AVAILABLE ROOM(S) :</strong></td>
        <td><?php echo $total_rooms;?></td>
        <td><strong>TOTAL GUEST(S) :</strong></td>
        <td><?php echo $total_guest;?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><strong>TOTAL OCCUPIED ROOM(S) :</strong></td>
        <td><?php echo $total_occupied;?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><strong>TOTAL VACANT ROOM(S) :</strong></td>
        <td><?php echo $total_vacent;?></td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
    </table>
   
   <div style="clear:both"></div>   
  <p align="right" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
 </div>
