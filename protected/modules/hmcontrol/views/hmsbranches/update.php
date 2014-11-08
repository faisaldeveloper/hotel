<?php
$this->breadcrumbs=array(
	'Hms Branches'=>array('index'),
	$model->branch_id=>array('view','id'=>$model->branch_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List HmsBranches', 'url'=>array('index')),
	array('label'=>'Create HmsBranches', 'url'=>array('create')),
	array('label'=>'View HmsBranches', 'url'=>array('view', 'id'=>$model->branch_id)),
	array('label'=>'Manage HmsBranches', 'url'=>array('admin')),
);
?>

<h1>Update Branch : <?php echo $model->hotel->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>