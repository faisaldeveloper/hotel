<?php

$this->breadcrumbs=array(

	'Guest Ledgers'=>array('index'),

	$model->id,

);



?>

<style>

.allfolios{

	margin:20px;	

	width: 250px;

	float:left;

	background-color:#9CC;

	padding:10px;

	

}



.round-corner{

	border:2px; 

	border-top-left-radius: .5em;

	border-top-right-radius: .5em;

	border-bottom-left-radius: .5em;

	border-bottom-right-radius: .5em;

}

</style>





<h1><?php echo Yii::t('views','Merge Folio') ?></h1>



<div id="billfrom" class="allfolios round-corner">

<?php 



$branch_id = yii::app()->user->branch_id;

		$sql = "select chkin_id, guest_name from hms_guest_ledger where room_status = 'O' and  branch_id = $branch_id Group by chkin_id";

		$res = Yii::app()->db->createCommand($sql)->query();	

		$i=1;

		foreach($res as $row){

		$bill = $row[chkin_id];		

		echo "<p><input type=\"checkbox\" name=\"cbk[]\" id=\"cbk-$i\" value=\"$bill\" /> ". $bill. " - " . ucwords($row[guest_name])."</p>";

		$i++;

		}



?>

</div>



<div style="float:left; margin-top:150px; padding:10px;">

<?php echo CHtml::image(yii::app()->baseUrl."/images/nect.png",'Next',array('onclick'=>'process()')); ?>

</div>







 <?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'merge-folio-form',

	'enableAjaxValidation'=>false,	

	'htmlOptions'=>array('target'=>'_blank'),

)); ?>

<div id="billto" class="allfolios round-corner" style="display:none;">

	<div id="ajax_div"><input type="submit" name="btn" value=" Print "  /> </div>

</div>



<?php $this->endWidget(); ?>   





<script>

function process(){

	var t1 = $("#billfrom > p > input").size();	

	var t2 = $("#billto > p > input").size();	

	var total = t1+t2;

	//alert(total);

 	$("#billto").show();		

		for(i=total;i>0;i--){		

			//if($('#cbk-'+i).is(':checked')){

			var node = $("#billfrom").find('#cbk-'+i);

			if(node.is(':checked')){									

				var cloned = $('#cbk-'+i).parent();

				//$('#billto').append(cloned);				 							

				$(cloned).insertBefore('#ajax_div');

			}	

			//else {alert('not checked');}			

		} 		

}

</script>

