<?php
$this->breadcrumbs=array(
	'Hms Branches'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HmsBranches', 'url'=>array('index')),
	array('label'=>'Manage HmsBranches', 'url'=>array('admin')),
);
?>

<h1>Create HmsBranches</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>