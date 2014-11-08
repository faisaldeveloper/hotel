<?php
$this->breadcrumbs=array(
	'Hms Branches',
);

$this->menu=array(
	array('label'=>'Create HmsBranches', 'url'=>array('create')),
	array('label'=>'Manage HmsBranches', 'url'=>array('admin')),
);
?>

<h1>Hms Branches</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
