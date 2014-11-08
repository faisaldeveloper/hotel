<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('res_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->res_id), array('view', 'id'=>$data->res_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('res_description')); ?>:</b>
	<?php echo CHtml::encode($data->res_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />


</div>