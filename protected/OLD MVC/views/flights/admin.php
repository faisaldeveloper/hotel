<?php
$this->breadcrumbs=array(
	'Flights'=>array('index'),
	'Manage',
);
$this->menu=array(
	//array('label'=>'List Flights', 'url'=>array('index')),
	array('label'=>'Create Flights', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('flights-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1> <?php echo Yii::t('views','Manage Flights') ?></h1>
<?php 
$template ='';
if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}
if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}
//if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'flights-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'flight_id',
		array('header'=>'Sr #','class'=>'IndexColumn'),
		'flight_name',
		'flight_arrival',
		'flight_departure',
		//'branch_id',
		array(
			'class'=>'CButtonColumn',
			'template'=>$template ,	
		),
	),
)); ?>
