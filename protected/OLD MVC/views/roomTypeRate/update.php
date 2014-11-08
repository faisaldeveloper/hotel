<?php

$this->menu=array(array('label'=>'Manage RoomTypeRate', 'url'=>array('admin')),);

$company_name=Company::model()->find("comp_id = ".$company_id)->comp_name;

?>



<h1> <?php echo Yii::t('views','Update Rates For') ?>  <font color="#FF0000"><?php echo $company_name; ?></font></h1>

















<div class="form">



<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'room-type-rate-form',

	'enableAjaxValidation'=>false,

)); 







$branch_id = Yii::app()->user->branch_id;

$user_id = Yii::app()->user->id;

// echo "--$company_id";

/* $con = array("condition"=>"branch_id =  $branch_id", 'select'=>'t.company_id', "distinct"=>true,);



$roomtyperes = RoomTypeRate::model()->findAll($con);

$cc = '(';

foreach($roomtyperes as $row){	 

	$cc .=" comp_id !=".$row->company_id ." AND"; 

}

$cc2 = rtrim($cc,' AND'); $cc2 .= ')';

$con2 = array("condition"=> $cc2 ." AND branch_id =  $branch_id"); */



 //echo "----".$cc2;

?>

  		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$branch_id)); ?>		

		<?php echo $form->hiddenField($model,'user_id',array('value'=>$user_id)); ?>

        <?php echo $form->hiddenField($model,'company_id',array('value'=>$company_id)); ?>

        <?php echo $form->hiddenField($model,'comp_allow_gst',array('value'=>1)); ?>

		

	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary($model); ?>

    

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

    

    <div class="row" style="float:left"><h3> <?php echo Yii::t('views','Time When Offered:') ?>  <?php echo date("d/m/y H:i", strtotime($company_model->rate_date)); ?></h3></div>

    

 <table width="605" border="1">

  <tr>

    <td><h2> <?php echo Yii::t('views','Room Type') ?></h2></td>

    <td><h2> <?php echo Yii::t('views','Rate') ?> </h2></td>      

  </tr>

  

  <?php  $i= 0;   

$room_type_res = HmsRoomType::model()->findAll("branch_id = $branch_id");

foreach($room_type_res as $row){

 echo $form->hiddenField($model,"room_type_id[$i]",array('value'=>$row['room_type_id'])); 

 echo $form->hiddenField($model,"rate_type_id[$i]",array('value'=>1)); // this is a dumy value from hms_room_rate table 

 

 $room_rate = RoomTypeRate::model()->find("room_type_id = ". $row['room_type_id']." AND company_id = $company_id")->room_rate; 

 $ratetyperate_id = RoomTypeRate::model()->find("room_type_id = ". $row['room_type_id']." AND company_id = $company_id")->room_type_rate_id;

 

 echo $form->hiddenField($model,"room_type_rate_id[$i]",array('value'=>$ratetyperate_id)); // this is a dumy value from hms_room_rate table 

 ?>	

 

  <tr>

    <td>&nbsp; <strong><?php echo $row['room_name']; ?></strong></td>

    <td>&nbsp;<?php echo $form->textField($model,"room_rate[$i]", array('value'=>$room_rate)); ?></td>   

  </tr>		

  

<?php  $i++; } ?>

</table>



	

  <div style="clear:both;"> </div>



	<div class="row buttons">

		<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save'); ?>

	</div>



<?php $this->endWidget(); ?>



</div><!-- form -->