<?php

$this->breadcrumbs=array(

	'Exchange Rates'=>array('index'),

	$model->excange_rate_id=>array('view','id'=>$model->excange_rate_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List ExchangeRate', 'url'=>array('index')),

	array('label'=>'Create ExchangeRate', 'url'=>array('create')),

	array('label'=>'View ExchangeRate', 'url'=>array('view', 'id'=>$model->excange_rate_id)),

	array('label'=>'Manage ExchangeRate', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Update ExchangeRate') ?> <?php echo $model->excange_rate_id; ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>