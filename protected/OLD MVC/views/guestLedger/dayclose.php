<?php
$this->breadcrumbs=array('Checkin Infos'=>array('index'),'Create',);
$this->menu=array(	array('label'=>'Manage CheckinInfo', 'url'=>array('admin')),);

function updateDayend(){	
	
		//Check current time and compare it with dayend current day and update dayend table set night post to 0 
		$current_date =  date("Y-m-d");
		$branch_id = yii::app()->user->branch_id;
		$res = DayEnd::model()->find("branch_id= $branch_id");	
		$active_date = $res->active_date;
		
		if(strtotime($current_date) > strtotime($active_date) || (strtotime($current_date) == strtotime($active_date) && date('H') >= 22)){
			$sql = "update day_end set night_post='0' where branch_id= $branch_id";			
			Yii::app()->db->createCommand($sql)->query();
			//echo "--:".date('H');	
		}
		//echo "-----------:".date('H')."--".strtotime($current_date)."---".strtotime($active_date);		
	}
updateDayend();
?>

<?php
$branch_id = yii::app()->user->branch_id;
$res = DayEnd::model()->find("branch_id= $branch_id");


$sql = "select night_post_date from hms_checkin_info where chkout_status = 'N' and night_post_date != '0000:00:00' group by night_post_date";
$last_np = Yii::app()->db->createCommand($sql)->queryScalar();



$today_date = $res->today_date;
$act_date = $res->active_date;
$last_night_post = explode(" ",$res->last_night_post);
$last_night_post_date = $last_night_post[0];

?>
<h1>  Business Day : <?php echo date("F j, Y", strtotime($act_date)); ?></h1>
<?php
//$mydate = date("Y-m-d"); 


$flag = 0;
if(strtotime($last_night_post_date) > strtotime($act_date)){$flag = 1;} //night post operation is completed.

//echo "<h2> Business Day : ". date("F j, Y", strtotime($act_date)) . " </h2>";

echo "np: ".$last_night_post_date . " - act : ".$act_date . " - np_flag = ". $res->night_post . " - f: ".$flag;

if($res->night_post==0 && $flag==1){
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'guest-ledger-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>
		       		
        <?php echo $form->hiddenField($model,'night_post',array('value'=>1)); ?>			
		<?php $hotel_branch_id = yii::app()->user->branch_id;?>        
		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>
		<?php echo $form->error($model,'branch_id'); ?>
	
<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Click To Day Close' : ' Click To Day Close ', array('id'=>'btn_dayclose')); ?>
       
	</div>

<?php $this->endWidget();
}
else { 
 echo "<h1 style=\"font-family:Verdana, Geneva, sans-serif; color:#900;\">Night Must be Posted Before Day Close Operation.<br>[Last Night Post: ". date("d/m/y", strtotime($last_np))."]</h1>";
/*
?>
<h1 style="font-family:Verdana, Geneva, sans-serif; color:#900;"><?php echo  date("F j, Y", strtotime($act_date.' -1 day')); ?> Day Has Been Closed </h1>
<?php */ }?>

 <p>Note : Day close button will be reset everyday after 6'O clock.</p>
<script>
jQuery('#btn_dayclose').live('click',function() {
	if(!confirm('Are you sure you want to Close The Day?...'+' <?php echo date("F j, Y H:i:s", strtotime($act_date)); ?>')) return false;
	else return true;
	
});
</script>