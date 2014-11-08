<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('floor_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->floor_id), array('view', 'id'=>$data->floor_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<!--<b><?php //echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php //echo CHtml::encode($data->branch_id); ?>
	<br />
-->

</div>