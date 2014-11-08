<?php
$this->breadcrumbs=array(
	'Hms Floors'=>array('index'),
	'Manage',
);
$this->menu=array(
	//array('label'=>'List Floor', 'url'=>array('index')),
	array('label'=>'Create Floor', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hms-floor-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1><?php echo Yii::t('views','Manage Floors') ?> </h1>
<?php 
$template ='';
if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}
if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}
//if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'hms-floor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'floor_id',
		array('header'=>'Sr #','class'=>'IndexColumn'),
		'description',
		//'branch_id',
		array(
			'class'=>'CButtonColumn',
			'template'=>$template ,
		),
	),
)); ?>
