<?php
$this->breadcrumbs=array(
	'Room Types'=>array('index'),
	$model->room_type_id,
);
$this->menu=array(
	//array('label'=>'List RoomType', 'url'=>array('index')),
	array('label'=>'Create RoomType', 'url'=>array('create')),
	array('label'=>'Update RoomType', 'url'=>array('update', 'id'=>$model->room_type_id)),
	//array('label'=>'Delete RoomType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->room_type_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RoomType', 'url'=>array('admin')),
);
?>
<h1><?php echo Yii::t('views','View RoomType -') ?> <?php echo $model->room_name; ?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'room_type_id',
		'room_name',
		'adults',
		'childs',
		'room_rate',
		//'branch_id',
	),
)); ?>
