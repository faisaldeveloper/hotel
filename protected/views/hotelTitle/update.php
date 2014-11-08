<?php

$this->breadcrumbs=array(

	'Hotel Titles'=>array('index'),

	$model->title=>array('view','id'=>$model->id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List HotelTitle', 'url'=>array('index')),

	array('label'=>'Create HotelTitle', 'url'=>array('create')),

	array('label'=>'View HotelTitle', 'url'=>array('view', 'id'=>$model->id)),

	array('label'=>'Manage HotelTitle', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Update HotelTitle') ?> <?php echo $model->id; ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>