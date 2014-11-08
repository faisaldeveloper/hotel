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
    <td colspan="3" align="center" style="font-size: 12px;"><strong>ROOM SHIFT REPORT</strong></td>    
  </tr>
  <tr>      
    <td colspan="3" align="center" style="font-size: 10px;"><strong><?php echo $showdate; ?></strong></td>   
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
  <table width="100%" border="0">
    <tr>
      <td><strong>S.No</strong></td>     
      <td><strong>Folio</strong></td>       
      <td><strong>Guest Name</strong></td>
      <td><strong>Company</strong></td>
      <td><strong> Old Room </strong></td>
      <td><strong> New Room </strong> </td> 
      <td><strong> Reason </strong></td>       
      <td><strong>Date</strong></td>        
    </tr>
    <?php
//$result = RoomShift::model()->findAll("shift_date between '$from_date1' and '$to_date1' and branch_id = $branch_id");
$sql = "select * from hms_room_shift where shift_date between '$from_date1' and '$to_date1' and branch_id = $branch_id ORDER BY id DESC";
$result = Yii::app()->db->createCommand($sql)->query();
    foreach($result as $row){
		$i++;
		$chkin_id = $row['chkin_id'];		
		$guest_name = GuestInfo::model()->find("guest_id =". $row['guest_id'])->guest_name;	
		$comp_id = GuestInfo::model()->find("guest_id =". $row['guest_id'])->guest_company_id;		
		$new_room_name = RoomMaster::model()->find("mst_room_id = ". $row['new_room_id'])->mst_room_name;
		$old_room_name = RoomMaster::model()->find("mst_room_id = ". $row['old_room_id'])->mst_room_name;
		
		if(!empty($comp_id))
		$comp_name = Company::model()->find("comp_id =". $comp_id)->comp_name;	
		
		$reason = $row['reason'];
		$date = $row['shift_date'];
	?>
    <tr class="text">
      <td><?php echo $i;?></td>
       <td><?php echo $chkin_id;?></td>
        <td><?php echo strtoupper($guest_name);?></td>
        <td><?php echo $comp_name;?></td>
        <td><?php echo $old_room_name;?></td>        
        <td><?php echo $new_room_name; ?></td> 
        <td><?php echo $reason; ?></td>             
       <td><?php echo  date("d/m/y H:i", strtotime($date));?></td>    
    </tr>
    <?php } ?>
  </table>
  <div style="clear:both"></div>
 
  
  <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>