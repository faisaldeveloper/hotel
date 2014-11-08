<?php

$this->breadcrumbs=array(

	'Newspapers'=>array('index'),

	$model->newspaper_id,

);



$this->menu=array(

	//array('label'=>'List Newspapers', 'url'=>array('index')),

	array('label'=>'Create Newspapers', 'url'=>array('create')),

	array('label'=>'Update Newspapers', 'url'=>array('update', 'id'=>$model->newspaper_id)),

	array('label'=>'Delete Newspapers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->newspaper_id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Manage Newspapers', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','View Newspapers -') ?>  <?php echo $model->newspaper_name; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		//'newspaper_id',

		'newspaper_name',

		//'branch_id',

	),

)); ?>

