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
	$showdate="<br/> From:  ".date("d/m/y H:i", strtotime($from_date1))."\t TO:  ".date("d/m/y H:i", strtotime($to_date1));
	}
$result = ReservationInfo::model()->findAll(" reservation_status = '2' and chkin_date between '$from_date1' and '$to_date1' and branch_id = $branch_id ");
//$total_record = count($result);
 ?>
 
<div class="container_mce">
  <table  width="100%" border="0" style="margin-top:0px">
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
    <td colspan="3" align="center" style="font-size:12px"><strong>CANCELLED RESERVATION REPORT</strong></td>   
  </tr>
  
  <tr>    
    <td colspan="3" align="center" style="font-size:10px"><strong> <?php echo $showdate; ?></strong></td>  
  </tr>
  
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  <table width="100%" border="0" align="center">
    <tr>
      <td><strong>Conf#</strong></td>
      <td><strong>Guest Name</strong></td>
      <td><strong>Comapny</strong></td>
      <td><strong>Room Type</strong></td>
      <td><strong>Rate</strong></td>
      <td><strong>Arrival</strong></td>
      <td><strong>Departure</strong></td>
      <td><strong>Cancel Date</strong></td>
      <td><strong>Reason</strong><strong></strong></td>
    </tr>
    <?php
    foreach($result as $rs){
		$i++;
		$conf = $rs['reservation_id'];
	 					$res_type = $rs['res_type'];
	 					$company_id = $rs['company_id'];
	 		
						$clientname = $rs['client_name'];
						$compid=$rs['company_id'];
						$company_id=Company::model()->find("comp_id=$compid");
		 				$companyname=$company_id->comp_name;
						$address=$rs['client_address'];
						$phone=$rs['client_phone'];
						$chkin_date=$rs['chkin_date'];
						$chkout_date=$rs['chkout_date'];
												
						$room_type= HmsRoomType::model()->find("room_type_id=". $rs['room_type'])->room_name;
						$rate=$rs['room_charges'];
						$cancel_date=$rs['cancel_date'];
						$cancelreason=$rs['cancel_reason'];
							
								
	?>
    <tr class="text">
      <td><?php echo $conf;?></td>
      <td><?php echo strtoupper($clientname);?></td>
      <td><?php echo $companyname;?></td>
      <td><?php echo $room_type;?></td>
      <td><?php echo $rate;?></td>
      <td><?php echo date("d/m/y",strtotime($chkin_date));?></td>
      <td><?php echo date("d/m/y",strtotime($chkout_date));?></td>
      <td><?php echo $cancel_date;?></td>
      <td><?php echo $cancelreason;?></td>
    </tr>
    <?php } ?>
  </table>
     <hr />
   
   
      
 <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>
