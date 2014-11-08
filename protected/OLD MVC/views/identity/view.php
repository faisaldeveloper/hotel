<?php

$this->breadcrumbs=array(

	'Identities'=>array('index'),

	$model->identity_id,

);



$this->menu=array(

	//array('label'=>'List Identity', 'url'=>array('index')),

	array('label'=>'Create Identity', 'url'=>array('create')),

	array('label'=>'Update Identity', 'url'=>array('update', 'id'=>$model->identity_id)),

	array('label'=>'Delete Identity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->identity_id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Manage Identity', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','') ?>  <?php echo $model->identity_description; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		//'identity_id',

		'identity_description',

		//'branch_id',

	),

)); ?>

