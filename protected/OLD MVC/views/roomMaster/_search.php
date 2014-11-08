<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'mst_room_id'); ?>
		<?php //echo $form->textField($model,'mst_room_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mst_room_name'); ?>
		<?php echo $form->textField($model,'mst_room_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mst_floor_id'); ?>
		<?php //echo $form->textField($model,'mst_floor_id'); ?>
         <?php echo $form->dropDownList($model,'mst_roomtypeid', CHtml::listData(HmsRoomType::model()->findAll(), 'room_type_id', 
		'room_name'),array('prompt'=>'Select Room Type')); 
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mst_roomtypeid'); ?>
		<?php //echo $form->textField($model,'mst_roomtypeid'); ?>
        <?php echo $form->dropDownList($model,'mst_floor_id', CHtml::listData(HmsFloor::model()->findAll(), 'floor_id', 
		'description'),array('prompt'=>'Select Floor')); 
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mst_room_remarks'); ?>
		<?php echo $form->textField($model,'mst_room_remarks',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mst_room_adults'); ?>
		<?php echo $form->textField($model,'mst_room_adults'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mst_room_childs'); ?>
		<?php echo $form->textField($model,'mst_room_childs'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'mst_room_status'); ?>
		<?php //echo $form->textField($model,'mst_room_status',array('size'=>2,'maxlength'=>2)); ?>
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