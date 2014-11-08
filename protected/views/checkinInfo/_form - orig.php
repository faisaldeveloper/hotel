<style>
/* input{
	margin-bottom:0px;
}

input[type="text"]{
	width:120px;
}

textarea{
	width:120px;
	min-height:20px;
}	 */

input[type="text"]{
	font-size:10px;	
}

</style>
<script>
 $(function(){
	 
	 $("input").css('margin-bottom','10px');
	 $(".form input[type=\"text\"]").css('width','120px');
	// $(".form input[type=\"text\"]:has([hasDatepicker])").css('backgroundColor','red');
	 
	 
	 $(".form select:eq(1)").css('width','120px'); //complany select list width is restricted.
	 //$(".form select:eq(4)").css('width','120px'); //complany select list width is restricted. CheckinInfo_guest_company_id
	  $("#CheckinInfo_guest_company_id").css('width','125px');	  
	 $("#GuestInfo_guest_country_id").css('width','118px');
	  
	 $("textarea").css('width','180px','min-height','20px');
	 $("#CheckinInfo_total_days").css('width','25px');
	 $("#CheckinInfo_chkin_id").css('width','40px');
	 $("#b_tax").css('width','32px');
	 $("#childs").css('width','32px');
	 $("#CheckinInfo_total_person").css('width','32px');
	 $("#extra_bed").css('width','32px'); 	   
	 $("#gst_amount").css('width','32px'); 
	 $("#CheckinInfo_amount_paid").css('width','60px'); 
	 $("#balance").css('width','60px'); 	
	 $("#btn_submit").css('margin-left','430px'); 	
	 $("#CheckinInfo_total_charges").css('width','100px'); 
	 
	// $(".form .hasDatepicker3").css('backgroundColor','red'); 	
	 $(".form .hasDatepicker3").css('width','90px'); 
	 //$("input").focus();
  	 //$(":focus").css("background-color","yellow");
	 
	/*  $('input:text').focus(
		function(){ 
			$(this).css('backgroundColor','#AFD8D8');
		});
		$('input:text').blur(
		function(){
			$(this).css('backgroundColor','white');
		}); */

	   	 
	/* $("tr").hover( function(){
		$(this).css('backgroundColor','yellow');
	},function() {
        $(this).css('backgroundColor', '')
    }); */
});

$(document).ready(function(){ 
 // $('.form').find("input[type=textarea], input[type=password], textarea").each(function(ev)
  $('.form').find("input[type=text], textarea").each(function(ev) {
      if(!$(this).val()) { 	  
			var str = $(this).closest('.row').children('label').text();	
			// $(this).closest('.row').children('label').remove();				
     		$(this).attr("placeholder", str.replace('*', ''));
  	  }
  });
  $("select").css('font-size','11px');
});
</script>

<div class="form">
<?php 
$myroomtypeid = '';
if(isset($myroomid) && !empty($myroomid)){	
$myroomtypeid = RoomMaster::model()->find("mst_room_id=$myroomid")->mst_roomtypeid;
//echo "-$myroomid--".$myroomtypeid ; //$form->hiddenField($model,'room_type',array('value'=>$room_type));
}


$this->widget('ext.EChosen.EChosen');
$hotel_branch_id = yii::app()->user->branch_id;
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'checkin-info-form',
	'enableAjaxValidation'=>false,
));

$hotel_branch_id = yii::app()->user->branch_id;
$user_id = yii::app()->user->id;

//2 tables CheckinInfo,guestinfo

$date_value = ''; 
if($model->isNewRecord==true){$date_value1 = date('d-m-Y'); $date_value2 = date('d-m-Y', strtotime(date('Y-m-d'). ' +1 day')); $t_days = 1;} 
else {$date_value1 = $model->chkin_date;  $date_value2 = $model->chkout_date; $t_days = $model->total_days;}
 ?>

	<?php echo $form->errorSummary(array($model,$guest_info)); ?>
		
		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>
		<?php echo $form->hiddenField($guest_info,'branch_id',array('value'=>$hotel_branch_id)); ?>		
		<?php echo $form->hiddenField($guest_info,'user_id',array('value'=>$user_id)); ?>
        <?php echo $form->hiddenField($model,'sale_person_id',array('value'=>3)); ?>
		<?php // echo $form->hiddenField($model,'reservation_id',array('value'=>'')); ?>
        <?php //echo $form->hiddenField($model,'drop_servce',array('value'=>'')); ?>
        
