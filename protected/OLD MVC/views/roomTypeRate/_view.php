<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->comp_name), array('view', 'id'=>$data->comp_id)); ?>
	<br />

	<?php
	$RoomTypeRate = RoomTypeRate::model()->findAll("company_id = ".$data->comp_id);
	$i=1;
	foreach( $RoomTypeRate as $row){
	if($row['comp_allow_gst']==1){$gst="Yes";}else{$gst="No";}
	$HmsRoomType = HmsRoomType::model()->find("room_type_id = ".$row['room_type_id']);
	
	if($i++==1){?>
	<table>
	<tr><th width="100px">Type</th><th width="50px">Rate</th><th>G.S.T</th></tr>	
	<?php
	}
	?>
	<tr>
	<td><b><?php echo CHtml::encode($HmsRoomType->room_name); ?>:</b></td>
	<td><?php echo CHtml::encode($row['room_rate']); ?></td>
	<td><?php echo CHtml::encode($gst); ?></td>
	</tr>
	<?php
	}
	
	?>
</table>

</div>