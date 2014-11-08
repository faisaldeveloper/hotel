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
if(isset($sval) && $sval=='ON') $gst_show = " AND ci.gst_show > 0";
else $gst_show = "";
//echo "----".$created_date;	
$cd = date("Y-m-d", strtotime($created_date));
$sql="SELECT ser.service_description as name, ser.service_code as code, sum(debit) as  dr_total, sum(credit) as  cr_total FROM `hms_guest_ledger` gl left join hms_services ser on ser.service_id=gl.service_id LEFT JOIN hms_checkin_info ci ON ci.chkin_id = gl.chkin_id  where gl.c_date like '$cd%' ". $gst_show ." group by ser.service_id";
$res = Yii::app()->db->createCommand($sql)->query();
 ?>
 
<div class="container_mce">

<table width="100%" border="0">
 <tr>    
    <td colspan="3" align="center" style="font-size: 12px; border-color:#FFF !important"><strong><?php echo Yii::t('views','Control Sheet For Date:');  ?></strong></td>    
  </tr>
  <tr>
    <td colspan="3" align="center" style="font-size: 10px; border-color:#FFF !important"><strong><?php echo '<h2>'. date("d-m-Y", strtotime($created_date)).'</h2>'; ?> </strong></td> 
  </tr>
</table>
 <?php /*?> <table width="100%" border="0"  align="center">
  <tr>
    <td  rowspan="3">&nbsp;</td>
    <td  rowspan="3"><img src="<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php echo $hotel_logo_image;?>" height="98px" width="75px" /></td>
    <td colspan="3" align="center">&nbsp;<font size="+2"><strong><?php echo ucwords($hotel_title); ?></strong></font></td>
    
    <td  rowspan="3"><strong><?php echo Yii::t('views','Date') ?></strong></td>
    <td  rowspan="3"><?php echo date('j F, Y H:i:s');?></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong><?php echo ucwords($branch_address); ?></strong></td>
  </tr>
  <tr>    
    <td colspan="3" align="center"><strong><?php echo Yii::t('views','Control Sheet For Date:') ?> <?php echo date("d-m-Y", strtotime($created_date)); ?></strong></td>
  </tr>
</table><?php */?>
<br />
 <div style="width:100%;; border-bottom: solid 1px #000; margin:5px 0;"></div>
 <br />
 <table width="100%" align="center"  border="1">
    <tr>
      <td ><strong></strong></td> 
      <td ><strong><?php echo Yii::t('views','Service Code') ?></strong></td>     
      <td  align="left"><strong> <?php echo Yii::t('views','Service Name') ?></strong></td>
      <td  align="left"><strong> <?php echo Yii::t('views','Debit') ?></strong></td>
      <td  align="left"><strong>  <?php echo Yii::t('views','Credit') ?></strong></td>     
    </tr>
    <?php 	
		//$services = Services::model()->findAll();	
		//$sql="select an.id, an.name, SUM(al.amount) as total_amount from account_ledger al LEFT JOIN account_name an ON (an.id = al.cr || an.id = al.dr) WHERE an.account_type_id = 4 AND al.dr !=89 AND al.created_date LIKE '$cd%' Group by an.name";
		//SELECT ser.service_description, ser.service_code, sum(debit-credit) FROM `hms_guest_ledger` gl left join hms_services ser on ser.service_id=gl.service_id  where gl.c_date like '2013-07-03 00:00:00' group by ser.service_id
		
		
		//$sql="SELECT ser.service_description as name, ser.service_code as code, sum(debit-credit) as  total_amount FROM `hms_guest_ledger` gl left join hms_services ser on ser.service_id=gl.service_id  where gl.c_date like '$cd%' group by ser.service_id";
		
		
		//echo $sql;
		$i=0; $grand_total_dr = 0;$grand_total_cr = 0;
		foreach($res as $row){ 
		$i++;
		$service = $row['name'];
		$dr_total = abs($row['dr_total']);
		$cr_total = abs($row['cr_total']);
		$grand_total_dr += $dr_total;
		$grand_total_cr += $cr_total;
	?>
    
     <tr>
      <td ><strong></strong></td> 
      <td ><strong><?php echo $row['code']; ?></strong></td>     
      <td  align="left"><strong><?php echo $service; ?></strong></td>
      <td  align="left"><strong><?php echo number_format(abs($dr_total)); ?></strong></td>
      <td  align="left"><strong><?php echo number_format(abs($cr_total)); ?></strong></td>     
    </tr>
    <?php } ?>
    <tr>
      <td colspan="5"><div style="width:100%;; border-bottom: solid 1px #000; margin:5px 0;"></div>
 <br /></td>         
    </tr>
    
    <tr>
      <td colspan="2"><strong><?php echo date("H:i:s", time()); ?></strong></td> 
      <td ><strong><?php echo Yii::t('views','Grand Total: (In Rs)') ?></strong></td>          
      <td  align="left"><strong><?php echo number_format($grand_total_dr).".00"; ?></strong></td>
      <td><strong><?php echo number_format($grand_total_cr).".00"; ?></strong></td>     
    </tr>
    
    </table>
 
  
  <p align="right" style="padding-right:10px;"> <input type="button" value="Print" onclick="javascript: window.print() " />    </p>
    
</div>