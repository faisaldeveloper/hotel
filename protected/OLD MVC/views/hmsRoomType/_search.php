<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'room_type_id'); ?>
		<?php //echo $form->textField($model,'room_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'room_name'); ?>
		<?php echo $form->textField($model,'room_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adults'); ?>
		<?php echo $form->textField($model,'adults'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'childs'); ?>
		<?php echo $form->textField($model,'childs'); ?>
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