<?php

$this->breadcrumbs=array('Checkin Infos'=>array('index'),$model->chkin_id,);



?>

<table class="mytbl" style="background-color:transparent;" width="200" border="0">

  <tr>

    <td width="750px"><h1> <?php echo Yii::t('views','') ?> <?php echo ucwords(strtolower($model->guest->guest_name)); ?></h1></td>    

    <td><?php echo $this->myMenu;?></td>

  </tr>  

</table>





<?php 

$this->widget('application.components.widgets.XDetailView', array(



	'data'=>$model,

	 'ItemColumns' => 2,

	'attributes'=>array(

		//'chkin_id',

		//'guest_id',

	array('label'=>'Guest Name', 'value'=> ucwords($model->guest->guest_name)),	

		'reservation_id',

	array('label'=>'Mobile', 'value'=> ucwords($model->guest->guest_mobile)),

	array('label'=>'Phone', 'value'=> ucwords($model->guest->guest_phone)),

	array('label'=>'Address', 'value'=> ucwords($model->guest->guest_address)),

	array('label'=>'Email', 'value'=>$model->guest->guest_email),

	

		//'chkin_date',

	array('label'=>'Checkin Date', 'value'=> date("F j, Y H:i:s", strtotime($model->chkin_date))),

		//'chkout_date',

	array('label'=>'Checkout Date', 'value'=> date("F j, Y H:i:s", strtotime($model->chkout_date))),

		

		//'chkin_time',

		//'chkout_time',

		//'drop_service',

		array('label'=>'Drop Service ', 'value'  => ($model->drop_service=="Y")?"Yes":"No"),

		 



		//'flight_name',

		array('label'=>'Flight ', 'value'=> $model->flight->flight_name),		

		'flight_time',

		//'total_days',

		array('label'=>'Total Stay ', 'value'=> $model->total_days.' Nights'),		

		//'room_id',		

		//'room_type', //room type is not defined as fk, so following code is not working

		array('label'=>'Room Type ', 'value'=> ucfirst($model->roomtype->room_name)),	

		

		//array('label'=>'Room Type', 'value'=> ucfirst($model->roomtype->room_name)),

		//'room_name',

		array('label'=>'Room # ', 'value'=> ucfirst($model->room->mst_room_name)),		

		//'guest_company_id',

		array('label'=>'Company ', 'value'=> ucfirst($model->company->comp_name)),		

		//'rate_type',

		'total_person',

		//'total_charges',

		'amount_paid',

		//'chkout_status',

		array('label'=>'Checkout Status ', 'value'  => ($model->chkout_status=="Y")?"Yes":"No"),

		

		

		//'chkin_user_id',

		//'chkout_user_id',

		//'guest_status_id',

		

		

		'chkin_id',

		//'sale_person_id',

		array('label'=>'Sale Person ', 'value'=> ucfirst($model->salePerson->sale_person_name)),

		

		//'comming_from',

		array('name'=>'comming_from','value'=>ucwords($model->comming_from)),

		//'next_destination',

		array('name'=>'next_destination','value'=>ucwords($model->next_destination)),

		

		'newspaper_id',

		'rate',

		//'gst',

		array('label'=>'GST ', 'value'  => ($model->gst=="Y")?"Yes":"No"),

		//'bed_tax',

		array('label'=>'Bed Tax ', 'value'  => ($model->bed_tax=="Y")?"Yes":"No"),

		//'branch_id',

	),



)); 

?>

