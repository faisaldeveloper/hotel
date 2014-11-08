<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->country_id), array('view', 'id'=>$data->country_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_name')); ?>:</b>
	<?php echo CHtml::encode($data->country_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_currancy')); ?>:</b>
	<?php echo CHtml::encode($data->country_currancy); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('currancy_sign')); ?>:</b>
	<?php echo CHtml::encode($data->currancy_sign); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_code')); ?>:</b>
	<?php echo CHtml::encode($data->country_code); ?>
	<br />


</div>