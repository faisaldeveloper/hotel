<?php
$this->breadcrumbs=array(
	'Guest Statuses',
);

$this->menu=array(
	array('label'=>'Create GuestStatus', 'url'=>array('create')),
	array('label'=>'Manage GuestStatus', 'url'=>array('admin')),
);
?>

<h1>Guest Statuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
