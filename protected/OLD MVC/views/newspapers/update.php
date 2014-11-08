<?php

$this->breadcrumbs=array(

	'Newspapers'=>array('index'),

	$model->newspaper_id=>array('view','id'=>$model->newspaper_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List Newspapers', 'url'=>array('index')),

	array('label'=>'Create Newspapers', 'url'=>array('create')),

	array('label'=>'View Newspapers', 'url'=>array('view', 'id'=>$model->newspaper_id)),

	array('label'=>'Manage Newspapers', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Update Newspapers -') ?> <?php echo $model->newspaper_name; ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>