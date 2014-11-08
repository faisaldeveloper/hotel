<?php

$this->breadcrumbs=array(

	'Salutations'=>array('index'),

	'Manage',

);



$this->menu=array(

	//array('label'=>'List Salutation', 'url'=>array('index')),

	array('label'=>'Create Salutation', 'url'=>array('create')),

);



Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){

	$('.search-form').toggle();

	return false;

});

$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('salutation-grid', {

		data: $(this).serialize()

	});

	return false;

});

");

?>



<h1><?php echo Yii::t('views','Manage Salutations') ?> </h1>







<?php $this->widget('zii.widgets.grid.CGridView', array(

	'id'=>'salutation-grid',

	'dataProvider'=>$model->search(),

	'filter'=>$model,

	'columns'=>array(

		//'salutation_id',

		array('header'=>'Sr','class'=>'IndexColumn'),

		'salutation_name',

		//'branch_id',

		array(

			'class'=>'CButtonColumn',

		),

	),

)); ?>

