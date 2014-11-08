<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('reservation_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->reservation_id), array('view', 'id'=>$data->reservation_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('res_type')); ?>:</b>
	<?php echo CHtml::encode($data->res_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('group_name')); ?>:</b>
	<?php echo CHtml::encode($data->group_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_id')); ?>:</b>
	<?php echo CHtml::encode($data->company_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('to_person')); ?>:</b>
	<?php echo CHtml::encode($data->to_person); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('designation')); ?>:</b>
	<?php echo CHtml::encode($data->designation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chkin_date')); ?>:</b>
	<?php echo CHtml::encode($data->chkin_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('chkin_time')); ?>:</b>
	<?php echo CHtml::encode($data->chkin_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chkout_date')); ?>:</b>
	<?php echo CHtml::encode($data->chkout_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chkout_time')); ?>:</b>
	<?php echo CHtml::encode($data->chkout_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_date')); ?>:</b>
	<?php echo CHtml::encode($data->c_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_days')); ?>:</b>
	<?php echo CHtml::encode($data->total_days); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pick_service')); ?>:</b>
	<?php echo CHtml::encode($data->pick_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_name')); ?>:</b>
	<?php echo CHtml::encode($data->flight_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_time')); ?>:</b>
	<?php echo CHtml::encode($data->flight_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drop_service')); ?>:</b>
	<?php echo CHtml::encode($data->drop_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drop_flight_name')); ?>:</b>
	<?php echo CHtml::encode($data->drop_flight_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drop_flight_time')); ?>:</b>
	<?php echo CHtml::encode($data->drop_flight_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_salutation_id')); ?>:</b>
	<?php echo CHtml::encode($data->client_salutation_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_name')); ?>:</b>
	<?php echo CHtml::encode($data->client_name); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('client_address')); ?>:</b>
	<?php echo CHtml::encode($data->client_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_country_id')); ?>:</b>
	<?php echo CHtml::encode($data->client_country_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_mobile')); ?>:</b>
	<?php echo CHtml::encode($data->client_mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_phone')); ?>:</b>
	<?php echo CHtml::encode($data->client_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_email')); ?>:</b>
	<?php echo CHtml::encode($data->client_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_identity_id')); ?>:</b>
	<?php echo CHtml::encode($data->client_identity_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_identity_no')); ?>:</b>
	<?php echo CHtml::encode($data->client_identity_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reservation_status')); ?>:</b>
	<?php echo CHtml::encode($data->reservation_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancel_status')); ?>:</b>
	<?php echo CHtml::encode($data->cancel_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancel_date')); ?>:</b>
	<?php echo CHtml::encode($data->cancel_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancel_reason')); ?>:</b>
	<?php echo CHtml::encode($data->cancel_reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancel_time')); ?>:</b>
	<?php echo CHtml::encode($data->cancel_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancel_by')); ?>:</b>
	<?php echo CHtml::encode($data->cancel_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chkin_status')); ?>:</b>
	<?php echo CHtml::encode($data->chkin_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('noshow_status')); ?>:</b>
	<?php echo CHtml::encode($data->noshow_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->client_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_charges')); ?>:</b>
	<?php echo CHtml::encode($data->room_charges); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount')); ?>:</b>
	<?php echo CHtml::encode($data->discount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gst')); ?>:</b>
	<?php echo CHtml::encode($data->gst); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('advance')); ?>:</b>
	<?php echo CHtml::encode($data->advance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_person_id')); ?>:</b>
	<?php echo CHtml::encode($data->sale_person_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />

	*/ ?>

</div>