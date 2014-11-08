<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chkin_id'); ?>
		<?php echo $form->textField($model,'chkin_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guest_name'); ?>
		<?php echo $form->textField($model,'guest_name',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'room_status'); ?>
		<?php echo $form->textField($model,'room_status',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'room_id'); ?>
		<?php echo $form->textField($model,'room_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chkin_date'); ?>
		<?php echo $form->textField($model,'chkin_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chkout_date'); ?>
		<?php echo $form->textField($model,'chkout_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_date'); ?>
		<?php echo $form->textField($model,'c_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_time'); ?>
		<?php echo $form->textField($model,'c_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'service_id'); ?>
		<?php echo $form->textField($model,'service_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remarks'); ?>
		<?php echo $form->textField($model,'remarks',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'debit'); ?>
		<?php echo $form->textField($model,'debit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'credit'); ?>
		<?php echo $form->textField($model,'credit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'balance'); ?>
		<?php echo $form->textField($model,'balance'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cash_paid'); ?>
		<?php echo $form->textField($model,'cash_paid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'credit_card'); ?>
		<?php echo $form->textField($model,'credit_card',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'credit_card_no'); ?>
		<?php echo $form->textField($model,'credit_card_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'btc'); ?>
		<?php echo $form->textField($model,'btc',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'late_out'); ?>
		<?php echo $form->textField($model,'late_out',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'branch_id'); ?>
		<?php echo $form->textField($model,'branch_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->