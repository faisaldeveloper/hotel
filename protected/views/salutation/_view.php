<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('salutation_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->salutation_id), array('view', 'id'=>$data->salutation_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('salutation_name')); ?>:</b>
	<?php echo CHtml::encode($data->salutation_name); ?>
	<br />

	<!--<b><?php //echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php //echo CHtml::encode($data->branch_id); ?>
	<br />
-->

</div>