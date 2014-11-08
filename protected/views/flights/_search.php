<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'flight_id'); ?>
		<?php //echo $form->textField($model,'flight_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight_name'); ?>
		<?php echo $form->textField($model,'flight_name',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight_arrival'); ?>
		<?php echo $form->textField($model,'flight_arrival'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight_departure'); ?>
		<?php echo $form->textField($model,'flight_departure'); ?>
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