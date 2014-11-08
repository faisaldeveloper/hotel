<?php

$res_id =  $_REQUEST['id'];





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

 ?>

 

<div class="container_mce">

  <table  width="100%" border="0">

  <tr>

    <td  class="33" rowspan="3">&nbsp;</td>

    <td class="171" rowspan="3"><img src="<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php echo $hotel_logo_image;?>" height="98px" class="75px" /></td>

    <td colspan="3" align="center">&nbsp;<font size="+2"><strong><?php echo ucwords($hotel_title); ?></strong></font></td>

    

    <td class="62" rowspan="3"><strong>Date</strong></td>

    <td class="165" rowspan="3"><?php echo date('j F, Y');?></td>

  </tr>

  <tr>

    <td colspan="3" align="center"><strong><?php echo ucwords($branch_address); ?></strong></td>

  </tr>

  <tr>    

    <td colspan="3" align="center"><strong>Guest Registration Card</strong></td>

  </tr>

</table>

<hr />



<?php 

$result = ReservationInfo::model()->findAll("reservation_id=$res_id and branch_id = $branch_id");

foreach($result as $row){

	 		$reservation_id = $row['reservation_id']; 	

			$res_type = $row['res_type'];	

			$group_name = $row['group_name'];

			$company_name=Company::model()->find("comp_id =". $row['company_id'])->comp_name;

			$to_person = $row['to_person'];

			$designation = $row['designation'];

			$chkin_date = $row['chkin_date'];

	 		$chkout_date = $row['chkout_date'];

			$total_days = $row['total_days'];

			

			$pick_service = $row['pick_service'];

			$flight_name = $row['flight_name'];

			$flight_time = $row['flight_time'];

			

			$drop_service = $row['drop_service'];

			$drop_flight_name = $row['drop_flight_name'];

			$drop_flight_time = $row['drop_flight_time'];

			

			$salutation_name = 	Salutation::model()->find("salutation_id=". $row['client_salutation_id'])->salutation_name;			

			$guest_name = $row['client_name'];

			$guest_address = $row['client_address'];

			$country_name = Country::model()->find("country_id =". $row['client_country_id'])->country_name;

			$guest_mobile = $row['client_mobile'];			

			$guest_phone = $row['client_phone'];

			$guest_email = $row['client_email'];			

			

			$reservation_status = ReservationStatus::model()->find("res_id = ".$row['reservation_status'])->res_description;

			$room_type = $row['room_type'];

	 		$room_name = $row['room_name'];	

}



?>





<table  width="100%" border="0">

  <tr>

    <td class="165"><strong>Guest Name:</strong></td>

    <td colspan="5" class="mytd"><?php echo ucwords($guest_name);?></td>

    </tr>

  <tr>

    <td><strong>Company:</strong></td>

    <td colspan="5" class="mytd"><?php echo $company_name;?></td>

    </tr>

  <tr>

    <td><strong>Address:</strong></td>

    <td colspan="5" class="mytd"><?php echo ucwords($guest_address);?></td>

    </tr>

  <tr>

    <td><strong><?php echo $identity_name;?></strong></td>

    <td colspan="2" class="mytd"><?php echo $guest_identity_no;?></td>

    <td colspan="2">&nbsp;</td>

    <td class="98">&nbsp;</td>

  </tr>

  <tr>

    <td><strong>Nationality</strong></td>

    <td class="99" class="mytd"><?php echo $country_name;?></td>

    <td class="112"><strong>Profession:</strong></td>

    <td class="158" class="mytd">&nbsp;</td>

    <td class="87"><strong>Date of Birth:</strong></td>

    <td class="mytd"><?php

	if(strtotime($guest_dob) > 500)

	 echo date("d/m/y",strtotime($guest_dob));

	 else echo "N/A";

	 

	 ?></td>

  </tr>

  <tr>

    <td><strong>Checkin Date:</strong></td>

    <td class="mytd"><?php echo date('F j, Y H:i', strtotime($chkin_date));?></td>

    <td><strong>Checkout Date:</strong></td>

    <td class="mytd"><?php echo date('F j, Y H:i', strtotime($chkout_date));?></td>

    <td><strong>Stay:</strong></td>

     <td><?php echo $total_days; ?> &nbsp;&nbsp; Day(s)</td>

    </tr>

</table>

<hr />

<table  width="100%" border="0">

  <tr>

    <td class="132">&nbsp;</td>

    <td colspan="2">&nbsp;</td>

    <td class="97"><strong>Mobile #:</strong></td>

    <td class="175" class="mytd"><?php echo $guest_mobile;?></td>

  </tr>

  <tr>

    <td><strong>Payment Mode:</strong></td>

    <td colspan="2">&nbsp;</td>

    <td><strong>Office #:</strong></td>

    <td class="mytd">&nbsp;</td>

  </tr>

  <tr>

    <td><strong>Advance Payment:</strong></td>

    <td class="113" class="mytd">&nbsp;</td>

    <td class="205">&nbsp;</td>

    <td><strong>Newspaper:</strong></td>

    <td class="mytd">&nbsp;</td>

  </tr>

</table>

<hr />



<table width="100%" class="tblstyle">

  <tr>

    <td class="122"><strong>Room Number</strong></td>

    <td class="117"><strong>Total Persons</strong></td>

    <td class="181"><strong>Room Type</strong></td>

    <td class="92"><strong>Rate</strong></td>

    <td class="114"><strong>Check-In By</strong></td>

  </tr>

  <tr>

    <td align="left"><?php echo $room_name;?></td>

    <td align="left"><?php echo $total_person;?></td>

    <td><?php echo $room_type;?></td>

    <td><?php echo $rate."-".$wgst;?></td>

    <td><?php echo $user_name;?></td>

  </tr>

</table>

<br />

<table class="993" border="0">

  <tr>

    <td class="194"><strong>Signature Duty Manager</strong></td>

    <td class="273"><strong>_____________________</strong></td>

    <td class="209"><strong>Signatire Guest</strong></td>

    <td class="299"><strong>_______________________</strong></td>

  </tr>

</table> 



<?php

$url = Yii::app()->createUrl('ReservationInfo/pdf/'.$res_id);

$baseurl = Yii::app()->baseUrl."/images/pdf.png";

//echo $baseurl;

$img = '<img src=\"/hotel/images/pdf_icon.png" height="50" width="60" alt="Download as pdf" title="Download as pdf" />';

$link = CHtml::link($img, $url, array('class' => 'hello'));

?>

	<p align="right"> <?php echo $link; ?>       

   <span align="right"  style="padding-right:10px;"> <input type="button" value="Print" onclick="printpage()" /> </span>   </p>

    <script> function printpage(){window.print()}</script>



</div>