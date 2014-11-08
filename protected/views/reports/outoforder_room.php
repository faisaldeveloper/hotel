<?php

$branch_id = yii::app()->user->branch_id;	 
$branch_info = HmsBranches::model()->findAll("branch_id=$branch_id");
 foreach($branch_info as $b_info){
	 $branch_address = $b_info['branch_address'];
	 $branch_phone = $b_info['branch_phone'];
	 $branch_fax = $b_info['branch_fax'];
	 $branch_email = $b_info['branch_email'];
	 $hotel_id = $b_info['hotel_id'];
	 		
			$hotel_info = HotelTitle::model()->findAll("id=$hotel_id");
 			foreach($hotel_info as $h_info){
	 		$hotel_title = $h_info['title'];
			$hotel_website = $h_info['website'];
			$hotel_logo_image = $h_info['logo_image'];
	 		}
	 }	
	 $branch_address .= "<br> Phone: $branch_phone Fax: $branch_fax <br> email: $branch_email"; 
 ?>
 
 
<div class="container_mce">
  <table  width="100%" border="0">
  <tr>
    <td rowspan="3">&nbsp;</td>
    <td rowspan="3"><img src="<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php echo $hotel_logo_image;?>" height="98px" width="75px" /></td>
    <td colspan="3" align="center">&nbsp;<font size="+2"><strong><?php echo ucwords($hotel_title); ?></strong></font></td>
    
    <td rowspan="3" valign="top"><strong>Date</strong></td>
    <td rowspan="3" valign="top"><?php echo date('j F, Y H:i:s');?></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong><?php echo ucwords($branch_address); ?></strong></td>
  </tr>
  <tr>    
    <td colspan="3" align="center"><strong>Room Status Report</strong></td>
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
<table width="100%" border="1" align="center">
      <tr>
        <td><strong>Sr#</strong></td>
         <td><strong>Room Name</strong></td>
        <td><strong>Floor</strong></td>       
       
        <td><strong>Adults</strong></td>
        <td><strong>Children</strong></td>
        <td><strong>Status</strong></td>        
      </tr>
      <?php
      $RoomMaster = RoomMaster::model()->findAll("branch_id = $branch_id   and mst_room_status='D' ");
 foreach($RoomMaster as $rs){
	 $i++;
	 $mst_room_name = $rs['mst_room_name']; 
	 $mst_room_remarks=$rs['mst_room_remarks'];
	 $res_floor = HmsFloor::model()->findAll("floor_id=".$rs['mst_floor_id']);
	 foreach($res_floor as $row){$floor = $row[description];}
	 
	 $res_room_type = HmsRoomType::model()->findAll("room_type_id=".$rs['mst_roomtypeid']);
	 foreach($res_room_type as $row){$room_type = $row[room_name];}
	 
	 $mst_room_adults = $rs['mst_room_adults'];
	 $mst_room_childs = $rs['mst_room_childs'];
	 $mst_room_status = $rs['mst_room_status'];
	 if($mst_room_status=='V')$mst_room_status="Available";	
	 else if($mst_room_status=='O')$mst_room_status="Occupied";	
	 else if($mst_room_status=='D')$mst_room_status="Dirty";	
	 else if($mst_room_status=='R')$mst_room_status="Reserved";	 
	  
	  ?>
      <tr>
        <td valign="top"><?php echo $i;?></td>
        <td valign="top"><?php echo $room_type;?></td>
        <td><?php echo  $mst_room_name;?></td>
        
        <td align="center"><?php echo $mst_room_adults;?></td>
        <td align="center"><?php echo $mst_room_childs;?></td>       
      <td><?php echo  $mst_room_status;?></td>
        
    </tr>
      <?php
 	}
	  ?>
  </table>
   
   
   <div style="clear:both"></div>   
  <p align="right" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>

 </div> 

