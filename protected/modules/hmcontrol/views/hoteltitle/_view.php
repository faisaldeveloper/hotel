<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_title')); ?>:</b>
	<?php echo CHtml::encode($data->application_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('website')); ?>:</b>
	<?php echo CHtml::encode($data->website); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logo_image')); ?>:</b>
	<?php echo CHtml::encode($data->logo_image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bg_image')); ?>:</b>
	<?php echo CHtml::encode($data->bg_image); ?>
	<br />


</div>