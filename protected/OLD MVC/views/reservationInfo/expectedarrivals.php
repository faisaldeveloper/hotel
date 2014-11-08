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





//print_r($data);

$from_date1 = $data['from_date'];

$to_date1 = $data['to_date'];









$result = ReservationInfo::model()->findAll("chkin_status='N' and reservation_status = '1' and chkin_date between '$from_date1' and '$to_date1' and branch_id = $branch_id");



$total_record = count($result);

	 



 ?>

 

<style>

.container_mce{

	margin:auto;

	width:850px;

	min-height:500px;

	font-family:Tahoma, Geneva, sans-serif;

	font-size:15px;

	border: #666 thin ridge;

	line-height:17px;

	}

	strong{

		

		color:#006;

		}

	td.mytd{

		border-bottom:1px solid #000;}	

		

	table.tblstyle{

		border-collapse::collapse;}

		table.tblstyleid{

			border: 1px solid #000;

			}

	td.text{

		font-size:9px;

		}		



</style>



<div class="container_mce">

  <table width="846" border="0">

    <tr>

      <td width="132" rowspan="3"><img src="<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php echo $hotel_logo_image;?>" alt="" /></td>

      <td colspan="5">&nbsp;</td>

      <td>&nbsp;</td>

    </tr>

    <tr>

      <td colspan="5" align="center"><strong>Expected Arrivals Report</strong></td>

      <td><?php echo $hotel_title;?></td>

    </tr>

    <tr>

      <td width="71" align="left">&nbsp;</td>

      <td width="89" align="right"><?php echo $from_date1;?></td>

      <td width="56" align="center"><strong>To:</strong></td>

      <td width="99" align="left"><?php echo $to_date1;?></td>

      <td width="81" align="center">&nbsp;</td>

      <td><?php echo $branch_address;?></td>

    </tr>

    <tr>

      <td colspan="7"><hr /></td>

    </tr>

  </table>

  <table width="843" border="0">

    <tr>

      <td width="23"><strong>Sr:</strong></td>

      <td width="175"><strong>Guest Name</strong></td>

      <td width="149"><strong>Comapny</strong></td>

      <td width="100"><strong>Contact</strong></td>

      <td width="94"><strong>Arrival</strong></td>

      <td width="97"><strong>Check Out</strong></td>

      <td width="43"><strong>Pick</strong></td>

      <td width="69"><strong>Flight</strong></td>

      <td width="55"><strong>Time</strong></td>

    </tr>

    <?php

    foreach($result as $row){

		$i++;

	 $res_type = $row['res_type'];

	 $company_id = $row['company_id'];

	 		$company=Company::model()->findAll("comp_id =$company_id");

						foreach($company as $comp){

						$company_name = $comp['comp_name'];

						}

		

		

	

	 $chkin_date = $row['chkin_date'];

	 $chkout_date = $row['chkout_date'];

	 

	 $total_days = $row['total_days'];

	 

	 $pick_service = $row['pick_service'];

	 $flight_name = $row['flight_name'];

	 		

			if($pick_service=='Y'){

				$pickup = "Yes";

			$p_flight_info = Flights::model()->findAll("flight_id=$flight_name");

			 foreach($p_flight_info as $p_flight_info){

				 $p_flight_name = $p_flight_info['flight_name'];

				 }

				 $flight_time = $row['flight_time'];

			}else{

				$p_flight_name = "";

				$flight_time = "";

				$pickup = "No";

				}

	 

	 

	 

	 

	 

	 $client_salutation_id = $row['client_salutation_id'];

	 	

				$saluations = 	Salutation::model()->findAll("salutation_id=$client_salutation_id");

				foreach($saluations as $s){

					$salutation_name = $s['salutation_name'];

					}

	 

	 $client_name = $row['client_name'];

	 $client_address = $row['client_address'];

	 $client_country_id = $row['client_country_id'];

	 $client_mobile = $row['client_mobile'];

	 

	 $client_phone = $row['client_phone'];

	 $client_email = $row['client_email'];

	 $client_remarks = $row['client_remarks'];

	 $room_charges = $row['room_charges'];

	 $discount = $row['discount'];

	 $gst = $row['gst'];

	 $advance = $row['advance'];

	?>

    <tr class="text">

      <td><?php echo $i;?></td>

      <td><?php echo $salutation_name.ucwords($client_name);?></td>

      <td><?php echo $company_name;?></td>

      <td><?php echo $client_mobile;?></td>

     <td><?php echo date("d/m/y",strtotime($chkin_date));?></td>

      <td><?php echo date("d/m/y",strtotime($chkout_date));?></td>

      <td><?php echo $pickup;?></td>

      <td><?php echo $p_flight_name;?></td>

      <td><?php echo $flight_time;?></td>

    </tr>

    <?php } ?>

  </table>

  <hr />

  <br />

  <p><strong>Total Reservations: <?php echo $total_record;?></strong></p>

  

  <p align="right" style="padding-right:10px;"> <input type="button" value="Print" onclick="printpage()" />    </p>

    <script> function printpage(){window.print()}</script>

</div>



