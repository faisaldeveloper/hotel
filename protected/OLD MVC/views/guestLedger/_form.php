<div class="form">



<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'guest-ledger-form',

	'enableAjaxValidation'=>false,

)); ?>



	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary($model); ?>



	<div class="row">

		<?php echo $form->labelEx($model,'chkin_id'); ?>

		<?php echo $form->textField($model,'chkin_id'); ?>

		<?php echo $form->error($model,'chkin_id'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'guest_name'); ?>

		<?php echo $form->textField($model,'guest_name',array('size'=>30,'maxlength'=>30)); ?>

		<?php echo $form->error($model,'guest_name'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'room_status'); ?>

		<?php echo $form->textField($model,'room_status',array('size'=>2,'maxlength'=>2)); ?>

		<?php echo $form->error($model,'room_status'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'room_id'); ?>

		<?php echo $form->textField($model,'room_id'); ?>

		<?php echo $form->error($model,'room_id'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'chkin_date'); ?>

		<?php echo $form->textField($model,'chkin_date'); ?>

		<?php echo $form->error($model,'chkin_date'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'chkout_date'); ?>

		<?php echo $form->textField($model,'chkout_date'); ?>

		<?php echo $form->error($model,'chkout_date'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'c_date'); ?>

		<?php echo $form->textField($model,'c_date'); ?>

		<?php echo $form->error($model,'c_date'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'c_time'); ?>

		<?php echo $form->textField($model,'c_time'); ?>

		<?php echo $form->error($model,'c_time'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'service_id'); ?>

		<?php echo $form->textField($model,'service_id'); ?>

		<?php echo $form->error($model,'service_id'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'remarks'); ?>

		<?php echo $form->textField($model,'remarks',array('size'=>30,'maxlength'=>30)); ?>

		<?php echo $form->error($model,'remarks'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'debit'); ?>

		<?php echo $form->textField($model,'debit'); ?>

		<?php echo $form->error($model,'debit'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'credit'); ?>

		<?php echo $form->textField($model,'credit'); ?>

		<?php echo $form->error($model,'credit'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'balance'); ?>

		<?php echo $form->textField($model,'balance'); ?>

		<?php echo $form->error($model,'balance'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'cash_paid'); ?>

		<?php echo $form->textField($model,'cash_paid'); ?>

		<?php echo $form->error($model,'cash_paid'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'credit_card'); ?>

		<?php echo $form->textField($model,'credit_card',array('size'=>2,'maxlength'=>2)); ?>

		<?php echo $form->error($model,'credit_card'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'credit_card_no'); ?>

		<?php echo $form->textField($model,'credit_card_no'); ?>

		<?php echo $form->error($model,'credit_card_no'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'btc'); ?>

		<?php echo $form->textField($model,'btc',array('size'=>2,'maxlength'=>2)); ?>

		<?php echo $form->error($model,'btc'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'company_id'); ?>

		<?php echo $form->textField($model,'company_id'); ?>

		<?php echo $form->error($model,'company_id'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'user_id'); ?>

		<?php echo $form->textField($model,'user_id'); ?>

		<?php echo $form->error($model,'user_id'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'late_out'); ?>

		<?php echo $form->textField($model,'late_out',array('size'=>2,'maxlength'=>2)); ?>

		<?php echo $form->error($model,'late_out'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'branch_id'); ?>

		<?php echo $form->textField($model,'branch_id'); ?>

		<?php echo $form->error($model,'branch_id'); ?>

	</div>



	<div class="row buttons">

		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

	</div>



<?php $this->endWidget(); ?>



</div><!-- form -->