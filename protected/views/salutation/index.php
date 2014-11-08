<?php
$this->breadcrumbs=array(
	'Salutations',
);

$this->menu=array(
	array('label'=>'Create Salutation', 'url'=>array('create')),
	array('label'=>'Manage Salutation', 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('views','Salutations') ?> </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
