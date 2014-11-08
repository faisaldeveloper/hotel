<div class="form">

<?php 
$this->widget('ext.EChosen.EChosen');

$hotel_branch_id = yii::app()->user->branch_id;
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'guest-ledger-form',
	'enableAjaxValidation'=>false,
)); ?>



<?php 
		$room_id = $model->room_id;
		if($room_id >0)
		$room_name = RoomMaster::model()->find("mst_room_id = $room_id")->mst_room_name;
		?>

         <p class="note">Room No: <?php echo  $room_name; ?>.</p>


 <!-- <?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
-->
	<?php echo $form->errorSummary($model); ?>
		<?php echo $form->hiddenField($model,'chkin_id'); ?>		
		<?php echo $form->hiddenField($model,'guest_name',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->hiddenField($model,'room_status',array('size'=>2,'maxlength'=>2,'value'=>'O')); ?>
		<?php echo $form->hiddenField($model,'room_id'); ?>		
		<?php echo $form->hiddenField($model,'chkin_date'); ?>		
		<?php echo $form->hiddenField($model,'chkout_date'); ?>	
		<?php echo $form->hiddenField($model,'c_date',array('value'=>date('Y-m-d H:i:s'))); ?>
		<?php echo $form->hiddenField($model,'c_time',array('value'=>date('H:m a'))); ?>

	<table width="472" border="1">

  <tr>
    <td width="113">&nbsp;<?php echo $form->labelEx($model,'service_id'); ?></td>
    <td width="275">&nbsp; <?php 		
		/*  if($model->room_id==0){
		 echo $form->dropDownList($model,'service_id', CHtml::listData(Services::model()->findAll("service_description LIKE 'Cash'"), 'service_id', 'service_description'),
		array('prompt'=>'Select Service','onchange'=>'document.getElementById("GuestLedger_service_code").value=this.value')//,'class'=>'chzn-select'
		  ); 
		 }

		 else{ */
		 echo $form->dropDownList($model,'service_id', CHtml::listData(Services::model()->findAll(array('order'=>'service_description')), 'service_id', 'service_description'),
		 array('prompt'=>'Select Service','onchange'=>'document.getElementById("GuestLedger_service_code").value=this.value')//,'class'=>'chzn-select'
		 ); 
		// }			 

		?> </td>

    <td width="62">&nbsp;<?php $form->error($model,'service_id'); ?></td>
  </tr>  

   <tr>
    <td>&nbsp;<?php echo $form->labelEx($model,'OR Enter Code:'); ?></td>
    <td>&nbsp;<input id="GuestLedger_service_code" size="9" type="text" name="GuestLedger[service_code]" placeholder="service code" onchange="document.getElementById('GuestLedger_service_id').value=this.value;"

    onblur="document.getElementById('GuestLedger_service_id').value=this.value;" /></td>
    <td>&nbsp;<?php //echo $form->error($model,'debit'); ?></td>
  </tr>  

  <tr>
    <td>&nbsp;<?php echo $form->labelEx($model,'debit'); ?></td>
    <td>&nbsp;<?php echo $form->textField($model,'debit', array('size'=>'15')); ?></td>
    <td>&nbsp;<?php $form->error($model,'debit'); ?></td>
  </tr> 

  <tr>
    <td>&nbsp;<?php echo $form->labelEx($model,'remarks'); ?></td>
    <td>&nbsp;<?php echo $form->textField($model,'remarks',array('size'=>15,'maxlength'=>30)); ?></td>
    <td>&nbsp;<?php $form->error($model,'remarks'); ?></td>
  </tr>  
  
  <?php if($model->room_id==0){ // this is for cash entry ?>  
  <tr>
    <td>&nbsp;<?php echo $form->labelEx($model,'btc'); ?></td>
    <td>&nbsp;<?php 
	$mop = array('0'=>'Cash', '1'=>'Debit Card','2'=>'Credit Card', '3'=>'BTC');
	
	echo $form->dropDownList($model,'btc',$mop, array(
			'onchange' => 'CompanySelectlist(this)',
	));
	
	?>
    <span id="room_loader" style="display:none"><img src="/hotel/images/processing.gif" alt="pro" /> </span>
    </td>
    <td>&nbsp;<?php $form->error($model,'btc'); ?></td>
  </tr>
  
  
   <tr>
    <td>&nbsp;<div  id="company_lbl" style="display:none;"> <?php echo $form->labelEx($model,'company_id'); ?></div></td>
    <td>&nbsp;<div  id="company_name" style="display:none;"> <?php 
	$con = array("condition"=>"branch_id=$hotel_branch_id", "order"=>"comp_name");
	  $var ="";
	  //if(empty($model->company_id)){$var = array('options' => array('1'=>array('selected'=>true)));}	 
	  echo $form->dropDownList($model,'company_id', CHtml::listData(Company::model()->findAll($con), 'comp_id','comp_name'), $var);
	?></div></td>
    <td>&nbsp;<?php $form->error($model,'company_id'); ?></td>
    </tr>
    
     
  
  <?php } ?>  

</table>

		<?php echo $form->hiddenField($model,'credit',array('value'=>'0')); ?>	
		<?php echo $form->hiddenField($model,'balance',array('value'=>'0')); ?>
		<?php echo $form->hiddenField($model,'cash_paid',array('value'=>'0')); ?>
		<?php echo $form->hiddenField($model,'credit_card',array('size'=>2,'maxlength'=>2,'value'=>'0')); ?>	
		<?php echo $form->hiddenField($model,'credit_card_no',array('value'=>'0')); ?>		
		<?php //echo $form->hiddenField($model,'btc',array('size'=>2,'maxlength'=>2,'value'=>'0')); ?>
		<?php //echo $form->hiddenField($model,'company_id'); ?>		

<div class="row">

		<?php $user_id = yii::app()->user->id;?>	
        <?php echo $form->hiddenField($model,'user_id',array('value'=>$user_id)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php $hotel_branch_id = yii::app()->user->branch_id;?>		
		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>
		<?php echo $form->error($model,'branch_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Add Service' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<script>
function CompanySelectlist(a){
	if(a.value == 3){
		document.getElementById('company_lbl').style.display = 'block';
		document.getElementById('company_name').style.display = 'block';
	}else { 
		document.getElementById('company_lbl').style.display = 'none';
		document.getElementById('company_name').style.display = 'none';
	}
}
</script>