<fieldset>   <legend class="mcelegend" style="color:#900;">Stay Information:</legend>
    
	<div class="row" style="float:left; margin-left:5px;">
	<?php echo $form->labelEx($model,'chkin_date'); ?>
    <?php 
	
	 $this->widget('zii.widgets.jui.CJuiDatePicker', array(    
					'name'=>'CheckinInfo[chkin_date]',					
					'attribute'=>'chkin_date',
					'model'=>$model,    
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'minDate'=> 'DateDiff.getMinDate()', 
						'dateFormat'=>'dd-mm-yy',
					),
					'htmlOptions'=>array( 
					'class'=>'hasDatepicker3',
					'style'=>'height:15px;',
					'value'=>$date_value1,
					),
				));	
	
?>			<?php echo $form->error($model,'chkin_date'); ?>	
     </div>    
     
      <div class="row" style="float:left; margin-left:5px;">    
     <?php echo $form->labelEx($model,'chkout_date'); ?>
		  <?php 
		  
		   $this->widget('zii.widgets.jui.CJuiDatePicker', array(    
					'name'=>'CheckinInfo[chkout_date]',
					//'id'=>'user_Birthdate',
					'model'=>$model, 
					'attribute'=>'chkout_date',   
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'minDate'=> 'DateDiff.getMinDate()', 
						'dateFormat'=>'dd-mm-yy',
					),
					'htmlOptions'=>array( 
					'class'=>'hasDatepicker3',
					'style'=>'height:15px;',
					'value'=>$date_value2,
					'onchange'=>'DateDiff.inDays()',
					),
				));			  
		
