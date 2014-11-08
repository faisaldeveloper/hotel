<?php

//====date for report by imdad

$report_date='';

if(isset($_GET['date'])){

$report_date = '/date/'.$_GET['date'];	

}

$user_id = yii::app()->user->id;

$user_info = User::model()->findAll("id=$user_id");

foreach($user_info as $u_info){ $user_name = $u_info['username']; }

$branch_id = yii::app()->user->branch_id;

$sql = "select active_date from day_end where branch_id = $branch_id";



//for previous date report by imdad

if(isset($_GET['date'])){

$business_date = $_GET['date'];	

}else{

$business_date = Yii::app()->db->createCommand($sql)->queryScalar();

}





//print_r($data);

 ?>

 



 

<fieldset style="background-color: #CCC">  

  <table width="483" border="0" align="center">

    <tr>

      <td width="51"><strong><?php echo Yii::t('views','Sr#') ?></strong></td>     

      <td width="123" align="left"><strong>Service Code</strong></td>

      <td width="331" align="left"><strong>Service Name</strong></td>       

    </tr>

    <?php

	

	

$sql = "select s.service_id, s.service_code, s.service_description FROM hms_services s 

Left JOIN hms_guest_ledger gl ON s.service_id = gl.service_id WHERE c_date LIKE '$business_date%' GROUP BY s.service_description ORDER BY s.service_id";

$result = Yii::app()->db->createCommand($sql)->query();



//echo $sql;

$total_record = count($result);

$url = Yii::app()->createUrl('Reports/Codewisesummary');



    foreach($result as $row){

		$i++;		

		$service_id=$row['service_id'];	

		$service_code=$row['service_code'];

		$service_description=$row['service_description'];			 

	?>

    <tr class="text">

      <td align="left"><?php echo $i;?></td>

      <td align="left"><?php echo $service_code;?></td>

      <td align="left"><a href="<?php echo $url."/id/".$service_id.$report_date; ?>" target="_blank"> <?php echo $service_description;?> </a></td>         

    </tr>

    <?php } ?>

  </table>

  </fieldset>

 

