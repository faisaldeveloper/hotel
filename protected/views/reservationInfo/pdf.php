<?php
ob_start();
ob_clean();
$res_id =  $_REQUEST['id'];
$user_id = yii::app()->user->id;
$user_name = User::model()->find("id=$user_id")->username;
 
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
 // $hotel_logo_image = Yii::app()->request->baseUrl."/hotel_logos/".$hotel_logo_image;
 //$hotel_logo_image = Yii::app()->request->baseUrl.'/protected/venders/tcpdf/images/'. $hotel_logo_image;
 $hotel_logo_image = Yii::app()->request->baseUrl."/".$hotel_logo_image;
// echo  $hotel_logo_image ; 
//exit;
 //$hotel_logo_image = Yii::app()->request->baseUrl."".$hotel_logo_image;
 

 
Yii::import('application.vendors.*');
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
$original_mem = ini_get('memory_limit');
 ini_set('memory_limit','640M');
 ini_set('max_execution_time', 300);
 
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
	width:760px;
	height: auto;
	margin:auto;
	font-family: Calibri;
	font-size: 11px;
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
}
.contenttable tbody tr td{
font-weight: normal;
}
thead{font-weight: bold;}
</style>

<?php 
$html = '';
$baseurl = Yii::app()->request->baseUrl; 
//$result = ReservationInfo::model()->findAll("reservation_id=$res_id and branch_id = $branch_id");
$result = ReservationInfo::model()->findAll("reservation_id=$res_id and branch_id = $branch_id");
foreach($result as $row){ $res_type = $row['res_type']; $group_name = $row['group_name']; }
if($res_type=="G"){
	//$result = ReservationInfo::model()->findAll("group_name LIKE '$group_name' and branch_id = $branch_id");
	$result = ReservationInfo::model()->findAll("group_name = '$group_name' and reservation_status !=2 and branch_id = $branch_id");
}
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
}
 if($res_type == "I") $restype = "Individual"; else $restype= "Group"; 

 
 if($res_type=='I'){
	 $fn = explode("/", $guest_name);
	 if(count($fn) > 1) $pdf_name = $fn[0];
	 else  $pdf_name = $guest_name;
 
 }
else { $pdf_name =$company_name;}
?>


<?php
$html .='<div id="topheader">
 <span style="margin-right:100px; float:right;"> Confirmation # '. $reservation_id.'</span>
<div style="background: width:auto; height:auto; float:left; margin:0px 0px 0 55px;">';
$html .='<table border="1" width="100%" align="center"><tbody>
<tr align="center">
<td>To:</td>
<td>'. $to_person .'</td>
<td rowspan="5">From <br /> '. ucwords($hotel_title) .'</td>
<td>Web </td>
<td>'. $hotel_website .'</td>
</tr>
<tr align="center">
<td>Company</td>
<td>'. $company_name .'</td>
<td>Email</td>
<td>'. $branch_email .'</td>
</tr>
<tr align="center">
<td>Tel:</td>
<td>'. $company_phone .'</td>
<td>Tel:</td>
<td>'. $branch_phone .'</td>
</tr>
<tr align="center">
<td>Fax:</td>
<td>'. $company_fax .'</td>
<td>Fax:</td>
<td>'. $branch_fax .'</td>
</tr></tbody></table>';
$html .= '<p>This reservation is only valid subject to receipt of confirmation from the Guest / Company</p>';



$html .='<table border="1" width="100%" align="center" class="contenttable">
<thead>
<tr>
<th  rowspan="2">Guest Name</th>
<th  rowspan="2">Arrival Date</th>
<th  rowspan="2">Departure Date</th>
<th  rowspan="2">Rms#</th>
<th  rowspan="2">Room Type</th>
<th  rowspan="2">Room<br />Rate</th>
<th  rowspan="2">Mode of payment</th>
<th  colspan="4">Flight Details</th>
</tr>
<tr align="center">
<th>Flight</th>
<th >Pick</th>
<th>Flight</th>
<th >Drop</th>
</tr>
</thead>
<tbody>';
$total_rooms = count($result);
foreach($result as $row){
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
			$client_remarks = $row['client_remarks'];	
					
			//if(strlen($flight_name) > 10)$flight_name				
			$flight_time2 = explode(":", $flight_time);
			if(count($flight_time2) > 2) $flight_time = $flight_time2[0].":".$flight_time2[1];
			$drop_flight_time2 = explode(":", $drop_flight_time);
			if(count($drop_flight_time2) > 2) $drop_flight_time = $drop_flight_time2[0].":".$drop_flight_time2[1];
			
			if($pick_service=='N')$flight_time = '';
			if($drop_service=='N')$drop_flight_time = '';
			
			$mode_of_payment = $row['mode_of_payment'];
			if($mode_of_payment==1)$mode_of_payment = "Cash/Credit Card";
			if($mode_of_payment==2) $mode_of_payment = "BTC";	
		
			
$html .='<tr align="center">
<td >'.  $salutation_name." ". strtoupper(strtolower($guest_name)).' </td>
<td >'.  date("d/m/y", strtotime($chkin_date)).' </td>
<td >'.  date("d/m/y", strtotime($chkout_date)).' </td>
<td >1</td>
<td >'.  $room_name.' </td>
<td >'.  $room_rate.'  + Tax</td>
<td >'.  $mode_of_payment.' </td>
<td >'.  $pick_service.' </td>
<td >'.  $flight_name. ' '.$flight_time.' </td>
<td >'.$drop_service.'</td>
<td >'.$drop_flight_time.' '.$drop_flight_time.' </td>
</tr>';
}

