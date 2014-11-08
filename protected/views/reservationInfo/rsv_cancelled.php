<?php

$this->breadcrumbs=array(

	'Reservation Infos'=>array('index'),

	'Cancelled',

);



$this->menu=array(

	//array('label'=>'List ReservationInfo', 'url'=>array('index')),

	array('label'=>'Create ReservationInfo', 'url'=>array('create')),

);



Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){

	$('.search-form').toggle();

	return false;

});

$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('reservation-info-grid', {

		data: $(this).serialize()

	});

	return false;

});

");

?>



<h1> <?php echo Yii::t('views','Manage Reservation Infos') ?> </h1>





<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">

<?php $this->renderPartial('_search',array(

	'model'=>$model,

)); ?>

</div><!-- search-form -->



<?php 

	$icons ="{pdf}";

	$this->widget('zii.widgets.grid.CGridView', array(

	'id'=>'reservation-info-grid',

	'dataProvider'=>$model->res_search(),

	'filter'=>$model,

	'columns'=>array(

		array('header'=>'Sr:','class'=>'IndexColumn'),

		//'company_id',

		array('name'=>'company_id', 'value'=>'$data->company->comp_name'),

		'res_type',

		'group_name',

		//'client_name',

		array('name'=>'client_name', 'value'=>'ucwords($data->client_name)'),

		

		'client_mobile',

		'reservation_id',

		/*'to_person',

		'designation',

		

		'chkin_date',

		'chkin_time',

		'chkout_date',

		'chkout_time',

		'c_date',

		'total_days',

		'pick_service',

		'flight_name',

		'flight_time',

		'drop_service',

		'drop_flight_name',

		'drop_flight_time',

		'client_salutation_id',

		

		'client_address',

		'client_country_id',

		

		'client_phone',

		'client_email',

		'client_identity_id',

		'client_identity_no',

		'reservation_status',

		'cancel_status',

		'cancel_date',

		'cancel_reason',

		'cancel_time',

		'cancel_by',

		'chkin_status',

		'noshow_status',

		'client_remarks',

		'room_charges',

		'discount',

		'gst',

		'advance',

		'user_id',

		'sale_person_id',

		'branch_id',

		*/

		array(

			'header' => 'Actions',

			'class' => 'CButtonColumn',

			'template'=>$icons,

			'buttons'=>array

			(

				'pdf' => array

				(

				'label'=>'Check-In',

				'imageUrl'=>Yii::app()->request->baseUrl.'/images/chkin.jpg',

				'url'=>'Yii::app()->baseUrl."/checkinInfo/create/$data->reservation_id"',

				'options'=>array('title'=>'Check-In'),

				//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',

				),

			

			/*'view' => array

			(

			'label'=>'view',

			//'imageUrl'=>Yii::app()->request->baseUrl.'/images/pdf.jpg',

			//'url'=>'Yii::app()->baseUrl."/clientDocs/view/$data->id"',

			'options'=>array('title'=>'view','target'=>'_blank'),

			//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',

			),

			

			'update' => array

			(

			'label'=>'update',

			//'imageUrl'=>Yii::app()->request->baseUrl.'/images/pdf.jpg',

			//'url'=>'Yii::app()->baseUrl."/clientDocs/update/$data->id"',

			'options'=>array('title'=>'update','target'=>'_blank'),

			//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',

			),

			

			'delete' => array

			(

			'label'=>'delete',

			//'imageUrl'=>Yii::app()->request->baseUrl.'/images/pdf.jpg',

			//'url'=>'Yii::app()->baseUrl."/clientDocs/delete/$data->id"',

			'options'=>array('title'=>'delete','target'=>'_blank'),

			//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',

			),*/

			

			),//end buttons

			),//end Actions

	),

)); ?>

