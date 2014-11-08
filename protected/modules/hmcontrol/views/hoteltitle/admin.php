<?php
$this->breadcrumbs=array(
	'Hotel Titles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List HotelTitle', 'url'=>array('index')),
	array('label'=>'Create HotelTitle', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hotel-title-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Hotels</h1>



<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'hotel-title-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
		'header'=>'Sn',
		'value'=>'++$row',
		),
		'title',
		'application_title',
		'website',
		//'logo_image',
		array(
		 'name'=>'logo_image',
		 'type'=>'html',
		 'value'=>'(!empty($data->logo_image))?CHtml::image("/hotel/hotel_logos/".$data->logo_image,"",array("style"=>"width:35px;height:35px;")):"no image"',
		 ),
		//'bg_image',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
