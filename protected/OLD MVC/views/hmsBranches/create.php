<?php

$this->breadcrumbs=array(

	'HMS Branches'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List Branches', 'url'=>array('index')),

	array('label'=>'Manage Branches', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Create Branches') ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>