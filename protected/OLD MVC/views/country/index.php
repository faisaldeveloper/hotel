<?php
$this->breadcrumbs=array(
	'Countries',
);

$this->menu=array(
	array('label'=>'Create Country', 'url'=>array('create')),
	array('label'=>'Manage Country', 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('views','Countries') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
