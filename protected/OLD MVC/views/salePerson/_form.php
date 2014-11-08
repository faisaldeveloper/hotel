<div class="form">



<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'sale-person-form',

	'enableAjaxValidation'=>false,

)); ?>



	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary($model); ?>



	<div class="row">

		<?php echo $form->labelEx($model,'sale_person_name'); ?>

		<?php echo $form->textField($model,'sale_person_name',array('size'=>30,'maxlength'=>30)); ?>

		<?php echo $form->error($model,'sale_person_name'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'sale_person_comm'); ?>

		<?php echo $form->textField($model,'sale_person_comm'); ?>

		<?php echo $form->error($model,'sale_person_comm'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'is_active'); ?>

		<?php echo $form->checkBox($model,'is_active',array('value' => 'Yes', 'uncheckValue'=>'No')); ?>

		<?php echo $form->error($model,'is_active'); ?>

	</div>



	<div class="row">

		<?php $hotel_branch_id = yii::app()->user->branch_id;?>

		<?php //echo $form->labelEx($model,'branch_id'); ?>

		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>

		<?php echo $form->error($model,'branch_id'); ?>

	</div>



	<div class="row buttons">

		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

	</div>



<?php $this->endWidget(); ?>



</div><!-- form -->