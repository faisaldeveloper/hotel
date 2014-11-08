<?php
$hotel_branch_id = yii::app()->user->branch_id;


?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'room-master-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields-s with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->hiddenField($model,'mst_floor_id', array('value'=>$model->mst_floor_id)); ?>
	<?php echo $form->hiddenField($model,'mst_roomtypeid', array('value'=>$model->mst_roomtypeid)); ?>
    <?php echo $form->hiddenField($model,'mst_room_remarks', array('value'=>$model->mst_room_remarks)); ?>
    <?php echo $form->hiddenField($model,'mst_room_adults', array('value'=>$model->mst_room_adults)); ?>	           

	<div class="row">
		<?php echo $form->labelEx($model,'mst_room_name'); ?>
		<?php echo $form->textField($model,'mst_room_name', array('readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'mst_room_name'); ?>
	</div>	
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'mst_room_status'); ?>
		<?php 
		//echo $form->textField($model,'mst_room_status',array('size'=>'2'));
		$rooms = array();
		$rooms['V'] = 'Vacant'; $rooms['D'] = 'Dirty';
		echo $form->dropDownList($model,'mst_room_status',$rooms); ?>
		<?php echo $form->error($model,'mst_room_status'); ?>
	</div>

	<div class="row">
		<?php $hotel_branch_id = yii::app()->user->branch_id;?>		
		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>		
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->