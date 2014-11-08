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

	 



	 $from_date = $_POST[from_date];

	 $to_date = $_POST[to_date];

	 

	 //$_SESSION['gst_show'] = 'to do';

$sval = Yii::app()->session['taxcontrol'];

if(isset($sval) && $sval=='ON') $gst_show = " AND ci.gst_show > 0";

else $gst_show = "";

	// echo "---".$from_date."--".$to_date."--"."(c_date Between '$from_date' And '$to_date') And branch_id = $branch_id Order By id";	 

	

	

function CalculateTotalBTC($company_id){

	$branch_id = yii::app()->user->branch_id;

	$GuestLedger = GuestLedger::model()->findAll(" btc='3' and company_id = $company_id and  branch_id = $branch_id");

	$balance =0;

	foreach($GuestLedger as $row){

	 		$balance += $row['balance'];			

	}

	return $balance;

}

 ?>

 

 

<div class="container_mce">

  <table  width="100%" border="0">

  <tr>

    <td rowspan="3">&nbsp;</td>

    <td rowspan="3"><img src="<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php echo $hotel_logo_image;?>" height="98px" width="75px" /></td>

    <td colspan="3" align="center">&nbsp;<font size="+2"><strong><?php echo ucwords($hotel_title); ?></strong></font></td>

    

    <td rowspan="3" valign="top"><strong>Date</strong></td>

    <td rowspan="3" valign="top"><?php echo date('j F, Y H:i:s');?></td>

  </tr>

  <tr>

    <td colspan="3" align="center"><strong><?php echo ucwords($branch_address); ?></strong></td>

  </tr>

  <tr>    

    <td colspan="3" align="center"><strong> Company Overdue Report: </strong></td>

  </tr>

</table>

  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>

<table width="100%" border="1" align="center">

     <tr>

        <td><strong>Sr#</strong></td>		  

        <td><strong>Room No</strong></td>

        <td><strong>Guest Name</strong></td>     

        <td><strong>Folio No</strong></td> 

        <td><strong>Company</strong></td>          

        <td><strong>Arrival</strong></td>   

        <td><strong>Departure</strong></td>  

        <td><strong>P.Mode</strong></td>

        <td><strong>Charges</strong></td> 

        <td><strong>Advance</strong></td>     

        <td><strong>Balance</strong></td>        

      </tr>

    <?php	  

	//$GuestLedger = GuestLedger::model()->findAll(" btc='3' AND balance > 0 and branch_id = $branch_id Order By company_id");

	$sql = "select gl.*, ci.gst_show, ci.guest_folio_no from hms_guest_ledger gl left join hms_checkin_info ci on gl.chkin_id = ci.chkin_id where gl.btc='3' ".$gst_show . " AND gl.balance > 0 and ci.branch_id = $branch_id Order By gl.company_id";

		

	$GuestLedger = Yii::app()->db->createCommand($sql)->query();

	 	

	foreach($GuestLedger as $rs){

	 $i++;

	 $guest_name = $rs['guest_name'];

	 $folio=$rs['chkin_id'];

	 

	 

	 

	 $comp_id=$rs['company_id'];

	 if(!isset($comp_id_old)){ $comp_id_old = $comp_id; $ch = 1;}

	 

	 else if(isset($comp_id_old) and $comp_id_old != $comp_id){ $comp_id_old = $comp_id; $ch = 2; }

	 else if($comp_id_old == $comp_id) $ch=0;

	 

	 if($ch==1 || $ch==2){

	 $company_name=Company::model()->find("comp_id= $comp_id")->comp_name; 

	 $btc_total = CalculateTotalBTC($comp_id);	 

	 echo "<tr><td colspan=\"11\"><h2 style=\"text-decoration:underline;\"> ". ucwords(strtolower($company_name)) ." - Rs. $btc_total</h2></td></tr>\n";	 

	 }	 

	 	 

	// end of overdue amount calculation	 

	 $dr =0; $pmode = '';

	 $cash=CheckinInfo::model()->find("chkin_id=$folio")->cash;

	 $credit_card=CheckinInfo::model()->find("chkin_id=$folio")->credit_card;

	 $debit_card=CheckinInfo::model()->find("chkin_id=$folio")->debit_card;

	 $btc=CheckinInfo::model()->find("chkin_id=$folio")->btc;

	 if($cash=="Y") $pmode .="Cash";

	 if($credit_card=="Y") $pmode .= "/C-Card";

	 if($debit_card=="Y") $pmode .= "/D-Card";

	 if($btc=="Y") $pmode .= "/BTC";

	 

	 

	 $dr=GuestLedger::model()->find("btc=3 AND balance > 0 AND chkin_id=$folio")->balance;	 

	 $mst_room_name = RoomMaster::model()->find("mst_room_id=".$rs['room_id'])->mst_room_name;	 

	 $service = Services::model()->find("service_id=".$rs['service_id'])->service_description;	

	

	 $remarks = $rs['remarks'];

	 $c_date = $rs['c_date'];

	 $chkin = $rs['chkin_date'];

	 $chkout = $rs['chkout_date'];	 

	 $cr = $rs['credit'];

	

	 //$balance = $rs['balance'];

	 $total_dr +=$dr;

	 $total_cr +=$cr;  

	 

	 $guest_folio_no = $rs['guest_folio_no'];

	 	$gst_folio_no = $rs['gst_show'];	 

	 	if(empty($gst_show))	{ $folio_no =  $guest_folio_no; }

	 	else $folio_no = $gst_folio_no;	

		

	  ?>

      <tr>

        <td valign="top"><?php echo $i;?></td>

        <td><?php echo  $mst_room_name;?></td> 

        <td><?php echo  ucwords(strtolower($guest_name));?></td> 

        <td><?php echo  $folio;?></td> 

        <td><?php echo  $company_name;?></td>        

        <td><?php echo date("d/m/y", strtotime($chkin)); ?></td>

        <td><?php echo  date("d/m/y", strtotime($chkout)); ?></td>

        <td><?php echo  trim($pmode, "/");?></td>      

        <td><?php echo  $dr;?></td>       

        <td><?php echo  $cr;?></td>       

        <td><?php echo  $dr;?></td>        

    </tr>

    

      <?php	

	 

 	}

	  ?>

	 

      <tr>        

        <td colspan="10" align="center"><strong>Total Amount (In Rs.)</strong></td>

        <td><strong><?php echo number_format($total_dr,0).".00";?></strong></td>       

      </tr>

  </table>

<hr />

    

   



 </div>



<p align="center"><input type="button" name="btn" value="Print" onclick="javascript:window.print" /></p>



