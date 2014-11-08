<?php
$this->breadcrumbs=array(
	'Flights'=>array('index'),
	$model->flight_id,
);
$this->menu=array(
	//array('label'=>'List Flights', 'url'=>array('index')),
	array('label'=>'Create Flights', 'url'=>array('create')),
	//array('label'=>'Update Flights', 'url'=>array('update', 'id'=>$model->flight_id)),
	//array('label'=>'Delete Flights', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->flight_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Flights', 'url'=>array('admin')),
);
?>
<h1> <?php echo Yii::t('views','View Flights') ?> </h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'flight_id',
		'flight_name',
		'flight_arrival',
		//'flight_departure',
		//'branch_id',
	),
)); ?>
