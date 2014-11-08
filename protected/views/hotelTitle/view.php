<?php

$this->breadcrumbs=array(

	'Hotel Titles'=>array('index'),

	$model->title,

);



$this->menu=array(

	//array('label'=>'List HotelTitle', 'url'=>array('index')),

	array('label'=>'Create HotelTitle', 'url'=>array('create')),

	array('label'=>'Update HotelTitle', 'url'=>array('update', 'id'=>$model->id)),

	array('label'=>'Delete HotelTitle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Manage HotelTitle', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','View HotelTitle #') ?> <?php echo $model->id; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		'id',

		'title',

		'application_title',

		'website',

		//'logo_image',

		//'bg_image',

	),

)); ?>

