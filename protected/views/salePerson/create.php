<?php

$this->breadcrumbs=array(

	'Sale Persons'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List SalePerson', 'url'=>array('index')),

	array('label'=>'Manage SalePerson', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Create SalePerson') ?> </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>