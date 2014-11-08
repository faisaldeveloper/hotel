<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->branch_id), array('view', 'id'=>$data->branch_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_address')); ?>:</b>
	<?php echo CHtml::encode($data->branch_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_phone')); ?>:</b>
	<?php echo CHtml::encode($data->branch_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_fax')); ?>:</b>
	<?php echo CHtml::encode($data->branch_fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_email')); ?>:</b>
	<?php echo CHtml::encode($data->branch_email); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('room_limit')); ?>:</b>
	<?php echo CHtml::encode($data->room_limit); ?>
	<br />    

	<b><?php echo CHtml::encode($data->getAttributeLabel('hotel_id')); ?>:</b>
	<?php echo CHtml::encode($data->hotel_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active_date')); ?>:</b>
	<?php echo CHtml::encode($data->active_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('expiry_date')); ?>:</b>
	<?php echo CHtml::encode($data->expiry_date); ?>
	<br />

	*/ ?>

</div>