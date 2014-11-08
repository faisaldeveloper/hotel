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

$gl_res = GuestLedger::model()->findAll(" room_status !='O' and chkin_date between '$from_date1' and '$to_date1' and branch_id = $branch_id");



	//echo "<br>--".$gl_res->guest_name;

	//echo "<br>--".$gl_res->chkin_date;

	//echo "<br>--".$gl_res->company_id;



////////// end of code





//$result = ReservationInfo::model()->findAll("chkin_status='N' and reservation_status = '1' and chkin_date between '$from_date1' and '$to_date1' and branch_id = $branch_id");





	//echo "--bb-".$total_record; 



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

    <td colspan="3" align="center"><strong>Sales Person Wise Report</strong></td>

  </tr>

</table>

  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>

  

  

  <table width="100%" border="0">

    <tr>

      <td align="center"><strong>S.No</strong></td>

      <td align="center"><strong>Sales Person Name</strong></td>

      <td align="center"><strong>Sales Person Id</strong></td>

       

       <td align="center"><strong>No Of Resrvation.</strong></td>

       

           

     

      

       

     

     

    </tr>

    <?php

$from_date1 = $data['from_date'];

$to_date1 = $data['to_date'];

	$gl_res = SalePerson::model()->findAll("branch_id = $branch_id  ");

$total_record = count($gl_res);

    foreach($gl_res as $row){

		$i++;

		$Sale_person_id = $row['sale_person_id'];

		$sale_person_name = $row['sale_person_name'];

	 		$record=ReservationInfo::model()->findAll("sale_person_id =$Sale_person_id");

			$total_reservation= count($record);

	

	?>

    <tr class="text">

      <td align="center"><?php echo $i;?></td>

       <td align="center"><?php echo $sale_person_name;?></td>

        <td align="center"><?php echo $Sale_person_id;?></td>

        <td align="center"><?php echo $total_reservation; ?></td>

       <!-- <td><?php echo $person; ?></td>

         <td><?php echo $company_name;?></td>

          <td><?php echo $mst_room_status;?></td>

         <td><?php echo date("d/m/y",strtotime($chkin_date));?></td>

       <td><?php echo date("d/m/y",strtotime($chkout_date));?></td>-->

     

     

      

     <td><?php echo  $client_remark;?></td>

     

     

      

     

    </tr>

    <?php } ?>

  </table>

  <div style="clear:both"></div>

 

  

  <p align="right" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>

    

</div>



