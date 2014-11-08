<?php
$this->breadcrumbs=array(
	'Countries'=>array('index'),
	'Manage',
);
$this->menu=array(
	//array('label'=>'List Country', 'url'=>array('index')),
	array('label'=>'Create Country', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('country-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1> <?php echo Yii::t('views','Manage Countries') ?></h1>
<?php 
$template ='';
if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}
if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}
//if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'country-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'country_id',
		array('header'=>'Sr:','class'=>'IndexColumn'),
		'country_name',
		'country_currancy',
		'currancy_sign',
		'country_code',
		array(
			'class'=>'CButtonColumn',
			'template'=>$template ,
		),
	),
)); ?>
