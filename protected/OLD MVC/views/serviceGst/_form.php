<div class="form">



<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'service-gst-form',

	'enableAjaxValidation'=>false,

)); ?>



	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary($model); ?>



	<div class="row">

		<?php //echo $form->labelEx($model,'gst_service_id'); ?>

		<?php //echo $form->textField($model,'gst_service_id'); 

		echo $form->hiddenField($model,'gst_service_id',array('value'=>1));

		?>

		<?php //echo $form->error($model,'gst_service_id'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'gst_percent'); ?>

		<?php echo $form->textField($model,'gst_percent'); ?>

		<?php echo $form->error($model,'gst_percent'); ?>

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