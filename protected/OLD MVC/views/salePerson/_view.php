<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_person_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sale_person_id), array('view', 'id'=>$data->sale_person_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_person_name')); ?>:</b>
	<?php echo CHtml::encode($data->sale_person_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_person_comm')); ?>:</b>
	<?php echo CHtml::encode($data->sale_person_comm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	<!--<b><?php //echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php //echo CHtml::encode($data->branch_id); ?>
	<br />
-->

</div>