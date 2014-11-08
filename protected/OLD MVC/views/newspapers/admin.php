<?php

$this->breadcrumbs=array(

	'Newspapers'=>array('index'),

	'Manage',

);



$this->menu=array(

	//array('label'=>'List Newspapers', 'url'=>array('index')),

	array('label'=>'Create Newspapers', 'url'=>array('create')),

);



Yii::app()->clientScript->registerScript('search',"

$('.search-button').click(function(){

	$('.search-form').toggle();

	return false;

});

$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('newspapers-grid', {

		data: $(this).serialize()

	});

	return false;

});

");

?>



<h1> <?php echo Yii::t('views','Manage Newspapers') ?> </h1>

<?php 

$template ='';

if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}

if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}

if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}

?>

<?php $this->widget('zii.widgets.grid.CGridView', array(

	'id'=>'newspapers-grid',

	'dataProvider'=>$model->search(),

	'filter'=>$model,

	'columns'=>array(

		//'newspaper_id',

		array('header'=>'Sr #','class'=>'IndexColumn'),

		'newspaper_name',

		//'branch_id',

		array(

			'class'=>'CButtonColumn',

			'template'=>$template ,	

		),

	),

)); ?>

