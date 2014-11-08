<?php

$this->breadcrumbs=array(

	'Salutations'=>array('index'),

	$model->salutation_id,

);



$this->menu=array(

	//array('label'=>'List Salutation', 'url'=>array('index')),

	array('label'=>'Create Salutation', 'url'=>array('create')),

	array('label'=>'Update Salutation', 'url'=>array('update', 'id'=>$model->salutation_id)),

	array('label'=>'Delete Salutation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->salutation_id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Manage Salutation', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','View Salutation #') ?><?php echo $model->salutation_id; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		'salutation_id',

		'salutation_name',

		//'branch_id',

	),

)); ?>

