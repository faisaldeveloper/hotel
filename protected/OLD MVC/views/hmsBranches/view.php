<?php

$this->breadcrumbs=array(

	'HMS Branches'=>array('index'),

	$model->branch_id,

);



$this->menu=array(

	//array('label'=>'List Branches', 'url'=>array('index')),

	array('label'=>'Create Branches', 'url'=>array('create')),

	array('label'=>'Update Branches', 'url'=>array('update', 'id'=>$model->branch_id)),

	array('label'=>'Delete Branches', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->branch_id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Manage Branches', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','View Branches #') ?> <?php echo $model->branch_id; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		'branch_id',

		'branch_address',

		'branch_phone',

		'branch_fax',

		'branch_email',

		//'hotel_id',

		array('label'=>'Hotel','value'=>$model->hotel->title),

		'active_date',

		'expiry_date',

	),

)); ?>

