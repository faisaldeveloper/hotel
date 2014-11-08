<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('mst_room_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mst_room_id), array('view', 'id'=>$data->mst_room_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mst_room_name')); ?>:</b>
	<?php echo CHtml::encode($data->mst_room_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mst_floor_id')); ?>:</b>
	<?php echo CHtml::encode($data->Floor->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mst_roomtypeid')); ?>:</b>
	<?php echo CHtml::encode($data->Roomtype->room_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mst_room_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->mst_room_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mst_room_adults')); ?>:</b>
	<?php echo CHtml::encode($data->mst_room_adults); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mst_room_childs')); ?>:</b>
	<?php echo CHtml::encode($data->mst_room_childs); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('mst_room_status')); ?>:</b>
	<?php echo CHtml::encode($data->mst_room_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />

	*/ ?>

</div>