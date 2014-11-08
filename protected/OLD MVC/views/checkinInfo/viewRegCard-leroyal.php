<?php
$chkin_id =  $_REQUEST['id'];
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
$result = CheckinInfo::model()->findAll("chkin_id=$chkin_id and branch_id = $branch_id");
foreach($result as $row){
	 $guest_id = $row['guest_id'];
	 		$guest_info = 	GuestInfo::model()->findAll("guest_id=$guest_id");
	 		foreach($guest_info as $r){			
				$salutation_name = 	Salutation::model()->find("salutation_id=". $r['guest_salutation_id'])->salutation_name;			
				$guest_name = $r['guest_name'];
				$guest_address = $r['guest_address'];
				$guest_phone = $r['guest_phone'];
				$guest_mobile = $r['guest_mobile'];			
				$identity_name = Identity::model()->find("identity_id =". $r['guest_identity_id'])->identity_description;
				$guest_identity_no = $r['guest_identity_no'];	
				$guest_identity_issu = $r['guest_identity_issu'];
				$guest_identity_expire = $r['guest_identiy_expire'];		
				$country_name = Country::model()->find("country_id =". $r['guest_country_id'])->country_name;				
				$guest_dob = $r['guest_dob'];			
			}	 
	 
	 $reservation_id = $row['reservation_id'];
	 $chkin_date = $row['chkin_date'];
	 $chkout_date = $row['chkout_date'];	
	 $drop_service = $row['drop_service'];
	 $flight_name = $row['flight_name'];
	 $flight_time = $row['flight_time'];
	 $total_days = $row['total_days'];
	 
	 $cash = $row['cash'];
	 $debit_card = $row['debit_card'];
	 $credit_card = $row['credit_card'];
	 $btc = $row['btc'];
	 
	 if($cash=="Y") $payment_mode .= "Cash";
	 if($debit_card=="Y") $payment_mode .= "/DC";
	 if($credit_card=="Y") $payment_mode .= "/CC";
	 if($btc=="Y") $payment_mode .= "/BTC";
	 
	 $slash = substr($payment_mode, 0,1);
	 if($slash=='/'){ 
	 	$len = strlen($payment_mode);
	 	$n =substr($payment_mode, 1,$len); 
		$payment_mode = $n;
	}
	
	
	 $room_type = HmsRoomType::model()->find("room_type_id =".$row['room_type'])->room_name;	
	 $room_name=RoomMaster::model()->find("mst_room_id =".$row['room_name'])->mst_room_name;	
	 $company_name=Company::model()->find("comp_id =". $row['guest_company_id'])->comp_name;
	 
	 $total_person = $row['total_person'];
	 $total_charges = $row['total_charges'];
	 $amount_paid = $row['amount_paid'];
	 $chkin_user_id = $row['chkin_user_id'];
	 $chkin_id = $row['chkin_id'];
	 $comming_from = $row['comming_from'];
	 $next_destination = $row['next_destination'];
	 $rate = $row['rate'];
	 $gst = $row['gst'];
	 	if($gst=='Y'){$wgst = "With GST";}else{$wgst="Without GST";}
	 $bed_tax = $row['bed_tax']; 
	 
	 $guest_folio_no = $row['guest_folio_no'];
	 $guest_folio_no = str_pad((int)$guest_folio_no,"4","0",STR_PAD_LEFT);
	  $reg_no = $row['reg_no']; 	 
}

$sql = "select MIN(id) from hms_guest_ledger gl where gl.chkin_id = ".$_REQUEST['id'];
$gid = Yii::app()->db->createCommand($sql)->queryScalar();

$sql = "select c_time from hms_guest_ledger gl where gl.id = ".$gid;
$cin_time = Yii::app()->db->createCommand($sql)->queryScalar();
if($cin_time  == '00:00:00') $cin_time = '';

 ?>
 
 <style type="text/css">
.container{
width:700px;
margin:0 auto;
padding:5px 5px 0px 5px;
margin-top:-10px;
height:970px;
border: 1px solid;
/* background: #6699FF; */
}

.topheader{
	width:694px;
	height:100px;
	margin:auto;
	font-family:"Book Antiqua";
	color:black;
	
}
.header-left{
width:200px;
float:left;
padding:3px;
font-weight:300;
margin-top:7px;
margin-left:1px;
font-size:12px;
}

.header-mid{
width:250px;
float:left;
text-align:center;}

.header-right{
width:230px;
float:left;
margin-top:7px;
text-align:right;
padding:3px;
font-weight:300;
font-size:12px;}

.text-area{
width:690px;
margin:auto;
margin:-7px 3px;
font-family:"Lucida Handwriting";
font-size:14px;
text-align:justify;

}
.terms{
width:695px;
margin:auto;
padding-bottom:0px;
font-style:italic;
font-weight:700;
font-family:"Book Antiqua";
font-size:13px;

}
.terms ul li{
list-style-type: decimal;
}

.form{
width:694px;
margin:auto;
font-size:14px;
}
.sign{
width:694px;

}
.sign p{
float:right;
padding:20px 38px;
font-size:14px;
}

