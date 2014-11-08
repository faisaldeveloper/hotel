<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'gst_id'); ?>
		<?php //echo $form->textField($model,'gst_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gst_service_id'); ?>
		<?php echo $form->textField($model,'gst_service_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gst_percent'); ?>
		<?php echo $form->textField($model,'gst_percent'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'branch_id'); ?>
		<?php //echo $form->textField($model,'branch_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->