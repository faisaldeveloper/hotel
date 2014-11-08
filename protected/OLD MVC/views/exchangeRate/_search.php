<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'excange_rate_id'); ?>
		<?php //echo $form->textField($model,'excange_rate_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_id'); ?>
		<?php //echo $form->textField($model,'country_id'); ?>
         <?php echo $form->dropDownList($model,'country_id', CHtml::listData(Country::model()->findAll(), 'country_id', 
		'country_name'),array('prompt'=>'Select Country')); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'sign'); ?>
		<?php echo $form->textField($model,'sign'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exchabge_rate'); ?>
		<?php echo $form->textField($model,'exchabge_rate'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'branch_id'); ?>
		<?php //echo $form->textField($model,'branch_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'user_id'); ?>
		<?php //echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->