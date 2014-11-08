<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'identity_id'); ?>
		<?php //echo $form->textField($model,'identity_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'identity_description'); ?>
		<?php echo $form->textField($model,'identity_description',array('size'=>30,'maxlength'=>30)); ?>
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