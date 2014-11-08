<?php
/*
Following is the code to import smarty templates
*/
Yii::import('application.vendors.Smarty.libs.*');
require 'Smarty.class.php';

$smarty = new Smarty;

/* $smarty->assign('hello','Hello World, this is my first Smarty!');
$smarty->assign('foo','this is message');

$template_string='{$hello}';
echo $smarty->fetch('string:'.$template_string); */



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
$smarty->assign('branch_address',$branch_address);
$smarty->assign('branch_phone',$branch_phone);
$smarty->assign('branch_fax',$branch_fax);
$smarty->assign('hotel_title',$hotel_title);
$smarty->assign('hotel_website',$hotel_website);
$smarty->assign('hotel_logo_image',$hotel_logo_image);



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


//More smarty assignments
$smarty->assign('base_url',Yii::app()->baseUrl);


$smarty->assign('salutation_name',$salutation_name);
$smarty->assign('guest_name',strtoupper(strtolower($guest_name)));
$smarty->assign('guest_address',ucwords($guest_address));
$smarty->assign('guest_phone',$guest_phone);
$smarty->assign('guest_mobile',$guest_mobile);
$smarty->assign('identity_name',$identity_name);
$smarty->assign('guest_identity_no',$guest_identity_no);
$smarty->assign('guest_identity_issu',$guest_identity_issu);
$smarty->assign('guest_identity_expire',$guest_identity_expire);
$smarty->assign('country_name',$country_name);
$smarty->assign('guest_dob',$guest_dob);

$smarty->assign('chkin_date',$chkin_date);
$smarty->assign('chkout_date',$chkout_date);
$smarty->assign('drop_service',$drop_service);
$smarty->assign('flight_name',$flight_name);
$smarty->assign('flight_time',$flight_time);
$smarty->assign('total_days',$total_days);
$smarty->assign('guest_dob',$guest_dob);

$smarty->assign('payment_mode',$payment_mode);
$smarty->assign('room_type',$room_type);
$smarty->assign('room_name',$room_name);

$smarty->assign('room_type',$room_type);
$smarty->assign('room_name',$room_name);
	  
$smarty->assign('total_person',$total_person);
$smarty->assign('total_charges',$total_charges);
$smarty->assign('amount_paid',$amount_paid);
$smarty->assign('chkin_id',$chkin_id);

$smarty->assign('next_destination',$next_destination);
$smarty->assign('rate',$rate);

$smarty->assign('gst',$gst);
$smarty->assign('wgst',$wgst);
$smarty->assign('bed_tax',$bed_tax);
$smarty->assign('guest_folio_no',$guest_folio_no);
$smarty->assign('reg_no',$reg_no);

$smarty->assign('cin_time',$cin_time);

$spaces1 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; 
$spaces = $spaces1.$spaces1;
$smarty->assign('spaces',$spaces);

$smarty->assign('company_name',$company_name);
if(empty($prof)) $prof= $spaces;
$smarty->assign('prof',$prof);
if(empty($comming_from)) $comming_from=$spaces;
$smarty->assign('comming_from',$comming_from);


$str = '<div class="header-mid"><img src="{$base_url}/hotel_logos/le-royal.png" /></div>';

$temp = Yii::app()->db->createCommand("select contents from templates where id = 1")->queryScalar();
echo $smarty->fetch('string:'.$temp); 
//$smarty->display('templates/site/test.tpl');

 ?>
