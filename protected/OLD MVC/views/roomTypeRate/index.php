<?php
$this->breadcrumbs=array(
	'Room Type Rates',
);

$this->menu=array(
	array('label'=>'Create RoomTypeRate', 'url'=>array('update', 'id'=>$model[0]->company_id)),
	array('label'=>'Manage RoomTypeRate', 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('views','Room Type Rates') ?> </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
