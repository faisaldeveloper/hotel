<?php
$user_id = yii::app()->user->id;
$user_info = User::model()->findAll("id=$user_id");
foreach($user_info as $u_info){ $user_name = $u_info['username']; }
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
/////////////////////////
$folo_no =  $foliono;
// use this bill no to find service ids from split_merge_folio and then get service details from guest_ladger table.
	$res = SplitMergeFolio::model()->find("bill_no=$folo_no");		
	$billone = explode(",",$res->unchecked);
	sort($billone);
	$billtwo = explode(",",$res->checked);
	sort($billtwo);
$result = GuestLedger::model()->findAll("chkin_id=$folo_no order by id ASC");
 
 $chkin_info = CheckinInfo::model()->findAll("chkin_id=$folo_no");
 foreach($chkin_info as $rs){
	 $guest_id = $rs['guest_id'];
	 $chkin_date = $rs['chkin_date'];
	 	$guest_info = 	GuestInfo::model()->findAll("guest_id=$guest_id");
	 	    foreach($guest_info as $r){				
				$salutation_name = Salutation::model()->find("salutation_id=".$r['guest_salutation_id'])->salutation_name;		
				$guest_name = $r['guest_name'];
				$guest_address = $r['guest_address'];
				$guest_phone = $r['guest_phone'];
				$guest_mobile = $r['guest_mobile'];			
			}
	 }
