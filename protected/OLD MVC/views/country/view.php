<?php

$this->breadcrumbs=array(

	'Countries'=>array('index'),

	$model->country_id,

);



$this->menu=array(

	//array('label'=>'List Country', 'url'=>array('index')),

	array('label'=>'Create Country', 'url'=>array('create')),

	array('label'=>'Update Country', 'url'=>array('update', 'id'=>$model->country_id)),

	array('label'=>'Delete Country', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->country_id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Manage Country', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','View Country') ?> - <?php echo $model->country_name; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		//'country_id',

		'country_name',

		'country_currancy',

		'currancy_sign',

		'country_code',

	),

)); ?>

