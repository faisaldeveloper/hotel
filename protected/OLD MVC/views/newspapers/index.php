<?php
$this->breadcrumbs=array(
	'Newspapers',
);

$this->menu=array(
	array('label'=>'Create Newspapers', 'url'=>array('create')),
	array('label'=>'Manage Newspapers', 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('views','Newspapers') ?> </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
