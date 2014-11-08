<?php

$this->breadcrumbs=array(

	'Hotel Titles'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List HotelTitle', 'url'=>array('index')),

	array('label'=>'Manage HotelTitle', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Create HotelTitle') ?> </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>