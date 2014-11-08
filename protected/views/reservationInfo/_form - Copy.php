<style>
input{
	margin-bottom:0px;
}
input[type="text"]{
	width:120px;
}
textarea{
	width:120px;
	min-height:20px;
}
select{
	width:125px;
}
::-webkit-input-placeholder {
   color: red;
}
:-moz-placeholder { /* Firefox 18- */
   color: red;  
}
::-moz-placeholder {  /* Firefox 19+ */
   color: red;  
}
:-ms-input-placeholder {  
   color: red;  
}
.mem{
	background-color:#FFFFFF;
	font:Georgia, "Times New Roman", Times, serif;
	font-size:12px;
	font-weight:bold;
	color:#900;
	
}
</style>
<script src="<?php echo Yii::app()->baseUrl."/js/jquery.inputmask.js"?>"></script>


<script>
$("#ReservationInfo_client_salutation_id").css('width','50px'); //
$("#ReservationInfo_client_name").css('width','280px');
$("#ReservationInfo_client_address").css('width','340px');
$("#ReservationInfo_reservation_id").css('width','50px');
$("#ReservationInfo_client_remarks").css('width','558px');

//$("#ReservationInfo_client_mobile").inputmask("0999-9999999",{placeholder:"_", clearIncomplete: true });
$("#ReservationInfo_guest_mobile").inputmask("0999-9999999",{placeholder:"_", clearIncomplete: true });


$(document).ready(function(){
var add = $("#ReservationInfo_client_identity_id").val();
if(add==1){$("#ReservationInfo_client_identity_no").inputmask("99999-9999999-9",{placeholder:"_", clearIncomplete: true });}
else if(add==2){ $("#ReservationInfo_client_identity_no").inputmask("***************",{placeholder:"", clearIncomplete: false }); }
else { $("#ReservationInfo_client_identity_no").inputmask("***************",{placeholder:"", clearIncomplete: false }); }
});

function test(add){
	if(add==1){$("#ReservationInfo_client_identity_no").inputmask("99999-9999999-9",{placeholder:"_", clearIncomplete: true });}
else if(add==2){ $("#ReservationInfo_client_identity_no").inputmask("***************",{placeholder:"", clearIncomplete: false }); }
else { $("#ReservationInfo_client_identity_no").inputmask("***************",{placeholder:"", clearIncomplete: false }); }
}
</script>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reservation-info-form',
	//'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false,'validateOnChange'=>false),
)); 
$hotel_branch_id = yii::app()->user->branch_id;
$user_id = yii::app()->user->id;
$date_value = ''; 
if($model->isNewRecord==true){$date_value1 = date('d-m-Y'); $date_value2 = date('d-m-Y', strtotime(date('Y-m-d'). ' +1 day')); $t_days = 1;} 
else {$date_value1 = $model->chkin_date;  $date_value2 = $model->chkout_date; $t_days = $model->total_days;}
?>
	<!--<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