?>          <?php echo $form->error($model,'chkout_date'); ?>
</div>    
        
        <div class="row" style="float:left; margin-left:5px;"> 
        <?php echo $form->labelEx($model,'total_nights'); ?>
        <?php echo $form->textField($model,'total_days',array('size'=>'5','Maxlength'=>'5','value'=>$t_days, 'readonly'=>'readonly')); ?> <?php echo $form->error($model,'total_days'); ?>
         </div>
           
        
        <div class="row" style="float:left; margin-left:5px;"> 
        <?php echo $form->labelEx($model,'reservation_id'); ?>
        <?php
		if($model->isNewRecord==true){
		$curr_date = date('Y-m-d 00:00:00');
		$con = array("condition"=>" chkin_date >= '$curr_date' AND branch_id =  $hotel_branch_id  AND chkin_status = 'N'", 'order'=>'chkin_date ASC',);
		
		 echo $form->dropDownList($model,'reservation_id', CHtml::listData(ReservationInfo::model()->findAll($con), 'reservation_id', 'client_name'),array('prompt'=>'Select Reservation','class'=>'chzn-select',
		'onchange' => CHtml::ajax(
						array(
							'type' => 'POST',
							'url' => CController::createUrl('CheckinInfo/dynamicResData'),							
							'beforeSend' => 'function(){ $("#res_loader").show(); }',
							//'complete' => 'function(data){alert(data); }',
							'success'=>"function(data){ 
								var obj=$.parseJSON(data);	$(\"#res_loader\").hide();							
								/* $.each(obj,function(index,value){  //alert(index+'--'+value);
										var tp = $('#'+index).attr('type');	
										if(tp=='text'){ $('#'+index).val(value); rate_update_total(); }									
										else  $('#'+index).html(value);
								});  */
								
								$.each(obj,function(index,value){			
									var tp = $('#'+index).attr('type');			
									if(tp=='radio' || tp=='checkbox'){ //alert(index+'--'+value);
									$('#'+index).attr('checked','checked');	
									}else{
									$('#'+index).val(value);	
									}			
									});			
									}",
							//}",		
							//'update'=>'#GuestInfo_guest_address', //selector to update //get id method
							'error'=>'function(xhr, ajaxOptions, thrownError){alert(xhr.status+\'--\'+thrownError); }',						
						)
				)			
		)); 
		}
		else{ if($model->reservation_id=='' || $model->reservation_id==NULL) $model->reservation_id=NULL;
		  echo $form->textField($model,'reservation_id', array('value' => $model->reservation_id, 'readonly'=>'readonly')); }
		?>
        <span id="res_loader" style="display:none"><img src="/hotel/images/processing.gif" alt="pro" /> </span>	      
		<?php echo $form->error($model,'reservation_id'); ?>
          </div>        
        
            <div style="clear:left"></div>
            
        
        <div class="row" style="float:left; margin-left:5px;">    
            <?php echo $form->labelEx($model,'drop_service'); ?>
            <?php echo $form->checkBox($model,'drop_service',array('value' => 'Y', 'uncheckValue'=>'N', 
					'onclick'=>	"javascript:
					if($('#CheckinInfo_drop_service').attr('checked')){			
							$('#CheckinInfo_flight_name').show();
							$('#CheckinInfo_flight_time').show();
						}else{
							$('#CheckinInfo_flight_name').hide();
							$('#CheckinInfo_flight_time').hide();
						}")); ?>
             <?php //echo $form->error($model,'drop_service'); ?>
              </div>

	<div class="row" style="float:left; margin-left:5px;"> 	
			 <?php echo $form->labelEx($model,'flight'); ?>               
             <?php echo $form->dropDownList($model,'flight_name', CHtml::listData(Flights::model()->findAll(), 'flight_id', 'flight_name'),array('prompt'=>'Select Flight','style'=>'display:block'));?> 		     
        </div>      
        
        <div class="row" style="float:left; margin-left:5px;">
        <?php echo $form->labelEx($model,'flight_time'); ?>   
         <?php echo $form->textField($model,'flight_time',array('size'=>'10','style'=>'Display:block')); ?>
         </div>         
</fieldset>



<fieldset>
  <legend class="mcelegend"  style="color:#900;">Guest Personal Information:</legend>
 
 <div class="row" style="float:left; margin-left:5px;">    
 		
    <?php echo $form->dropDownList($guest_info,'guest_salutation_id', CHtml::listData(Salutation::model()->findAll(), 'salutation_id', 
		'salutation_name')); 	?>
      <?php echo $form->error($guest_info,'guest_salutation_id'); ?>
      
       <?php echo $form->labelEx($guest_info,'guest_name'); ?>
      <?php echo $form->textField($guest_info,'guest_name',array('size'=>30,'maxlength'=>30)); ?>
      <?php echo $form->error($guest_info,'guest_name'); ?>
      </div>
      
      <div class="row" style="float:left; margin-left:5px;">   	
  	  <?php echo $form->labelEx($model,'guest_company_id'); ?>   
      <?php 
	  //$con = array("condition"=>"branch_id=$hotel_branch_id", 'order'=>'comp_name ASC');
	  $con = array("condition"=>"branch_id=$hotel_branch_id");
	  echo $form->dropDownList($model,'guest_company_id', CHtml::listData(Company::model()->findAll($con), 'comp_id','comp_name'));?>      
       <?php echo $form->error($model,'guest_company_id'); ?>
    </div>
      
	<!--<div class="row" style="float:left; margin-left:5px;">   			   
	   <?php //echo $form->labelEx($model,'sale_person_id'); ?>
	   <?php //echo $form->textField($model,'sale_person_id'); ?>
        <?php //echo $form->dropDownList($model,'sale_person_id', CHtml::listData(SalePerson::model()->findAll("branch_id=$hotel_branch_id"), 'sale_person_id', 'sale_person_name')); ?>
		<?php // echo $form->error($model,'sale_person_id'); ?>   
   </div>-->
      
	<div class="row" style="float:left; margin-left:5px;">   	
   		<?php echo $form->labelEx($model,'chkin_id'); ?>        
	   <?php echo $form->textField($model,'chkin_id',array('size'=>'10', 'readonly'=>'readonly')); ?>
       <?php echo $form->error($model,'chkin_id'); ?>
   </div>	
    
     <div style="clear:left"></div>
      
	<div class="row" style="float:left; margin-left:5px;">   	    
    <?php echo $form->labelEx($guest_info,'guest_mobile'); ?>	
   <?php echo $form->textField($guest_info,'guest_mobile',array('maxlength'=>'12',
		'ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('CheckinInfo/dynamicProfile'), //url to call.
		//Style: CController::createUrl('currentController/methodToCall')		
		//'update'=>'#GuestInfo_guest_address', //selector to update //get id method
		
		'beforeSend' => 'function(){ $("#city_loader").show(); }',
		//'complete' => 'function(data){alert(data); }',
		'success'=>"function(data){
		var obj=$.parseJSON(data);
		 $(\"#city_loader\").hide();	
		$.each(obj,function(index,value){	
			//alert(index+value);		
			//if(index=='CheckinInfo_guest_id' && value > 0){
				var tp = $('#'+index).attr('type');			
				if(tp=='radio' || tp=='checkbox'){
					$('#'+index).attr('checked','checked');	
				}else{	$('#'+index).val(value); }
			//}
			});			
			}",
		//'data'=>'js:javascript statement' 
		//leave out the data key to pass all form values through
		)));?>
        <span id="city_loader" style="display:none"><img src="/hotel/images/processing.gif" alt="pro" /> </span>
		<?php echo $form->error($guest_info,'guest_mobile'); ?>        
        </div>
      
	<div class="row" style="float:left; margin-left:5px;">   	
        <?php //Guest Id Field Will set id Found else it will get some default value which will call function to add 
     //new record and get id?>
		<?php //echo $form->labelEx($model,'guest_id'); ?>
		<?php //echo $form->textField($model,'guest_id'); ?><?php //echo $form->error($model,'guest_id'); ?>
      </div>  
     
     <div class="row" style="float:left; margin-left:5px;">     
    <?php //echo $form->labelEx($guest_info,'guest_gender'); ?>   
    <?php
	/*	 $guest_info->guest_gender = 'M'; 
		  echo $form->radioButtonList($guest_info,'guest_gender',array(
                            'M'=>'Male',
                            'F'=>'Female',                            
                    ),array(
                        'separator'=>'&nbsp;',
                        'labelOptions'=>array('style'=>'display: inline; margin-right: 10px; font-weight: normal;'),
                )); */ ?>
		<?php //echo $form->error($guest_info,'guest_gender'); ?>
     </div>  
     
     <div class="row" style="float:left; margin-left:5px;">      
    <?php echo $form->labelEx($guest_info,'guest_address'); ?>      
    <?php //$guest_info->guest_address = "Client Address here...";
	echo $form->textArea($guest_info, 'guest_address', array('maxlength' => 50, 'rows' => 1, 'cols' => 30)); ?>
      <?php echo $form->error($guest_info,'guest_address'); ?>   
       </div>  
      
      <div style="clear:left"></div>
      
     <div class="row" style="float:left; margin-left:5px;">       
    <?php echo $form->labelEx($guest_info,'guest_phone'); ?>
    <?php echo $form->textField($guest_info,'guest_phone'); ?>
	<?php echo $form->error($guest_info,'guest_phone'); ?>
     </div>  
     
     <div class="row" style="float:left; margin-left:5px;">     	
	<?php echo $form->labelEx($guest_info,'guest_email'); ?>
   <?php echo $form->textField($guest_info,'guest_email',array('size'=>30,'maxlength'=>50)); ?> <?php echo $form->error($guest_info,'guest_email'); ?>
    </div>  
     
     <div class="row" style="float:left; margin-left:5px;">       
    <?php echo $form->labelEx($guest_info,'guest_country_id'); ?>    
    <?php echo $form->dropDownList($guest_info,'guest_country_id', CHtml::listData(Country::model()->findAll(), 'country_id','country_name')); ?>        
	<?php echo $form->error($guest_info,'guest_country_id'); ?> 
     </div>  
     
     <div class="row" style="float:left; margin-left:5px;">     	
	<?php echo $form->labelEx($model,'newspaper_id'); ?>
    <?php echo $form->dropDownList(CheckinInfo::model(),'newspaper_id', CHtml::listData(Newspapers::model()->findAll(), 'newspaper_id', 
		'newspaper_name'),array('prompt'=>'Select News Paper'));?>
	<?php echo $form->error($model,'newspaper_id'); ?>
     </div>  
     
      <div style="clear:left"></div>
     
     <div class="row" style="float:left; margin-left:5px;">       
    <?php echo $form->labelEx($guest_info,'guest_identity_id'); ?>  
    <?php echo $form->dropDownList($guest_info,'guest_identity_id', CHtml::listData(Identity::model()->findAll(), 'identity_id', 'identity_description')); ?>        
	<?php echo $form->error($guest_info,'guest_identity_id'); ?>
     </div>  
     
     <div class="row" style="float:left; margin-left:5px;">         
    <?php echo $form->labelEx($guest_info,'guest_identity_no'); ?>
    <?php echo $form->textField($guest_info,'guest_identity_no'); ?> 
	<?php echo $form->error($guest_info,'guest_identity_no'); ?>   
     </div>  
     
     <div class="row" style="float:left; margin-left:5px;">       
    <?php echo $form->labelEx($guest_info,'issue_date'); ?>   
         <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(    
    'name'=>'GuestInfo[guest_identity_issu]',   
    'model'=>$guest_info,    
	'attribute'=>'guest_identity_issu',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
		'dateFormat'=>'dd-mm-yy',
    ),
    'htmlOptions'=>array( 
	'class'=>'hasDatepicker3',
	'style'=>'height:15px;',
    ),
));
?>	<?php echo $form->error($guest_info,'guest_identity_issu'); ?>
       </div>  
     
     <div class="row" style="float:left; margin-left:5px;">             
    <?php echo $form->labelEx($guest_info,'expiry_date'); ?> 
         <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(    
    'name'=>'GuestInfo[guest_identiy_expire]',   
    'model'=>$guest_info,   
	'attribute'=>'guest_identiy_expire', 
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
		'dateFormat'=>'dd-mm-yy',
    ),
    'htmlOptions'=>array( 
	'class'=>'hasDatepicker3',
	'style'=>'height:15px;',
    ),
));
?>	<?php echo $form->error($guest_info,'guest_identiy_expire'); ?>
     </div>  
     
      <div style="clear:left"></div>
     
     <div class="row" style="float:left; margin-left:5px;">    
    <?php echo $form->labelEx($guest_info,'guest_dob'); ?>   
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(    
    'name'=>'GuestInfo[guest_dob]',    
    'model'=>$guest_info,	   
	'attribute'=>'guest_dob', 
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
		'mode'=>'datetime',
		'dateFormat'=>'dd-mm-yy',
    ),
    'htmlOptions'=>array( 
	'class'=>'hasDatepicker3',
	'style'=>'height:15px;',
    ),
));
?><?php echo $form->error($guest_info,'guest_dob'); ?>
      </div>  
     
     <div class="row" style="float:left; margin-left:5px;">             
    <?php echo $form->labelEx($model,'guest_status_id'); ?>  
    <?php echo $form->dropDownList($model,'guest_status_id', CHtml::listData(GuestStatus::model()->findAll(), 'guest_status_id', 'status_description')); ?>
		<?php echo $form->error($model,'guest_status_id'); ?>
     </div>  
     
     <div class="row" style="float:left; margin-left:5px;">     		
    <?php echo $form->labelEx($model,'comming_from'); ?>		
    <?php echo $form->textField($model,'comming_from',array('size'=>20,'maxlength'=>20)); ?>
	<?php echo $form->error($model,'comming_from'); ?>
      </div>  
     
     <div class="row" style="float:left; margin-left:5px;">             
    <?php echo $form->labelEx($model,'destination'); ?>		
    <?php echo $form->textField($model,'next_destination',array('size'=>20,'maxlength'=>20)); ?>
	<?php echo $form->error($model,'next_destination'); ?>
     </div>  
         

 </fieldset>
 
 
 
 
