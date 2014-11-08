<?php
$this->breadcrumbs=array(
	'Sale Persons',
);

$this->menu=array(
	array('label'=>'Create SalePerson', 'url'=>array('create')),
	array('label'=>'Manage SalePerson', 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('views','Sale Persons') ?> </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
