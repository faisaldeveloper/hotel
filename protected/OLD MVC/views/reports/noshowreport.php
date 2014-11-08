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
	//$showdate= "<br/> From  ".date("j F, Y H:i", strtotime($from_date1)). "\t TO:".date("j F, Y H:i", strtotime($to_date1));
	$showdate= "<br/> From  ".date("d/m/Y H:i", strtotime($from_date1)). "\t TO:".date("d/m/Y H:i", strtotime($to_date1));
	}
$now = date('Y-m-d H:i:s');
//$result = ReservationInfo::model()->findAll("noshow_status='Y' and reservation_status = '1' and chkin_date between '$from_date1' and '$to_date1' and branch_id = $branch_id");
$con = " (chkin_date BETWEEN '$from_date1' AND '$to_date1') AND (chkout_date BETWEEN '$from_date1' AND '$to_date1')";
//$result = ReservationInfo::model()->findAll("reservation_status != '2' and chkout_date < '$now' and branch_id = $branch_id");
$result = ReservationInfo::model()->findAll("reservation_status != '2' and ".$con." and chkin_status ='N' AND branch_id = $branch_id");
//$total_record = count($result);
//echo $total_record;
//print_r($result);
	 
 ?>
 
<div class="container_mce">
 <table width="100%" border="0">
 <?php /*?> <tr>
    <td rowspan="3">&nbsp;</td>
    <td rowspan="3"><img src="<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php echo $hotel_logo_image;?>" height="98px" width="75px" /></td>
    <td colspan="3" align="center">&nbsp;<font size="+2"><strong><?php echo ucwords($hotel_title); ?></strong></font></td>
    
    <td rowspan="3"><strong>Date</strong></td>
    <td rowspan="3"><?php echo date('j F, Y H:i:s');?></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong><?php echo ucwords($branch_address); ?></strong></td>
  </tr><?php */?>
  <tr>    
    <td colspan="3" align="center" style="font-size:12px"><strong>No-Show Report <?php echo $showdate;?> </strong></td>
  </tr>
</table>
 <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
  <table width="100%" border="0">
    <tr style="border-bottom:solid 1px;" >
      <td><strong>Conf#</strong></td>
      <td align="left"><strong>Guest Name</strong></td>
      <td align="left"><strong>Comapny</strong></td>      
       <td align="left"><strong>Contact No</strong></td>      
      <td align="left"><strong>Check In</strong></td>
      <td align="left"><strong>Check Out</strong></td>     
      <td align="left"><strong>Flight</strong></td>       
       <td align="left"><strong>Remarks</strong></td>
    </tr>
    <?php
    foreach($result as $rs){
		$i++;
	$conf = $rs['reservation_id'];
	$res_type = $rs['res_type'];	 		
						$clientname = $rs['client_name'];
						$compid=$rs['company_id'];
						$companyname=Company::model()->find("comp_id=$compid")->comp_name;		 				
						$address=$rs['client_address'];
						$phone=$rs['client_phone'];
						$chkin_date=$rs['chkin_date'];
						$chkout_date=$rs['chkout_date'];
						$flight=$rs['flight_name'];
						if(!empty($flight)){$flight_name=Flights::model()->find("flight_id=$flight")->flight_name;} 
						else $flight_name="";
						$time=$rs['flight_time'];
						$pickup=$rs['pick_service'];
						$remark=$rs['client_remarks'];
	?>
    <tr class="text">
     <td align="left"><?php echo $conf;?></td>
      <td  align="left"><?php echo strtoupper(strtolower($clientname));?></td>
      <td  align="left"><?php echo $companyname;?></td>      
      <td  align="left"><?php echo $phone;?></td>       
      <td  align="left"><?php echo date("d/m/y",strtotime($chkin_date));?></td>
      <td  align="left"><?php echo date("d/m/y",strtotime($chkout_date));?></td>     
      <td  align="left"><?php echo $flight_name;?></td>     
      <td  align="left"><?php echo $remark;?></td>     
       
    </tr>
    <?php } ?>
  </table>
 <div style="clear:both"></div>
 
  <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>
