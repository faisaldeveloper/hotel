<?php
$this->breadcrumbs=array(
	'Room Types'=>array('index'),
	'Manage',
);
$this->menu=array(
	//array('label'=>'List RoomType', 'url'=>array('index')),
	array('label'=>'Create RoomType', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hms-room-type-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1><?php echo Yii::t('views','Manage Room Types') ?> </h1>
<?php 
$template ='';
if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}
if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}
//if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'hms-room-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'room_type_id',
		array('header'=>'Sr #','class'=>'IndexColumn'),
		'room_name',
		'adults',
		'childs',
		'room_rate',
		//'branch_id',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
