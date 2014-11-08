<?php

$this->breadcrumbs=array(

	'Salutations'=>array('index'),

	$model->salutation_id=>array('view','id'=>$model->salutation_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List Salutation', 'url'=>array('index')),

	array('label'=>'Create Salutation', 'url'=>array('create')),

	array('label'=>'View Salutation', 'url'=>array('view', 'id'=>$model->salutation_id)),

	array('label'=>'Manage Salutation', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Update Salutation') ?>  <?php echo $model->salutation_id; ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>