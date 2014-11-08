<?php
$this->breadcrumbs=array(
	'Guest Infos',
);

$this->menu=array(
	array('label'=>'Create GuestInfo', 'url'=>array('create')),
	array('label'=>'Manage GuestInfo', 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('views','Guest Infos') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
