<?php
$this->breadcrumbs=array(
	'Room Masters'=>array('index'),
	'Manage',
);
$this->menu=array(
	//array('label'=>'List RoomMaster', 'url'=>array('index')),
	array('label'=>'Create RoomMaster', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('room-master-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Manage Room Master</h1>
<?php 
$template ='';
if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}
if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}
//if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}
?>
<?php 
$room_status_array = array('V'=>'Vacant','O'=>'Occupied','D'=>'Dirty','R'=>'Reserved');
$floor_array = array('1st Floor'=>'1st Floor','2nd Floor'=>'2nd Floor','3rd Floor'=>'3rd Floor','4th Floor'=>'4th Floor');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'room-master-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'mst_room_id',
		array('header'=>'Sr:','class'=>'IndexColumn'),
		'mst_room_name',
		//'mst_floor_id',
		array('name'=>'mst_floor_id','filter'=>$floor_array, 'value'=>'$data->Floor->description'),
		//'mst_roomtypeid',
		array('name'=>'mst_roomtypeid', 'value'=>'$data->Roomtype->room_name'),
		//'mst_room_remarks',
		'mst_room_adults',
		//'mst_room_childs',
		//'mst_room_status',	
		array('name'=>'mst_room_status','filter'=>$room_status_array, 'value'=>'$data->mst_room_status'),	
		//'branch_id',
		
		array(
			'class'=>'CButtonColumn',
			'template'=>$template ,			
						
				'buttons'=>array (
				'update' => array(
					'label'=>'Update',
					//other params
					'visible'=>'$data->mst_room_status!="O"',
				),
				'delete' => array(
					'label'=>'Delete',
					//other params
					'visible'=>'$data->mst_room_status!="O"',
				),),
				
			),
		
	),
)); ?>
