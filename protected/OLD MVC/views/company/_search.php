<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'comp_id'); ?>
		<?php //echo $form->textField($model,'comp_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comp_name'); ?>
		<?php echo $form->textField($model,'comp_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comp_contact_person'); ?>
		<?php echo $form->textField($model,'comp_contact_person',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'person_designation'); ?>
		<?php echo $form->textField($model,'person_designation',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'person_mobile'); ?>
		<?php echo $form->textField($model,'person_mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comp_address'); ?>
		<?php echo $form->textField($model,'comp_address',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comp_phone'); ?>
		<?php echo $form->textField($model,'comp_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comp_fax'); ?>
		<?php echo $form->textField($model,'comp_fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comp_email'); ?>
		<?php echo $form->textField($model,'comp_email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comp_website'); ?>
		<?php echo $form->textField($model,'comp_website',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comp_allow_credit'); ?>
		<?php //echo $form->textField($model,'comp_allow_credit',array('size'=>2,'maxlength'=>2)); ?>
        <?php echo $form->checkBox($model,'comp_allow_credit',array('value' => 'Y', 'uncheckValue'=>'N')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_id'); ?>
		<?php //echo $form->textField($model,'country_id'); ?>
        <?php echo $form->dropDownList($model,'country_id', CHtml::listData(Country::model()->findAll(), 'country_id', 
		'country_name'),array('prompt'=>'Select Country')); 
		?>
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