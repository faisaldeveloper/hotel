<?php

$this->breadcrumbs=array(

	'Countries'=>array('index'),

	$model->country_id=>array('view','id'=>$model->country_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List Country', 'url'=>array('index')),

	array('label'=>'Create Country', 'url'=>array('create')),

	array('label'=>'View Country', 'url'=>array('view', 'id'=>$model->country_id)),

	array('label'=>'Manage Country', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Update Country') ?> </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>