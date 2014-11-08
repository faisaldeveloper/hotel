
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'checkin-info-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Auto Night Posting</p>

	<?php //echo $form->errorSummary($model,$guest_info); ?>


<div class="row">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Process Night Posting' : 'Save'); ?>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
