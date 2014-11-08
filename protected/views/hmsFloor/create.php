<?php

$this->breadcrumbs=array(

	'Floors'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List Floor', 'url'=>array('index')),

	array('label'=>'Manage Floor', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Create Floor') ?> </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>