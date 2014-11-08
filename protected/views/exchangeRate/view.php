<?php

$this->breadcrumbs=array(

	'Exchange Rates'=>array('index'),

	$model->excange_rate_id,

);



$this->menu=array(

	//array('label'=>'List ExchangeRate', 'url'=>array('index')),

	array('label'=>'Create ExchangeRate', 'url'=>array('create')),

	array('label'=>'Update ExchangeRate', 'url'=>array('update', 'id'=>$model->excange_rate_id)),

	array('label'=>'Delete ExchangeRate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->excange_rate_id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Manage ExchangeRate', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','View ExchangeRate #') ?><?php echo $model->excange_rate_id; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		'excange_rate_id',

		//'country_id',

		array('label'=>'Country','value'=>$model->country->country_name),

		'sign',

		'exchabge_rate',

		'branch_id',

		'user_id',

	),

)); ?>

