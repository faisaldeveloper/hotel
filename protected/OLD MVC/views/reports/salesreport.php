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



	 $from_date = $_POST['from_date'];

	 $to_date = $_POST['to_date'];

	 if(isset($from_date) and isset($to_date)){

		 

		 $showdate="<br/> From:  ".date("j F, Y H:i", strtotime($from_date))."\t TO:  ".date("j F, Y H:i",strtotime($to_date));

		 }



$from_date = explode(" ",$_POST['from_date']);

$to_date = explode(" ",$_POST['to_date']);

$from_date = $from_date[0]." 00:00:00";

$to_date = $to_date[0]." 00:00:00";

	// echo "---".$from_date."--".$to_date."--"."(c_date Between '$from_date' And '$to_date') And branch_id = $branch_id Order By id";

	

	 //$_SESSION['gst_show'] = 'to do';

$sval = Yii::app()->session['taxcontrol'];

if(isset($sval) && $sval=='ON') $gst_show = " AND ci.gst_show > 0";

else $gst_show = "";	 

 ?>

 



<div class="container_mce">

<table width="100%" border="0">

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

    <td colspan="3" align="center"><strong>Sales Report From: <?php echo $showdate; ?></strong></td>

  </tr>

</table>

  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>

<table width="100%" border="1" align="center">

      <tr>

        <td><strong>Sr#</strong></td>

		<td><strong>Guest Name</strong></td>

		<td><strong>Room</strong></td>

        <td><strong>S Code</strong></td>

        <td><strong>Service</strong></td>

        <td><strong>Remarks</strong></td> 

        <td><strong>Folio No.</strong></td> 

        <td><strong>Date</strong></td>       

        <td><strong>Dr</strong></td>

        <td><strong>Cr</strong></td>

        

      </tr>

      <?php

      //$GuestLedger = GuestLedger::model()->findAll("(c_date Between '$from_date' And '$to_date') And branch_id = $branch_id Order By id");

	  

	  // this query user tax control from checkin info table i.e gst_show value

	  $sql = "";

	  $sql = "select gl.*, ci.gst_show, ci.guest_folio_no from hms_guest_ledger gl";

	  $sql .= " Left join hms_checkin_info ci";

	  $sql .= " ON gl.chkin_id = ci.chkin_id";

	  $sql .= " where 1 ".$gst_show ." and gl.c_date BETWEEN '$from_date' AND '$to_date'";

	  

	 $GuestLedger = Yii::app()->db->createCommand($sql)->query();

	  

 foreach($GuestLedger as $rs){

	 $i++;

	 $guest_name = $rs['guest_name']; 

	 

	 $mst_room_name = RoomMaster::model()->find("mst_room_id=".$rs['room_id'])->mst_room_name;	 

	 $service = Services::model()->find("service_id=".$rs['service_id'])->service_description;

	 $service_code = Services::model()->find("service_id=".$rs['service_id'])->service_code;

	

	 

	 $remarks = $rs['remarks'];

	 $c_date = $rs['c_date'];

	 $dr = $rs['debit'];

	 $cr = $rs['credit'];	;

	 //$balance = $rs['balance'];

	 $total_dr +=$dr;

	 $total_cr +=$cr;

	 

	  $guest_folio_no = $rs['guest_folio_no'];

	  $gst_folio_no = $rs['gst_show'];	 

	  if(empty($gst_show))	{ $folio_no =  $guest_folio_no; }

	  else $folio_no = $gst_folio_no;		  

	  ?>

      <tr>

        <td valign="top"><?php echo $i;?></td>

        <td valign="top"><?php echo ucwords($guest_name);?></td>

        <td><?php echo $mst_room_name;?></td>

         <td><?php echo $service_code;?></td>

        <td><?php echo $service;?></td>

        <td><?php echo $remarks;?></td>

        <td><?php echo $folio_no;?></td>

        <td><?php echo date("d/m/y",strtotime($c_date));?></td>

        <td><?php echo $dr;?></td>       

        <td><?php echo $cr;?></td>	

        

    </tr>

      <?php

 	}

	  ?>

	  <tr>

        <td colspan="8"></td>

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

        <td width="6%">&nbsp;</td>

        <td width="6%">&nbsp;</td>

        <td width="6%">&nbsp;</td>

        <td width="6%">&nbsp;</td>

        <td width="6%">&nbsp;</td>

        <td width="6%">&nbsp;</td>

         <td width="18%">&nbsp;</td>             

        <td width="25%"><strong>Total</strong></td>

        <td width="10%"><strong><?php echo number_format($total_dr,0);?></strong></td>

        <td width="11%"><strong><?php echo number_format($total_cr,0);?></strong></td>        

      </tr>

  </table>

<hr />

     

  <p align="right" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>

  

  </div>

   

