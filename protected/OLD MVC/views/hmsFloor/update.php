<?php

$this->breadcrumbs=array(

	'Hms Floors'=>array('index'),

	$model->floor_id=>array('view','id'=>$model->floor_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List Floor', 'url'=>array('index')),

	array('label'=>'Create Floor', 'url'=>array('create')),

	array('label'=>'View Floor', 'url'=>array('view', 'id'=>$model->floor_id)),

	array('label'=>'Manage Floor', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Update Floor') ?>  <?php echo $model->floor_id; ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>