<fieldset> <legend class="mcelegend"  style="color:#900;">Room Rate Information:</legend> 
  
   <div class="row" style="float:left; margin-left:5px;"> 
   <?php  
   if(!empty($model->room_id)) echo $form->hiddenField($model,'room_type', array('value'=>$model->room_type));
   else echo $form->hiddenField($model,'room_type', array('value'=>$myroomtypeid));
   ?>
	<?php echo $form->error($model,'room_type'); ?>
  </div>  
  
   <div class="row" style="float:left; margin-left:5px;">         
  <?php echo $form->labelEx($model,'room_id'); ?>
    <?php  //echo "--".$model->room_name."-".$model->room_type;
	 if(!empty($model->room_id) && !isset($myroomid)) { //update code
		
		//echo $model->room_name;	
	echo $form->dropDownList($model,'room_id', CHtml::listData(RoomMaster::model()->findAll("mst_roomtypeid =".$model->room_type." AND (mst_room_status='V' || mst_room_id=".$model->room_name.") AND branch_id=$hotel_branch_id"), 'mst_room_id', 'mst_room_name'),array('prompt'=>'Select Room'));	
	
		//echo $form->dropDownList($model, 'room_name', array(), array('prompt'=>'Select Room','onchange' => 'assignRoomid(this.value)'));
	}
	else if(isset($myroomid)) {
		//if(isset($myroomid))   $cond =  " mst_room_id = '$myroomid' AND mst_room_status='V' AND branch_id=$hotel_branch_id";
		$myroom = RoomMaster::model()->find(" mst_room_id=$myroomid")->mst_room_name;	
		echo $form->hiddenField($model,'room_id', array('value'=>$myroomid));	
		echo "<input type=\"text\" name=\"myroom\" id=\"myroom\" readonly=\"readonly\" value=\"". $myroom."\">";
	}
	
	else { //new 
	 $cond = " mst_room_status='V' AND branch_id=$hotel_branch_id";
	
	
	echo $form->dropDownList($model,'room_id', CHtml::listData(RoomMaster::model()->findAll($cond), 'mst_room_id', 'mst_room_name'),array('prompt'=>'Select Room','class'=>'chzn-select',
	'onchange' => CHtml::ajax(
						array(
							'type' => 'POST',
							'url' => CController::createUrl('CheckinInfo/DynamicRoomrate'),							
							'beforeSend' => 'function(){ $("#room_loader").show(); }',
							//'complete' => 'function(data){alert(data); }',
							'success'=>"function(data){ 
								var obj=$.parseJSON(data);	$(\"#room_loader\").hide();							
								$.each(obj,function(index,value){ //alert(index+'--'+value);
										
										var tp = $('#'+index).attr('type');	
										if(tp=='text'){ $('#'+index).val(value); rate_update_total(); }	
										else if(index=='CheckinInfo_room_type')	$('#'+index).val(value);							
										else  $('#'+index).html(value);
								}); 
							}",		
							//'update'=>'#GuestInfo_guest_address', //selector to update //get id method
							'error'=>'function(xhr, ajaxOptions, thrownError){alert(xhr.status+\'--\'+thrownError); }',												
							//'update' => '#' . CHtml::activeId($model, 'room_name'),
						)
				)			
		)); 	
	}
	//echo $form->dropDownList($model, 'room_id', array(), array('prompt'=>'Select Room','onchange' => 'assignRoomid(this.value)')); ?> 
    <span id="room_loader" style="display:none"><img src="/hotel/images/processing.gif" alt="pro" /> </span>
	<?php echo $form->error($model,'room_id'); ?>      
	<?php //echo $form->hiddenField($model,'room_id', array('value'=>'1'));	?>     
    </div>  
     
     <div class="row" style="float:left; margin-left:5px;">         
   <?php echo $form->labelEx($model,'rate'); ?>        
   <?php echo $form->textField($model,'rate',array('size'=>'8', 'onchange'=>'changeTotalCharges()')); ?>   
   <?php echo $form->error($model,'rate'); ?>
    </div>       
    
     <div class="row" style="float:left; margin-left:5px;">         
    <?php echo $form->labelEx($model,'comments'); ?>
    <?php echo $form->textField($model,'comments',array('size'=>20,'maxlength'=>50)); ?>
     <?php echo $form->error($model,'comments'); ?>
    </div> 
     
     <div class="row" style="float:left; margin-left:5px;">         
    <?php echo $form->label($model,'Total persons'); ?>
        <script>
        function t_p(){			
			var adlt = $('#CheckinInfo_total_person').val();
			document.getElementById('b_tax').value = adlt;
			}
        </script>
    <?php echo $form->error($model,'total_person'); ?>
	<?php 
	if($model->isNewRecord)
	echo $form->textField($model,'total_person',array('size'=>'2px', 'value'=>'1', 'onblur'=>'t_p()'));
	else echo $form->textField($model,'total_person',array('size'=>'2px', 'onblur'=>'t_p()'));
	 ?>
    </div>  
    
     <div style="clear:left"></div>
     
     <div class="row" style="float:left; margin-left:5px;">          
    <span class="mcetd">
    <?php echo $form->labelEx($model,'bed_tax'); ?>
	<?php echo $form->checkBox($model,'bed_tax',array('value' => 'Y', 'uncheckValue'=>'N','onclick'=>'btax()')); ?> 
	<?php echo $form->error($model,'bed_tax'); ?></span>
    <input type="text" id="b_tax" name="b_tax" value="0" class=" mceinput" style="width:30px" />
    </div>  
     
     
     
     <div class="row" style="float:left; margin-left:5px;">       
    Childrens: <input type="text" id="childs" name="childs" value="" disabled="disabled" style="width:20px;" />
   </div>  
     
     <div class="row" style="float:left; margin-left:5px;">           
    Extra Bed : <input type="checkbox" id="e_bd" onclick="show()"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="extra_bed" name="extra_bed" style="width:50px;" onblur="tamount_ext()" disabled="disabled" />	 
	 <?php echo $form->hiddenField($model,'extra_bed',array('size'=>10,'maxlength'=>25,'value'=>'')); 
	
	 ?>    
  </div>  
     
      
     
     <div class="row" style="float:left; margin-left:5px;">       
    <?php echo $form->labelEx($model,'gst'); ?>
    <span class="mcetd">
	<?php echo $form->checkBox($model,'gst',array('value' => 'Y', 'uncheckValue'=>'N','onclick'=>'get_wgst()')); ?> 
	<?php echo $form->error($model,'gst'); ?> </span>
    
    <?php $gst_rate =  ServiceGst::model()->find("gst_service_id = 2 AND branch_id=". yii::app()->user->branch_id)->gst_percent; ?>
    
    <input id="r_gst" name="r_gst" value="<?php echo $gst_rate; ?>" readonly="readonly" style="width:25px; font-size:10px;" />%
    <input type="text"  name="gst_amount" id="gst_amount" value="" class=" mceinput mcerateinput1" style="width:50px" />
    <?php //echo $form->hiddenField($model,'gst_amount',array('size'=>10,'maxlength'=>25,'value'=>'')); ?>
  </div>  
  
   <div class="row" style="float:left; margin-left:5px;">           
    <?php echo $form->labelEx($model,'total_charges'); ?>
    <?php echo $form->textField($model,'total_charges',array('size'=>'8')); ?><?php echo $form->error($model,'total_charges'); ?>
      </div> 
  
   <div style="clear:left"></div>
  
   <div class="row" style="float:left; margin-left:5px;">
   <?php //echo $form->checkBox($model,'bed_tax',array('value' => 'Y', 'uncheckValue'=>'N','onclick'=>'btax()')); ?>            
    <span class="mcetd">  Cash<?php  echo $form->checkBox($model,'cash',array('value' => 'Y', 'uncheckValue'=>'N')); ?>    </span>
    <span class="mcetd">  C/Card<?php  echo $form->checkBox($model,'credit_card',array('value' => 'Y', 'uncheckValue'=>'N')); ?>    </span>
    <span class="mcetd">  D/Card<?php  echo $form->checkBox($model,'debit_card',array('value' => 'Y', 'uncheckValue'=>'N')); ?>  </span>
    <span class="mcetd">  BTC<?php  echo $form->checkBox($model,'btc',array('value' => 'Y', 'uncheckValue'=>'N')); ?>  </span>
    </div>
     
     
     
     
     
     <div class="row" style="float:left; margin-left:5px;">           
    <?php echo $form->labelEx($model,'amount_paid'); ?>
    <?php echo $form->textField($model,'amount_paid',array('size'=>'8')); ?><?php echo $form->error($model,'amount_paid'); ?>
    </div>  
     
     <div class="row" style="float:left; margin-left:5px;">       
    Balance:  <input type="text" id="balance" name="balance" style="width:75px"  disabled="disabled"/>
    </div>  
     
    
    <?php echo $form->hiddenField($model,'rate_type',array('value'=>'1')); ?>         
    <?php echo $form->hiddenField($model,'chkout_status',array('value'=>'N')); ?>
    <?php echo $form->hiddenField($model,'chkin_user_id',array('value'=>$user_id)); ?>
    <?php echo $form->hiddenField($model,'gst_amount',array('value'=>0)); ?>
     
      <div style="clear:left"></div>
      
     <div class="row" style="float:left; margin-left:5px;">           
    <span class="mcetd">          
    <?php  echo $form->checkBox($model,'prev_night',array('value' => 'Y', 'uncheckValue'=>'N','onclick'=>'prevNight()')); ?> 
	<?php echo $form->error($model,'prev_night'); ?> 
    </span>Charge Previous Night
    </div>  
     
   
    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Check-IN' : 'Save', array('id'=>'btn_submit')); ?>
	</div>
    
    
  </fieldset>
