<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>



<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
		'header'=>'Sn',
		'value'=>'++$row',
		),
		
		'username',
		//array('name'=>'username', 'header'=>'Name','value'=>'ucwords($data->username)'),
		'password',
		'email',
		//'hotel_id',
		array('name'=>'hotel_id', 'header'=>'Hotel', 'value'=>'$data->hotel->title'),
		//'hotel_branch_id',
		array('name'=>'hotel_branch_id', 'header'=>'Branch', 'value'=>'$data->hotelBranch->branch_address'),
		
		array(
			'header'=>'Actions',
			'class'=>'CButtonColumn',
		),
	),
)); ?>
