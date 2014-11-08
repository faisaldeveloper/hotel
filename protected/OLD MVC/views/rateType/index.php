<?php
$this->breadcrumbs=array(
	'Rate Types',
);

$this->menu=array(
	array('label'=>'Create RateType', 'url'=>array('create')),
	array('label'=>'Manage RateType', 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('views','Rate Types') ?> </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
