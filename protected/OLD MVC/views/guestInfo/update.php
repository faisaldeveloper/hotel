<?php

$this->breadcrumbs=array(

	'Guest Infos'=>array('index'),

	$model->guest_id=>array('view','id'=>$model->guest_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List GuestInfo', 'url'=>array('index')),

	array('label'=>'Create GuestInfo', 'url'=>array('create')),

	array('label'=>'View GuestInfo', 'url'=>array('view', 'id'=>$model->guest_id)),

	array('label'=>'Manage GuestInfo', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Update GuestInfo') ?> <?php echo $model->guest_id; ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>