<?php

$this->breadcrumbs=array(

	'Flights'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List Flights', 'url'=>array('index')),

	array('label'=>'Manage Flights', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Create Flights') ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>