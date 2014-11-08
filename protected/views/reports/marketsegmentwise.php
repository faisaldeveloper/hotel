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
$from_date1 = $data['from_date'];
$to_date1 = $data['to_date'];
$dates = " AND ci.chkin_date BETWEEN '$from_date1' AND '$to_date1' ";
if(isset($from_date1) and isset($to_date1)){		 
		 $showdate="<br/> From:  ".date("d/m/y H:i", strtotime($from_date1))."\t TO:  ".date("d/m/y H:i", strtotime($to_date1));
		 }

$sql = "select co.comp_id, co.comp_name from hms_checkin_info ci LEFT JOIN hms_company_info co ON ci.guest_company_id = co.comp_id where 1 ". $dates ." GROUP BY co.comp_id";
 
$result = Yii::app()->db->createCommand($sql)->queryAll();
$total_record = count($result);
 ?>
<div class="container_mce">
  <table width="100%" border="0">
 <!--
  <tr>
    <td rowspan="3">&nbsp;</td>
    <td rowspan="3"><img src="<?php //echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php //echo $hotel_logo_image;?>" height="98px" width="75px" /></td>
    <td colspan="3" align="center">&nbsp;<font size="+2"><strong><?php //echo ucwords($hotel_title); ?></strong></font></td>
    
    <td rowspan="3"><strong>Date</strong></td>
    <td rowspan="3"><?php //echo date('j F, Y H:i:s');?></td>
  </tr>
-->
  <tr>   
    <td colspan="3" align="center" style="font-size: 12px;"><strong>MARKET SEGENT REPORT COMPANY WISE</strong></td>    
  </tr>
  <tr>      
    <td colspan="3" align="center" style="font-size: 10px;"><strong><?php echo $showdate; ?></strong></td>   
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
  
  
  <table width="100%" border="0">
    <tr style="background-color:#CCC; border:solid 1px;">
      <td><strong>Sr#</strong></td>
      <td><strong>Company Name </strong></td>
      <td><strong>Total Nights</strong></td>
      <td align="right"><strong>Room Charges</strong></td>
      <td align="right"><strong>Other Charges</strong></td>
      <td align="right"><strong>Total</strong></td>
      <td><strong></strong></td>      
    </tr>
    <?php
	$dates =  " AND chkin_date BETWEEN '$from_date1' AND '$to_date1'";
	$g_total = 0; $g_total_days =0; $g_room_rent =0; $g_other = 0; $gg_total =0; 
    foreach($result as $row){
		$i++;
		 $comp_id = $row['comp_id'];
		 $company_name = $row['comp_name']; 
		 $sql = "select SUM(total_days) as toal_nights from hms_checkin_info where guest_company_id = $comp_id". $dates;		 
		 $total_days = Yii::app()->db->createCommand($sql)->queryScalar();	
		 
		 $sql = "select SUM(debit) as room_rent from hms_guest_ledger where (service_id = 1 || service_id = 2 || service_id = 21) AND company_id = $comp_id ".$dates;		 
		 $room_rent = Yii::app()->db->createCommand($sql)->queryScalar();		 
		 
		  $sql = "select SUM(debit) from hms_guest_ledger where (service_id != 1 AND service_id != 2 AND service_id != 21) AND company_id = $comp_id ".$dates;		 
		 $other_charges = Yii::app()->db->createCommand($sql)->queryScalar();
		 
		 $g_total_days +=$total_days;
		 $g_room_rent +=$room_rent;
		 $g_other +=  $other_charges;
		 $g_total = $room_rent  + $other_charges;
		 $gg_total +=$g_total;
	?>
    <tr class="text">
      <td><?php echo $i;?></td>
      <td><?php echo ucwords(strtolower($company_name));?></td>
      <td><?php echo $total_days;?></td>
      <td align="right"><?php echo number_format($room_rent, 2); ?></td>
      <td align="right"><?php echo number_format($other_charges, 2) ;?></td>
      <td align="right"><?php echo number_format($g_total, 2); ?></td>
      <td><strong></strong></td>  
    </tr>
    <?php } ?>
    
     <tr class="text" style="background-color:#CCC; border:solid 1px;">
      <td><b>GRAND TOTAL</b></td>
      <td><b><?php echo $i;?> Companies</b></td>
      <td><b><?php echo $g_total_days;?> Nights</b></td>
      <td align="right"><b><?php echo number_format($g_room_rent, 2); ?></b></td>
      <td align="right"><b><?php echo number_format($g_other, 2) ;?></b></td>
      <td align="right"><?php echo number_format($gg_total, 2); ?></td>
      <td ></td>  
    </tr>
    
  </table>
  <div style="clear:both"></div>
 
  
  <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>