-->
	<?php echo $form->errorSummary($model); ?>
    	
		<?php echo $form->hiddenField($model,'cancel_status',array('size'=>2,'maxlength'=>2,'value'=>'N')); ?>		
		<?php echo $form->hiddenField($model,'cancel_date'); ?>		
        <?php echo $form->hiddenField($model,'c_date',array('value'=> date('Y-m-d'))); ?>  
		<?php echo $form->hiddenField($model,'cancel_reason',array('size'=>50,'maxlength'=>50)); ?>	    	
		<?php echo $form->hiddenField($model,'chkin_status',array('size'=>2,'maxlength'=>2,'value'=>'N')); ?>		
		<?php echo $form->hiddenField($model,'noshow_status',array('size'=>2,'maxlength'=>2,'value'=>'N')); ?>
        <?php echo $form->hiddenField($model,'cancel_by',array('value'=>$user_id)); ?>			
        <?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>    	
		<?php echo $form->hiddenField($model,'user_id',array('value'=>$user_id)); ?> 
        
        <?php 
		$sales_person_id = SalePerson::model()->find("branch_id = $hotel_branch_id")->sale_person_id;
		echo $form->hiddenField($model,'sale_person_id',array('value'=>$sales_person_id)); ?>    	
        <?php echo $form->hiddenField($model,'client_identity_id',array('value'=>1)); ?> 
	
  <fieldset>
    <legend class="mcelegend" style="color:#900;">Company Information :</legend>
   
   
     <div class="row" style="float:left; margin-left:5px; di">  
 <?php echo $form->labelEx($model,'company_id'); ?>       
    <div style="float:left">
    <?php 
	$con = array("condition"=>"branch_id=$hotel_branch_id", "order"=>"comp_name");
	
	echo $form->dropDownList($model,'company_id', CHtml::listData(Company::model()->findAll($con), 'comp_id','comp_name')
	,array(
		//'options' => array('1'=>array('selected'=>true)),	
		'prompt'=>'Select Company',	
		'ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('ReservationInfo/dynamicProfile'), //url to call.
		//Style: CController::createUrl('currentController/methodToCall')
		'beforeSend' => 'function(){ $("#city_loader").addClass("loading"); }',
    	'complete' => 'function(data){$("#city_loader").removeClass("loading"); }',
		//'update'=>'#GuestInfo_guest_address', //selector to update //get id method
		'error'=>'function(xhr, ajaxOptions, thrownError){alert(xhr.status+\'--\'+thrownError); }',		
		'success'=>"function(data){ 
			var obj=$.parseJSON(data);		
			$.each(obj,function(index,value){			
			  var tp = $('#'+index).attr('type');			
				if(tp=='radio' || tp=='checkbox'){
					$('#'+index).attr('checked','checked');	
				}else{
					$('#'+index).val(value);	
				}			
			});			
			}",
		//'data'=>'js:javascript statement' 
		//leave out the data key to pass all form values through
		))); 
		?>
        </div>
        <div id="city_loader"></div>	   
 	 </div>  
           
 <div class="row" style="float:left; margin-left:5px;">    
    <?php echo $form->labelEx($model,'to_person'); ?>
	<?php echo $form->textField($model,'to_person',array('size'=>20,'maxlength'=>20)); ?> 	
 </div>
     
      <div class="row" style="float:left; margin-left:5px;">      	
	<?php echo $form->labelEx($model,'designation'); ?>
	<?php echo $form->textField($model,'designation',array('size'=>20,'maxlength'=>20)); ?>	
  </div>
   
 <div class="row" style="float:left; margin-left:5px;">      	
	<?php echo $form->labelEx($model,'client_mobile'); ?>
	<?php echo $form->textField($model,'client_mobile',array('maxlength'=>'12')); ?> 	
 </div> 
  
    <div style="clear:left"></div>
  
 <div class="row" style="float:left; margin-left:5px;">      	  
	<?php echo $form->labelEx($model,'client_phone'); ?>
	<?php echo $form->textField($model,'client_phone'); ?>		
 </div> 
 
 <div class="row" style="float:left; margin-left:5px;">   
 <?php echo $form->labelEx($model,'res_type'); ?>
 <?php echo $form->checkBox($model,'res_type',array('value' => 'G', 'uncheckValue'=>'I',"onclick"=>"js:
 					
					if($(this).is(\":checked\")==true){
					$('#group_row0').hide();											
					$('#group_row').show();	
					$('#group_row2').show();
					$('#ReservationInfo_group_name').focus();	
					this.value = 'G';
					}else{	
					$('#group_row').val('');	$('#group_row2').val('');					
					$('#group_row').hide();
					$('#group_row2').hide();
					$('#group_row0').show();
					this.value = 'I';	
					}					
					",	
				)); ?>  
   </div>
   
   <?php 
   	if(isset($model->res_type) && $model->res_type=='G'){ $sh = "style=\"display:block\" "; $sh2 = "style=\"display:none\" ";}
    else {$sh = "style=\"display:none\" "; $sh2 = "style=\"display:block\" "; }
   ?>
   
    <div class="row" style="float:left; margin-left:5px;">      
  <span class="mcetr" <?php echo $sh2; ?> id="group_row0">
    <?php echo "Individual"; ?>
	
    </span> 
 </div>
 
   <!--<div class="row" style="float:left; margin-left:5px;">      
  <span class="mcetr" <?php echo $sh; ?> id="group_row">
    <?php //echo $form->labelEx($model,'group_name'); ?>  
    </span> 
 </div>
-->
 <?php echo $form->hiddenField($model,'group_name',array('size'=>30,'maxlength'=>30, 'onBlur'=>'groupname_ob()')); ?> 
 <script>
 function groupname_ob(){
	$("#ReservationInfo_total_reservations").focus();
 }
 function totalres_ob(){ 
 	var a = $("#ReservationInfo_total_reservations").val();
	//alert(a);
	 if(a=='')
	$("#ReservationInfo_total_reservations").focus();
 }
 </script>
 
  <div class="row" style="float:left; margin-left:5px;">  
  <span class="mcetr" <?php echo $sh; ?> id="group_row2">    	  
	<?php echo $form->labelEx($model,'total_reservations'); ?>
    <?php echo $form->textField($model,'total_reservations',array('size'=>30,'maxlength'=>30, 'onBlur'=>'totalres_ob()')) ?>
     
    </span> 
   
     </div> 
     
 <div id="group_members" class="mem" style="margin-top:20px; float:left !important"><?php echo $str; ?></div>
 </fieldset>
 
 
 
 
 
  <fieldset>
    <legend class="mcelegend" style="color:#900;">Arrival Information :</legend>
   
   
   <div class="row" style="float:left; margin-left:5px;">
   <?php echo $form->labelEx($model,'chkin_date'); ?>
				 <?php 
				 $this->widget('zii.widgets.jui.CJuiDatePicker', array(    
					'name'=>'ReservationInfo[chkin_date]',					
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
					'style'=>'height:24px;',
					'value'=>$date_value1,
					),
				));
						 
				?>       
		<?php //echo $form->error($model,'chkin_date'); ?>        
        </div>        
        
        <div class="row" style="float:left; margin-left:5px;">		  
		  <?php echo $form->labelEx($model,'chkout_date'); ?>          
         <?php 		 
		  $this->widget('zii.widgets.jui.CJuiDatePicker', array(    
					'name'=>'ReservationInfo[chkout_date]',					
					'attribute'=>'chkout_date',   
					'model'=>$model, 					
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'dd-mm-yy',
						'minDate'=> 'DateDiff.getMinDate()', 
						
					),
					'htmlOptions'=>array( 
					'class'=>'hasDatepicker3',
					'style'=>'height:24px;',
					'value'=>$date_value2,
					'onchange'=>'DateDiff.inDays()',
					),
				));		 
			?>
            <?php //echo $form->error($model,'chkout_date'); ?>
