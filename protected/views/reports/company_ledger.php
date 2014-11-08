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

 ?>

 

 

<?php 

$from_date1 = $data['from_date'];

$con = $data['criteria'];



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

    <td colspan="3" align="center"><strong><?php echo "$con "; ?>Company Ledger Report</strong></td>

  </tr>

</table>

  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>



<table width="100%" border="0" align="left">

      <tr>

        <td><strong>Sr#</strong></td>

        <td align="left"><strong>Date</strong></td>

        <td><strong>Particulars</strong></td>

        <td align="left"><strong>Dr</strong></td>

        <td align="left"><strong>Cr</strong></td>

        <td align="left"><strong>Amount</strong></td>

        <td align="left"><strong>Balance</strong></td>            

      </tr>

      <?php

      $acc_name = AccountName::model()->find("name LIKE '$con'")->id;

	  $AccountLedger = AccountLedger::model()->findAll("dr = $acc_name || cr = $acc_name");

	  $balance = 0;

 foreach($AccountLedger as $rs){

	 $i++;

	 $dr = $rs['dr'];

	 $cr = $rs['cr'];

	 $acc_dr = AccountName::model()->find("id=". $dr)->name;

	 $acc_cr = AccountName::model()->find("id=". $cr)->name;

	 $chkin_id = $rs['chkin_id'];	 

	 $created_date = $rs['created_date'];

	 

	 $amount = $rs['amount'];

	 if($dr==$acc_name){ $balance -= $amount; }

	 if($cr==$acc_name){ $balance += $amount; }

	

	

	  ?>

      <tr>

        <td><?php echo $i;?></td>

        <td><?php echo date("d/m/y", strtotime($created_date));?></td>

        <td><?php echo $chkin_id;?></td>

        <td><?php echo $acc_dr;?></td>

        <td><?php echo $acc_cr;?></td>

        <td><?php echo $amount;?></td>

        <td><?php echo $balance;?></td>

        

    </tr>

      <?php

 	}

	  ?>

  </table>

  <div style="clear:both"> </div>

  <br />

  <h2>  <?php echo "Balance = Rs. ".$balance; ?> </h2>

   <br />

    <table width="100%" border="0"  align="left">

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

         <td align="right">&nbsp;</td>

      </tr>

    </table>



<div style="clear:both"></div>   

  <p align="right" style="padding-right:10px;"> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>



 </div>



