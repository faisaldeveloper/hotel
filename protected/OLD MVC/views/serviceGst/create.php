<?php

$this->breadcrumbs=array(

	'Service Gsts'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List ServiceGst', 'url'=>array('index')),

	array('label'=>'Manage ServiceGst', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Create ServiceGst') ?> </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>