<?php

$this->breadcrumbs=array(

	'Guest Infos'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List GuestInfo', 'url'=>array('index')),

	array('label'=>'Manage GuestInfo', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Create New Guest') ?> </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>