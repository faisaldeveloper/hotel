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
$branch_id = yii::app()->user->branch_id;	 
$active_date = DayEnd::model()->find("branch_id= $branch_id")->active_date;	
if(!isset($con_date))
$con_date =$active_date ;


$from_date1 = $data['from_date'];
$to_date1 = $data['to_date'];
if(isset($from_date1) and isset($to_date1)){	
$showdate="<br/> From:  ".date("d/m/y H:i", strtotime($from_date1))."\t TO:  ".date("d/m/y H:i", strtotime($to_date1));	
}
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
    <td colspan="3" align="center" style="font-size:12px"><strong>COMPANY WISE SALE REPORT</strong></td>   
  </tr>
  
  <tr>    
    <td colspan="3" align="center" style="font-size:10px"><strong> <?php echo $showdate; ?></strong></td>  
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
  <table width="100%" border="0">
    <tr>
      <td><strong>Sr#</strong></td>
     
      <td align="left"><strong>Company Name</strong></td>
      <td align="left"><strong>Company Address</strong></td>
      <td align="left"><strong>Contact Person</strong></td>
      <td align="left"><strong>No Of Guest</strong></td>
     
    </tr>
    <?php
	$sql = "select count(room_id)as total, comp.*, ci.* FROM hms_checkin_info ci
	Left Join hms_company_info comp 
	ON  ci.guest_company_id = comp.comp_id where ci.chkin_date BETWEEN '$from_date1' AND '$to_date1' GROUP BY comp.comp_id ORDER BY comp.comp_name";
	
	//echo $sql;
	$result = Yii::app()->db->createCommand($sql)->query();
	
//$result = Company::model()->findAll(" branch_id = $branch_id");
$total_record = count($result);
$url = Yii::app()->createUrl('Reports/Companyguestdetails');
//echo $url;
    foreach($result as $row){
		$i++;	
	 	$company_id = $row['comp_id']; 	
	 	$guest=CheckinInfo::model()->findAll("guest_company_id =$company_id");
		$total_guest = $row['total']; 	 //count($guest);	
		
		$address=$row['comp_address'];
		$contact_person=$row['comp_contact_person'];
		$company_name=$row['comp_name'];	 
	?>
    <tr class="text">
      <td align="left"><?php echo $i;?></td>
     <td align="left"><a style="text-decoration:none;" target="_blank" href="<?php echo $url.'/'.$company_id.'?d1='.$from_date1.'&d2='.$to_date1; ?>" > <?php echo $company_name;?> </a></td>
     
  
      <td align="left"><?php echo $address;?></td>   
      <td align="left"><?php echo $contact_person;?></td>
      <td align="left"><?php echo$total_guest;?></td>      
    </tr>
    <?php } ?>
  </table>
 
  <div style="clear:both"></div> 
 
 <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>


