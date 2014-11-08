<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'guest_id'); ?>
		<?php //echo $form->textField($model,'guest_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guest_salutation_id'); ?>
		<?php //echo $form->textField($model,'guest_salutation_id'); ?>
        <?php echo $form->dropDownList($model,'guest_salutation_id', CHtml::listData(Salutation::model()->findAll(), 'salutation_id', 
		'salutation_name'),array('prompt'=>'Salutation')); 
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guest_name'); ?>
		<?php echo $form->textField($model,'guest_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guest_address'); ?>
		<?php echo $form->textField($model,'guest_address',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guest_phone'); ?>
		<?php echo $form->textField($model,'guest_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guest_country_id'); ?>
		<?php //echo $form->textField($model,'guest_country_id'); ?>
         <?php echo $form->dropDownList($model,'guest_country_id', CHtml::listData(Country::model()->findAll(), 'country_id', 
		'country_name'),array('prompt'=>'Select Country')); 
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guest_mobile'); ?>
		<?php echo $form->textField($model,'guest_mobile'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'guest_identity_id'); ?>
		<?php //echo $form->textField($model,'guest_identity_id'); ?>
        
	</div>

	<div class="row">
		<?php echo $form->label($model,'guest_identity_no'); ?>
		<?php echo $form->textField($model,'guest_identity_no'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'guest_identity_issu'); ?>
		<?php //echo $form->textField($model,'guest_identity_issu'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'guest_identiy_expire'); ?>
		<?php //echo $form->textField($model,'guest_identiy_expire'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'guest_gender'); ?>
		<?php //echo $form->textField($model,'guest_gender',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guest_email'); ?>
		<?php echo $form->textField($model,'guest_email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guest_company_id'); ?>
		<?php //echo $form->textField($model,'guest_company_id'); ?>
        <?php echo $form->dropDownList($model,'guest_company_id', CHtml::listData(Company::model()->findAll(), 'comp_id', 
		'comp_name'),array('prompt'=>'Select Company')); 
		?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'guest_remarks'); ?>
		<?php //echo $form->textField($model,'guest_remarks',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'guest_dob'); ?>
		<?php //echo $form->textField($model,'guest_dob'); ?>
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