</div>
	
 <script> 
 var DateDiff = {
    inDays: function() {		
		var nn = document.getElementById('ReservationInfo_chkin_date').value.split("-");
		var mm = document.getElementById('ReservationInfo_chkout_date').value.split("-");
		//alert(nn+'--'+mm);	
		var n = nn[2]+'/'+nn[1]+'/'+nn[0];
		var m = mm[2]+'/'+mm[1]+'/'+mm[0];
		//alert(n+'--'+m);	
		var d1 = new Date(n);
		var d2 = new Date(m);
		var t2 = d2.getTime();
        var t1 = d1.getTime();
        var res = parseInt((t2-t1)/(24*3600*1000)); 
		if(res >= 1) document.getElementById('ReservationInfo_total_days').value = res;
		else document.getElementById('ReservationInfo_total_days').value = 1;
    },
	
	getMinDate: function(){
		 var minDate = new Date(); //alert(minDate.getDate() - (7));    
   		// minDate.setDate(minDate.getDate() - (7)); 
		 minDate.setDate(minDate.getDate()); 
	}
 }</script>
 
 <div class="row" style="float:left; margin-left:5px;">	  
	  <?php echo Yii::t('views','nights');//$form->labelEx($model,'nights'); ?>
	  <?php echo $form->textField($model,'total_days',array('size'=>'5', 'readonly'=>'readonly','value'=>$t_days)); ?>
		<?php //echo $form->error($model,'total_days'); ?>        
 </div>
 
 <div class="row" style="float:left; margin-left:5px;">	  
	  <?php echo $form->labelEx($model, 'reservation_id'); ?>
	  <?php echo $form->textField($model,'reservation_id',array('size'=>'5', 'Maxlength'=>'15', 'readonly'=>'readonly','value'=>$model->reservation_id)); ?>
		<?php //echo $form->error($model,'total_days'); ?>        
 </div>
 
 <div class="row" style="float:left; margin-left:5px;">         
    </div>
    
    
    
   <div style="clear:left"></div>
   
   
	<div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'pick_service'); ?>
		<?php echo $form->checkBox($model,'pick_service',array('value' => 'Y', 'uncheckValue'=>'N', 'onclick'=>'updateService()')); ?>		      
   </div>
	<div class="row" style="float:left; margin-left:5px;"> 
		<?php echo $form->dropDownList($model,'flight_name', CHtml::listData(Flights::model()->findAll(), 'flight_id', 
		'flight_name'),array('prompt'=>'Select Flight',
		//'disabled'=>'disabled',
		'ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('ReservationInfo/DynamicFtime'), //url to call.		
		'success'=>"function(data){
			var obj=$.parseJSON(data);			
			$('#ReservationInfo_flight_time').val(obj.flight_time);			
			}",		
		))); ?>        
        </div>
	<div class="row" style="float:left; margin-left:5px;">
		 <?php ////echo $form->textField($model,'flight_time',array('size'=>8,'maxlength'=>10, 'disabled'=>'disabled'));
		 echo $form->textField($model,'flight_time',array('size'=>8,'maxlength'=>10)); 
		  ?> 
    </div>
    
		<div class="row" style="float:left; margin-left:5px;">		
		<?php echo $form->labelEx($model,'drop_service'); ?>
		<?php echo $form->checkBox($model,'drop_service',array('value' => 'Y', 'uncheckValue'=>'N', 'onclick'=>'updateService()')); ?>
        		<?php echo $form->dropDownList($model,'drop_flight_name', CHtml::listData(Flights::model()->findAll(), 'flight_id', 
		'flight_name'),array('prompt'=>'Select Flight',
		//'disabled'=>'disabled',
		'ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('ReservationInfo/DynamicDtime'), //url to call.		
		'success'=>"function(data){
			var obj=$.parseJSON(data);			
			$('#ReservationInfo_drop_flight_time').val(obj.drop_flight_time);			
			}",	
		))); ?>		      
        </div>
	<div class="row" style="float:left; margin-left:5px;">			
		<?php //echo $form->textField($model,'drop_flight_time',array('size'=>10,'maxlength'=>10, 'disabled'=>'disabled'));
		echo $form->textField($model,'drop_flight_time',array('size'=>10,'maxlength'=>10));
		 ?> 		     
	   </div>	
  </fieldset>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
    
    <fieldset>
  <legend class="mcelegend" style="color:#900;">Guest Person Information:</legend>
   
   <div class="row"  id="row_0" style="float:left; margin-left:5px; ">      
   <?php echo $form->labelEx($model,'client_name'); ?>
	<?php	
	echo $form->dropDownList($model,'client_salutation_id', CHtml::listData(Salutation::model()->findAll(), 'salutation_id','salutation_name')); 
	echo "&nbsp;&nbsp".$form->textField($model,'client_name',array('size'=>30,'maxlength'=>30));
	
		
	/*echo $form->dropDownList($model,'client_salutation_id', CHtml::listData(Salutation::model()->findAll(), 'salutation_id','salutation_name')); 
	echo "&nbsp;&nbsp".$form->textField($model,'client_name',array('size'=>30,'maxlength'=>30, 'autocomplete'=>'off',  'onkeyup'=>'suggest(this.value)', 'onblur'=>'fill()' ));*/
	?>
    
   <!--  <div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="<?php //echo Yii::app()->request->baseUrl; ?>/images/arrow.png" style="position: relative; top: -10px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
      </div>-->
      
    </div>
	
    
    <div class="row"  id="row_0" style="float:left; margin-left:5px; "> 
     <?php echo $form->labelEx($model,'guest_mobile'); ?> 
    <?php echo $form->textField($model,'guest_mobile',array('maxlength'=>12));	?>
    </div>	    
    
     <div class="row"  id="row_0" style="float:left; margin-left:5px; "> 
     <?php echo $form->labelEx($model,'guest_phone'); ?> 
    <?php echo $form->textField($model,'guest_phone',array('size'=>15,'maxlength'=>15));	?>
    </div>	
     
     <div style="clear:left"></div>
      
 
      <div class="row" style="float:left; margin-left:5px;">         
        <?php echo $form->labelEx($model,'client_address'); ?>
        <?php echo $form->textField($model,'client_address',array('size'=>50,'maxlength'=>255)); ?>
     </div>
     
     <div class="row" style="float:left; margin-left:5px;">      		
		<?php echo $form->labelEx($model,'client_country_id'); ?>
		<?php echo $form->dropDownList($model,'client_country_id', CHtml::listData(Country::model()->findAll(), 'country_id','country_name'), array('onchange'=>'updateClientIdentity(this.value)')); ?>				
 	</div>
    
    <script>function updateClientIdentity(x){		
		if(x > 1){	$('#ReservationInfo_client_identity_id [value="2"]').attr('selected',true);	}
		else {$('#ReservationInfo_client_identity_id [value="1"]').attr('selected',true);}
	}</script>
     
     <div class="row" style="float:left; margin-left:5px;">      		
            <?php echo $form->labelEx($model,'client_email'); ?>
            <?php echo $form->textField($model,'client_email',array('size'=>30,'maxlength'=>30)); ?>            
      </div>   
     
  <div style="clear:left"></div>
  
  	<div class="row" style="float:left; margin-left:5px;">       
    <?php echo $form->labelEx($model,'client_identity_id'); ?>  
    <?php echo $form->dropDownList($model,'client_identity_id', CHtml::listData(Identity::model()->findAll(), 'identity_id', 'identity_description'), array('onchange' => 'test(this.value)')); ?>        
	</div>  
     
     <div class="row" style="float:left; margin-left:5px;">         
    <?php echo $form->labelEx($model,'client_identity_no'); ?>
    <?php echo $form->textField($model,'client_identity_no',array('size'=>15,'maxlength'=>15)); ?> 	  
     </div>
  
  
   <div style="clear:left"></div>
 </fieldset>
 
 
 
 
 
 
 
 
 
 
 
 
  
 
 
 
 
 
 
    
