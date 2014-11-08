<?php

$this->breadcrumbs=array(

	'Flights'=>array('index'),

	$model->flight_id=>array('view','id'=>$model->flight_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List Flights', 'url'=>array('index')),

	array('label'=>'Create Flights', 'url'=>array('create')),

	array('label'=>'View Flights', 'url'=>array('view', 'id'=>$model->flight_id)),

	array('label'=>'Manage Flights', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Update Flight') ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>