<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('excange_rate_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->excange_rate_id), array('view', 'id'=>$data->excange_rate_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_id')); ?>:</b>
	<?php echo CHtml::encode($data->Country->country_name); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('sign')); ?>:</b>
	<?php echo CHtml::encode($data->sign); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exchabge_rate')); ?>:</b>
	<?php echo CHtml::encode($data->exchabge_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />


</div>