<?php

$this->breadcrumbs=array(

	'Service Gsts'=>array('index'),

	$model->gst_id=>array('view','id'=>$model->gst_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List ServiceGst', 'url'=>array('index')),

	array('label'=>'Create ServiceGst', 'url'=>array('create')),

	array('label'=>'View ServiceGst', 'url'=>array('view', 'id'=>$model->gst_id)),

	array('label'=>'Manage ServiceGst', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Update Service Gst') ?>  </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>