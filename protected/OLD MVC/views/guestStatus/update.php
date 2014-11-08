<?php
$this->breadcrumbs=array(
	'Guest Statuses'=>array('index'),
	$model->guest_status_id=>array('view','id'=>$model->guest_status_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List GuestStatus', 'url'=>array('index')),
	array('label'=>'Create GuestStatus', 'url'=>array('create')),
	array('label'=>'View GuestStatus', 'url'=>array('view', 'id'=>$model->guest_status_id)),
	array('label'=>'Manage GuestStatus', 'url'=>array('admin')),
);
?>

<h1>Update GuestStatus <?php echo $model->guest_status_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>