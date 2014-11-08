<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate_type_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rate_type_id), array('view', 'id'=>$data->rate_type_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate_name')); ?>:</b>
	<?php echo CHtml::encode($data->rate_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('days')); ?>:</b>
	<?php echo CHtml::encode($data->days); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />


</div>