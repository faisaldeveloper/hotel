<?php

$this->breadcrumbs=array(

	'Services'=>array('index'),

	$model->service_id,

);



$this->menu=array(

	//array('label'=>'List Services', 'url'=>array('index')),

	//array('label'=>'Create Services', 'url'=>array('create')),

	//array('label'=>'Update Services', 'url'=>array('update', 'id'=>$model->service_id)),

	//array('label'=>'Delete Services', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->service_id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Manage Services', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','View Service -') ?>  <?php echo $model->service_description; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		//'service_id',

		'service_code',

		'service_description',

		'servise_type',

		'service_rate',

		//'branch_id',

	),

)); ?>