<fieldset>
  <legend class="mcelegend" style="color:#900;">Room Info</legend>
    <div class="row" style="float:left; margin-left:5px;display:block;">       
   <?php echo $form->labelEx($model,'room_type'); ?>
   <?php
	$bid = yii::app()->user->branch_id;	
	echo $form->dropDownList($model,'room_type', CHtml::listData(HmsRoomType::model()->findAll("branch_id=$bid"), 'room_type_id', 'room_name'),array('prompt'=>'Select Room Type',
		 'onchange' => CHtml::ajax(
						array(
							'type' => 'POST',
							'url' => CController::createUrl('ReservationInfo/dynamicRooms'),							
							'beforeSend' => 'function(){ $("#res_loader").show(); }',
							//'complete' => 'function(data){alert(data); }',
							'success'=>"function(data){ 
								var obj=$.parseJSON(data); $(\"#res_loader\").hide();										
								$.each(obj,function(index,value){
										var tp = $('#'+index).attr('type');	
										if(tp=='text'){ $('#'+index).val(value); }									
										else  $('#'+index).html(value);										
								}); 
							}",
		
							//'update'=>'#GuestInfo_guest_address', //selector to update //get id method
							'error'=>'function(xhr, ajaxOptions, thrownError){alert(xhr.status+\'--\'+thrownError); }',												
							//'update' => '#' . CHtml::activeId($model, 'room_name'),
						)
				)			
		)); 
	?>
     <span id="res_loader" style="display:none"><img src="/hotel/images/processing.gif" alt="pro" /> </span>		
	<?php //echo $form->error($model,'room_type'); ?>
	 </div>
        
