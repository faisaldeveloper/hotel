<?php

$this->breadcrumbs=array(

	'Rate Types'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List RateType', 'url'=>array('index')),

	array('label'=>'Manage RateType', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Create RateType') ?> </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>