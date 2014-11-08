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
    <td colspan="3" align="center"><strong> Long Staying Report</strong></td>
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
<table width="100%" border="1" align="center">
      <tr>
       
        <td><strong>Room</strong></td>
        
        <td><strong>Guest Name</strong></td>
        <td><strong>Company</strong></td>                
        <td><strong>Nationality</strong></td>
        <td><strong>Check In</strong></td>
        <td><strong>Check Out</strong></td>
      	<td><strong>Status</strong></td>
      </tr>
      <?php
	  
	  $now = strtotime( date('Y-m-d H:i:s')); //50  34 25
	  $last_7_days = $now - (60*60*24*7); // we consider long stay which is more than 7 days long
	  $lw = date('Y-m-d H:i:s', $last_7_days);	  
      $chkin_info = CheckinInfo::model()->findAll(" chkin_date < '".$lw."' and  branch_id = $branch_id and chkout_status = 'N'  order by room_id");
 foreach($chkin_info as $rs){
	 $i++;
	 $guest_id = $rs['guest_id'];
	 $chkin_date = $rs['chkin_date'];
	 $chkout_date = $rs['chkout_date'];
	 $chkout_status = $rs['chkout_status'];
	 if($chkout_status == 'Y') $status = "Ckecked out";
	 else  $status = "Staying";
	$room=$rs['room_id'];
	 $rn=RoomMaster::model()->find("mst_room_id	= $room");
	 $room_name=$rn->mst_room_name;
	  
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
      
        <td  valign="top"><?php echo $room_name;?></td>
       
        <td><?php echo $salutation_name.ucwords($guest_name);?></td>      
        <td><?php echo $company_name;?></td>
        
         <td><?php  echo $country_name;?></td>
        <td><?php echo date("d/m/y",strtotime($chkin_date));?></td>
        <td><?php echo date("d/m/y",strtotime($chkout_date));?></td>
        <td><?php  echo $status;?></td>
    </tr>
      <?php
 	}
	  ?>
  </table>   
    <hr />
 <p align="right" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    
    
    </div>
