<?php

$this->breadcrumbs=array(

	'Room Masters'=>array('index'),

	$model->mst_room_id,

);



$this->menu=array(

	//array('label'=>'List RoomMaster', 'url'=>array('index')),

	array('label'=>'Create RoomMaster', 'url'=>array('create')),

	array('label'=>'Update RoomMaster', 'url'=>array('update', 'id'=>$model->mst_room_id)),

	array('label'=>'Delete RoomMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->mst_room_id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Manage RoomMaster', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','View RoomMaster -') ?>  <?php echo $model->mst_room_name; ?></h1>



<?php 

if($model->mst_room_status=="V") $room_status =  "Available";

else if($model->mst_room_status=="D") $room_status =  "Dirty";

else if($model->mst_room_status=="O") $room_status =  "Occupied";

else if($model->mst_room_status=="R") $room_status =  "Reserve";



$this->widget('application.components.widgets.XDetailView', array(

 'data'=>$model,

 'ItemColumns' => 2,

 'attributes'=>array(

		//'mst_room_id',

		'mst_room_name',

		//'mst_floor_id',

		array('label'=>'Floor Name','value'=>$model->Floor->description),

		//'mst_roomtypeid',

		array('label'=>'Room Type','value'=>$model->Roomtype->room_name),

		'mst_room_remarks',

		'mst_room_adults',

		'mst_room_childs',

		//'mst_room_status',

		array('label'=>'Room Status','value'=>$room_status),

		//'branch_id',

	),

)); 

?>





