<?php

$this->breadcrumbs=array(

	'Room Types'=>array('index'),

	$model->room_type_id=>array('view','id'=>$model->room_type_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List RoomType', 'url'=>array('index')),

	array('label'=>'Create RoomType', 'url'=>array('create')),

	array('label'=>'View RoomType', 'url'=>array('view', 'id'=>$model->room_type_id)),

	array('label'=>'Manage RoomType', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Update Room Type') ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>