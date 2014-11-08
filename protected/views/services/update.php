<?php

$this->breadcrumbs=array(

	'Services'=>array('index'),

	$model->service_id=>array('view','id'=>$model->service_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List Services', 'url'=>array('index')),

	array('label'=>'Create Services', 'url'=>array('create')),

	array('label'=>'View Services', 'url'=>array('view', 'id'=>$model->service_id)),

	array('label'=>'Manage Services', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Update Services') ?> </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>