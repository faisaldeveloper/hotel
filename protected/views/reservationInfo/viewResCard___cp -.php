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

 

<style type="text/css">

body{

	margin:0;

	color: #333333;

	padding-top: 0px;

	padding-right: 0;

	padding-bottom: 0;

	padding-left: 0;

	background: #999999;

	background-position: top;

	font-family:"Arial";

}

div, h1, h2, h3, h4,form, label, input, img, span{

	margin:0; padding:0;

}

p{

color:#585858;

}





.spacer{

	clear:both; 

	font-size:0; 

	line-height:0;

}

.clear{ clear:both;

}

/*------------------------------------------------topheader--------------------*/

#topheader{

	width:930px;

	height: 1300px;

	margin:auto;

	font-family: Calibri;

	font-size: 12px;

	font-style: normal;

	line-height: normal;

	font-weight: bold;

	font-variant: normal;

	text-transform: none;

	color: #333333;

	text-decoration: none;

	padding: 0px;

	float: none;

	background:#FFFFFF;

	

}

.logo{

	border:none;

	 margin:10px 0 0 430px;

	width:300px;

	height:100px;

}

</style>



<?php 

$result = ReservationInfo::model()->findAll("reservation_id=$res_id and branch_id = $branch_id");

foreach($result as $row){

	 		$reservation_id = $row['reservation_id']; 	

			$res_type = $row['res_type'];	

			$group_name = $row['group_name'];

			$company_name=Company::model()->find("comp_id =". $row['company_id'])->comp_name;

			$company_address =Company::model()->find("comp_id =". $row['company_id'])->comp_address;

			$company_phone =Company::model()->find("comp_id =". $row['company_id'])->comp_phone;

			$company_fax =Company::model()->find("comp_id =". $row['company_id'])->comp_fax;

			

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

			

			$room_rate = "Room Rate ";

			if(!empty($row['room_type'])){

			$room_name = HmsRoomType::model()->find("room_type_id = ".$row['room_type'])->room_name;

			$room_rate = RoomTypeRate::model()->find("company_id = ". $row['company_id'] ." AND room_type_id = ".$row['room_type'])->room_rate;

			//$room_rate = HmsRoomType::model()->find("room_type_id = ".$row['room_type'])->room_rate;

			}

			

	 		//$room_name = $row['room_name'];	

}



?>





<div id="topheader">

<div class="logo">Crown Plaza Logo </div>

<center><font style="font-size:24px; line-height:1.5em;"> ROOM RESEVATION CONFIRMATIOM</font></center> Confirmation # 31,643

<div style="background: width:auto; height:auto; float:left; margin:0px 0px 0 55px;  ">

<table border="1" width="800" align="center">



<tr align="center">

<td>To:</td>

<td><?php echo ucwords(strtolower($to_person)); ?></td>

<td rowspan="4">From <br /> Crown Plaza</td>

<td>Web </td>

<td>www.hotelcrownplaza.com</td>

</tr>



<tr align="center">

<td>Company</td>

<td><?php echo $company_address; ?></td>

<td>Email</td>

<td>info@hotelcrownplaza.com<br />reservation@hotelcrownplaza.com</td>

</tr>



<tr align="center">

<td>Tel:</td>

<td><?php echo $company_phone; ?></td>

<td>Tel:</td>

<td>+92-51-2277890</td>

</tr>



<tr align="center">

<td>Fax:</td>

<td><?php echo $company_fax; ?></td>

<td>Fax:</td>

<td>92-51-282718,2273967</td>

</tr>





<caption align="bottom"><br /><i>This reservation is only valid subject to receipt of confirmation from the Guest / Company</i></caption><br />

</table>



<table border="1" width="800px" align="center">

<tr align="center">

<th  rowspan="2">Guest Name</th>

<th  rowspan="2">Arrival Date</th>

<th  rowspan="2">Dep.Date</th>

<th  rowspan="2">Rms#</th>

<th  rowspan="2">Room Type</th>

<th  rowspan="2">Room<br />Rate + Tax</th>

<th  rowspan="2">Mod of payment</th>

<th  colspan="4">Flight Details</th>

</tr>



<tr align="center">

<th >Pick</th>

<th >Time</th>

<th >Drop</th>

<th >Time</th>

</tr>



<tr align="center">

<td ><?php echo $salutation_name." ". strtoupper(strtolower($guest_name)); ?></td>

<td ><?php echo date("d/m/y", strtotime($chkin_date)); ?></td>

<td ><?php echo date("d/m/y", strtotime($chkout_date)); ?></td>

<td >1</td>

<td ><?php echo $room_name; ?></td>

<td ><?php echo $room_rate; ?> + Tax</td>

<td >Cash,C/Card</td>

