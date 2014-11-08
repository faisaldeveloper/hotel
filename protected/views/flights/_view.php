<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->flight_id), array('view', 'id'=>$data->flight_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_name')); ?>:</b>
	<?php echo CHtml::encode($data->flight_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_arrival')); ?>:</b>
	<?php echo CHtml::encode($data->flight_arrival); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_departure')); ?>:</b>
	<?php echo CHtml::encode($data->flight_departure); ?>
	<br />

	<!--<b><?php //echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php //echo CHtml::encode($data->branch_id); ?>
	<br />
-->

</div>