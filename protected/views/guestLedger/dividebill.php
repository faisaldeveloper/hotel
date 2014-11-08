<?php

$this->breadcrumbs=array('Guest Ledgers',);



$this->menu=array(

	array('label'=>'Create GuestLedger', 'url'=>array('create')),

	array('label'=>'Manage GuestLedger', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Guest Ledgers Divide Bill') ?></h1>



<?php  



$sql = "select ci.rate, gi.guest_name from hms_checkin_info ci LEFT JOIN hms_guest_info gi ON ci.guest_id = gi.guest_id where chkin_id = ". $model->chkin_id;

$res = Yii::app()->db->createCommand($sql)->query();

foreach($res as $row){

$rate = $row['rate'];

$guest_name = $row['guest_name'];	

}

echo " Guest Name : ". $guest_name. " Room Rate Applied = ". $rate;





$roomrate1 =0; $roomrate2=0;

$sql = "select count(id) from hms_guest_ledger where debit!= $rate AND service_id =".$model->service_id. " and chkin_id = ". $model->chkin_id;

$total_rows = Yii::app()->db->createCommand($sql)->queryScalar();



if($total_rows > 0){

	$sql = "select distinct debit from hms_guest_ledger where service_id =".$model->service_id. " and chkin_id = ". $model->chkin_id;	

	$res_rows = Yii::app()->db->createCommand($sql)->queryAll();

	$i=0; 

	foreach($res_rows as $row) {

		if($i==0) $roomrate1 = $row[debit];

		else $roomrate2 = $row[debit];

		$i++;

	}	

}







?>



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'guest-ledger-form',

	'enableAjaxValidation'=>false,

)); ?>





	<div class="row">

		<?php echo $form->labelEx($model,'debit'); ?>

		<?php echo $form->textField($model,'debit', array ('value'=>$rate)); ?>

		<?php echo $form->error($model,'debit'); ?>

	</div>

    

    <div class="row">

		<?php echo $form->labelEx($model,'room_rent1'); ?>

		<?php echo $form->textField($model,'room_rent1', array('value'=>$roomrate1, 'onBlur'=>'updateRent2()')); ?>

		<?php echo $form->error($model,'room_rent1'); ?>

	</div>

    

    <div class="row">

		<?php echo $form->labelEx($model,'room_rent2'); ?>

		<?php echo $form->textField($model,'room_rent2', array ('value'=>$roomrate2)); ?>

		<?php echo $form->error($model,'room_rent2'); ?>

	</div>

    

    

    

    <?php 

		echo $form->hiddenField($model,'chkin_id');

		echo $form->hiddenField($model,'guest_name');

		echo $form->hiddenField($model,'room_status');

		

		echo $form->hiddenField($model,'room_id');

		echo $form->hiddenField($model,'chkin_date');

		echo $form->hiddenField($model,'chkout_date');

		echo $form->hiddenField($model,'c_date');

		echo $form->hiddenField($model,'c_time');

		echo $form->hiddenField($model,'service_id');

		echo $form->hiddenField($model,'remarks');

		echo $form->hiddenField($model,'credit');

		echo $form->hiddenField($model,'balance');

		echo $form->hiddenField($model,'cash_paid');

		echo $form->hiddenField($model,'credit_card');

		echo $form->hiddenField($model,'credit_card_no');

		echo $form->hiddenField($model,'btc');

		echo $form->hiddenField($model,'company_id');

		echo $form->hiddenField($model,'user_id');

		echo $form->hiddenField($model,'late_out');

		echo $form->hiddenField($model,'branch_id');

		

		

		

	?>

		    

    

<div class="row buttons">

		<?php echo CHtml::submitButton($model->isNewRecord ? 'Change Rent' : 'Save'); ?>

	</div>

	

<?php $this->endWidget(); ?>

</div><!-- form -->



<script>

function updateRent2(){	

	var rent1 = document.getElementById('GuestLedger_room_rent1').value; 

	var total_rent = document.getElementById('GuestLedger_debit').value; 

	//alert(rent1+'----'+total_rent);

	if(rent1 < total_rent){	

	document.getElementById('GuestLedger_room_rent2').value = total_rent - rent1;	

	}else {

		document.getElementById('GuestLedger_room_rent2').value = 0;

		document.getElementById('GuestLedger_room_rent1').value = total_rent;

	}

}

</script>