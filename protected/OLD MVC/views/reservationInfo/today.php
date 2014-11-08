<?php
$this->breadcrumbs=array(
	'Reservation Infos'=>array('index'),
	$model->reservation_id=>array('view','id'=>$model->reservation_id),
	'Update',
);
$this->menu=array(
	//array('label'=>'List ReservationInfo', 'url'=>array('index')),
	array('label'=>'Create ReservationInfo', 'url'=>array('create')),
	array('label'=>'View ReservationInfo', 'url'=>array('view', 'id'=>$model->reservation_id)),
	array('label'=>'Manage ReservationInfo', 'url'=>array('admin')),
);
?>
<style type="text/css">
.round-corner{
	border:2px; 
	border-top-left-radius: .5em;
	border-top-right-radius: .5em;
	border-bottom-left-radius: .5em;
	border-bottom-right-radius: .5em;
}
</style>
<h1> <?php echo Yii::t('views','Today') ?> </h1>
<?php //$this->widget('ext.flowing-calendar.FlowingCalendarWidget');?>
<?php
	//$cur_date = date("Y-m-d");
	$branch_id = yii::app()->user->branch_id;	
	$cur_date = DayEnd::model()->find("branch_id= $branch_id")->active_date;		
	$total_rooms = RoomMaster::model()->findAll("branch_id=$branch_id Order by mst_room_name");
	$bg_color = "background-color:#ccc;";		
?>
<div class="dashIcon span-3 round-corner" style="color: #000 !important; width:910px; <?php echo $bg_color; ?>">  

<?php 
$arrival = ReservationInfo::model()->findAll("chkin_date LIKE '$cur_date%' AND (reservation_status = 1 || reservation_status = 3)  AND chkin_status='N' AND branch_id=$branch_id order by reservation_id");
?>
<h1> <?php echo Yii::t('views','Expected Arrivals'). " - [". count($arrival)."]"; ?> </h1>
<table id="tbl1" width="800">
<tr style=" background-color: #5EA6E1; border: solid 1px !important;">
 <th><?php echo Yii::t('views','Conf#') ?></th>
 <th> <?php echo Yii::t('views','Name') ?> </th>
 <th><?php echo Yii::t('views','Company') ?> </th>
 <th><?php echo Yii::t('views','Nights') ?> </th>
 <th> <?php echo Yii::t('views','Room Type') ?> </th>
 <th><?php echo Yii::t('views','Rate') ?> </th>
 <th> <?php echo Yii::t('views','MOP') ?></th> 
</tr>
<?php 
$i=1;

	
foreach ($arrival as $row){
	$company_id = $row['company_id'];
	$company_name = Company::model()->find("comp_id = $company_id")->comp_name;
	$room = HmsRoomType::model()->find("room_type_id = ". $row['room_type'])->room_name;
	$mop = $row['mode_of_payment'];
	if($mop==1){$mop = "Cash/CC";}
	if($mop==2){$mop = "BTC";}
?>
<tr>
 <td><?php echo $row['reservation_id']; ?></td>
 <td><?php echo ucwords(strtolower($row['client_name'])); ?></td>
 <td><?php echo substr($company_name, 0, 20); ?></td>
 <td><?php echo $row['total_days']; ?></td>
 <td><?php echo $room; ?></td>
 <td><?php echo $row['room_charges']; ?></td>
 <td><?php echo $mop; ?></td>  
</tr>
<?php $i++;  }?>
</table>


<?php 
$depart = CheckinInfo::model()->findAll("chkout_date LIKE '$cur_date%' AND chkout_status = 'N' AND branch_id=$branch_id");
?>
<h1> <?php echo Yii::t('views','Expected Departures'). " - [". count($depart)."]" ?> </h1>
<table id="tbl1" width="800">
<tr style=" background-color: #5EA6E1; border: solid 1px !important;">
 <th><?php echo Yii::t('views','Sr#') ?></th>
 <th> <?php echo Yii::t('views','Room #') ?> </th>
 <th><?php echo Yii::t('views','Name') ?> </th>
 <th> <?php echo Yii::t('views','Company') ?> </th>
 <th> <?php echo Yii::t('views','Nationality') ?> </th>
 <th><?php echo Yii::t('views','Arrival') ?> </th>
 <th><?php echo Yii::t('views','Departure') ?> </th> 
</tr>
<?php 
$i=1;

foreach ($depart as $row){
	$room_id = $row->room_id;
$room_no = RoomMaster::model()->find("mst_room_id = $room_id AND branch_id=$branch_id")->mst_room_name;	
?>
<tr>
 <td><?php echo $i; ?></td>
 <td><?php echo $room_no; ?></td>
 <td><?php echo ucwords(strtolower($row->guest->guest_name)); ?></td>
 <td><?php echo substr($row->company->comp_name, 0, 20); ?></td>
 <td><?php echo $row->guest->guestCountry->country_name; ?></td>
 <td><?php echo $row->chkin_date; ?></td>
 <td><?php echo $row->chkout_date; ?></td>  
</tr>
<?php $i++;  }?>
</table>
</div>
