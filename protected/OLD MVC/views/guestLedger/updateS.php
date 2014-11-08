<?php

$this->breadcrumbs=array(

	'Guest Ledgers'=>array('index'),

	$model->id=>array('view','id'=>$model->id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List GuestLedger', 'url'=>array('index')),

	array('label'=>'Create GuestLedger', 'url'=>array('create')),

	array('label'=>'View GuestLedger', 'url'=>array('view', 'id'=>$model->id)),

	array('label'=>'Manage GuestLedger', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Update GuestLedger') ?>  <?php echo $model->id; ?></h1>



<?php echo $this->renderPartial('_formS', array('model'=>$model)); ?>