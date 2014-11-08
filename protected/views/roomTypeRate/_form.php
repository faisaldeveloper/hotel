<?php 
$branch_id = Yii::app()->user->branch_id;
$user_id = Yii::app()->user->id;
$con = array("condition"=>"branch_id =  $branch_id", 'select'=>'t.company_id', "distinct"=>true,);
$roomtyperes = RoomTypeRate::model()->findAll($con);
$cc = '(';
foreach($roomtyperes as $row){	 $cc .=" comp_id !=".$row->company_id ." AND"; }
	
	$cc2 = rtrim($cc,' AND'); $cc2 .= ')';	
	if($cc2 == '()') $cc2 = 1;
 	$con2 = array("condition"=> $cc2 ." AND branch_id =  $branch_id", "order"=>"comp_name");
 //echo "----".$cc2."---"; print_r($con2);


?>



<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'room-type-rate-form',
	'enableAjaxValidation'=>false,
)); 
?>

  		<?php 
		echo $form->hiddenField($model,'branch_id',array('value'=>$branch_id));
		echo $form->hiddenField($model,'user_id',array('value'=>$user_id)); 
		echo $form->hiddenField($company_model,'rate_date', array('value'=>date("Y-m-d H:i:s")));
		?>	

	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary(array($model, $company_model)); ?>    

    <div class="row">
		<?php echo $form->labelEx($model,'company_id'); ?>
		<?php echo $form->dropDownList($model,'company_id', CHtml::listData(Company::model()->findAll($con2), 'comp_id', 'comp_name'), array('options' => array('1'=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'company_id'); ?>
	</div>       

    <div class="row"  style="float:left">
    	<?php echo $form->labelEx($company_model,'rate_to'); ?>
		<?php echo $form->textField($company_model,'rate_to');	?>
		<?php echo $form->error($company_model,'rate_to'); ?>	
    </div>    

    <div class="row" style="float:left">
    	<?php echo $form->labelEx($company_model,'rate_from'); ?>
		<?php echo $form->textField($company_model,'rate_from');	?>
		<?php echo $form->error($company_model,'rate_from'); ?>	
    </div>
 <table width="100%" border="1">
  <tr>
    <td><h2>Room Type</h2></td>
    <td><h2>Rate</h2></td>   
  </tr>  

  <?php  $i= 0;   
$room_type_res = HmsRoomType::model()->findAll("branch_id = $branch_id");
foreach($room_type_res as $row){
 echo $form->hiddenField($model,"room_type_id[$i]",array('value'=>$row['room_type_id'])); 
 echo $form->hiddenField($model,"rate_type_id[$i]",array('value'=>1)); // this is a dumy value from hms_room_rate table 
 ?>	
  <tr>
    <td>&nbsp; <strong><?php echo $row['room_name']; ?></strong></td>
    <td>&nbsp;<?php echo $form->textField($model,"room_rate[$i]"); ?></td>  
  </tr>		
<?php  $i++; } ?>
</table> 

<div style="clear:both;"> </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->