<td ></td>

<td >9:19</td>

<td ></td>

<td >9:19</td>

</tr>



<caption align="bottom"></caption><br />

</table>



<br /><br />

<font style="font-size:18px; font-weight:500;"><u> Sepcial Instructions</u></font><br />

VIP Handlings:

<br />

<font style="font-size:18px; font-weight:500;"><u> Above Rates are Inclusive of Following Privililegis</u></font><br />

<div style="background:; width:350px; height:auto; float:left; margin:5px; ">

<ul type="disc">

<li><i>Airport pick up & Drop <b>(prior to advance flight detail)</b></i></li>

<li><i>Buffet Breakfast at coffe shop.</i></li>

<li><i>Welcome Drink upon arrival.</i></li>

<li><i>Fruit Baskets in room.</i></li>

<li><i>Complimentary Tea & Coffe in Deluxe premium <br />

Non-Smoking and Suite Room.</i></li>

</ul></div>



<div style="background:; width:350px; height:auto; float:left; margin:5px; ">

<ul type="disc">

<li><i>Most of the Deluxe , premium Non-Smoking and Suite rooms are facing margalla Hills.</b></i></li>

<li><i>Free use of Health club & Gym.</i></li>

<li><i>Daily Newspaper.</i></li>

<li><i>Late Check out till 3:00pm if Available.</i></li>

</ul></div>

<br /><br /><br /><br /><br />

<br /><br />





 <font style="margin-left:26px; font-size:24px;">Note:</font><br />

<div style="background:; width:800px; height:auto; float:left; margin:5px; border:solid; border-size:1px;">

<table>

<tr>

<td>CHECK-IN TIME: 12:00 Noon.  <font style="margin-left:300px;">CHECK-OUT TIME: 12:00 Noon</font><br />

In case of late check-out after 5:00pm One Night Room + Tax will be charged.

</td>

</tr>



<tr>

<td style="border:solid; width:800px;">In case of Early Check In, <b>Previous night will be charged</b></td>



</tr>

<tr>

<td style="border:solid; width:800px;"><b>Extention in stay, prior to advance notice and subjected to availability of room.</b></td>



</tr>

</table>

 <center><font style=" font-size:24px;">Unguaranteed reservations will be held till 04:00pm on arrival date</font></center><br /><br />

 <center><font style=" font-size:18px;"><u>Please Guarantee this reservation to avoid inconvenience.</u></font></center><br />

 <center><font style=" font-size:14px; line-height:1px;">(Must be return to hotel after completion)</font></center><br />

<font style=" font-size:18px; margin-left: 50px;"> <u>In case of No-Show of guestes, amount Equivalent to one night room rent will be charged.</u></font><br />

<font style=" font-size:12px; margin-left: 50px;">to avoid No-show charges, reservation must be cancelled at least 72 Hours prior to arrival date.</font> <br /><br /><br /><br />

<center><div style="border: solid; width:700px; ">

I wish to guaranteed the reservation and agree with conditions mentions above.





</div></center>

<center><div style="border: solid; width:700px; text-align:left; font-size:18px;">

&nbsp;&nbsp;&nbsp;NAME:



 <font style="margin-left:300px;">SIGNATURE:</font>

</div>

<div style="border: solid; width:700px; text-align:left; font-size:18px;">

&nbsp;&nbsp;&nbsp;DESIGNATION:



 <font style="margin-left:245px;">STAMP:</font>

</div>

</center>

<br />

<font style="font-size:18px; margin-left: 50px;"> Mode: </font><font style=" font-size:12px; margin-left: 50px;">(Please Tick)</font><br />

<br />



<font style=" font-size:12px; margin-left: 60px;"> Credit Card: </font><font style=" font-size:12px; margin-left: 120px;"> Advance: </font><font style=" font-size:12px; margin-left: 170px;">Billto Company Latter:</font><br /><br />



<font style=" font-size:12px; margin-left: 50px;">Looking forward to welcome you and your guest and extending our utmost professional service.</font><br /><font style=" font-size:12px; margin-left: 50px;">We appreciate your valueable patronage.</font>

<br /><br />

</div>

</div>

<div style="clear:both"></div>



<?php

$url = Yii::app()->createUrl('ReservationInfo/pdf/'.$res_id);

$baseurl = Yii::app()->baseUrl."/images/pdf.png";

//echo $baseurl;

$img = '<img src=\"/hotel/images/pdf_icon.png" height="50" width="60" alt="Download as pdf" title="Download as pdf" />';

$link = CHtml::link($img, $url, array('class' => 'hello'));

?>

	



<p align="right"  style="padding-right:10px;">  <?php echo $link; ?> <input type="button" value="Print" onclick="javascript: window.print()" />  </p>

</div>