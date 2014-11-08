<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'guest-status-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'status_description'); ?>
		<?php echo $form->textField($model,'status_description',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'status_description'); ?>
	</div>

	<div class="row">
		<?php $hotel_branch_id = yii::app()->user->branch_id;?>
		<?php //echo $form->labelEx($model,'branch_id'); ?>
		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>
		<?php echo $form->error($model,'branch_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->