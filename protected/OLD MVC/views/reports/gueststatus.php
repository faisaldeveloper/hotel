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


//$_SESSION['gst_show'] = 'to do';
$sval = Yii::app()->session['taxcontrol'];
if(isset($sval) && $sval=='ON') $gst_show = " ci.gst_show > 0";
else $gst_show = "";


$sql = "select distinct gi.guest_id, gi.* From hms_guest_info gi Left Join hms_checkin_info ci ON gi.guest_id = ci.guest_id  Where gi.branch_id = $branch_id ".$gst_show ." ORDER BY guest_company_id";
//echo $sql;

$result = Yii::app()->db->createCommand($sql)->query();

//$result = GuestInfo::model()->findAll("branch_id = $branch_id Order by guest_name ASC");


$total_record = count($result);
 ?>
 


<div class="container_mce">
  <table width="100%" border="0">
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
    <td colspan="3" align="center"><strong>All Guests Report</strong></td>
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
  <table width="100%" border="0">
    <tr>
      <td><strong>Sr#</strong></td>
      <td align="left"><strong>Guest Name</strong></td>
      <td align="left"><strong>Address</strong></td>
      <td align="left"><strong>Mobile</strong></td>     
      <td align="left"><strong>Phone</strong></td> 
      <td align="left"><strong>Comapny</strong></td>
      <td align="left"><strong>Contact Person</strong></td>
       <td align="left"><strong>Phone</strong></td>
      
           
    </tr>
    <?php
    foreach($result as $row){
		$i++;
	 $guest_name = $row['guest_name'];
	 $guest_address=$row['guest_address'];
	 $guest_mobile=$row['guest_mobile'];
	 $guest_phone=$row['guest_phone'];
	 $company_id = $row['guest_company_id'];
	 		$company=Company::model()->findAll("comp_id =$company_id");
						foreach($company as $comp){
						$company_name = $comp['comp_name'];
						$company_phone=$comp['comp_phone'];
						$comp_contact_person=$comp['comp_contact_person'];
						}
		$guest_phone=$row['guest_phone'];
		
	?>
    <tr class="text">
      <td align="left"><?php echo $i;?></td>
      <td align="left"><?php echo $salutation_name.ucwords(strtolower($guest_name));?></td>
      <td align="left"><?php echo ucwords(strtolower($guest_address));?></td>
      <td align="left"><?php echo $guest_mobile;?></td>
      <td align="left"><?php echo $guest_phone;?></td>
      <td align="left"><?php echo $company_name;?></td>
      <td align="left"><?php echo ucwords(strtolower($comp_contact_person));?></td>     
      <td align="left"><?php echo $company_phone;?></td>
          
    </tr>
    <?php } ?>
  </table>
  <div style="clear:both"></div>
  <p><strong>Total Guest: <?php echo $total_record;?></strong></p>
  
  <p align="right" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
   
</div>
