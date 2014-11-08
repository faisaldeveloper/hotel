<?php
$this->breadcrumbs=array(
	'Room Type Rates'=>array('index'),
	'Manage',
);
$this->menu=array(
	//array('label'=>'List RoomTypeRate', 'url'=>array('index')),
	array('label'=>'Add Rate For Company', 'url'=>array('create')),
	
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('room-type-rate-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1> <?php echo Yii::t('views','Manage Room Type Rates') ?> </h1>
<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button'));*/ ?>
<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div><!-- search-form -->


<?php 
$template ='';
if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}
if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}
//if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}
?>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'room-type-rate-grid',
	'dataProvider'=>$model->admin(),
	'filter'=>$model,
	'columns'=>array(
		//'room_type_rate_id',
		array("header"=>"Sr.","class"=>"IndexColumn"),
		array('name'=>'company_id','value'=>'$data->company->comp_name'),
		//'room_rate',
		//'comp_allow_gst',
		//'room_type_id',
		//'rate_type_id',
		//array('name'=>'room_type_id','value'=>'$data->rateType->rate_name'),
		
		//'company_id',
		
		//'room_rate_status',
		
		//'room_comments',
		//'comp_allow_gst',
		//'branch_id',
		//'user_id',
		
		array(
			'class'=>'CButtonColumn',
			'template'=>$template ,
		),
	),
)); 
?>
