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



	// $from_date = $_POST[from_date];

	// $to_date = $_POST[to_date];

	 if(isset($from_date) and isset($to_date)){

		 

		 $showdate="<br/> From:  ".date("j F, Y H:i", strtotime($from_date))."\t TO:  ".date("j F, Y H:i",strtotime($to_date));

		 }

		 

//$_SESSION['gst_show'] = 'to do';

$sval = Yii::app()->session['taxcontrol'];

if(isset($sval) && $sval=='ON') $gst_show = " AND ci.gst_show > 0";

else $gst_show = "";

/////////////////////////

	 $sName = Yii::app()->db->createCommand("select service_description From hms_services where service_id = $service_id")->queryScalar();

 //////////////////////////////////

 $sql = "";

	  $sql = "select gl.*, SUM(gl.debit) AS Total, ci.guest_folio_no, ci.gst_show from hms_guest_ledger gl";

	  $sql .= " Left join hms_checkin_info ci";

	  $sql .= " ON gl.chkin_id = ci.chkin_id";

	  $sql .= " where gl.service_id = $service_id and c_date BETWEEN '$from_date%' AND '$to_date%' ". $gst_show ." group by gl.chkin_id";

	  //echo "$sql<br>";

	  

	  $result = Yii::app()->db->createCommand($sql)->query();	  

	  $showdate="<br/> From:  ".date("j F, Y H:i", strtotime($from_date))."\t TO:  ".date("j F, Y H:i", strtotime($to_date));

	 

?>

 

<div class="container_mce">

  <table  width="100%" border="0">

  <tr>

    <td rowspan="3">&nbsp;</td>

    <td rowspan="3"><img src="<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php echo $hotel_logo_image;?>" height="98px" width="75px" /></td>

    <td colspan="3" align="center">&nbsp;<font size="+2"><strong><?php echo ucwords($hotel_title); ?></strong></font></td>

    

    <td rowspan="3" valign="top"><strong>Date</strong></td>

    <td rowspan="3" valign="top"><?php echo date('d/m/y H:i:s');?></td>

  </tr>

  <tr>

    <td colspan="3" align="center"><strong>Charge Code-Wise Report2 - <?php echo $sName; ?></strong></td>

  </tr>

  <tr>    

    <td colspan="3" align="center"><strong><?php echo "Date : ". $showdate; ?></strong></td>

  </tr>

</table>

  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>

<table width="100%" border="1" align="center">

      <tr>  

       <td></td> 

        <td><strong>S No</strong></td>

        <td><strong>Date</strong></td>      

      	<td><strong>Folio No.</strong></td>		        

        <td><strong>Amount</strong></td>

        <td></td>         

      </tr>

      <?php     

 foreach($result as $rs){

	 $i++;

	 $guest_name = $rs['guest_name']; 

	 

	 

	 $res_rm = RoomMaster::model()->findAll("mst_room_id=".$rs['room_id']);

	 foreach($res_rm as $row){$mst_room_name = $row[mst_room_name];} 

	 $remarks = $rs['remarks'];

	 $c_date = $rs['c_date'];

	 $dr = $rs['debit'];

	 $cr = $rs['credit'];

	  $total = $rs['Total'];

	 //$balance = $rs['balance'];

	 $total_dr +=$dr;

	 $total_cr +=$cr;

	 

	 $guest_folio_no = $rs['guest_folio_no'];

	 $gst_folio_no = $rs['gst_show'];

	 

	 if(empty($gst_show))	{ $folio_no =  $guest_folio_no; }

	 else 

	 $folio_no = $gst_folio_no;

	 

	 $folio_no = str_pad((int) $folio_no,"5","0",STR_PAD_LEFT); 		

	  ?>

      <tr>

      <td></td> 

        <td><?php echo $i;?></td>

        <td><?php echo date("d/m/y",strtotime($c_date));?></td>

        <td><?php echo $folio_no;?></td>              

        <td><?php echo $total;?></td>       

       <td></td> 

    </tr>

      <?php

 	}

	  ?>

	  <tr>

       <td></td> 

        <td colspan="3" align="center"><strong>Total Amount - <?php echo $sName; ?> (In Rs)</strong></td>       

        <td><strong><?php echo number_format($total_dr,0).".00";?></strong></td>          

        <td></td>         

    </tr>

	 	  

  </table>

  

  

    



</div>

<p align="center" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>   