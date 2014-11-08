<?php
$this->breadcrumbs=array(
	'Checkin Infos',
);

$this->menu=array(
	array('label'=>'Create CheckinInfo', 'url'=>array('create')),
	array('label'=>'Manage CheckinInfo', 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('views','Checkin Infos') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