<?php $this->endWidget(); ?>
</div><!-- form -->







<script>
 var DateDiff = {

    inDays: function() { 
		var nn = document.getElementById('CheckinInfo_chkin_date').value.split("-");
		var mm = document.getElementById('CheckinInfo_chkout_date').value.split("-");
		//alert(nn+'--'+mm);	
		var n = nn[2]+'/'+nn[1]+'/'+nn[0];
		var m = mm[2]+'/'+mm[1]+'/'+mm[0];
		//alert(n+'--'+m);	
		var d1 = new Date(n);
		var d2 = new Date(m);
		var t2 = d2.getTime();
        var t1 = d1.getTime();

        var res = parseInt((t2-t1)/(24*3600*1000)); 
		if(res >= 1) document.getElementById('CheckinInfo_total_days').value = res;
		else document.getElementById('CheckinInfo_total_days').value = 1;
    },
 }
 
 /////////////////////////////////
 function changeTotalCharges(){
	var rate = $("#CheckinInfo_rate").val();
	$("#CheckinInfo_total_charges").val(rate);	
 }
////////////////////////////////////
	function assignRoomid(x){		
		//$("#room_id").value = x;		
		document.getElementById('CheckinInfo_room_id').value= x;		
	}
///////////////////////////////////////
function prevNight(){ 
	//var ch_val = $('#CheckinInfo_prev_night').attr('checked');
	//if(ch_val=="checked")	$('#CheckinInfo_prev_night').val('Y');
	//else $('#CheckinInfo_prev_night').val('N');
	
	//alert($('#CheckinInfo_prev_night').val());
}
////////////////////
	 function get_wgst(){
		 
		/*  var tc = $('#CheckinInfo_total_charges').val();
		 var gst=  parseInt(tc)+ Math.round(tc * 0.16);
		 $('#CheckinInfo_total_charges').val(gst); */
					
			 var ch_val = $('#CheckinInfo_gst').attr('checked');
			if(ch_val=="checked"){ 
				var rate = document.getElementById('CheckinInfo_rate').value;
				var days = document.getElementById('CheckinInfo_total_days').value;			
				var r_gst =document.getElementById('r_gst').value;			
			
			var res = rate * days;
			
			var gst = rate * r_gst/100;
			var days = parseInt( $('#CheckinInfo_total_days').val() ) * gst; 
			var t_charges = parseInt( $('#CheckinInfo_total_charges').val() ); 
			
			var t_charg = t_charges + Math.round(days);
			
			document.getElementById('CheckinInfo_total_charges').value = t_charg;
			document.getElementById('gst_amount').value= Math.round(gst);
			$('#CheckinInfo_gst_amount').val(gst);
			
			
				}else{
					var t_charges = parseInt( $('#CheckinInfo_total_charges').val() );
					var g_amount = document.getElementById('gst_amount').value;
					
					var days = parseInt( $('#CheckinInfo_total_days').val() ) * g_amount; 
					var n_amount = t_charges - days;
					//alert(n_amount);
					document.getElementById('gst_amount').value=0;
					var Zval = 0;
					$('#CheckinInfo_gst_amount').val(Zval);
					document.getElementById('CheckinInfo_total_charges').value = n_amount;
					
					} 
			}
