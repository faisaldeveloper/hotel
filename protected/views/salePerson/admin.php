<?php

$this->breadcrumbs=array(

	'Sale Persons'=>array('index'),

	'Manage',

);



$this->menu=array(

	//array('label'=>'List SalePerson', 'url'=>array('index')),

	array('label'=>'Create SalePerson', 'url'=>array('create')),

);



Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){

	$('.search-form').toggle();

	return false;

});

$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('sale-person-grid', {

		data: $(this).serialize()

	});

	return false;

});

");

?>



<h1> <?php echo Yii::t('views','Manage Sale Persons') ?> </h1>





<?php 

$template ='';

if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}

if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}

if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}

?>



<?php $this->widget('zii.widgets.grid.CGridView', array(

	'id'=>'sale-person-grid',

	'dataProvider'=>$model->search(),

	'filter'=>$model,

	'columns'=>array(

		//'sale_person_id',

		array('header'=>'Sr #','class'=>'IndexColumn'),

		'sale_person_name',

		'sale_person_comm',

		'is_active',

		//'branch_id',

		array(

			'class'=>'CButtonColumn',

			'template'=>$template ,	

		),

	),

)); ?>

