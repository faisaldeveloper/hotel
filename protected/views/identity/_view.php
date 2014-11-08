<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('identity_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->identity_id), array('view', 'id'=>$data->identity_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('identity_description')); ?>:</b>
	<?php echo CHtml::encode($data->identity_description); ?>
	<br />

	<!--<b><?php //echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php //echo CHtml::encode($data->branch_id); ?>
	<br />
-->

</div>