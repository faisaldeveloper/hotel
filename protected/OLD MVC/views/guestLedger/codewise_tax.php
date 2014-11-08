<?php

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

		 

//$_SESSION['gst_show'] = 'to do';

$sval = Yii::app()->session['taxcontrol'];

if(isset($sval) && $sval=='ON') $gst_show = " AND gst_show > 0";

else $gst_show = "";



//echo "----".$from_date."----".$to_date;	

//$cd = date("Y-m-d", strtotime($created_date));

$from_date = date("Y-m-d", strtotime($from_date));

$to_date = date("Y-m-d", strtotime($to_date));



$dates = $from_date ."~". $to_date ;

 ?>







<fieldset style="background-color: #CCC">  

  <table width="483" border="0" align="center">

    <tr>

      <td width="51"><strong><?php echo Yii::t('views','Sr#') ?></strong></td>     

      <td width="123" align="left"><strong> <?php echo Yii::t('views','Service Code') ?></strong></td>

      <td width="331" align="left"><strong> <?php echo Yii::t('views','Service Name') ?></strong></td>       

    </tr>

    <?php

	

	

$sql = "select s.service_id, s.service_code, s.service_description FROM hms_services s 

Left JOIN hms_guest_ledger gl ON s.service_id = gl.service_id WHERE c_date BETWEEN '$from_date%' AND '$to_date%' GROUP BY s.service_description ORDER BY s.service_id";

$result = Yii::app()->db->createCommand($sql)->query();



//echo $sql;

$total_record = count($result);

$url = Yii::app()->createUrl('Reports/Codewisesummary2');



    foreach($result as $row){

		$i++;		

		$service_id=$row['service_id'];	

		$service_code=$row['service_code'];

		$service_description=$row['service_description'];			 

	?>

    <tr class="text">

      <td align="left"><?php echo $i;?></td>

      <td align="left"><?php echo $service_code;?></td>

      <td align="left"><a href="<?php echo $url."/id/".$service_id.":".$dates; ?>" target="_blank"> <?php echo $service_description;?> </a></td>         

    </tr>

    <?php } ?>

  </table>

  </fieldset>

 

