<?php

$this->breadcrumbs=array(

	'Newspapers'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List Newspapers', 'url'=>array('index')),

	array('label'=>'Manage Newspapers', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Create Newspapers') ?> </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>