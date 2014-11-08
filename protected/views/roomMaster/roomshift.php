<?php $hotel_branch_id = yii::app()->user->branch_id; ?>
<h2> <?php echo Yii::t('views','Room Shift') ?>  </h2>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'room-master-form',
	'enableAjaxValidation'=>false,
)); ?>
	
	<?php echo $form->errorSummary($model); ?>	           
	    
    <?php 
	$branch_id = yii::app()->user->branch_id;
		$sql = "select gl.chkin_id, gl.guest_name, rm.mst_room_name from hms_guest_ledger gl
		LEFT JOIN hms_checkin_info ci
		ON ci.chkin_id = gl.chkin_id
		LEFT JOIN hms_room_master rm
		ON ci.room_id = rm.mst_room_id		
		WHERE ci.chkout_status = 'N' Group by gl.chkin_id ORDER BY rm.mst_room_id";
		$result = Yii::app()->db->createCommand($sql)->query();		
			
	?>
    
    <div class="row">
     <span style="margin-left:25px;"> <?php echo Yii::t('views','Select Guest:') ?>  </span>  <select name="RoomMaster_old_room" id="RoomMaster_old_room" >
    <?php 
	foreach ($result as $row ) { 
	echo "<option value='". $row['chkin_id']."'>" . $row['mst_room_name'] ." - ". ucwords(strtolower($row['guest_name'])) ." </option>";	
	}
	?>
    </select>
	</div>
    
    <div class="row">
    <span style="margin-left:25px;">  <?php echo Yii::t('views','Reason') ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>   <input name="RoomMaster_reason" type="text" />
    </div>
	
    <div class="row">
    <?php echo $form->labelEx($model,'New Room'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo $form->dropDownList($model,'mst_room_id', CHtml::listData(RoomMaster::model()->findAll("mst_room_status='V' AND branch_id=$hotel_branch_id"), 'mst_room_id', 'mst_room_name'),array('prompt'=>'Select New Room'));	?>
	<?php echo $form->error($model,'mst_room_id'); ?>    
    </div>
    
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Update' : 'Update'); ?>
	</div>
<?php $this->endWidget(); ?>
</div>
