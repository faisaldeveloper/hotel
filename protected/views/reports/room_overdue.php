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
if(isset($sval) && $sval=='ON') $gst_show = " AND cin.gst_show > 0";
else $gst_show = "";
//echo "----".$created_date;	
$cd = date("Y-m-d").' 00:00:00';
 ?>
 
 <style>
 td{
	 border-bottom:solid 1px !important;
	 
 }
 </style>
 
 
<div class="container_mce">
  <table  width="100%" border="0">
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
    <td colspan="3" align="center" style="font-size: 12px; border-color:#FFF !important"><strong>ROOM OVERDUE REPORT</strong></td>    
  </tr>
  <tr>      
    <td colspan="3" align="center" style="font-size: 10px; border-color:#FFF !important"><strong><?php echo $showdate; ?></strong></td>   
  </tr>
</table>

  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
 
 <table align="center" width="100%" border="0">
    <tr>
      <td ><strong></strong></td> 
      <td><strong>Folio</strong></td>     
      <td align="left"><strong>Room</strong></td>
      <td align="left"><strong>Guest Name</strong></td>
      <td align="left"><strong>Company</strong></td>
      <td align="left"><strong>Arival</strong></td>
      <td align="left"><strong>Departure</strong></td>
      <td align="left"><strong>MOP</strong></td>
      <td align="right"><strong>Receivable</strong></td>
      <td align="right"><strong>Received</strong></td>
      <td align="right"><strong>Balance</strong></td>     
    </tr>
    <?php 				
		$sql="SELECT rm.mst_room_name as name, gl.chkin_id,gl.chkin_date,gl.chkout_date,ci.comp_name, cin.cash, cin.debit_card, cin.credit_card, cin.btc, cin.guest_folio_no, gl.guest_name ,sum(debit) as receivable,sum(credit) as received FROM `hms_guest_ledger` gl left join hms_room_master rm on gl.room_id=rm.mst_room_id left join hms_checkin_info cin on gl.chkin_id = cin.chkin_id left join hms_company_info ci on  gl.company_id = ci.comp_id where cin.chkout_status='N' ".$gst_show." group by gl.chkin_id order by rm.mst_room_name ASC";
		
		$res = Yii::app()->db->createCommand($sql)->query();
		//echo $sql;
		$i=$grand_total = $grand_receivable=$grand_received=0;
		foreach($res as $row){ 
		$i++;
		$room_name = $row['name'];
		$total_amount = (int)$row['receivable']-(int)$row['received'];
		$grand_receivable += (int)$row['receivable'];
		$grand_received += (int)$row['received'];
		$grand_total += $total_amount;
		
		
		$checkid = $row['chkin_id'];		
		$q = "select mst_room_name from hms_room_master where mst_room_id =(select room_id from hms_guest_ledger where id = (select MAX(id) from hms_guest_ledger where chkin_id = '$checkid'))";		
		$room_name = Yii::app()->db->createCommand($q)->queryScalar();
		
		 $cash = $row['cash'];
		 $debit_card = $row['debit_card'];
		 $credit_card = $row['credit_card'];
		 $btc = $row['btc'];
		 $guest_folio_no = $row['guest_folio_no'];
		 
		 $payment_mode ='';
		 if($cash=="Y") $payment_mode .= "Cash";
		 if($debit_card=="Y") $payment_mode .= "/DC";
		 if($credit_card=="Y") $payment_mode .= "/CC";
		 if($btc=="Y") $payment_mode .= "/BTC";
		 
		 $payment_mode = ltrim($payment_mode,"/");
		 
		 $guest_folio_no = str_pad((int)$guest_folio_no,"4","0",STR_PAD_LEFT);
	?>
    
     <tr>
      <td>&nbsp;</td> 
      <td><?php echo $guest_folio_no; ?></td>     
      <td align="left"><?php echo $room_name; ?></td>
      <td align="left"><?php echo strtoupper($row['guest_name']); ?></td>
      <td align="left"><?php echo $row['comp_name']; ?></td>
      <td align="left"><?php echo date('d/m/y',strtotime($row['chkin_date'])); ?></td>
      <td align="left"><?php echo date('d/m/y',strtotime($row['chkout_date'])); ?></td>
      <td align="left"><?php echo $payment_mode; ?></td>
      <td align="right"><?php echo number_format($row['receivable'], 2); ?></td>
      <td align="right"><?php echo number_format($row['received'], 2); ?></td>      
      <td align="right"><?php echo number_format($total_amount, 2); ?></td>     
    </tr>
    <?php } ?>
   
    <tr>
      <td colspan="8" align="center"><strong>Grand Total</strong></td>
      <td align="right"><strong><?php echo number_format($grand_receivable, 2); ?></strong></td>
      <td align="right"><strong><?php echo number_format($grand_received, 2); ?></strong></td>
      
      <td align="right"><strong><?php echo number_format($grand_total, 2); ?></strong></td>     
    </tr>
    
    
    </table>
 <div style="clear:both"></div>   
  
  <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>