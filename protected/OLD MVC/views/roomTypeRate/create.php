<?php

$this->breadcrumbs=array(

	'Room Type Rates'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List RoomTypeRate', 'url'=>array('index')),

	array('label'=>'Manage RoomTypeRate', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Create RoomTypeRate') ?> </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model,'company_model'=>$company_model)); ?>