<style>
th, td, caption {
    padding: 2px 2px 2px 2px;
}
.grid-view {
    padding: 0px;
}
input[type="button"] {
   
    height: 30px;
    width: 100px;
}
.mini-box{
	height:20px;
	width:20px;
	border:thin;
	float:left;	
}

thead th {
	 background: #C0D7BF;
   
}

caption, th, td {
    float: none !important;
    font-weight: normal;
    text-align: center;
	border-bottom: solid 1px;
}
</style>
<script>

</script>
<?php
$dummy_total_rooms = Yii::app()->db->createCommand("select value from settings where unit = 'total_rooms'")->queryScalar();
//$dummy_total_rooms = 50;
if(empty($_REQUEST['m'])){
$monthno = '0';
$next = $monthno+1;
$previous=$monthno-1; 
}else{
$monthno = $_REQUEST['m'];
$next = $monthno+1;
$previous=($monthno-1);
}
$date = date('Y-m-d');
$timestamp = strtotime ( "$monthno month" , strtotime ( $date ) ) ;
?>
<div style="width:500px; margin:0 auto">
<div style="float:left">
<?php echo CHtml::button('Previous', array('submit' => array('ReservationInfo/Forecast/m/'.$previous))); ?>
</div>
<div style="float:left;width:260px; margin:0 auto; text-align:center">
<?php
echo '<h2> Reservations - '.date ( 'F, Y' , $timestamp ).'</h2>';
?>
</div>
<div style="float:left">
<?php echo CHtml::button('Next', array('submit' => array('ReservationInfo/Forecast/m/'.$next))); ?>
</div>
<div style="clear:left"></div>
</div>
<?php
$branch_id = Yii::app()->user->branch_id;
$year = date ( 'Y' , $timestamp );
$month = date ( 'm' , $timestamp );
$daysofmonth = date ( 't' , $timestamp );
$cond = "$year-$month%";
$num = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31

$curr_date = date("Y-m-d");
?>




