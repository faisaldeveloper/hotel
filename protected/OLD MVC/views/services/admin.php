<?php
$this->breadcrumbs=array(
	'Services'=>array('index'),
	'Manage',
);
$this->menu=array(
	//array('label'=>'List Services', 'url'=>array('index')),
	array('label'=>'Create Services', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('services-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1> <?php echo Yii::t('views','>Manage Services') ?></h1>
<?php 
$template ='';
if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}
if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}
//if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'services-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'service_id',
		array('header'=>'Sr:','class'=>'IndexColumn'),
		'service_code',
		'service_description',
		'servise_type',
		//'service_rate',
		//'branch_id',
		array(
			'class'=>'CButtonColumn',
			'template'=>$template ,	
		),
	),
)); ?>
