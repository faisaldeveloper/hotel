<?php

$this->breadcrumbs=array(

	'Guest Ledgers'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List GuestLedger', 'url'=>array('index')),

	array('label'=>'Manage GuestLedger', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Create GuestLedger') ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>