<?php

$this->breadcrumbs=array(

	'Rate Types'=>array('index'),

	$model->rate_type_id=>array('view','id'=>$model->rate_type_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List RateType', 'url'=>array('index')),

	array('label'=>'Create RateType', 'url'=>array('create')),

	array('label'=>'View RateType', 'url'=>array('view', 'id'=>$model->rate_type_id)),

	array('label'=>'Manage RateType', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Update RateType') ?>  <?php echo $model->rate_type_id; ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>