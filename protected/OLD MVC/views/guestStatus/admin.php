<?php
$this->breadcrumbs=array(
	'Guest Statuses'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List GuestStatus', 'url'=>array('index')),
	array('label'=>'Create GuestStatus', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('guest-status-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Guest Statuses</h1>

<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'guest-status-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'guest_status_id',
		array('header'=>'Sr #','class'=>'IndexColumn'),
		'status_description',
		//'branch_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
