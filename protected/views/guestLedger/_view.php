<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chkin_id')); ?>:</b>
	<?php echo CHtml::encode($data->chkin_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_name')); ?>:</b>
	<?php echo CHtml::encode($data->guest_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_status')); ?>:</b>
	<?php echo CHtml::encode($data->room_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_id')); ?>:</b>
	<?php echo CHtml::encode($data->room_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chkin_date')); ?>:</b>
	<?php echo CHtml::encode($data->chkin_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chkout_date')); ?>:</b>
	<?php echo CHtml::encode($data->chkout_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('c_date')); ?>:</b>
	<?php echo CHtml::encode($data->c_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_time')); ?>:</b>
	<?php echo CHtml::encode($data->c_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_id')); ?>:</b>
	<?php echo CHtml::encode($data->service_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks')); ?>:</b>
	<?php echo CHtml::encode($data->remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('debit')); ?>:</b>
	<?php echo CHtml::encode($data->debit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('credit')); ?>:</b>
	<?php echo CHtml::encode($data->credit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('balance')); ?>:</b>
	<?php echo CHtml::encode($data->balance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cash_paid')); ?>:</b>
	<?php echo CHtml::encode($data->cash_paid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('credit_card')); ?>:</b>
	<?php echo CHtml::encode($data->credit_card); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('credit_card_no')); ?>:</b>
	<?php echo CHtml::encode($data->credit_card_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('btc')); ?>:</b>
	<?php echo CHtml::encode($data->btc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_id')); ?>:</b>
	<?php echo CHtml::encode($data->company_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('late_out')); ?>:</b>
	<?php echo CHtml::encode($data->late_out); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />

	*/ ?>

</div>