$html .='<tr>
<td colspan="3" align="center">Total</td>
<td align="center"> '. $total_rooms.'</td>
<th colspan="7"> </th>
</tr>
<caption align="bottom"></caption><br />
</tbody>
</table>';


$html .='<br />
<font style="font-size:18px; font-weight:500;"><u><b>Special Instructions:</b></u>  '. ucwords($client_remarks).'</font><br />
VIP Handling:
<br />
<font style="font-size:18px; font-weight:500;"><u> <b>Above Rates are Inclusive of Following Privileges</b></u></font><br />

<table>
<tr>
<td> Airport pick up & Drop <b>(prior to advance flight detail)</b></td>
<td> Most of the Deluxe , premium Non-Smoking and Suite rooms are facing Margalla Hills.</td>
</tr>
<tr>
<td> Buffet Breakfast at coffee shop.</td>
<td> Free use of Health club & Gym.</td>
</tr>
<tr>
<td> Welcome Drink upon arrival.</td>
<td> Daily Newspaper.</td>
</tr>
<tr>
<td> Fruit Baskets in room.</td>
<td> Late Check out till 3:00pm if Available.</td>
</tr>
<tr>
<td> Complimentary Tea & Coffee in Deluxe Premium Non-Smoking and Suite Room.</td>
<td> &nbsp; </td>
</tr>
</table>


<div style="clear:both"></div>
 <font style="margin-left:26px; font-size:24px;">Note:</font><br />
<div style="background:; width:100%; height:auto; float:left; margin:5px; border:solid 1px; border-size:1px;">


<table>
<tr>
<td>CHECK-IN TIME: 12:00 Noon.  <font style="margin-left:300px;">CHECK-OUT TIME: 12:00 Noon</font><br />
In case of late check-out after 5:00pm One Night Room + Tax will be charged.
</td>
</tr>
<tr>
<td style="border:solid 1px; width:100%;">In case of Early Check In, <b>Previous night will be charged</b></td>
</tr>
<tr>
<td style="border:solid 1px; width:100%;"><b>Extension in stay, prior to advance notice and subjected to availability of room.</b></td>
</tr>
</table>';

$html .='<center><font style=" font-size:24px;">Un-guaranteed Reservations will be held till 04:00pm on arrival date</font></center><br />
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
<div style="clear:both"></div>';
?>
<?php
 class MYPDF extends TCPDF {	
	public function Footer() {		
		$this->SetY(-15); 
		$this->SetFont('helvetica', 'I', 8);		
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Faisal Shahzad');
$pdf->SetTitle('CP Reports');
$pdf->SetSubject('Hotel Reports');
$pdf->SetKeywords('Hotel, reservations, reports');
//121108102737l1.jpeg
$logo_img = "121108102737l1.jpg";
$logo_img =$hotel_logo_image;
$pdf->SetHeaderData($logo_img, '20', 'Hotel Crown Plaza', "ROOM RESEVATION CONFIRMATIOM");
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);
$pdf->SetFont('times', '', 10);
//$pdf->AddPage();
$page_format = array(
	'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 297),
	'CropBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 297),
	'BleedBox' => array ('llx' => 5, 'lly' => 5, 'urx' => 205, 'ury' => 292),
	'TrimBox' => array ('llx' => 10, 'lly' => 10, 'urx' => 200, 'ury' => 287),
	'ArtBox' => array ('llx' => 15, 'lly' => 15, 'urx' => 195, 'ury' => 282),
	'Dur' => 3,	
	'trans' => array('D' => 1.5,'S' => 'Split','Dm' => 'V','M' => 'O'),
	//'Rotate' => 90,
	'PZ' => 1,
);
ob_start();
$pdf->AddPage('L', $page_format, false, false);
$pdf->writeHTML($html, true, false, true, false, ''); 
$repdate = $pdf_name. date("Hi");
//Close and output PDF document
$pdf->Output('pdf_files/'.$repdate.'.pdf', 'FD');
ini_set('memory_limit',$original_mem);
?>
