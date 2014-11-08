<?php
$hotel_branch_id = yii::app()->user->branch_id;
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'room-master-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php //echo $form->errorSummary($model); 
		 	
	?>
          
	           
	<div class="row">
		<?php echo $form->labelEx($model,'mst_room_name'); ?>
		<?php echo $form->textField($model,'mst_room_name'); ?>
		<?php //echo $form->error($model,'mst_room_name'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'mst_floor_id'); ?>
		<?php //echo $form->textField($model,'mst_floor_id'); ?>
        <?php 
		//$criteria = new CDbCriteria();
		//$criteria->addCondition("branch_id=:branch_id");
		echo $form->dropDownList($model,'mst_floor_id', CHtml::listData(HmsFloor::model()->findAll("branch_id=$hotel_branch_id"), 'floor_id', 
		'description'),array('prompt'=>'Select Floor')); 
		?>
		<?php //echo $form->error($model,'mst_floor_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'mst_roomtypeid'); ?>
		<?php //echo $form->textField($model,'mst_roomtypeid'); ?>
        <?php //echo $form->dropDownList($model,'mst_roomtypeid', CHtml::listData(HmsRoomType::model()->findAll(), 'room_type_id', 
		//'room_name'),array('prompt'=>'Select Room Type')); ?>
       
		<?php echo $form->dropDownList($model,'mst_roomtypeid', CHtml::listData(HmsRoomType::model()->findAll("branch_id=$hotel_branch_id"), 'room_type_id', 
		'room_name'),array('prompt'=>'Select Room Type',
		'ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('hmsRoomType/dynamicPerson'), //url to call.
		//Style: CController::createUrl('currentController/methodToCall')
		//'update'=>'#ExchangeRate_sign', //selector to update //get id method
		'success'=>"function(data){
			var obj=$.parseJSON(data);
			
			$('#RoomMaster_mst_room_adults').val(obj.adults);
			$('#RoomMaster_mst_room_childs').val(obj.childs);
			}",
		//'data'=>'js:javascript statement' 
		//leave out the data key to pass all form values through
		))); 
		?>
		<?php //echo $form->error($model,'mst_roomtypeid'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'mst_room_remarks'); ?>
		<?php echo $form->textField($model,'mst_room_remarks',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'mst_room_remarks'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'mst_room_adults'); ?>
		<?php echo $form->textField($model,'mst_room_adults',array('size'=>'2')); ?>
		<?php //echo $form->error($model,'mst_room_adults'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'mst_room_childs'); ?>
		<?php echo $form->textField($model,'mst_room_childs',array('size'=>'2')); ?>
		<?php //echo $form->error($model,'mst_room_childs'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'mst_room_status'); ?>
		<?php 
		//echo $form->textField($model,'mst_room_status',array('size'=>'2'));
		$rooms = array();
		$rooms['V'] = 'Vacant'; $rooms['D'] = 'Dirty'; $rooms['O'] = 'Occupied'; $rooms['R'] = 'Reserve';
		
		$readonly = "";
		if($model->isNewRecord==false && $model->mst_room_status == "O") $readonly=array('disabled'=>'disabled');
		echo $form->dropDownList($model,'mst_room_status',$rooms, $readonly); ?>
		<?php //echo $form->error($model,'mst_room_status'); ?>
	</div>
	<div class="row">
		<?php $hotel_branch_id = yii::app()->user->branch_id;?>
		<?php //echo $form->labelEx($model,'branch_id'); ?>
		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>
		<?php //echo $form->error($model,'branch_id'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->