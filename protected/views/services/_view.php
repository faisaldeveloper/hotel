<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->service_id), array('view', 'id'=>$data->service_id)); ?>
	<br />
    
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('service_code')); ?>:</b>
	<?php echo CHtml::encode($data->service_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_description')); ?>:</b>
	<?php echo CHtml::encode($data->service_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('servise_type')); ?>:</b>
	<?php echo CHtml::encode($data->servise_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_rate')); ?>:</b>
	<?php echo CHtml::encode($data->service_rate); ?>
	<br />

	<!--<b><?php //echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php //echo CHtml::encode($data->branch_id); ?>
	<br />-->


</div>