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
<table width="100%" border="0">
  <tr>   
    <td colspan="3" align="center" style="font-size: 12px;"><strong>ROOM STATUS REPORT</strong></td>    
  </tr>
  <tr>      
    <td colspan="3" align="center" style="font-size: 10px;"><strong><?php //echo $showdate; ?></strong></td>   
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
<table width="100%"  border="0" align="center">
      <tr>
        <td><strong>Sr#</strong></td>
         <td ><strong>Room No</strong></td>              
        <td  ><strong>Room Type</strong></td>
        <td ><strong>Floor</strong></td> 
        <td  ><strong>Adults</strong></td>
        <td><strong>Children</strong></td>
        <td  ><strong>Status</strong></td>        
      </tr>
      <?php
      $RoomMaster = RoomMaster::model()->findAll("branch_id = $branch_id Order By mst_room_id");
 foreach($RoomMaster as $rs){
	 $i++;
	 $mst_room_name = $rs['mst_room_name']; 
	 
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
        <td valign="top"><?php echo $mst_room_name;?></td>
        <td><?php echo $room_type;?></td>
        <td><?php echo ucwords($floor);?></td>       
        <td><?php echo $mst_room_adults;?></td>
        <td align="left"><?php echo $mst_room_childs;?></td>       
        <td><?php echo $mst_room_status;?></td>
        
    </tr>
      <?php
 	}
	  ?>
  </table>  

    
    <div style="clear:both"></div>
    <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>
