<?php
$this->breadcrumbs=array(
	'Service Gsts',
);

$this->menu=array(
	array('label'=>'Create ServiceGst', 'url'=>array('create')),
	array('label'=>'Manage ServiceGst', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('views','Service Gsts') ?> </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
