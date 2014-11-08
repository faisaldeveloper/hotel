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

	 

///// ------------------------

 $total_rooms = Yii::app()->db->createCommand("select count(mst_room_id) from hms_room_master where branch_id = $branch_id")->queryScalar();

	

	//occupied

	$total_occupied = Yii::app()->db->createCommand("select count(mst_room_id) from hms_room_master where mst_room_status = 'O' and branch_id = $branch_id")->queryScalar();

	$total_vacent = $total_rooms - $total_occupied;

	

	$total_guest = Yii::app()->db->createCommand("select SUM(total_person) from hms_checkin_info where chkout_status = 'N' and branch_id = $branch_id")->queryScalar();

	

	//dirty

	$total_dirty = Yii::app()->db->createCommand("select count(mst_room_id) from hms_room_master where mst_room_status = 'D' and branch_id = $branch_id")->queryScalar();

	

	//availabe

	$total_availabe = Yii::app()->db->createCommand("select count(mst_room_id) from hms_room_master where mst_room_status = 'V' and branch_id = $branch_id")->queryScalar();

	

	

	 $percent_occupied = number_format((($total_occupied *100) / $total_rooms),2) ; 

	 $percent_availabe = number_format((($total_availabe *100) / $total_rooms),2) ; 

	 $percent_dirty = number_format((($total_dirty *100) / $total_rooms),2) ; 

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

    <td colspan="3" align="center"><strong>Daily Occupancy Report - <?php echo "<font color=\"red\">".$percent_occupied." % Room Occupancy </font>"; ?></strong></td>

  </tr>

</table>

  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>



<table width="100%" border="0" align="center">

      <tr>        

        <td align="left"><strong>Room</strong></td>

        <td align="left"><strong>Name</strong></td>

        <td align="left"><strong>Person#</strong></td>

        <td align="left"><strong>Company</strong></td>

        <td align="left"><strong>Country</strong></td>

        <td align="left"><strong>Check-In</strong></td> 

        <td align="left"><strong>Check-Out</strong></td> 

        <td align="left"><strong>Rate</strong></td>

        <td align="left"><strong>GST</strong></td> 

        <td align="left"><strong>B.Tax</strong></td> 

        <td align="left"><strong>Total</strong></td>  

        <td align="left"><strong>M.O.P</strong></td>

      </tr>

      <?php

	  $branch_id = yii::app()->user->branch_id;	 

	  $active_date = DayEnd::model()->find("branch_id= $branch_id")->active_date;	

	  $con = " chkin_date LIKE '$active_date%' AND chkout_date LIKE '$active_date%'";

	  //echo $con;

      $chkin_info = CheckinInfo::model()->findAll("(". $con.") || chkout_status = 'N' AND branch_id = $branch_id  ORDER BY room_id");

	  

	 // echo "--".count($chkin_info);

	  $gst_rate = ServiceGst::model()->find("branch_id = $branch_id")->gst_percent;

 foreach($chkin_info as $rs){

	 $i++; 

	 $payment_mode = '';

	 $guestid = $rs['guest_id'];	

	 $guest=GuestInfo::model()->find("guest_id= $guestid");

	 $guestname=$guest->guest_name;

	 $country_id = $guest->guest_country_id;	 

	 $room=$rs['room_id'];

	 

	 $room_name=RoomMaster::model()->find("mst_room_id	= $room")->mst_room_name;	 	 

	 $person=$rs['total_person'];	  

	 $compid=$rs['guest_company_id'];

	 $checkin=$rs['chkin_date'];

	 $checkout=$rs['chkout_date'];		 

	 $companyname=Company::model()->find("comp_id=$compid")->comp_name; 

	 $country=Country::model()->find("country_id=$country_id")->country_name;	 		 	 

	 $rate=$rs['rate'];

	 $gst= round(($rate / 100) * $gst_rate);

	 $total =  $rate + $gst;

	 $bedtax = $person;

	 

	 

	  $cash = $rs['cash'];

	 $debit_card = $rs['debit_card'];

	 $credit_card = $rs['credit_card'];

	 $btc = $rs['btc'];

	 if($cash=="Y") $payment_mode .= "Cash";

	 if($debit_card=="Y") $payment_mode .= "/DC";

	 if($credit_card=="Y") $payment_mode .= "/CC";

	 if($btc=="Y") $payment_mode .= "/BTC";

	  ?>

      <tr>        

        <td align="left"><?php echo $room_name;?></td>

        <td align="left"><?php echo ucwords(strtolower($guestname));?></td>

        <td align="center"><?php echo $person?></td>

        <td align="left"><?php echo $companyname;?></td>

        <td align="left"><?php echo  $country;?></td>

        <td align="left"><?php echo  date("d/m/y", strtotime($checkin));?></td>

        <td align="left"><?php echo  date("d/m/y", strtotime($checkout)); ?></td>

         <td align="left"><?php echo $rate;?></td>

        <td align="left"><?php echo $gst;?></td>

        <td align="left"><?php echo $bedtax;?></td>

        <td  align="left" ><?php echo $total;?></td> 

        <td  align="left" ><?php echo $payment_mode;?></td>   

        

    </tr>

      <?php

 	}

	  ?>

  </table>

    <hr />

 

  <p align="right" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>

    

</div>