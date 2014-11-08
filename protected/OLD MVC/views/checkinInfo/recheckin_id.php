<?php
$template ='';
if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}
if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}
//if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'checkin-info-grid',
	'dataProvider'=>$model->search2(),
	'filter'=>$model,
	'columns'=>array(
		//'chkin_id',
		array('header'=>'Sr:','class'=>'IndexColumn'),		
		 array(
			'header' => 'Folio',
			'class' => 'CButtonColumn',
			'template'=>'{Folio}',
			'buttons'=>array(
				'Folio' => array(
					'label'=>'Folio',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/calculator.gif',
					'url'=>'Yii::app()->baseUrl."/GuestLedger/admin/$data->chkin_id"',
					'options'=>array('title'=>'Folio'),
					//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
					),				
				),//end buttons
			),//end Actions 		
		
		//'guest_id',		
		array('name'=>'guest_id', 'value'=>'ucwords($data->guest->guest_name)'),		
		//'guest_company_id',
		array('name'=>'guest_company_id', 'value'=>'$data->company->comp_name'),				
		//'room_name',
		array('name'=>'room_name', 'value'=>'$data->room->mst_room_name'),		
		//'room_type',
		array('name'=>'room_type', 'value'=>'$data->roomtype->room_name'),	
		//'reservation_id',
		//'chkin_date',
		array('name'=>'chkin_date', 'value'=>'date("d/m/y",strtotime($data->chkin_date))'),
		
		//'chkout_date',
		array('name'=>'chkout_date', 'value'=>'date("d/m/y",strtotime($data->chkout_date))'),
				
		array(
			'header' => 'Reg Card',
			'class' => 'CButtonColumn',
			'template'=>'{regcard}',
			'buttons'=>array(
				'regcard' => array
					(
					'label'=>'Reg Card',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/regcard.png',
					'url'=>'Yii::app()->baseUrl."/CheckinInfo/viewRegCard/$data->chkin_id"',
					'options'=>array('title'=>'View Registration Card', 'target'=>'_blank'),
					//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
					),				
				),//end buttons
			),//end Actions		
		array(
			'class'=>'CButtonColumn',
			'template'=>$template ,		
				
			'buttons'=>array(			
			// view Record
			'update' => array(
			
			'url'=>'Yii::app()->baseUrl."/CheckinInfo/rechkin/$data->chkin_id"',
          	),
			), //end button array			
		),
	),
));
?>