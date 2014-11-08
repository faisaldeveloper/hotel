<div class="form">



<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'hms-room-type-form',

	'enableAjaxValidation'=>false,

		/*'enableClientValidation'=>true,

	'clientOptions'=>array(

		'validateOnSubmit'=>true,),*/

)); ?>



	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary($model); ?>



	<div class="row">

		<?php echo $form->labelEx($model,'room_name'); ?>

		<?php echo $form->textField($model,'room_name',array('size'=>50,'maxlength'=>50)); ?>

		<?php echo $form->error($model,'room_name'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'adults'); ?>

		<?php echo $form->textField($model,'adults'); ?>

		<?php echo $form->error($model,'adults'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'childs'); ?>

		<?php echo $form->textField($model,'childs'); ?>

		<?php echo $form->error($model,'childs'); ?>

	</div>

	

	<div class="row">

		<?php echo $form->labelEx($model,'room_rate'); ?>

		<?php echo $form->textField($model,'room_rate'); ?>

		<?php echo $form->error($model,'room_rate'); ?>

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