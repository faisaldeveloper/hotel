<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_type_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->room_type_id), array('view', 'id'=>$data->room_type_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_name')); ?>:</b>
	<?php echo CHtml::encode($data->room_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adults')); ?>:</b>
	<?php echo CHtml::encode($data->adults); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_rate')); ?>:</b>
	<?php echo CHtml::encode($data->room_rate); ?>
	<br />

	
	
	<!--<b><?php //echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php //echo CHtml::encode($data->branch_id); ?>
	<br />-->


</div>