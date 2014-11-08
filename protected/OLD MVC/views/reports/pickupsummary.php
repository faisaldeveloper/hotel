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
$result = ReservationInfo::model()->findAll("pick_service='Y' and reservation_status = '1' and chkin_date between '$from_date1' and '$to_date1' and branch_id = $branch_id");
//echo "---".count($result);
	//echo $total_record; 
 ?>
 
<table class="container_mce"><tr><td>
  <table width="100%" border="0">
  <tr>
    <td rowspan="3">&nbsp;</td>
    <td rowspan="3"><img src="<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php echo $hotel_logo_image;?>" height="98px" width="75px" /></td>
    <td colspan="3" align="center">&nbsp;<font size="+2"><strong><?php echo ucwords($hotel_title); ?></strong></font></td>
    
    <td rowspan="3" valign="top"><strong>Date</strong></td>
    <td rowspan="3" valign="top"><?php echo date('j F, Y H:i:s');?></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong><?php echo ucwords($branch_address); ?></strong></td>
  </tr>
  <tr>    
    <td colspan="3" align="center"><strong>Pickup Summary Report</strong></td>
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
  <table width="100%" border="0">
    <tr>
      <td><strong>Date</strong></td>       
      <td align="left"><strong>Guest Name</strong></td>     
      <td align="left"><strong>Comapny</strong></td>
      <td align="left"><strong>Flight</strong></td>
      <td align="left"><strong>Time</strong></td>  
       <td align="left"><strong>Rate</strong></td>
      <td align="left"><strong>Pick</strong></td>      
    </tr>
    <?php
   foreach($result as $row){
		
		$i++;
	 $res_type = $row['res_type'];
	 $company_id = $row['company_id'];
	 $company = Company::model()->find("comp_id =$company_id");
	 $company_name = $company->comp_name;	
		
	$sp = SalePerson::model()->find("sale_person_id =".$row['sale_person_id']);
	$sale_person = $sp->sale_person_comm;	
	
	
	
	 $chkin_date = $row['chkin_date'];
	 $chkout_date = $row['chkout_date'];
	 
	 $total_days = $row['total_days'];
	 
	 $pick_service = $row['pick_service'];
	 $flight_name = $row['flight_name'];
	 		
			if($pick_service=='Y'){
				$pickup = "Yes";
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
	 	
				$saluations = 	salutation::model()->findAll("salutation_id=$client_salutation_id");
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
	?>
    <tr class="text">
      <td><?php echo $i."-".$sale_person;?></td>
      <td><?php echo $salutation_name.ucwords($client_name);?></td>
      <td><?php echo $company_name;?></td>      
      
       <td><?php echo $p_flight_name;?></td>
      <td><?php echo $flight_time;?></td>
      <td><?php echo number_format($rate, 0);?></td>
       <td><?php echo $pickup;?></td>
       
        
    </tr>
    <?php } ?>
  </table>
 <div style="clear:both"></div>   
  <p align="right" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
   
 </div>
