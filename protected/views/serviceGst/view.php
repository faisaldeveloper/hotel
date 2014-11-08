<?php

$this->breadcrumbs=array(

	'Service Gsts'=>array('index'),

	$model->gst_id,

);



$this->menu=array(

	//array('label'=>'List ServiceGst', 'url'=>array('index')),

	array('label'=>'Create ServiceGst', 'url'=>array('create')),

	array('label'=>'Update ServiceGst', 'url'=>array('update', 'id'=>$model->gst_id)),

	array('label'=>'Delete ServiceGst', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->gst_id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Manage ServiceGst', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','ServiceGst') ?> </h1>



<?php $this->widget('zii.widgets.CDetailView', array(

	'data'=>$model,

	'attributes'=>array(

		//'gst_id',

		//'gst_service_id',

		array('label'=>'Floor Name','value'=>$model->gstService->service_description),

		'gst_percent',

		//'branch_id',

	),

)); ?>

