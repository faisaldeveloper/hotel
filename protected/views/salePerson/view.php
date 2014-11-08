<?php

$this->breadcrumbs=array(

	'Sale Persons'=>array('index'),

	$model->sale_person_id,

);



$this->menu=array(

	//array('label'=>'List SalePerson', 'url'=>array('index')),

	array('label'=>'Create SalePerson', 'url'=>array('create')),

	array('label'=>'Update SalePerson', 'url'=>array('update', 'id'=>$model->sale_person_id)),

	array('label'=>'Delete SalePerson', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sale_person_id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Manage SalePerson', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','View SalePerson #') ?> <?php echo $model->sale_person_id; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		'sale_person_id',

		'sale_person_name',

		'sale_person_comm',

		'is_active',

		//'branch_id',

	),

)); ?>

