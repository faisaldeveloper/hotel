<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reservation-status-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'res_description'); ?>
		<?php echo $form->textField($model,'res_description',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'res_description'); ?>
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