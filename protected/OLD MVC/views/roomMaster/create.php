<?php

$this->breadcrumbs=array(

	'Room Masters'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List RoomMaster', 'url'=>array('index')),

	array('label'=>'Manage RoomMaster', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Create RoomMaster') ?> </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>