<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->guest_id), array('view', 'id'=>$data->guest_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_name')); ?>:</b>
	<?php echo CHtml::encode($data->guestSalutation->salutation_name.$data->guest_name); ?>
	<br />

	<!--<b><?php //echo CHtml::encode($data->getAttributeLabel('guest_name')); ?>:</b>
	<?php //echo CHtml::encode($data->guest_name); ?>
	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_address')); ?>:</b>
	<?php echo CHtml::encode($data->guest_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_phone')); ?>:</b>
	<?php echo CHtml::encode($data->guest_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_mobile')); ?>:</b>
	<?php echo CHtml::encode($data->guest_mobile); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('guest_company_id')); ?>:</b>
	<?php echo CHtml::encode($data->guestCompany->comp_name); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('guest_country_id')); ?>:</b>
	<?php echo CHtml::encode($data->guestCountry->country_name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_identity_id')); ?>:</b>
	<?php echo CHtml::encode($data->guest_identity_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_identity_no')); ?>:</b>
	<?php echo CHtml::encode($data->guest_identity_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_identity_issu')); ?>:</b>
	<?php echo CHtml::encode($data->guest_identity_issu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_identiy_expire')); ?>:</b>
	<?php echo CHtml::encode($data->guest_identiy_expire); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_gender')); ?>:</b>
	<?php echo CHtml::encode($data->guest_gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_email')); ?>:</b>
	<?php echo CHtml::encode($data->guest_email); ?>
	<br />

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->guest_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_dob')); ?>:</b>
	<?php echo CHtml::encode($data->guest_dob); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	*/ ?>

</div>