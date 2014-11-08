<?php
$this->breadcrumbs=array(
	'Guest Statuses'=>array('index'),
	$model->guest_status_id,
);

$this->menu=array(
	//array('label'=>'List GuestStatus', 'url'=>array('index')),
	array('label'=>'Create GuestStatus', 'url'=>array('create')),
	array('label'=>'Update GuestStatus', 'url'=>array('update', 'id'=>$model->guest_status_id)),
	array('label'=>'Delete GuestStatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->guest_status_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GuestStatus', 'url'=>array('admin')),
);
?>

<h1>View GuestStatus #<?php echo $model->guest_status_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'guest_status_id',
		'status_description',
		//'branch_id',
	),
)); ?>
