<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'room_type_rate_id'); ?>
		<?php echo $form->textField($model,'room_type_rate_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'room_type_id'); ?>
		<?php echo $form->textField($model,'room_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rate_type_id'); ?>
		<?php echo $form->textField($model,'rate_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'room_rate'); ?>
		<?php echo $form->textField($model,'room_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'room_rate_status'); ?>
		<?php echo $form->textField($model,'room_rate_status',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'room_comments'); ?>
		<?php echo $form->textField($model,'room_comments',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comp_allow_gst'); ?>
		<?php echo $form->textField($model,'comp_allow_gst'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'branch_id'); ?>
		<?php echo $form->textField($model,'branch_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->