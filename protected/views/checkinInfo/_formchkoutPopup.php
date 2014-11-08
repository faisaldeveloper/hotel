<div class="form">
<?php 
$this->widget('ext.EChosen.EChosen');
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'guest-ledger-form',
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note"><span class="required"><b>Bill Payment for Folio No:  <?php echo $model->chkin_id; ?> </b></span></p>
	<?php echo $form->errorSummary($model); ?>
	
		<?php echo $form->hiddenField($model,'chkin_id'); ?>		
		<?php echo $form->hiddenField($model,'guest_name',array('size'=>30,'maxlength'=>30)); ?>		
		<?php echo $form->hiddenField($model,'room_status',array('size'=>2,'maxlength'=>2,'value'=>'O')); ?>		
		<?php echo $form->hiddenField($model,'room_id'); ?>		
		<?php echo $form->hiddenField($model,'chkin_date'); ?>		
		<?php echo $form->hiddenField($model,'chkout_date'); ?>		
		<?php echo $form->hiddenField($model,'c_date',array('value'=>date('Y-m-d H:i:s'))); ?>		
		<?php echo $form->hiddenField($model,'c_time',array('value'=>date('H:m a'))); ?>
		
	<div class="row">
		<?php //echo $form->labelEx($model,'service_id'); ?>
        <?php 
		echo $form->hiddenField($model,'service_id',array('value'=> 48)); //48 is service id in services table
		?>			
         <?php $branch_id = yii::app()->user->branch_id; ?>
	</div>
	
    <div class="row">        
        <?php 
		$comp_id = Yii::app()->db->createCommand()->select('comp_id')->from('hms_company_info')->where("comp_name like 'walk%'")->queryScalar();
		
		
		if($model->company_id==1) $payment_types = array('0'=>'Cash','1'=>'Debit Card','2'=>'Credit Card'); 
		else $payment_types = array('0'=>'Cash','1'=>'Debit Card','2'=>'Credit Card', '3'=>'BTC'); 		
		?>		
        <?php echo $form->labelEx($model,'Pay Mode'); ?>	
		<?php echo $form->dropDownList($model, 'btc', $payment_types);?>		
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'debit'); ?>
		<?php echo $form->textField($model,'debit'); ?>
		<?php echo $form->error($model,'debit'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textField($model,'remarks',array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'remarks'); ?>
	</div>
	
		<?php echo $form->hiddenField($model,'credit',array('value'=>'0')); ?>		
		<?php echo $form->hiddenField($model,'balance',array('value'=>'0')); ?>		
		<?php echo $form->hiddenField($model,'cash_paid',array('value'=>'0')); ?>		
		<?php echo $form->hiddenField($model,'credit_card',array('size'=>2,'maxlength'=>2,'value'=>'0')); ?>		
		<?php echo $form->hiddenField($model,'credit_card_no',array('value'=>'0')); ?>
		<?php echo $form->hiddenField($model,'company_id'); ?>	
		<?php $user_id = yii::app()->user->id;?>		
        <?php echo $form->hiddenField($model,'user_id',array('value'=>$user_id)); ?>	
		<?php $hotel_branch_id = yii::app()->user->branch_id;?>		
		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>
		
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? ' OK ' : ' OK '); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->