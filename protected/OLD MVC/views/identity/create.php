<?php

$this->breadcrumbs=array(

	'Identities'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List Identity', 'url'=>array('index')),

	array('label'=>'Manage Identity', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Create Identity') ?> </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>