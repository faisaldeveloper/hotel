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
	 
	
	 $comp_name = $data['criteria']; 
 ?>
 <style>
 td{ border-bottom:solid 1px; }
 </style>
<div class="container_mce">
  <table  width="100%" border="0">
 
 <tr>    
    <td colspan="3" align="center" style="font-size:12px; border-bottom:0px !important;"><strong><?php echo $hotel_title; ?></strong></td>   
  </tr>
  <tr>
    <td colspan="3" align="center" style="font-size:12px;  border-bottom:0px !important;"><strong>LISTED COMPANIES REPORT</strong></td>    
  </tr>
</table>
  <div style="width:100%; border-bottom: solid 1px #000; margin:5px 0;"></div>
<table width="100%" border="0" align="left">
      <tr style="background-color:#CCC">
        <td><strong>Sr#</strong></td>
        <td><strong>Name</strong></td>
        <td align="left"><strong>Contact Person</strong></td>
        <td align="left"><strong>Address</strong></td>
        <td align="left"><strong>Phone</strong></td>
        <td align="left"><strong>Mobile</strong></td>
        <td align="left"><strong>Fax</strong></td>
        <td align="left"><strong>Email</strong></td>        
      </tr>
      <?php      
	  $sql = "select * from hms_company_info where comp_name LIKE '$comp_name%'";
	  $chkin_info = Yii::app()->db->createCommand($sql)->query();
	  
 foreach($chkin_info as $rs){
	 $i++;
	 $comp_name = $rs['comp_name'];
	 $comp_contact_person = $rs['comp_contact_person'];
	 $comp_address = $rs['comp_address'];
	 $comp_phone = $rs['comp_phone'];
	 $person_mobile = $rs['person_mobile'];
	 $comp_fax = $rs['comp_fax'];
	 $comp_email = $rs['comp_email'];	
		
	
	  ?>
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $comp_name;?></td>
        <td><?php echo ucwords($comp_contact_person);?></td>
        <td><?php echo $comp_address;?></td>
        <td><?php echo $comp_phone;?></td>
         <td><?php echo $person_mobile;?></td>
        <td><?php echo $comp_fax;?></td>
        <td><?php //echo $comp_email;?></td>
       
        
        
    </tr>
      <?php
 	}
	  ?>
  </table>
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
    
  <p align="right" style=" margin-top:40px; padding-right:10px;"><span style="float:left; font-size:12px;">Print Time: <?php echo date("d/m/y H:i"); ?></span> <input id="print" type="button" value="Print" onclick="printthis(this.id)" />    </p>
</div>
