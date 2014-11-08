<?php

$this->breadcrumbs=array(

	'Reservation Statuses'=>array('index'),

	$model->res_id,

);



$this->menu=array(

	//array('label'=>'List ReservationStatus', 'url'=>array('index')),

	array('label'=>'Create ReservationStatus', 'url'=>array('create')),

	array('label'=>'Update ReservationStatus', 'url'=>array('update', 'id'=>$model->res_id)),

	array('label'=>'Delete ReservationStatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->res_id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Manage ReservationStatus', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','View ReservationStatus #') ?> <?php echo $model->res_id; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		'res_id',

		'res_description',

		'branch_id',

	),

)); ?>