td.mytd {
	padding-top: 10px;
    border-bottom: 1px solid #000000;
}	
  </style>
</head>
 
<div class="container_mce">
  <div class="container">
<div class="topheader">
<div class="header-left">
House No.10, Street No.38.<br />
F-8/1, Islamabad.<br />
Ph: 051-2261168, 051-2261170<br />
Fax:051-2261169
</div>

<div class="header-mid"><img src="<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/le-royal.png" /></div>

<div class="header-right">
House No.2, Street No.57,<br />
F-8/4, Islamabad.<br />
Ph: 051-2287815, 051-2287816<br />
Fax: 051-2287817
</div>
</div><!--topheader close!-->
<div class="text-area">
<p>Rules of the LE Royal Guest House which are read/understood and signed by the guest, who wishes to stay in it. The Guest is bound to observe the following LE Royal Guest House Rules after signing the said Card:</p>
</div>
<div class="terms">
<ul>
<li> At the time of check in, Guests are requested to prove their identity.</li>
<li> Rights of admission are reserved.</li>
<li> No illegality is allowed against the law of the Land.</li>
<li> Immoral activities are strictly prohibited.</li>
<li> Check out time is 12:00 Noon.</li>
<li> Advance rent will be paid at the time of check in.</li>
<li> Cheques are not acceptable, only cash is accepted.</li>
<li> Bills are to be paid on presentation. No baggage is to be removed from the room until the bills are completely settled.</li>
<li> Lady visitor is not allowed to visit single person's room, staying as a Guest and Vice versa.<br />They are only allowed to see each other in the lobby area.</li>

<li> Visitors are not allowed to visit Guests in Guest House after 11 PM.</li>
<li> No percious things or cash will be left in the room while leaving the room and should be kept in personal custody and in case of any theft, burglary or any mishap, the Management, will not be resonsible.</li>
<li> If the car of any Guest is stolen from parking lot, the Management will not be responsible.</li>
<li> The Management is in no way responsible for any accident or even death.</li>
<li> Please keep the room unlocked from inside, except during night or resting intervals.</li>
<li> Ironing not allowed in any case, for ironing call ext.0 for Room Service.</li>
<li> Damages Caused by the Guest to the Guest House Building and other articles, belongings of the Guest House, will be charged from the Guest on prevailing market price.</li>
<li> Guests are requested to refrain from playing music in loud voice or have parties in their rooms.</li>
<li> Please switch off all electrical appliances and hand over your room key at the Reception when you leave.</li>

</ul></div>


<?php $spaces1 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; 
$spaces = $spaces1.$spaces1; ?>

<div class="form">
<table width="90%" style="margin-left:30px;">
<tr>
<td class="mytd"><b> Guest Name (In capital)</b> <?php echo strtoupper(strtolower($guest_name));?></td>
</tr>
<tr>
<td class="mytd"><b> Adress. </b> <?php echo ucwords($guest_address);?></td>
</tr>
<tr>
<td class="mytd"><b> Telephone.</b> <?php echo $guest_mobile.$spaces1;?><b> Identity Card No. </b> <?php echo $guest_identity_no;?></td>
</tr>
<tr>
<td class="mytd"><b> Email.</b>&nbsp;<?php echo $guest_address;?></td>
</tr>
<tr>
<td class="mytd"><b> Mobile No.</b> <?php echo $guest_mobile;?></td>
</tr>
<tr>
<td class="mytd"><b> Passport No.</b> <?php echo $passport_no.$spaces1;?><b> Date/Place od Issue</b> <?php echo $place_of_issue;?></td>
</tr>
<tr>
<td class="mytd"><b> Nationality.</b> <?php echo $country_name.$spaces1;?><b> Profession.</b> <?php if(!empty($prof)) echo $prof; else echo $spaces; ?><b>  Room.</b> <?php echo $room_name;?> </td>
</tr>
<tr>
<td class="mytd"><b> No of Persons accompanying.</b> <?php echo $total_person;?> Person(s)<?php echo $spaces1; ?><b> Purpose of Visit. </b> <?php //echo $comming_from;?> </td>
</tr>
<tr>
<td class="mytd"><b> Coming from.</b> <?php if(!empty($comming_from)) echo $comming_from; else echo $spaces; ?> <b> Relation. </b> <?php echo $relation;?> </td>
</tr>
<tr>
<td class="mytd"><b> Check in Date. </b> <?php echo $chkin_date.$spaces1;?><b> Time. </b> <?php echo $cin_time;?></td>
</tr>
<tr>
<td class="mytd"><b> Check Out Date.</b> <?php echo $chkout_date.$spaces1;?><b> Time.</b> <?php echo $chkout_time;?> </td>
</tr>
<tr>
<td class="mytd"><b> Mode od Payment. </b> <?php echo $payment_mode;?></td>
</tr>
</table>
</div>

<div style="padding-top:20px; float:left; padding-left:30px;"> <input type="button" value="Print" onclick="javascript: window.print() " />    </div>


<div class="sign"><p>Signature of Guest.____________________</p></div>

</div><!--container close!-->



  </div>  
   

