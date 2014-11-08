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
	$showdate="<br/> From:  ".date("j F, Y H:i", strtotime($from_date1))."\t TO:  ".date("j F, Y H:i", strtotime($to_date1));
	}
//$_SESSION['gst_show'] = 'to do';
$sval = Yii::app()->session['taxcontrol'];
if(isset($sval) && $sval=='ON') $gst_show = " AND gst_show > 0";
else $gst_show = "";
$from_date1 = $data['from_date'];
$to_date1 = $data['to_date'];
//$sql = "select ri.*, rm.* From hms_reservation_info ri LEFT JOIN hms_room_master rm ON ri.room_name = rm.mst_room_id where rm.mst_room_status = 'R' and ri.chkin_date BETWEEN '$from_date1' and '$to_date1' and rm.branch_id = $branch_id ";
$sql = "select ri.*, rm.* From hms_reservation_info ri LEFT JOIN hms_room_master rm ON ri.room_name = rm.mst_room_id where ri.chkin_date BETWEEN '$from_date1' and '$to_date1' and rm.branch_id = $branch_id ";
//echo $sql;
$checkin = Yii::app()->db->createCommand($sql)->query();
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
    <td colspan="3" align="center"><strong>Room Forecast  8-<?php echo $showdate; ?></strong></td>
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
  <table width="100%" border="0">
    <tr>
      <td><strong>Sr#</strong></td>
      <td align="left"><strong>Room Name</strong></td>
      <td align="left"><strong><?php echo date("d/m/y", strtotime($from_date1)); ?></strong></td>
      <td align="left"><strong><?php echo date("d/m/y", strtotime('+1 day', strtotime($from_date1))); ?></strong></td>
      <td align="left"><strong><?php echo date("d/m/y", strtotime('+2 day', strtotime($from_date1))); ?></strong></td>            
      <td align="left"><strong><?php echo date("d/m/y", strtotime('+3 day', strtotime($from_date1))); ?></strong></td>
      <td align="left"><strong><?php echo date("d/m/y", strtotime('+4 day', strtotime($from_date1))); ?></strong></td>
      <td align="left"><strong><?php echo date("d/m/y", strtotime('+5 day', strtotime($from_date1))); ?></strong></td>
      <td align="left"><strong><?php echo date("d/m/y", strtotime('+6 day', strtotime($from_date1))); ?></strong></td>          
    </tr>
    <?php
	$arr = array();
    foreach($checkin as $row){
		$i++;	
		$room_name=$row['mst_room_name'];
		$chkin_date = $row['chkin_date'];
		$chkout_date = $row['chkout_date'];		
			
		$arr = getRoomStatus($chkin_date, $chkout_date, $from_date1);		
				
	?>
    <tr class="text">
      <td align="left"><?php echo $i;?></td>     
      <td align="left"><?php echo $room_name;?></td>
       
      <td align="left"><?php echo $arr[0]; ?></td>
      <td align="left"><?php echo $arr[1]; ?></td>            
      <td align="left"><?php echo $arr[2]; ?></td>
      <td align="left"><?php echo $arr[3]; ?></td>
      <td align="left"><?php echo $arr[4]; ?></td>
      <td align="left"><?php echo $arr[5]; ?></td>
      <td align="left"><?php echo $arr[6]; ?></td>
    </tr>
    <?php } ?>
  </table>
 <div style="clear:both"></div>
 
  <p align="right" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />  </p>
  
</div>
<?php 
function getRoomStatus($chkin_date, $chkout_date, $from_date1){
	
	$str1 = strtotime($chkin_date);
	$str2 = strtotime($chkout_date);	
	$date0 = strtotime($from_date1);
	
	$date1 =strtotime($from_date1) + 60*60*24*1;
	$date2 =strtotime($from_date1) + 60*60*24*2;
	$date3 =strtotime($from_date1) + 60*60*24*3;
	$date4 =strtotime($from_date1) + 60*60*24*4;
	$date5 =strtotime($from_date1) + 60*60*24*5;
	$date6 =strtotime($from_date1) + 60*60*24*6;
	//$date7 =strtotime($from_date1) + 60*60*24*7;
	
	
	$arr = array();
	if($date0 >= $str1 && $date0 < $str2){$arr[0]= "R";} else {$arr[0]= "V";}
	if($date1 >= $str1 && $date1 < $str2){$arr[1]= "R";} else {$arr[1]= "V";}
	if($date2 >= $str1 && $date2 < $str2){$arr[2]= "R";} else {$arr[2]= "V";}
	if($date3 >= $str1 && $date3 < $str2){$arr[3]= "R";} else {$arr[3]= "V";}
	if($date4 >= $str1 && $date4 < $str2){$arr[4]= "R";} else {$arr[4]= "V";}
	if($date5 >= $str1 && $date5 < $str2){$arr[5]= "R";} else {$arr[5]= "V";}
	if($date6 >= $str1 && $date6 < $str2){$arr[6]= "R";} else {$arr[6]= "V";}
	//if($date7 >= $str1 && $date7 <= $str2){$arr[7]= "R";} else {$arr[7]= "V";}
	return $arr;
}
?>