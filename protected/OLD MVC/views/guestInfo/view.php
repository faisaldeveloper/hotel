<?php
$this->breadcrumbs=array('Guest Infos'=>array('index'),	$model->guest_id,);
$gid = $model->guest_id;
$this->menu=array(
	//array('label'=>'List GuestInfo', 'url'=>array('index')),
	array('label'=>'Create GuestInfo', 'url'=>array('create')),
	array('label'=>'Update GuestInfo', 'url'=>array('update', 'id'=>$model->guest_id)),
	array('label'=>'Delete GuestInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->guest_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GuestInfo', 'url'=>array('admin')),
);
$guest_name = GuestInfo::model()->find("guest_id = ". $model->guest_id)->guest_name;
?>
<h1><?php echo ucwords(strtolower($guest_name)); ?></h1>
<?php 
$this->widget('application.components.widgets.XDetailView', array(
 'data'=>$model,
 'ItemColumns' => 2,
 'attributes'=>array(
		//'guest_id',
		//'guest_salutation_id',
		array('label'=>'Name','value'=>$model->guestSalutation->salutation_name.' '. ucwords($model->guest_name)),
		//'guest_name',
		'guest_address',
		'guest_phone',
		'guest_mobile',
		//'guest_identity_id',
		array('label'=>'Company','value'=>$model->guestCompany->comp_name),
		
		
		/* 'guest_identity_no',
		//'guest_identity_issu',
		array('label'=>'Identity Issue Date', 'value'=> date("F j, Y", strtotime($model->guest_identity_issu))),
		//'guest_identiy_expire',
		array('label'=>'Identity Expiry Date', 'value'=> date("F j, Y", strtotime($model->guest_identiy_expire))),
		 */
		//'guest_gender',	 
		array('label'=>'Gender','value'=>($model->guest_gender=="M")?"Male":"Female"),
		array('label'=>'ID Doc','value'=>$model->guestIdentity->identity_description),		
		'guest_identity_no',
		
		
		'guest_email',
		'guest_remarks',
		//'guest_dob',
		array('label'=>'Date of Birth', 'value'=>(strtotime($model->guest_dob) =='')?"N/A": date("F j, Y", strtotime($model->guest_dob))),	
		//'guest_company_id',
		//'guest_country_id',
		array('label'=>'Country','value'=>$model->guestCountry->country_name),
		
		//'branch_id',
		//'user_id',
	 
 ),
)); 
?>
<?php 
$str ='';
$con1 = array("condition"=>"chkout_status = 'N' AND guest_id = ".$model->guest_id , 'order'=>'chkin_id DESC');
$res2 = CheckinInfo::model()->findAll($con1);
if(count($res2) > 0){$str =  " Guest is staying...";}
?>
<h1>  <?php echo Yii::t('views','Guest History:') ?>  <?php // echo  $str; ?></h1>
<?php 
//$con = array("condition"=>"chkin_date between '$from_date1' and '$to_date1' ", 'order'=>'chkin_date DESC');
$con2 = array("condition"=>"chkout_status = 'Y' AND guest_id = ".$model->guest_id , 'order'=>'chkin_id DESC', 'limit'=>5);
$res = CheckinInfo::model()->findAll($con2);
if(count($res) > 0){
?>
<table id="yw1" class="detail-view">
<tbody><tr class="even">
<th> <?php echo Yii::t('views','S#') ?> </th>
<th> <?php echo Yii::t('views','Checkin Date') ?></th>
<th> <?php echo Yii::t('views','Checkout Date') ?> </th>
<th> <?php echo Yii::t('views','Total Nights') ?> </th>
<th> <?php echo Yii::t('views','Total Persons') ?> </th>
<th> <?php echo Yii::t('views','Room No') ?> </th>
<th> <?php echo Yii::t('views','Room Rate') ?> </th>
<th> <?php echo Yii::t('views','Folio/Reg No') ?> </th>
</tr>
<?php $i=1;
foreach($res as $row){
		if($i%2==0)$class = "even";		else $class = "odd";
		$room_name = RoomMaster::model()->find("mst_room_id=". $row['room_id'])->mst_room_name;
		
		
echo "<tr class='". $class. "'>"; 
echo "<td>". $i."</td>";
echo "<td>". $row['chkin_date']."</td>"; //.$row['chkout_date'];
echo "<td>". $row['chkout_date']."</td>";
echo "<td>". $row['total_days']."</td>";
echo "<td>". $row['total_person']."</td>";
echo "<td>". $room_name."</td>";
echo "<td>". $row['rate']."</td>";
echo "<td>". $row['chkin_id']."/". $row['reg_no'] .".</td>";
echo "</tr>";
$i++;
}
?>
</tbody></table>
<?php 
}
else if($str=='') {
	$str = "No visits so far...";		
}
echo $str;
//$criteria=new CDbCriteria;
//$criteria->condition="guest_id = ".$model->guest_id;
//$res = new CActiveDataProvider('CheckinInfo', array('criteria'=>$criteria,));
//$res = new CActiveDataProvider('CheckinInfo',array('criteria'=>array('condition'=>'guest_id='.$gid,),));
?>