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
	height: auto;
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
	 margin:10px 0 0 330px;
	
}

.contenttable tbody tr td{
font-weight: normal;
}



@media Print{

.container_mce{
	margin:auto;
	width:770px;	
	height: 100%;
	font-family:Tahoma, Geneva, sans-serif;
	font-size:12px;
	/* border: #666 thin ridge; */
	line-height:17px;
	}
	
	td{	/*padding: 5px 2px 5px 2px;*/
		padding: 3px 0 0 5px;
		font-size:12px;
		line-height:150%;		
	}
	strong{
		font-weight:bold;
		color:#006;
		}
	td.mytd{
		border-bottom:1px solid #000;}	
		
	table.tblstyle{	border-collapse::collapse;}
	table.tblstyleid{	border: 1px solid #000;		}
			
	.td_border{	border-left: 1px solid #666;}
	table{ border-collapse:collapse;}	
	.tr_border{		border-style: double;	}
	.page-break	{ display: block; page-break-before: always; }
} 
	strong{
		font-weight:bold;
		color:#006;
		}
table{
	font-family:Verdana, Geneva, sans-serif;
	/* border:thin; */
}
td{
	font-family:Verdana, Geneva, sans-serif;
/* 	border:thin !important; */	
	}
</style>
<?php 
$result = ReservationInfo::model()->findAll("reservation_id=$res_id and branch_id = $branch_id");
foreach($result as $row){ $res_type = $row['res_type']; $group_name = $row['group_name']; }
if($res_type=="G"){
	$result = ReservationInfo::model()->findAll("group_name = '$group_name' and reservation_status !=2 and branch_id = $branch_id");
}
$tmp_res = ''; $f = 1;
foreach($result as $row){
	 		$reservation_id = $row['reservation_id'];
			if($f==1) $tmp_res = $reservation_id;
			$f++;
			 	
			$res_type = $row['res_type'];	
			$group_name = $row['group_name'];
			$company_name=Company::model()->find("comp_id =". $row['company_id'])->comp_name;
			$company_address =Company::model()->find("comp_id =". $row['company_id'])->comp_address;
			$company_phone =Company::model()->find("comp_id =". $row['company_id'])->comp_phone;
			$company_fax =Company::model()->find("comp_id =". $row['company_id'])->comp_fax;
			
			$client_mobile = $row['client_mobile'];
			
			$mode_of_payment = '';
			$mode_of_payment = $row['mode_of_payment'];
			if($mode_of_payment==1)$mode_of_payment = $reservation_id."Cash/Credit Card";
			if($mode_of_payment==2) $mode_of_payment = $reservation_id."BTC";	
			
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
			$room_rate = $row['room_charges'];
	 		//$room_name = $row['room_name'];	
}
$hotel_logo_image = Yii::app()->request->baseUrl."/hotel_logos/".$hotel_logo_image;
?>
<div id="topheader">
<div class="logo">
<img class="logo-round-corner" src="<?php echo $hotel_logo_image ?>" style="margin-left:10px" alt="logo" /> 
 </div>

<center><font style="font-size:24px; line-height:1.5em;"> ROOM RESERVATION CONFIRMATION</font></center>
<span align="left" style="margin-left:45px;">Print Date/Time : <?php echo date("d/m/y"); echo "&nbsp;&nbsp;&nbsp;".date("H:i"); ?>  </span> 
<span style="margin-right:140px; float:right;"> Confirmation # <?php echo $tmp_res; ?></span>
<div style="background: width:auto; height:auto; float:left; margin:0px 0px 0 40px;  ">
<table border="1" width="100%" align="center">
<tbody>
<tr align="center">
<td>To:</td>
<td><?php echo $to_person; ?></td>
<!--<td rowspan="5">From <br /> <?php //echo ucwords($hotel_title); ?></td>-->
<td>Web </td>
<td><?php echo $hotel_website; ?></td>
</tr>
<tr align="center">
<td>Company:</td>
<td><?php echo $company_name; ?></td>
<td>Email</td>
<td><?php echo $branch_email; ?></td>
</tr>
<tr align="center">
<td>Mobile:</td>
<td><?php echo $client_mobile; ?></td>
<td>Tel:</td>
<td><?php echo $branch_phone; ?></td>
</tr>
<tr align="center">
<td>Tel / Fax:</td>
<td><?php echo $company_phone." / ".$company_fax; ?></td>
<td style="border:1px solid #000;">Fax:</td>
<td><?php echo $branch_fax; ?></td>
</tr>
</tbody>
<caption align="bottom"><br /><i>This reservation is only valid subject to receipt of confirmation from the Guest / Company</i></caption><br />

</table>


<table border="1" width="100%" align="center" class="contenttable">
<thead>
<tr>
<th  rowspan="2">Guest Name</th>
<th  rowspan="2" style='width:75px'>Arrival Date</th>
<th  rowspan="2" style='width:75px'>Departure Date</th>
<th  rowspan="2">Rms#</th>
<th  rowspan="2" style='width:75px'>Room Type</th>
<th  rowspan="2">Room<br />Rate</th>
<th  rowspan="2" style='width:30px'>Mode of payment</th>
<th  colspan="4">Flight Details</th>
</tr>


<tr align="center">
<th style='width:60px'>Flight</th>
<th >Pick</th>
<th style='width:60px'>Flight</th>
<th >Drop</th>
</tr>
</thead>

<tbody>
<?php 
$total_rooms = count($result);
foreach($result as $row){

$flight_name='';$drop_flight_name ='';	$room_name = '';$room_rate ='';

	 		$reservation_id = $row['reservation_id']; 	
			$res_type = $row['res_type'];	
			$group_name = $row['group_name'];
			
			$chkin_date = $row['chkin_date'];
	 		$chkout_date = $row['chkout_date'];
			$total_days = $row['total_days'];
			
			$pick_service = $row['pick_service'];
			if(!empty($row['flight_name']))
			$flight_name = 	Flights::model()->find("flight_id=". $row['flight_name'])->flight_name;
			$flight_time = $row['flight_time'];
						
			$drop_service = $row['drop_service'];
			if(!empty($row['drop_flight_name']))
			$drop_flight_name = 	Flights::model()->find("flight_id=". $row['drop_flight_name'])->flight_name;			
			$drop_flight_time = $row['drop_flight_time'];
			
			$salutation_name = 	Salutation::model()->find("salutation_id=". $row['client_salutation_id'])->salutation_name;			
			$guest_name = $row['client_name'];			
			$reservation_status = ReservationStatus::model()->find("res_id = ".$row['reservation_status'])->res_description;
			
			
			$room_rate = "Room Rate ";
			if(!empty($row['room_type'])){
			$room_name = HmsRoomType::model()->find("room_type_id = ".$row['room_type'])->room_name;
			$room_rate = RoomTypeRate::model()->find("company_id = ". $row['company_id'] ." AND room_type_id = ".$row['room_type'])->room_rate;		
			}
			$room_rate = $row['room_charges'];	
			if(!empty($room_rate))$room_rate = $room_rate . " + TAX";
			$client_remarks = $row['client_remarks'];	
			
			$mode_of_payment = '';
			$mode_of_payment = $row['mode_of_payment'];
			if($mode_of_payment==1)$mode_of_payment = "Cash/Credit Card";
			if($mode_of_payment==2) $mode_of_payment = "BTC";	
			
			$salutation_name = 	Salutation::model()->find("salutation_id=". $row['client_salutation_id'])->salutation_name;			
			$guest_name = $row['client_name'];
			$guest_address = $row['client_address'];
			$country_name = Country::model()->find("country_id =". $row['client_country_id'])->country_name;
			$guest_mobile = $row['client_mobile'];			
			$guest_phone = $row['client_phone'];
			$guest_email = $row['client_email'];
					
			//if(strlen($flight_name) > 10)$flight_name
						
			$flight_time2 = explode(":", $flight_time);
			if(count($flight_time2) > 2) $flight_time = $flight_time2[0].":".$flight_time2[1];
			$drop_flight_time2 = explode(":", $drop_flight_time);
			if(count($drop_flight_time2) > 2) $drop_flight_time = $drop_flight_time2[0].":".$drop_flight_time2[1];
			
			//if($pick_service=='N')$flight_time = '';
			//if($drop_service=='N')$drop_flight_time = '';		
			
?>
<tr align="center">
<td ><?php echo $salutation_name." ". strtoupper(strtolower($guest_name)); ?></td>
<td ><?php echo date("d/m/y", strtotime($chkin_date)); ?></td>
<td ><?php echo date("d/m/y", strtotime($chkout_date)); ?></td>
<td >1</td>
<td ><?php echo $room_name; ?></td>
<td ><?php echo $room_rate; ?></td>
<td ><?php echo $mode_of_payment; ?></td>
<td ><?php echo $flight_name." ".$flight_time; ?></td>
<td ><?php echo $pick_service; ?></td>
<td ><?php echo $drop_flight_name." ".$drop_flight_time; ?></td>
<td ><?php echo $drop_service; ?></td>

</tr>
<?php } ?>
<tr>
<th colspan="3" align="center">Total</th>
<th align="center"> <?php echo $total_rooms; ?></th>
<th colspan="7"> </th>
</tr>
<caption align="bottom"></caption><br />
</tbody>
</table>


<br />
<font style="font-size:18px; font-weight:500;"><u> <b>Special Instructions:</b></u>  <?php echo ucwords($client_remarks); ?></font><br />
VIP Handling:
<br />
<font style="font-size:18px; font-weight:500;"><u> <b>Above Rates are Inclusive of Following Privileges</b></u></font><br />
<div style="background:; width:auto; height:auto; float:left; margin:5px; ">
<ul type="disc">
<li><i>Airport pick up & Drop <b>(prior to advance flight detail)</b></i></li>
<li><i>Buffet Breakfast at coffee shop.</i></li>
<li><i>Welcome Drink upon arrival.</i></li>
<li><i>Fruit Baskets in room.</i></li>
<li><i>Complimentary Tea & Coffee in Deluxe Premium <br />
Non-Smoking and Suite Room.</i></li>
</ul></div>
<div style="background:; width:auto; height:auto; float:left; margin:5px; ">
<ul type="disc">
<li><i>Most of the Deluxe , Premium Non-Smoking <br /> and Suite rooms are facing Margalla Hills.</b></i></li>
<li><i>Free use of Health club & Gym.</i></li>
<li><i>Daily Newspaper.</i></li>
<li><i>Late Check out till 3:00pm if Available.</i></li>
</ul></div>
<div style="clear:both"></div>
 <font style="margin-left:26px; font-size:24px;">Note:</font><br />
<div style="background:; width:100%; height:auto; float:left; margin:5px; border:solid 1px; border-size:1px;">


<table align="center">
<tr>
<td style="border:solid 1px; width:100%;">CHECK-IN TIME: 12:00 Noon.  <font style="margin-left:300px;">CHECK-OUT TIME: 12:00 Noon</font><br />
In case of late Check-out after 5:00pm One Night [Room Rent + Tax] will be charged.
</td>
</tr>
<tr>
<td style="border:solid 1px; width:100%;">In case of Early Check In, <b>Previous night will be charged</b></td>
</tr>
<tr>
<td style="border:solid 1px; width:100%;"><b>Extension in stay, prior to advance notice and subjected to availability of room.</b></td>
</tr>
</table>


 <center><font style=" font-size:24px;">Un-guaranteed Reservations will be held till 04:00pm on arrival date</font></center><br />
 <center><font style=" font-size:18px;"><u>Please Guarantee this reservation to avoid inconvenience.</u></font></center><br />
 <center><font style=" font-size:14px; line-height:1px;">(Must be return to hotel after completion)</font></center><br />
<font style=" font-size:18px; margin-left: 50px;"> <u>In case of No-Show of guests, amount Equivalent to one night room rent will be charged.</u></font><br />
<font style=" font-size:12px; margin-left: 50px;">to avoid No-show charges, reservation must be Canceled at least 48 Hours prior to arrival date.</font> <br /><br />
<div style="border: solid 1px ; padding-left:5px; margin-left:50px; width:695px; ">
I wish to guaranteed the reservation and agree with conditions mentions above.
</div>
<div style="border: solid 1px; margin: 2px 0 2px 50px; width:700px; text-align:left; font-size:18px;">
&nbsp;&nbsp;&nbsp;NAME: <font style="margin-left:300px;">SIGNATURE:</font>
</div>
<div style="border: solid 1px; margin-left:50px; width:700px; text-align:left; font-size:18px;">&nbsp;&nbsp;&nbsp;DESIGNATION:<font style="margin-left:245px;">STAMP:</font></div>
<br />
<font style="font-size:18px; margin-left: 50px;"> Mode: </font><font style=" font-size:12px; margin-left: 50px;">(Please Tick)</font><br />
<br />
<font style=" font-size:12px; margin-left: 60px;"> Credit Card: </font><font style=" font-size:12px; margin-left: 120px;"> Advance: </font><font style=" font-size:12px; margin-left: 170px;">Bill to Company Letter:</font><br /><br />
<font style=" font-size:12px; margin-left: 50px;">Looking forward to welcome you and your guest and extending our utmost professional service.</font><br /><font style=" font-size:12px; margin-left: 50px;">We appreciate your valuable patronage.</font>
<br />
</div>
</div>
<div style="clear:both"></div>

<span id="print_elements">
<?php
$url = Yii::app()->createUrl('ReservationInfo/pdf/'.$res_id);
$baseurl = Yii::app()->baseUrl."/images/pdf.png";
//echo $baseurl;
$img = '<img src="/hotel/images/pdf_icon.png" height="50" width="60" alt="Download as pdf" title="Download as pdf" />';
$link = CHtml::link($img , $url, array('class' => 'hello'));
?>
	

<p align="right"  style="padding-right:150px;">  <?php echo $link; ?> <input type="button" value="Print" onclick="javascript: hideelements(); window.print()" />  </p>

</span>
</div>

<script>
function hideelements(){
document.getElementById('print_elements').style.display = 'none';
}
</script>