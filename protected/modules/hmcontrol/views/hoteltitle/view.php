<?php
$this->breadcrumbs=array(
	'Hotel Titles'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List HotelTitle', 'url'=>array('index')),
	array('label'=>'Create HotelTitle', 'url'=>array('create')),
	array('label'=>'Update HotelTitle', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete HotelTitle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HotelTitle', 'url'=>array('admin')),
);
?>

<h1>View HotelTitle #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'title',
		'application_title',
		'website',
		//'logo_image',
		array(
		 'name'=>'logo_image',
		 'type'=>'html',		 
		 //'value'=>CHtml::image(\"/hotel/hotel_logos/".$model->logo_image,"",array("style"=>"width:35px;height:35px;")),
		 'value'=>(!empty($model->logo_image))?CHtml::image(\"/hotel/hotel_logos/".$model->logo_image,"",array("style"=>"width:35px;height:35px;")):"no image",
		 ),
		'bg_image',
	),
)); ?>