<!--  <div class="mcetr" id="roomnamerow" style="float:left; margin-left:5px;">
    <?php //echo $form->labelEx($model,'room_name'); ?>    
    	<?php 
/* 
		if(!empty($model->room_name)) {	
	echo $form->dropDownList($model,'room_name', CHtml::listData(RoomMaster::model()->findAll("mst_roomtypeid =".$model->room_type." AND (mst_room_status='V' || mst_room_id=".$model->room_name.") AND branch_id=$bid"), 'mst_room_id', 'mst_room_name'),array('prompt'=>'Select Room'));	
	}
	else
	echo $form->dropDownList($model, 'room_name', array(), array('prompt'=>'Select Room','onchange' => 'assignRoomid(this.value)')); 			     */
?>
    </div>-->
    	
    <div class="row" style="float:left; margin-left:5px;"> 
       <?php echo $form->labelEx($model,'room_charges'); ?>          
       <?php echo $form->textField($model,'room_charges'); ?>		     
    </div>    
      <div class="row" style="float:left; margin-left:5px;">
  	 	<?php echo $form->labelEx($model,'mode_of_payment'); ?> 
		<?php 
			$mop = array();
		$mop['1'] = 'Cash/Credit Card'; $mop['2'] = 'BTC'; 
		echo $form->dropDownList($model,'mode_of_payment',$mop); 
		//echo $form->textField($model,'mode_of_payment'); ?>
        </div>
    <div class="row" style="float:left; margin-left:5px;">    	
    <?php echo $form->labelEx($model,'advance'); ?>
	<?php echo $form->textField($model,'advance'); ?>
    </div> 
    
     <div style="clear:left"></div>
    
    <div class="row" style="float:left; margin-left:5px;">
   <?php echo $form->labelEx($model,'reservation_status'); ?> 
 <?php 
 if($model->isNewRecord)
 echo $form->dropDownList($model,'reservation_status', CHtml::listData(ReservationStatus::model()->findAll(), 'res_id','res_description'),array('prompt'=>'Select Status', 'options'=>array(1=>array('selected'=>'selected')))); 
