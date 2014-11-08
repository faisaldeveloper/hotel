<?php



$user_id = yii::app()->user->id;

$user_info = User::model()->findAll("id=$user_id");

 foreach($user_info as $u_info){

	 $user_name = $u_info['username'];

	 }



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



//print_r($data);

$from_date1 = $_POST[from_date];

$to_date1 = $_POST[to_date];

	 

///////// start of guest ledger info

$from_date1 = $data['from_date'];

$to_date1 = $data['to_date'];

if(isset($from_date1)and isset($to_date1)){

	$showdate="<br/> From:  ".date("j F, Y H:i", strtotime($from_date1))."\t TO:  ".date("j F, Y H:i", strtotime($to_date1));

	}

$checkin =CheckinInfo::model()->findAll("chkout_status ='N' and guest_company_id= '1' and  chkout_date between '$from_date1' and '$to_date1' and branch_id = $branch_id  ORDER BY room_id");



////////// end of code









 ?>

 





<div class="container_mce">

  <table width="100%" border="0">

  <tr>

    <td rowspan="3">&nbsp;</td>

    <td rowspan="3"><img src="<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php echo $hotel_logo_image;?>" height="98px" width="75px" /></td>

    <td colspan="3" align="center">&nbsp;<font size="+2"><strong><?php echo ucwords($hotel_title); ?></strong></font></td>

    

    <td rowspan="3"><strong>Date</strong></td>

    <td rowspan="3"><?php echo date('j F, Y H:i:s');?></td>

  </tr>

  <tr>

    <td colspan="3" align="center"><strong><?php echo ucwords($branch_address); ?></strong></td>

  </tr>

  <tr>    

    <td colspan="3" align="center"><strong>Expected General Check-Out Report <?php echo $showdate; ?></strong></td>

  </tr>

</table>

  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>

  

  

  <table width="100%" border="0">

    <tr>

       <td><strong>Sr#</strong></td> 

      <td  align="left"><strong>Room</strong></td>     

      <td  align="left"><strong>Folio No</strong></td>

      <td  align="left"><strong>Guest Name</strong></td>         

      <td  align="left"><strong>Company</strong></td>

      <td  align="left"><strong>Phone</strong></td>

      <td  align="left"><strong>Mobile</strong></td> 

      <td align="left"><strong>Check-In</strong></td>

      <td align="left"><strong>Check-Out</strong></td>   

    </tr>

    <?php

    foreach($checkin as $row){

		$i++;

		$guest_id= $row['guest_id'];		

		$guest_mobile = "";

		$guest_phone= "";

		$room_name=RoomMaster::model()->find("mst_room_id	= ".$room=$row['room_id'])->mst_room_name;	 

		$guest=GuestInfo::model()->find("guest_id=$guest_id");

		$guestname=$guest->guest_name;

		$guest_mobile=$guest->guest_mobile;

		$guest_phone=$guest->guest_phone;	

		

	 	$company_name = Company::model()->find("comp_id =".$row['guest_company_id'])->comp_name;					

		$chkin_date = $row['chkin_date'];		

		$chkout_date = $row['chkout_date'];	 		 

	 	$total_days = $row['total_days'];	

		$chkin_id = $row['chkin_id']; 			

	 

	?>

    <tr class="text">

     <td  align="left"><?php echo $i;?></td>

      <td align="left"><?php echo $room_name;?></td>

      <td align="left"><?php echo $chkin_id;?></td>

      <td  align="left"><?php echo ucwords($guestname);?></td>

      <td  align="left"><?php echo $company_name;?></td>

      <td  align="left"><?php echo $guest_phone; ?></td>

      <td  align="left"><?php echo $guest_mobile; ?></td>

      <td  align="left"><?php echo date("d/m/y",strtotime($chkin_date));?></td>

      <td  align="left"><?php echo date("d/m/y",strtotime($chkout_date));?></td>    

    </tr>

    <?php } ?>

  </table>

  <div style="clear:both"></div>

 <!-- <p><strong>Total Checkout: <?php echo $total_record;?></strong></p> -->

  

  <p align="right" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>

    

</div>