<?php
$this->menu=array(
	//array('label'=>'List RoomTypeRate', 'url'=>array('index')),
	array('label'=>'Update RoomTypeRate', 'url'=>array('update', 'id'=>$company_id)),
	array('label'=>'Manage RoomTypeRate', 'url'=>array('admin')),
);
?>
<h1><?php echo $company_name; ?></h1>

<div id="room-type-rate-grid" class="grid-view" cellpadding="0" cellspacing="0">

<table  class="mcetable" width="385" border="0" align="center">
  <tr>
    <th width="59">&nbsp;<?php echo Yii::t('views','Sr#') ?></th>
    <th width="198">&nbsp; <?php echo Yii::t('views','Room Type') ?></th>
    <th width="114">&nbsp; <?php echo Yii::t('views','Rate') ?></th>
  </tr>
<?php 
$i=1;
foreach($model as $row){
$room_type = HmsRoomType::model()->find("room_type_id = ". $row['room_type_id'])->room_name;
//echo "<br> $i - $room_type --- ". $row['room_rate'];
if($i%2==0)$class = " class=\"odd\"";
else $class = " class=\"even\"";
?>
<tr <?php echo $class ?>>
    <td>&nbsp;<?php echo $i; ?></td>
    <td>&nbsp;<?php echo $room_type; ?></td>
    <td>&nbsp;<?php echo $row['room_rate']; ?></td>
  </tr>
<?php
$i++;
}
?>
</table>

</div>


