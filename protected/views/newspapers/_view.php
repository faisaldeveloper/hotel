<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('newspaper_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->newspaper_id), array('view', 'id'=>$data->newspaper_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('newspaper_name')); ?>:</b>
	<?php echo CHtml::encode($data->newspaper_name); ?>
	<br />

	<!--<b><?php //echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php //echo CHtml::encode($data->branch_id); ?>
	<br />
-->

</div>