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



	 



$result = ReservationInfo::model()->findAll("reservation_id=$res_id and branch_id = $branch_id");



foreach($result as $row){

	 $res_type = $row['res_type'];

	 $company_id = $row['company_id'];

	 		$company=Company::model()->findAll("comp_id =$company_id");

						foreach($company as $comp){

						$company_name = $comp['comp_name'];

						}		

	 $to_person = $row['to_person'];

	 $chkin_date = $row['chkin_date'];

	 $chkout_date = $row['chkout_date'];

	 $c_date = $row['c_date'];

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

	 

	 

	 $drop_service = $row['drop_service'];

	 $drop_flight_name = $row['drop_flight_name'];

	 		if($drop_service=='Y'){

			$dropup = "Yes";	

			$d_flight_info = Flights::model()->findAll("flight_id=$drop_flight_name");

			 foreach($d_flight_info as $d_flight_info){

				 $d_flight_name = $d_flight_info['flight_name'];

				 }

				 $drop_flight_time = $row['drop_flight_time'];

			}else{

				$d_flight_name = "";

				$drop_flight_time = "";

				$dropup = "";

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

	 $client_identity_id = $row['client_identity_id'];

	 $client_identity_no = $row['client_identity_no'];

	 $reservation_status = $row['reservation_status'];

	 $client_remarks = $row['client_remarks'];

	 $room_charges = $row['room_charges'];

	 $discount = $row['discount'];

	 $gst = $row['gst'];

	 $advance = $row['advance'];

	 

}



 ?>

 

<style>

.container_mce{

	margin:auto;

	width:750px;

	min-height:500px;

	font-family:Tahoma, Geneva, sans-serif;

	font-size:11px;

	border: #666 thin ridge;

	line-height:17px;

	}

	strong{

		font-weight:bold;

		color:#006;

		}

	td.mytd{

		border-bottom:1px solid #000;}	

		

	table.tblstyle{

		border-collapse::collapse;}

		table.tblstyleid{

			border: 1px solid #000;

			}



</style>



<div class="container_mce">

  <table width="746" border="0">

    <tr>

      <td width="133" rowspan="2"><img src="<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php echo $hotel_logo_image;?>" />

      

      </td>

      <td width="405">&nbsp;</td>

      <td width="106">&nbsp;</td>

      <td width="74">&nbsp;</td>

    </tr>

    <tr>

      <td align="center"><strong> <?php echo Yii::t('views','Reservation Card') ?> </strong></td>

      <td><strong> <?php echo Yii::t('views','Reservation #:') ?> </strong></td>

      <td><?php echo $res_id;?></td>

    </tr>

    <tr>

      <td colspan="4"><hr /></td>

    </tr>

  </table>

  <p><strong>	<?php echo Yii::t('views','This reservation is only valid subject to receipt of confirmation from the Guest / Company') ?> </strong></p>

  <table width="745" border="0">

    <tr>

      <td width="103"><strong><?php echo Yii::t('views','To:') ?> </strong></td>

      <td width="292" class="mytd">&nbsp;</td>

      <td width="105"><strong><?php echo Yii::t('views','From:') ?> </strong></td>

      <td width="56"><strong><?php echo Yii::t('views','Web:') ?> </strong></td>

      <td width="155" class="mytd"><?php echo $hotel_website;?></td>

    </tr>

    <tr>

      <td><strong><?php echo Yii::t('views','Comapny') ?> </strong></td>

      <td class="mytd"><?php echo $client_mobile;?></td>

      <td width="105" valign="top"><?php echo $hotel_title;?></td>

      <td><strong><?php echo Yii::t('views','Email') ?> </strong></td>

      <td class="mytd"><?php echo $branch_email;?></td>

    </tr>

    <tr>

      <td><strong><?php echo Yii::t('views','Tel:') ?> </strong></td>

      <td class="mytd">&nbsp;</td>

      <td width="105" rowspan="2" valign="top"><?php echo $branch_address;?></td>

      <td><strong><?php echo Yii::t('views','Tel:') ?> </strong></td>

      <td class="mytd"><?php echo $branch_phone;?></td>

    </tr>

    <tr>

      <td><strong> <?php echo Yii::t('views','Fax:') ?> </strong></td>

      <td class="mytd">&nbsp;</td>

      <td><strong> <?php echo Yii::t('views','Fax:') ?> </strong></td>

      <td class="mytd"><?php echo $branch_fax;?></td>

    </tr>

  </table>

  <hr />

  <table width="743" border="1">

    <tr>

      <td width="115" rowspan="2"><strong><?php echo Yii::t('views','Name') ?> </strong></td>

      <td width="64" rowspan="2"><strong><?php echo Yii::t('views','Arrival') ?> </strong></td>

      <td width="90" rowspan="2"><strong><?php echo Yii::t('views','Departure') ?> </strong></td>

      <td width="47" rowspan="2"><strong><?php echo Yii::t('views','Room') ?> </strong></td>

      <td width="75" rowspan="2"><strong><?php echo Yii::t('views','Type') ?> </strong></td>

      <td width="55" rowspan="2"><strong><?php echo Yii::t('views','Rate') ?> </strong></td>

      <td width="54" rowspan="2"><strong><?php echo Yii::t('views','M.O.P') ?> </strong></td>

      <td colspan="4" align="center"><strong><?php echo Yii::t('views','Flight Details') ?> </strong></td>

    </tr>

    <tr>

      <td width="52"><strong><?php echo Yii::t('views','Pick') ?> </strong></td>

      <td width="41"><strong><?php echo Yii::t('views','Time') ?> </strong></td>

      <td width="39"><strong><?php echo Yii::t('views','Drop') ?> </strong></td>

      <td width="41"><strong><?php echo Yii::t('views','Time') ?> </strong></td>

    </tr>

    <tr>

      <td><?php echo $salutation_name."".$client_name?></td>

      <td><?php echo $chkin_date;?></td>

      <td><?php echo $chkout_date;?></td>

      <td>&nbsp;</td>

      <td>&nbsp;</td>

      <td align="right"><?php echo number_format($room_charges,0);?></td>

      <td>&nbsp;</td>

      <td><?php echo $p_flight_name;?></td>

      <td><?php echo $flight_time;?></td>

      <td><?php echo $d_flight_name;?></td>

      <td><?php echo $drop_flight_time;?></td>

    </tr>

    <tr>

      <td>&nbsp;</td>

      <td>&nbsp;</td>

      <td>&nbsp;</td>

      <td>&nbsp;</td>

      <td>&nbsp;</td>

      <td>&nbsp;</td>

      <td>&nbsp;</td>

      <td><strong><?php echo Yii::t('views','Pick') ?> </strong></td>

      <td><?php echo $pickup;?></td>

      <td><strong><?php echo Yii::t('views','Drop') ?> </strong></td>

      <td><?php echo $dropup;?></td>

    </tr>

  </table>

  <p>&nbsp;</p>

  <p>&nbsp;</p>

</div>