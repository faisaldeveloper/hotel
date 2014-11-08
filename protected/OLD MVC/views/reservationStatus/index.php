<?php
$this->breadcrumbs=array(
	'Reservation Statuses',
);

$this->menu=array(
	array('label'=>'Create ReservationStatus', 'url'=>array('create')),
	array('label'=>'Manage ReservationStatus', 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('views','Reservation Statuses') ?> </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
