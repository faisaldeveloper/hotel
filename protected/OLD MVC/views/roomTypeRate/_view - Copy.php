<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_type_rate_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->room_type_rate_id), array('view', 'id'=>$data->room_type_rate_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->room_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->rate_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_rate')); ?>:</b>
	<?php echo CHtml::encode($data->room_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_id')); ?>:</b>
	<?php echo CHtml::encode($data->company_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_rate_status')); ?>:</b>
	<?php echo CHtml::encode($data->room_rate_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_comments')); ?>:</b>
	<?php echo CHtml::encode($data->room_comments); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_allow_gst')); ?>:</b>
	<?php echo CHtml::encode($data->comp_allow_gst); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	*/ ?>

</div>