else 
echo $form->dropDownList($model,'reservation_status', CHtml::listData(ReservationStatus::model()->findAll(), 'res_id','res_description'),array('prompt'=>'Select Status')); ?>
        </div>
        
	<div class="row" style="float:left; margin-left:5px;">  
		<?php echo $form->labelEx($model,'client_remarks'); ?>
		<?php echo $form->textField($model,'client_remarks',array('size'=>50,'maxlength'=>50)); ?> 
    <?php //echo $form->labelEx($model,'discount'); ?>
	<?php //echo $form->textField($model,'discount'); ?>    
	</div>
       
   
        
        
 </fieldset>
	
    
    <div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create Reservation ' : 'Save',  array('class'=>'btn btn-primary')); 
		
		$this->widget("zii.widgets.jui.CJuiButton",array(
		  "name"=>"button",
		  "caption"=>$model->isNewRecord ? 'Create Reservation' : 'Save',
		  "value"=>"asd",
		  "htmlOptions"=>array("style"=>"")
  //color:#ffffff;background:#000;width:150px;height:40px;font-size:16px
  )  );	
		?>        
      
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
<script>
function updateService(){
/* 	var pick_service = $('#ReservationInfo_pick_service').attr('checked');
	var drop_service = $('#ReservationInfo_drop_service').attr('checked');
	
			if(pick_service=="checked") {
				document.getElementById('ReservationInfo_flight_name').disabled = false;
				document.getElementById('ReservationInfo_flight_time').disabled = false;
			}else{
				 document.getElementById('ReservationInfo_flight_name').disabled = true;
				 document.getElementById('ReservationInfo_flight_time').disabled = true;
			}
			
			if(drop_service=="checked") {
				document.getElementById('ReservationInfo_drop_flight_name').disabled = false;
				document.getElementById('ReservationInfo_drop_flight_time').disabled = false;
			}else{
				 document.getElementById('ReservationInfo_drop_flight_name').disabled = true;
				 document.getElementById('ReservationInfo_drop_flight_time').disabled = true;
			} */
}
</script>

<script>
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else { 
		$('#ReservationInfo_client_name').addClass('load');
		 var company_id = $("#ReservationInfo_company_id :selected").val();
		 inputString += '&'+company_id;	
			
			$.post("autosuggest", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#ReservationInfo_client_name').removeClass('load');
				}
			});
		}
	}

	function fill(id, name) { 	
		$('#ReservationInfo_client_name').val(name);		
		setTimeout("$('#suggestions').fadeOut();", 300);
	}

</script>

