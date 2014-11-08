<?php

$this->breadcrumbs=array(

	'Reservation Infos'=>array('index'),

	$model->reservation_id=>array('view','id'=>$model->reservation_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List ReservationInfo', 'url'=>array('index')),

	array('label'=>'Create ReservationInfo', 'url'=>array('create')),

	array('label'=>'View ReservationInfo', 'url'=>array('view', 'id'=>$model->reservation_id)),

	array('label'=>'Manage ReservationInfo', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Calendar') ?> </h1>



<?php $this->widget('ext.flowing-calendar.FlowingCalendarWidget');?>