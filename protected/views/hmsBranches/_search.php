<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'branch_id'); ?>
		<?php //echo $form->textField($model,'branch_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'branch_address'); ?>
		<?php echo $form->textField($model,'branch_address',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'branch_phone'); ?>
		<?php echo $form->textField($model,'branch_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'branch_fax'); ?>
		<?php echo $form->textField($model,'branch_fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'branch_email'); ?>
		<?php echo $form->textField($model,'branch_email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hotel_id'); ?>
		<?php echo $form->textField($model,'hotel_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'active_date'); ?>
		<?php echo $form->textField($model,'active_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expiry_date'); ?>
		<?php echo $form->textField($model,'expiry_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->