?>
<style>
.container_mce{
	margin:auto;
	width:1020px;
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
<table width="1013" border="0">
  <tr>
    <td width="33" rowspan="3">&nbsp;</td>
    <td width="171" rowspan="3"><img src="<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php echo $hotel_logo_image;?>" height="98px" width="75px" /></td>
    <td colspan="3" align="center">&nbsp;<strong><?php echo ucwords($hotel_title); ?></strong></td>
    
    <td width="62" rowspan="3"><strong>Date</strong></td>
    <td width="165" rowspan="3"><?php echo date('j F, Y');?></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong><?php echo ucwords($branch_address); ?></strong></td>
  </tr>
  <tr>    
    <td colspan="3" align="center"><strong>Guest Bill</strong></td>
  </tr>
</table>
 <hr />
    
<table width="993" border="0" align="center">
  <tr>
    <td width="442" height="109" valign="top"><table width="296" border="0">
     
      <tr>
        <td width="81"><strong>Name:</strong></td>
        <td width="205"><?php echo $salutation_name.ucwords($guest_name);?></td>
      </tr>
      <tr>
        <td><strong>Address:</strong></td>
        <td><?php echo ucwords($guest_address);?></td>
      </tr>
      <tr>
        <td><strong>Mobile:</strong></td>
        <td><?php echo $guest_mobile;?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="8" valign="top">&nbsp;</td>
    <td width="529" valign="top"><table width="289" border="0">
      
      <tr>
        <td width="140"><strong>Bill  No:</strong></td>
        <td width="139"><?php echo $folo_no;?></td>
      </tr>
      <tr>
        <td><strong>Date:</strong></td>
        <td><?php  echo date("d/m/y");//echo date("d/m/y",strtotime($chkin_date));?></td>
      </tr>
      <tr>
        <td><strong>Cashear:</strong></td>
        <td><?php echo $user_name;?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="11" colspan="3"><hr /></td>
  </tr>
  <tr>
    <td height="81" colspan="3">
    <table width="992" border="0">
  <tr>
    <td width="59"><strong>Sr#</strong></td>
    <td width="129"><strong>Date</strong></td>
    <td width="154"><strong>Service</strong></td>
    <td width="297"><strong>Description</strong></td>
    <td width="102"><strong>Debit</strong></td>
    <td width="104"><strong>Credit</strong></td>
    <td width="88"><strong>Balance</strong></td>
    <td width="25">&nbsp;</td>
  </tr>
  <?php
  $h=0;
  foreach($result as $row){	
	$id = $row['id']; $show="none";
	for($i=0;$i<count($billone); $i++){ if($id==$billone[$i]) { $show="show"; break;}}
	if($show == "show"){
		$h++;
			$sr_date = $row['c_date'];
			$service_id = $row['service_id'];			
			$S_name = Services::model()->find("service_id = ".$service_id)->service_description;					
			$remarks = $row['remarks'];
			$dr = $row['debit'];
			if($dr==0){$dr="";}else{$dr = $row['debit'];}
			$cr = $row['credit'];
			if($cr==0){$cr="";}else{$cr = $row['credit'];}
			
			if($cr==0){	$balance = $balance+$dr; }else{$balance = $balance-$cr; }
			$balance = $balance;
			$total_balance  =+ $balance;	
			//$balance = $row[''];
  ?>
  <tr>
    <td><?php echo $h; ?></td>
    <td><?php echo date("d/m/y",strtotime($sr_date));?></td>
    <td><?php echo $S_name."--";?></td>
    <td><?php echo ucwords($remarks);?></td>
    <td><?php echo $dr;?></td>
    <td><?php echo $cr;?></td>
    <td><?php echo $balance;?></td>
    <td>&nbsp;</td>
  </tr>
  <?php
  	}//end if
	
  } // end for
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong><?php echo $total_balance;?></strong></td>
    <td>&nbsp;</td>
  </tr>
  
  
  <!-- CODE FOR BILL TWO  -->
  <tr>
    <td width="59"><strong>Sr#</strong></td>
    <td width="129"><strong>Date</strong></td>
    <td width="154"><strong>Service</strong></td>
    <td width="297"><strong>Description</strong></td>
    <td width="102"><strong>Debit</strong></td>
    <td width="104"><strong>Credit</strong></td>
    <td width="88"><strong>Balance</strong></td>
    <td width="25">&nbsp;</td>
  </tr>
  <?php 
  $total_balance=0; $balance=0;
  $result = GuestLedger::model()->findAll("chkin_id=$folo_no order by id ASC");
   $h=0;
  foreach($result as $row){	
	$id = $row['id']; $show="none";
	for($i=0;$i<count($billtwo); $i++){ if($id==$billtwo[$i]) { $show="show"; break;}}
	if($show == "show"){
		$h++;
			$sr_date = $row['c_date'];
			$service_id = $row['service_id'];			
			$S_name = Services::model()->find("service_id = ".$service_id)->service_description;					
			$remarks = $row['remarks'];
			$dr = $row['debit'];
			if($dr==0){$dr="";}else{$dr = $row['debit'];}
			$cr = $row['credit'];
			if($cr==0){$cr="";}else{$cr = $row['credit'];}
			
			if($cr==0){	$balance = $balance+$dr; }else{$balance = $balance-$cr; }
			$balance = $balance;
			$total_balance  =+ $balance;	
			//$balance = $row[''];
  ?>
  <tr>
    <td><?php echo $h; ?></td>
    <td><?php echo date("d/m/y",strtotime($sr_date));?></td>
    <td><?php echo $S_name;?></td>
    <td><?php echo ucwords($remarks);?></td>
    <td><?php echo $dr;?></td>
    <td><?php echo $cr;?></td>
    <td><?php echo $balance;?></td>
    <td>&nbsp;</td>
  </tr>
  <?php
  	}//end if
	
  } // end for
  ?>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong><?php echo $total_balance;?></strong></td>
    <td>&nbsp;</td>
  </tr>
</table>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td height="10" colspan="3"><hr /></td>
  </tr>
  <tr>
    <td height="40" colspan="2"><strong>Cashear Signature___________</strong></td>
    <td height="40" align="right"><strong>Guest Signature_________________</strong></td>
  </tr>
</table>
<p align="right" style="padding-right:10px;"> <input type="button" value="Print" onclick="printpage()" />    </p>
    <script> function printpage(){window.print()}</script>
</div>
