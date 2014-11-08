<?php
//print_r($data);

$to_date = $data['to_date'];
$mydate = date("Y-m-d", strtotime($from_date));
//echo "-------".$mydate."---";


$monthno = '0';
$from_date = $data['from_date'];
$timestamp = strtotime ( "$monthno month" , strtotime($from_date)) ;

//echo date("Y-m-d", $timestamp);
?>
<style>
td{
	border-bottom:solid 1px;
	
}
</style>

<div class="container_mce">
 <table width="100%" border="0">
 <tr>    
    <td colspan="3" align="center" style="font-size: 12px; border-color:#FFF !important"><strong>ROOM RESERVATION FORECAST REPORT</strong></td>    
  </tr>
  <tr>
    <td colspan="3" align="center" style="font-size: 10px; border-color:#FFF !important"><strong><?php echo '<h2>'. date ( 'F, Y' , $timestamp ).'</h2>'; ?> </strong></td> 
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>  

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
?>
<table width="100%" class="item-class">
<thead>
<tr style="border-bottom:solid 1px">
<th align="left">Date</th>
<th align="left">Days</th>
<th>Total Rooms</th>
<th>Reserved</th>
<th>Occupied</th>
<th>Forecast</th>
<th>Available</th>
<th align="right" style="padding-right:20px;">Occupancy %</th>
<th></th>
</tr>
</thead>
<tbody>
<?php
for($i=1;$i<=$daysofmonth;$i++){// this loop runs for whole month
$today = "$year-$month-".str_pad($i, 2, "0", STR_PAD_LEFT);
$today = date('Y-m-d',strtotime($today));
$day = date('l',strtotime($today));

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

$total_reservations2 =0; $bg_color = "";
if($today > $curr_date){	$sql_reservation = "select count(reservation_id)  From hms_reservation_info where chkin_status = 'N'
AND  chkin_date < '$todaydate' AND chkout_date  > '$todaydate' AND noshow_status !='Y' AND  reservation_status='1'";
		// echo $sql_reservation; 		
		$total_reservations2 = Yii::app()->db->createCommand($sql_reservation)->queryScalar();
		$total_occupied = $total_occupied +	$total_reservations2;		
		//$total_reservations ."+". $total_occupied ."+". $total_reservations2;//
		
		
	

    ?>
    <tr class="<?php echo $rowclass;?>" >	
    <td align="left"><?php echo date("d/m/y", strtotime($today));?></td>	
    <td align="left"><?php echo $day;?></td> 
    <td align="center"><?php echo "64";//$total_occupied;?></td>	
    <td align="center"><?php echo $total_reservations;?></td>
    <td align="center"><?php echo $total_occupied;?></td> 
    <td align="center" style="background-color:#CCC"><?php echo $total_reservations + $total_occupied; ?></td>
    <td align="center"><?php echo 64 - ($total_reservations + $total_occupied); ?></td>
    <td align="right" style="padding-right:20px;"><?php echo number_format(($total_reservations + $total_occupied)* 100 /64, 2)." %"; ?></td>
    <td align="left"></td> 
 </tr>		
<?php }
} }
?>
</tbody>
</table>
 <div style="clear:both"></div>  
  <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>
