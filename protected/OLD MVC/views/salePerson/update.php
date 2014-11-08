<?php

$this->breadcrumbs=array(

	'Sale Persons'=>array('index'),

	$model->sale_person_id=>array('view','id'=>$model->sale_person_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List SalePerson', 'url'=>array('index')),

	array('label'=>'Create SalePerson', 'url'=>array('create')),

	array('label'=>'View SalePerson', 'url'=>array('view', 'id'=>$model->sale_person_id)),

	array('label'=>'Manage SalePerson', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Update SalePerson') ?>  <?php echo $model->sale_person_id; ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>