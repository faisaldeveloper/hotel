<?php

$this->breadcrumbs=array(

	'Rate Types'=>array('index'),

	$model->rate_type_id,

);



$this->menu=array(

	//array('label'=>'List RateType', 'url'=>array('index')),

	array('label'=>'Create RateType', 'url'=>array('create')),

	array('label'=>'Update RateType', 'url'=>array('update', 'id'=>$model->rate_type_id)),

	array('label'=>'Delete RateType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rate_type_id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Manage RateType', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','View RateType #') ?> <?php echo $model->rate_type_id; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		'rate_type_id',

		'rate_name',

		'days',

		'branch_id',

	),

)); ?>

