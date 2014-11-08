<?php
$this->breadcrumbs=array(
	'Hms Branches'=>array('index'),
	$model->branch_id,
);

$this->menu=array(
	array('label'=>'List HmsBranches', 'url'=>array('index')),
	array('label'=>'Create HmsBranches', 'url'=>array('create')),
	array('label'=>'Update HmsBranches', 'url'=>array('update', 'id'=>$model->branch_id)),
	array('label'=>'Delete HmsBranches', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->branch_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HmsBranches', 'url'=>array('admin')),
);
?>

<h1>View Hotel Branch #<?php echo $model->branch_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'branch_id',
		'branch_address',
		'branch_phone',
		'branch_fax',
		'branch_email',
		'room_limit',
		//'hotel_id',
		array('name'=>'hotel_id', 'header'=>'Hotel', 'value'=>$model->hotel->title),
		
		'active_date',
		'expiry_date',
	),
)); ?>
