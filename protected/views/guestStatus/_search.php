<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'guest_status_id'); ?>
		<?php //echo $form->textField($model,'guest_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_description'); ?>
		<?php echo $form->textField($model,'status_description',array('size'=>50,'maxlength'=>50)); ?>
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