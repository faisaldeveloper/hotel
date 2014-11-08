<?php
$this->breadcrumbs=array(
	'Identities',
);

$this->menu=array(
	array('label'=>'Create Identity', 'url'=>array('create')),
	array('label'=>'Manage Identity', 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('views','Identities') ?> </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
