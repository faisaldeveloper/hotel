<?php

$this->breadcrumbs=array(

	'HMS Branches'=>array('index'),

	$model->branch_id=>array('view','id'=>$model->branch_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List Branches', 'url'=>array('index')),

	array('label'=>'Create Branches', 'url'=>array('create')),

	array('label'=>'View Branches', 'url'=>array('view', 'id'=>$model->branch_id)),

	array('label'=>'Manage Branches', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Update Branches') ?> <?php echo $model->branch_id; ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>