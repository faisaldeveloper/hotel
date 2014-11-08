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



	 $from_date = $_POST[from_date];

	 $to_date = $_POST[to_date];



	// echo "---".$from_date."--".$to_date."--"."(c_date Between '$from_date' And '$to_date') And branch_id = $branch_id Order By id";	 

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

    <td colspan="3" align="center"><strong>Change Credit Summary </strong></td>

  </tr>

</table>

  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>

<table width="100%" border="1" align="center">

      <tr>

        <td><strong>Sr#</strong></td>

		<td><strong>Guest Name</strong></td>

		<td><strong>Room</strong></td>

        <td><strong>Service</strong></td>

         <td><strong>Date</strong></td>

        <td><strong>Voucher No</strong></td>

        <td><strong>Debit</strong></td>

        <td><strong>Credit</strong></td>

        <td><strong>Initial</strong></td>

        

        

        

      </tr>

      <?php

      $GuestLedger = GuestLedger::model()->findAll("(c_date Between '$from_date' And '$to_date') And branch_id = $branch_id Order By id");

 foreach($GuestLedger as $rs){

	 $i++;

	 $guest_name = $rs['guest_name']; 

	 

	 $res_rm = RoomMaster::model()->findAll("mst_room_id=".$rs['room_id']);

	 foreach($res_rm as $row){$mst_room_name = $row[mst_room_name];}

	 

	 $HmsServices = Services::model()->findAll("service_id=".$rs['service_id']);

	 foreach($HmsServices as $row){$service = $row[service_description];}

	  $folio=$rs['chkin_id'];

	 $remarks = $rs['remarks'];

	 $c_date = $rs['c_date'];

	 $dr = $rs['debit'];

	 $cr = $rs['credit'];

	 //$balance = $rs['balance'];

	 $total_dr +=$dr;

	 $total_cr +=$cr;

	 

	  

	  ?>

      <tr>

       

        <td valign="top"><?php echo $i;?></td>

        <td valign="top"><?php echo ucwords($guest_name);?></td>

        <td><?php echo $mst_room_name;?></td>

        <td><?php echo $service;?></td>

        <td><?php echo date("d/m/y",strtotime($c_date));?></td>

         <td><?php echo $folio;?></td>

        <td><?php echo $dr;?></td>       

        <td><?php echo $cr;?></td>

		

        

    </tr>

      <?php

 	}

	  ?>

	  <tr>

        <td colspan="6"></td>

		<td>---------</td>       

        <td>---------</td>          

    </tr>

	  <!--<tr>

        <td colspan="5"></td>

		<td>Total</td>

        <td><?php //echo $total_dr;?></td>       

        <td><?php //echo $total_cr;?></td>        

    </tr>-->

	  

  </table>

    <table width="100%" border="0">

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td><strong>Total</strong></td>

        <td><strong><?php echo number_format($total_dr,0);?></strong></td>

        <td><strong><?php echo number_format($total_cr,0);?></strong></td>        

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

        <td><strong>TOTAL GUEST(S) :</strong></td>

        <td><?php echo $total_guest;?></td>

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

        <td align="right"><input id="print" type="button" value="Print" onclick="printthis(this.id)" /></td>

      </tr>

      

      

      

    </table>

   



 </div>



