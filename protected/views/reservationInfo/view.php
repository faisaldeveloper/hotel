<?php

//$this->breadcrumbs=array(	'Reservation Infos'=>array('index'),	$model->reservation_id,);



/* $this->menu=array(

	//array('label'=>'List ReservationInfo', 'url'=>array('index')),

	array('label'=>'Create ReservationInfo', 'url'=>array('create')),

	array('label'=>'Update ReservationInfo', 'url'=>array('update', 'id'=>$model->reservation_id)),

	array('label'=>'Delete ReservationInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->reservation_id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Manage ReservationInfo', 'url'=>array('admin')),

); */



//this var is defined in framework/web/CCoontroler.php





/* $this->myMenu = "<div align=\"right\">";

$this->myMenu .= "<a href=\"/hotel/ReservationInfo/create\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/add.png\" title=\"Add New Reservation\"  /></a>";

$this->myMenu .= "<a  href=\"/hotel/ReservationInfo/admin\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/manage.png\" title=\"Mangage Reservations\" /></a>";

$this->myMenu .= "</div>"; */

?>

<table class="mytbl" style="background-color:transparent;" width="200" border="0"> 

  <tr>

    <td width="750px"><h1> <?php echo Yii::t('views','View ReservationInfo') ?>- <?php echo ucwords(strtolower($model->client_name)); ?></h1></td>    

    <td><?php echo $this->myMenu;?></td>

  </tr>  

</table>





<?php 

$this->widget('application.components.widgets.XDetailView', array(



	'data'=>$model,

	 'ItemColumns' => 2,

	'attributes'=>array(

		//'reservation_id',

		//'res_type',

		array('label'=>'Res Type ', 'value'  => ($model->res_type=="I")?"Individual":"Group"),

		'group_name',

		'client_name',

		'client_address',

		//'client_country_id',

		array('label'=>'Country ', 'value'=> ucfirst($model->clientCountry->country_name)),

		

		

		'client_mobile',

		'client_phone',

		'client_email',

		'chkin_date',

		//'chkin_time',

		//array('label'=>'Checkin Date', 'value'=> date("F j, Y H:i:s", strtotime($model->chkin_date))),		

		'chkout_date',

		//'client_identity_id',

		array('label'=>'Identity Document', 'value'=> ucfirst($model->clientIdentity->identity_description)),

		

		'client_identity_no',

		//'reservation_status',		

		array('label'=>'Reservtion Status ', 'value'=> ucfirst($model->reservationStatus->res_description)),

		

		//'company_id',

		array('label'=>'Company ', 'value'=> ucfirst($model->company->comp_name)),		

		'to_person',

		'designation',		

		

		//'chkout_time',

		//array('label'=>'Checkout Date', 'value'=> date("F j, Y  H:i:s", strtotime($model->chkout_date))),

		

		//'c_date',

		//'total_days',

		array('label'=>'Total Stay ', 'value'=> $model->total_days.' Nights'),

		

		//'pick_service',

		array('label'=>'Pick Service ', 'value'  => ($model->pick_service=="Y")?"Yes":"No"),

		array('name'=>'flight_name', 'label'=>'Flight ', 'value'=> $model->flights->flight_name),		

		//'flight_name',

		

		'flight_time',

		//'drop_service',

		array('label'=>'Drop Service ', 'value'  => ($model->drop_service=="Y")?"Yes":"No"),

		array('name'=>'drop_flight_name', 'label'=>'Flight ', 'value'=> $model->dropFlights->flight_name),	

		//'drop_flight_name',

			

		'drop_flight_time',

		//'client_salutation_id',

		

		//'cancel_status',

		//'cancel_reason',

		//'cancel_date',

		//array('label'=>'Cancel Date', 'value'=> date("F j, Y H:i:s", strtotime($model->cancel_date))),

		

		

		//'cancel_time',

		//'cancel_by',

		//array('label'=>'Cancel By ', 'value'=> ucfirst($model->user->username)),

		

		//'chkin_status',

		array('label'=>'Checkin Status ', 'value'  => ($model->chkin_status=="Y")?"Yes":"No"),

		//'noshow_status',

		//'client_remarks',

		'room_charges',

		'discount',

		//'gst',

		'advance',

		//'user_id',

		//'sale_person_id',

		//'branch_id',

	),



)); 

?>



