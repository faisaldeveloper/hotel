<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->comp_id), array('view', 'id'=>$data->comp_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_name')); ?>:</b>
	<?php echo CHtml::encode($data->comp_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_contact_person')); ?>:</b>
	<?php echo CHtml::encode($data->comp_contact_person); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('person_designation')); ?>:</b>
	<?php echo CHtml::encode($data->person_designation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('person_mobile')); ?>:</b>
	<?php echo CHtml::encode($data->person_mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_address')); ?>:</b>
	<?php echo CHtml::encode($data->comp_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_phone')); ?>:</b>
	<?php echo CHtml::encode($data->comp_phone); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_fax')); ?>:</b>
	<?php echo CHtml::encode($data->comp_fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_email')); ?>:</b>
	<?php echo CHtml::encode($data->comp_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_website')); ?>:</b>
	<?php echo CHtml::encode($data->comp_website); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_allow_credit')); ?>:</b>
	<?php echo CHtml::encode($data->comp_allow_credit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_id')); ?>:</b>
	<?php echo CHtml::encode($data->country_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	*/ ?>

</div>