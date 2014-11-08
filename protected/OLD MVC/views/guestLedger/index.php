<?php
$this->breadcrumbs=array(
	'Guest Ledgers',
);

$this->menu=array(
	array('label'=>'Create GuestLedger', 'url'=>array('create')),
	array('label'=>'Manage GuestLedger', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('views','Guest Ledgers') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
