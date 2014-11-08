<?php
$this->breadcrumbs=array(
	'Room Masters',
);

$this->menu=array(
	array('label'=>'Create RoomMaster', 'url'=>array('create')),
	array('label'=>'Manage RoomMaster', 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('views','Room Masters') ?> </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
