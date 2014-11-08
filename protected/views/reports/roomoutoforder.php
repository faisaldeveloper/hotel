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
    <td colspan="3" align="center"><strong>Rooms Out Of Order Report</strong></td>
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
<table width="100%" border="1" align="center">
      <tr>
        <td><strong>Sr#</strong></td>
         <td><strong>Room Name</strong></td>
        <td><strong>Floor</strong></td>       
        <td><strong>Type</strong></td>
        <td><strong>Adults</strong></td>
        <td><strong>Children</strong></td>
        <td><strong>Status</strong></td>        
      </tr>
      <?php
      $RoomMaster = RoomMaster::model()->findAll("mst_room_status = 'D' AND branch_id = $branch_id Order By mst_room_id");
 foreach($RoomMaster as $rs){
	 $i++;
	 $mst_room_name = $rs['mst_room_name'];	 
	 $floor = HmsFloor::model()->find("floor_id=".$rs['mst_floor_id'])->description;
	 
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
        <td><?php echo ucwords($floor);?></td>
        <td><?php echo $room_type;?></td>
        <td><?php echo $mst_room_adults;?></td>
        <td align="left"><?php echo $mst_room_childs;?></td>       
        <td><?php echo $mst_room_status;?></td>
        
    </tr>
      <?php
 	}
	  ?>
  </table>
    <table width="100%" border="0">
      <tr>
       <!-- <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong>Total</strong></td>
        <td><strong><?php echo number_format($total_rate,0);?></strong></td>
        <td><strong><?php echo number_format($total_gst,0);?></strong></td>
        <td><strong><?php echo $total_BedTax;?></strong></td> -->
      </tr>
  </table>
    <hr />
    <?php
    $total_rooms = Yii::app()->db->createCommand("select count(mst_room_id) from hms_room_master where branch_id = $branch_id")->queryScalar();
	$total_occupied = Yii::app()->db->createCommand("select count(mst_room_id) from hms_room_master where mst_room_status = 'O' and branch_id = $branch_id")->queryScalar();
	$total_vacent = $total_rooms - $total_occupied;
	
	$total_guest = Yii::app()->db->createCommand("select SUM(total_person) from hms_checkin_info where chkout_status = 'N' and branch_id = $branch_id")->queryScalar();
	?>
    
    <table width="100%" border="0" align="left">
      <tr>
        <td>&nbsp;</td>
        <td><strong>TOTAL AVAILABLE ROOM(S) :</strong></td>
        <td><?php echo $total_rooms;?></td>
       <!-- <td><strong>TOTAL GUEST(S) :</strong></td>
        <td><?php echo $total_guest;?></td> -->
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><strong>TOTAL OCCUPIED ROOM(S) :</strong></td>
        <td><?php echo $total_occupied;?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><strong>TOTAL VACANT ROOM(S) :</strong></td>
        <td><?php echo $total_vacent;?></td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
    </table>
   <div style="clear:both"></div>
   <p align="right" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />  </p>

 </div>

