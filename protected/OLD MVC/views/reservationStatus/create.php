<?php

$this->breadcrumbs=array(

	'Reservation Statuses'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List ReservationStatus', 'url'=>array('index')),

	array('label'=>'Manage ReservationStatus', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Create ReservationStatus') ?> </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>