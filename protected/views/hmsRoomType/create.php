<?php

$this->breadcrumbs=array(

	'Room Types'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List RoomType', 'url'=>array('index')),

	array('label'=>'Manage RoomType', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Create HmsRoomType') ?> </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>