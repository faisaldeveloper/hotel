<?php
$this->breadcrumbs=array(
	'Hms Branches'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List HmsBranches', 'url'=>array('index')),
	array('label'=>'Create HmsBranches', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hms-branches-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Hms Branches</h1>



<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'hms-branches-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'branch_id',
		array(
		'header'=>'Sn',
		'value'=>'++$row',
		),
		array('name'=>'hotel_id', 'header'=>'Hotel', 'value'=>'$data->hotel->title'),
		'branch_address',
		'branch_phone',
		'branch_fax',
		'branch_email',
		'room_limit',
		//'hotel_id',
		
		
		/*
		'active_date',
		'expiry_date',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
