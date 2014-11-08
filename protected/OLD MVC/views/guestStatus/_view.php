<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_status_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->guest_status_id), array('view', 'id'=>$data->guest_status_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_description')); ?>:</b>
	<?php echo CHtml::encode($data->status_description); ?>
	<br />

	<!--<b><?php //echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php //echo CHtml::encode($data->branch_id); ?>
	<br />-->


</div>