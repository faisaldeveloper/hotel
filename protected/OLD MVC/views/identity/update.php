<?php

$this->breadcrumbs=array(

	'Identities'=>array('index'),

	$model->identity_id=>array('view','id'=>$model->identity_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List Identity', 'url'=>array('index')),

	array('label'=>'Create Identity', 'url'=>array('create')),

	array('label'=>'View Identity', 'url'=>array('view', 'id'=>$model->identity_id)),

	array('label'=>'Manage Identity', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Update Identity') ?>  </h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>