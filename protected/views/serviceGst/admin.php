<?php
$this->breadcrumbs=array(
	'Service Gsts'=>array('index'),
	'Manage',
);
$this->menu=array(
	//array('label'=>'List ServiceGst', 'url'=>array('index')),
	array('label'=>'Create ServiceGst', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('service-gst-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1> <?php echo Yii::t('views','Manage Service Gsts') ?></h1>
<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'service-gst-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'gst_id',
		array('header'=>'Sr#','class'=>'IndexColumn'),
		//'gst_service_id',
		array('name'=>'gst_service_id', 'value'=>'$data->gstService->service_description'),
		'gst_percent',
		//'branch_id',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
