<?php

$this->breadcrumbs=array(

	'Identities'=>array('index'),

	'Manage',

);



$this->menu=array(

	//array('label'=>'List Identity', 'url'=>array('index')),

	array('label'=>'Create Identity', 'url'=>array('create')),

);



Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){

	$('.search-form').toggle();

	return false;

});

$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('identity-grid', {

		data: $(this).serialize()

	});

	return false;

});

");

?>



<h1> <?php echo Yii::t('views','Manage Identities') ?> </h1>

<?php 

$template ='';

if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}

if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}

if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}

?>

<?php $this->widget('zii.widgets.grid.CGridView', array(

	'id'=>'identity-grid',

	'dataProvider'=>$model->search(),

	'filter'=>$model,

	'columns'=>array(

		//'identity_id',

		array('header'=>'Sr#','class'=>'IndexColumn'),

		'identity_description',

		//'branch_id',

		array(

			'class'=>'CButtonColumn',

			'template'=>$template ,

		),

	),

)); ?>