<?php
$sql = "select *, count(reservation_id) as total_res  From hms_reservation_info where chkin_date LIKE '$cond' and chkin_status='
N' and branch_id = $branch_id ";
//echo $sql;
$reservations = Yii::app()->db->createCommand($sql)->query();
if(count($reservations) >0 ){
$room_name_arr = array();
$chkin_date_arr = array();
$chkout_date_arr = array();
$res_ids_arr = array();
foreach($reservations as $row){
	//array_push($room_name_arr, $row['mst_room_name']);
	array_push($chkin_date_arr, $row['chkin_date']);
	array_push($chkout_date_arr, $row['chkout_date']);	
	array_push($res_ids_arr, $row['reservation_id']);			
}


$x =0;
for($i=1;$i<=$daysofmonth;$i++){// this loop runs for whole month
$today = "$year-$month-".str_pad($i, 2, "0", STR_PAD_LEFT);
$today = date('Y-m-d',strtotime($today));
$day = date('l',strtotime($today));

if($today >= $curr_date){
?>
<div class="grid-view" id="reservations-grid" cellpadding="0" cellspacing="0" style="width:128px; float:left; margin:2px">
<table class="item-class">

<thead>
<tr>
<th id="reservations-grid_c1" colspan="2" style="padding-left:1px"><?php echo date('d-m-y',strtotime($today)).'('.$day.')';?></th></tr>
</thead>
<tbody>
<?php 

//echo "select count(reservation_id)  From hms_reservation_info where chkin_date >= '$today' AND chkout_date <='$today'";

for($j=0;$j < count($reservations);$j++){

if($j%2==0){$rowclass='even';}else{$rowclass='odd';}
		$room_name = $room_name_arr[$j];
		$chkin_date = $chkin_date_arr[$j];
		$chkout_date = $chkout_date_arr[$j];
		$res_id = $res_ids_arr[$j];
		$todaydate = $today .' 00:00:00';
		
		$sql = "select count(reservation_id)  From hms_reservation_info where chkin_status = 'N'
AND  chkin_date = '$todaydate' AND reservation_status='1'";
		 //echo $sql; 		
		$total_reservations= Yii::app()->db->createCommand($sql)->queryScalar();
		//$arr = getRoomStatus($chkin_date, $chkout_date, $today);	
		
		$sql_occupied_chkin = "select count(chkin_id)  From hms_checkin_info where chkout_status = 'N' AND  chkin_date <= '$todaydate' AND  chkout_date > '$todaydate'";
		$total_occupied = Yii::app()->db->createCommand($sql_occupied_chkin)->queryScalar();

$total_reservations2 =0;
if($today > $curr_date){	$sql_reservation = "select count(reservation_id)  From hms_reservation_info where chkin_status = 'N'
AND  chkin_date < '$todaydate' AND chkout_date  > '$todaydate' AND noshow_status !='Y' AND  reservation_status='1'";
		// echo $sql_reservation; 		
		$total_reservations2 = Yii::app()->db->createCommand($sql_reservation)->queryScalar();
		$total_occupied = $total_occupied +	$total_reservations2;
		
		//$total_reservations ."+". $total_occupied ."+". $total_reservations2;//
}

if($today >= $curr_date){	

	if($x%6==0){?>
    
    <tr class="<?php echo $rowclass;?>">
	<td><b><?php echo "Total Rooms";?></b></td>
    <td align="right"><?php echo $dummy_total_rooms;?></td>
 </tr>
 <tr class="<?php echo $rowclass;?>">
	<td><b><?php echo "Reserved";?></b></td>
    <td align="right"><?php echo $total_reservations;?></td>
 </tr>
 <tr class="<?php echo $rowclass;?>">
	<td><b><?php echo "Occupied";?></b></td>
    <td align="right"><?php echo $total_occupied;?></td>
 </tr>
 <tr style="padding: 10px 10px !important;" class="<?php echo $rowclass;?>">
	<td style="font-weight:bold; padding: 5px 0px 5px 0px; background-color: #CCC;"><?php echo "Forecast";?></td>
    <td align="right" style="font-weight:bold; padding: 5px 0px 5px 0px;  background-color:#CCC;"><?php echo $total_reservations + $total_occupied;?></td>
 </tr>
  <tr class="<?php echo $rowclass;?>">
	<td><b><?php echo "Available";?></b></td>
    <td align="right"><?php echo $dummy_total_rooms - ($total_reservations + $total_occupied);?></td>
 </tr>
  <tr class="<?php echo $rowclass;?>">
	<td><b><?php echo "Occupanncy";?></b></td>
    <td align="right"><?php echo number_format(($total_reservations + $total_occupied)* 100 /$dummy_total_rooms, 2); ?></td>
 </tr>
 
		
	<?php }	else {
?>
<tr class="<?php echo $rowclass;?>">
	<td><?php //echo "Total Rooms";?></td>
    <td><?php echo $dummy_total_rooms;?></td>
 </tr>
 <tr class="<?php echo $rowclass;?>">
	<td><?php //echo "Reserved";?></td>
    <td><?php echo $total_reservations;?></td>
 </tr>
 <tr class="<?php echo $rowclass;?>">
	<td><?php //echo "Occupied";?></td>
    <td><?php echo $total_occupied;?></td>
 </tr>
 <tr style="padding: 10px 10px !important;" class="<?php echo $rowclass;?>">
	<td style="font-weight:bold; padding: 5px 0px 5px 0px; background-color: #CCC;"><?php //echo "Forecast";?></td>
    <td style="font-weight:bold; padding: 5px 0px 5px 0px;  background-color:#CCC;"><?php echo $total_reservations + $total_occupied;?></td>
 </tr>
  <tr class="<?php echo $rowclass;?>">
	<td><?php //echo "Available";?></td>
    <td><?php echo $dummy_total_rooms - ($total_reservations + $total_occupied);?></td>
 </tr>
  <tr class="<?php echo $rowclass;?>">
	<td><?php //echo "Occupanncy";?></td>
    <td><?php echo number_format(($total_reservations + $total_occupied)*(100/$dummy_total_rooms), 2); ?></td>
 </tr>
<?php } //end elses
$x++;
} }?>
</tbody>
</table>
</div>
<?php


}
 if($j%6==0){?> 
 <div style="clear:left"></div>
 <?php }
}
} //end if count
else{echo "<div style=\"min-height:300px\"> NO Reservation Found </div>";}
?>
 
</div><!-- END OF .dashIcons -->
</div>
<?php 
function getRoomStatus($chkin_date, $chkout_date, $today){
	
	$str1 = strtotime($chkin_date);
	$str2 = strtotime($chkout_date);		
	$date =strtotime($today);	
	$arr = "";
	$resd = "<div class=\"mini-box\" style=\"background-color:#06C;\">&nbsp;R</div>";
	$available= "<div class=\"mini-box\" style=\"background-color:#060;\">&nbsp;</div>";
	if($date >= $str1 && $date < $str2){$arr= $resd;} else {$arr= $available;}	
	return $arr;
}
?>