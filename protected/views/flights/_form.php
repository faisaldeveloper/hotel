<div class="form">



<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'flights-form',

	'enableAjaxValidation'=>false,

)); ?>



	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary($model); ?>



	<div class="row">

		<?php echo $form->labelEx($model,'flight_name'); ?>

		<?php echo $form->textField($model,'flight_name',array('size'=>20,'maxlength'=>20)); ?>

		<?php echo $form->error($model,'flight_name'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'flight_arrival'); ?>

		<?php echo $form->textField($model,'flight_arrival'); ?>

		<?php echo $form->error($model,'flight_arrival'); ?>

	</div>



	<div class="row">
		<?php //echo $form->labelEx($model,'flight_departure'); ?>
		<?php //echo $form->textField($model,'flight_departure'); ?>
		<?php //echo $form->error($model,'flight_departure'); ?>
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