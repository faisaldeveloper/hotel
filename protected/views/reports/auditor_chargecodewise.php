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
$sql = "select active_date from day_end where branch_id = $branch_id";
//for previous date report by imdad
if(isset($_GET['date'])){
$business_date = $_GET['date'];	
}else{
$business_date = Yii::app()->db->createCommand($sql)->queryScalar();
}
///end of code  by imdad
$business_date = $c_date;
$branch_address .= "<br> Phone: $branch_phone Fax: $branch_fax <br> email: $branch_email";
	 $from_date = $_POST[from_date];
	 $to_date = $_POST[to_date];
	 if(isset($from_date) and isset($to_date)){
		 
		 $showdate="<br/> From:  ".date("j F, Y H:i", strtotime($from_date))."\t TO:  ".date("j F, Y H:i",strtotime($to_date));
		 }
		 
//$_SESSION['gst_show'] = 'to do';
$sval = Yii::app()->session['taxcontrol'];
if(isset($sval) && $sval=='ON') $gst_show = " AND ci.gst_show > 0";
else $gst_show = "";
/////////////////////////
	 $sName = Yii::app()->db->createCommand("select service_description From hms_services where service_id = $service_id")->queryScalar();
	 $order_by = Yii::app()->db->createCommand("select order_by From hms_services where service_id = $service_id")->queryScalar();
	 if($order_by==NULL) $order_by = "room_id";
 //////////////////////////////////
 $sql = "";
	 /*  $sql = "select gl.*, ci.guest_folio_no, ci.gst_show from hms_guest_ledger gl";
	  $sql .= " Left join hms_checkin_info ci";
	  $sql .= " ON gl.chkin_id = ci.chkin_id";
	  $sql .= " where gl.service_id = $service_id and c_date LIKE '$business_date%'". $gst_show ." ORDER BY gl.".$order_by ." ASC";
	 // echo "$sql<br>"; */
	 
	 $sql = "select gl.*, rm.mst_room_name, ci.guest_folio_no, ci.gst_show from hms_guest_ledger gl";
	  $sql .= " Left join hms_checkin_info ci";
	  $sql .= " ON gl.chkin_id = ci.chkin_id"; 
	  
	  $sql .= " inner join hms_room_master rm";
	  $sql .= " ON rm.mst_room_id = ci.room_id"; 
	 
	 if($service_id == 1 || $service_id == 2 || $service_id == 21)
	  $sql .= " where gl.service_id = $service_id and gl.c_date LIKE '$business_date%'". $gst_show ." ORDER BY ci.room_id ASC";
	 else 
	 $sql .= " where gl.service_id = $service_id and gl.c_date LIKE '$business_date%'". $gst_show ." ORDER BY gl.".$order_by ." ASC";
	//echo "$sql <br>";
	  $result = Yii::app()->db->createCommand($sql)->query();	 
?>
 
 <br />
 <br />
<div class="container_mce">
  <table  width="100%" border="0" style="margin-top:50px;">
  <tr>
    <td rowspan="3">&nbsp;</td>
    <td rowspan="3"></td>
    <td colspan="3" align="center">&nbsp;<font size="+1"><strong><?php echo $sName; ?><?php //echo ucwords($hotel_title); ?></strong></font></td>
    
    <td rowspan="3" valign="top"><strong>Date</strong></td>
    <td rowspan="3" valign="top"><?php echo date('d/m/y H:i:s');?></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong><!--Charge Code-Wise Report ---> <?php //echo $sName; ?></strong></td>
  </tr>
  <tr>    
    <td colspan="3" align="center"><strong><?php //echo "Date : ". date("d/m/y",strtotime($c_date)); ?></strong></td>
  </tr>
</table>
 <!-- <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>-->
<table width="100%" border="1" align="center">
      <tr>        
      	<td><strong>Folio No.</strong></td>   
		<td><strong>Guest Name</strong></td>
        <td><strong>Time</strong></td>
        <td><strong>Voucher #</strong></td>       
		<td><strong>Room</strong></td>
        <td align="center"><strong>Debit</strong></td>
        <td align="center"><strong>Credit</strong></td>       
        <td><strong>Initials</strong></td>        
      </tr>
      <?php    
	  $total_dr = 0;
	 $total_cr =0;
	  
 foreach($result as $rs){
	 $i++;
	 $guest_name = $rs['guest_name'];	  
	 if($rs['room_id'] >0)
	 $mst_room_name = RoomMaster::model()->find("mst_room_id=".$rs['room_id'])->mst_room_name;
	 $checkid = $rs['chkin_id'];	
	 $mst_room_name = $rs['mst_room_name'];	 
	 	
		
		$q = "select mst_room_name from hms_room_master where mst_room_id =(select room_id from hms_guest_ledger where id = (select MAX(id) from hms_guest_ledger where chkin_id = '$checkid'))";		
		//$mst_room_name = Yii::app()->db->createCommand($q)->queryScalar();
	 
	 $username = User::model()->find("id=".$rs['user_id'])->username;
	 $gst_folio_no = $rs['gst_show'];
	 
	 $remarks = $rs['remarks'];
	 $c_date = $rs['c_date'];
	 $dr = $rs['debit'];
	 $cr = $rs['credit'];
	
	 //$balance = $rs['balance'];
	 $total_dr +=$dr;
	 $total_cr +=$cr;
	 
	 $guest_folio_no = $rs['guest_folio_no'];
	 $gst_folio_no = $rs['gst_show'];
	 $mop = $rs['btc'];
	 $company = Company::model()->find("comp_id = ".$rs['company_id'])->comp_name;
	 
	 if($mop==0){ $mop = "Cash";}
	 else if($mop==2){$mop = "C/Card";}
	 else if($mop==3){$mop = "BTC";}
	 
	 
	 if(empty($gst_show))	{ $folio_no =  $guest_folio_no; }
	 else $folio_no = $gst_folio_no;
	 
	 $folio_no = str_pad((int) $folio_no,"5","0",STR_PAD_LEFT);  	
	 
	// if($gst_show == "")	{$remarks = "n/a";}
	 if($guest_name =='0'){ $guest_name = $mop ; $folio_no = '-';	$mst_room_name = '-';}
	 if($mop=="BTC") $guest_name = $company;
	 
	  ?>
      <tr> 
        <td><?php echo $folio_no;?></td>      
        <td valign="top"><?php echo strtoupper($guest_name);?></td>
        <td><?php echo date("H:i:s",strtotime($c_date));?></td>
        <td><?php echo $remarks;?></td>
        <td><?php echo $mst_room_name;?></td>       
        <td align="right" style="padding-right:10px;"><?php echo number_format($dr, 2);?></td>       
        <td align="right" style="padding-right:10px;"><?php echo number_format($cr, 2);?></td>
		<td><?php echo $username;?></td>        
    </tr>
      <?php
 	}
	  ?>
	  <tr>
        <td colspan="5" align="center"><strong>Total Amount - <?php echo $sName; ?> (In Rs)</strong></td>
        <td align="right" style="padding-right:10px;"><strong><?php echo number_format($total_dr,2);?></strong></td>
        <td align="right" style="padding-right:10px;"><strong><?php echo number_format($total_cr,2);?></strong></td>
        <td>&nbsp;</td>      
    </tr>
	 	  
  </table>
  
  
    
</div>
<p align="center" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>   