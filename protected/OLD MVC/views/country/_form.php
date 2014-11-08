<div class="form">



<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'country-form',

	'enableAjaxValidation'=>false,

)); ?>



	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary($model); ?>



	<div class="row">

		<?php echo $form->labelEx($model,'country_name'); ?>

		<?php echo $form->textField($model,'country_name',array('size'=>50,'maxlength'=>50)); ?>

		<?php echo $form->error($model,'country_name'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'country_currancy'); ?>

		<?php echo $form->textField($model,'country_currancy',array('size'=>50,'maxlength'=>50)); ?>

		<?php echo $form->error($model,'country_currancy'); ?>

	</div>

    

    	<div class="row">

		<?php echo $form->labelEx($model,'currancy_sign'); ?>

		<?php echo $form->textField($model,'currancy_sign',array('size'=>50,'maxlength'=>10)); ?>

		<?php echo $form->error($model,'currancy_sign'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'country_code'); ?>

		<?php echo $form->textField($model,'country_code'); ?>

		<?php echo $form->error($model,'country_code'); ?>

	</div>

    

   



	<div class="row buttons">

		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

	</div>



<?php $this->endWidget(); ?>



</div><!-- form -->