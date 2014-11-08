<?php
$this->breadcrumbs=array(
	'Hotel Titles',
);

$this->menu=array(
	array('label'=>'Create HotelTitle', 'url'=>array('create')),
	array('label'=>'Manage HotelTitle', 'url'=>array('admin')),
);
?>

<h1>Hotel Titles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