/////////////////////////////////////
		function rate_update_total(){
			
			var ch_val = $('#CheckinInfo_gst').attr('checked');
			if(ch_val=="checked"){
			//var total_charges = document.getElementById('CheckinInfo_total_charges').value;
			var day = document.getElementById('CheckinInfo_total_days').value;
			document.getElementById('CheckinInfo_total_charges').value = "";
								//document.getElementById('CheckinInfo_rate').value="0";
								
			var rate = document.getElementById('CheckinInfo_rate').value;
			var gst = document.getElementById('r_gst').value;
			var gst_amount = rate * gst / 100;			//alert(rate);
			
			var total = rate * day;
			var total1 = gst_amount + total;
			document.getElementById('gst_amount').value = gst_amount;
			document.getElementById('CheckinInfo_total_charges').value = total1;
				}else{
					var day = document.getElementById('CheckinInfo_total_days').value;
					var rate = document.getElementById('CheckinInfo_rate').value;
					var total = rate * day;
					document.getElementById('CheckinInfo_total_charges').value = total;
					
					}
			}	
/////////////////////////////////////
    function btax(){
		
		var ch_val = $('#CheckinInfo_bed_tax').attr('checked');
		var adults = 0;
		if($('#CheckinInfo_total_person').val()!='')
			var adults = parseInt($('#CheckinInfo_total_person').val() );		
		
		if(ch_val=="checked"){			
			document.getElementById('b_tax').value= adults;
			var t_charges = parseInt( $('#CheckinInfo_total_charges').val() );
			var amt = t_charges + adults; 
			document.getElementById('CheckinInfo_total_charges').value= amt;
		}else{
			document.getElementById('b_tax').value= 0;
			var tt = document.getElementById('CheckinInfo_total_charges').value;
			var n_val = tt - adults;			
			document.getElementById('CheckinInfo_total_charges').value = n_val;
		}
				
		}
