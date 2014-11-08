<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'service_id'); ?>
		<?php //echo $form->textField($model,'service_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'service_description'); ?>
		<?php echo $form->textField($model,'service_description',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'servise_type'); ?>
		<?php //echo $form->textField($model,'servise_type'); ?>
        
	</div>

	<div class="row">
		<?php echo $form->label($model,'service_rate'); ?>
		<?php echo $form->textField($model,'service_rate'); ?>
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