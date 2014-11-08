<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'sale_person_id'); ?>
		<?php //echo $form->textField($model,'sale_person_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sale_person_name'); ?>
		<?php echo $form->textField($model,'sale_person_name',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sale_person_comm'); ?>
		<?php echo $form->textField($model,'sale_person_comm'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_active'); ?>
		<?php //echo $form->textField($model,'is_active',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->checkBox($model,'is_active',array('value' => 'Yes', 'uncheckValue'=>'No')); ?>
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