///////////////////////////////////
	function tamount_ext(){			
		var e_bed = parseInt( $('#extra_bed').val() ); 
		$('#CheckinInfo_extra_bed').val(e_bed)
		var t_charges = parseInt( $('#CheckinInfo_total_charges').val() ); 
		var charg_ext = e_bed + t_charges;
		document.getElementById('CheckinInfo_total_charges').value= charg_ext;
			
		}
/////////////////////////////////		
	function show(){
		var ch_val = $('#e_bd').attr('checked');
		if(ch_val=="checked"){document.getElementById('extra_bed').disabled = false;}
		else{
				document.getElementById('extra_bed').disabled = true;
				var e_bed = parseInt( $('#extra_bed').val() ); 
				var t_charges = parseInt( $('#CheckinInfo_total_charges').val() ); 
				var charg_ext = t_charges - e_bed;
				document.getElementById('CheckinInfo_total_charges').value= charg_ext;
				document.getElementById('extra_bed').value = 0;				
				}
		}	
/////////////////////////////////
	function testit(){			
			$('#GuestInfo_guest_gender_0').attr('checked','checked');
			$('#CheckinInfo_gst').attr('checked','checked');			
			alert($('#GuestInfo_guest_gender_0').attr('type'));
			alert($('#CheckinInfo_gst').attr('type'));
	}
	
	$(document).ready(function(){
		$("#GuestInfo_guest_gender_1").css('margin-left' ,'100px');			
		$("#GuestInfo_guest_gender_1").next("label").css('margin-right' ,'-85px');	
		$("#CheckinInfo_guest_status_id").parent().next("div").find('label').css('width' ,'125px');	
		//CheckinInfo_comming_from
		$("#CheckinInfo_comming_from").parent().next("div").find('label').css('width' ,'125px');	
		$("#GuestInfo_guest_identity_issu").parent().next("div").find('label').css('width' ,'120px');	
	});
</script>