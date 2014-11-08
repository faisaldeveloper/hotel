<?php
$this->breadcrumbs=array(
	'Guest Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List GuestStatus', 'url'=>array('index')),
	array('label'=>'Manage GuestStatus', 'url'=>array('admin')),
);
?>

<h1>Create GuestStatus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>