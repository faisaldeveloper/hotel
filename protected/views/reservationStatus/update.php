<?php

$this->breadcrumbs=array(

	'Reservation Statuses'=>array('index'),

	$model->res_id=>array('view','id'=>$model->res_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List ReservationStatus', 'url'=>array('index')),

	array('label'=>'Create ReservationStatus', 'url'=>array('create')),

	array('label'=>'View ReservationStatus', 'url'=>array('view', 'id'=>$model->res_id)),

	array('label'=>'Manage ReservationStatus', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Update ReservationStatus') ?>  <?php echo $model->res_id; ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>