<?php $hotel_branch_id = yii::app()->user->branch_id; ?>
<h2> <?php echo Yii::t('views','Guest Change') ?>  </h2>

<style>
.suggestionsBox {
    background-color: #000000;
    border-top: 3px solid #000000;
    color: #FFFFFF;
    left: 0;
    margin: 213px 0 0 403px;
    padding: 0;
    position: absolute;
    top: 40px;
    width: 200px;
}
#country {
    border: 0px;
    font-size: 13px;
    padding: 0px;
}
</style>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'guest-change-form',
	'enableAjaxValidation'=>false,
)); ?>
	
	<?php echo $form->errorSummary($model); ?>	           
	    
    <?php 
	$branch_id = yii::app()->user->branch_id;
		$sql = "select ci.chkin_id, gi.guest_name, rm.mst_room_name from hms_checkin_info ci
		LEFT JOIN hms_guest_info gi
		ON ci.guest_id = gi.guest_id
		LEFT JOIN hms_room_master rm
		ON ci.room_id = rm.mst_room_id		
		WHERE ci.chkout_status = 'N' ORDER BY rm.mst_room_id";
		$result = Yii::app()->db->createCommand($sql)->query();		
			
	?>
    
    <div class="row">
     <span style="margin-left:25px;"> <?php echo Yii::t('views','Select Room:') ?>  </span>  <select name="CheckinInfo_chkin_id" id="CheckinInfo_chkin_id" >
    <?php 
	foreach ($result as $row ) { 
	echo "<option value='". $row['chkin_id']."'>" . $row['mst_room_name'] ." - ". ucwords(strtolower($row['guest_name'])) ." </option>";	
	}
	?>
    </select>
	</div>
    
   <div class="row">
    <?php  echo $form->labelEx($model,'guest_company_id'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
    <?php 
	 $con = array("condition"=>"branch_id=$hotel_branch_id", "order"=>"comp_name");
	  $var ="";
	  if(empty($model->guest_company_id)){$var = array('options' => array('1'=>array('selected'=>true)));}	 
	  echo $form->dropDownList($model,'guest_company_id', CHtml::listData(Company::model()->findAll($con), 'comp_id','comp_name'), $var);
	?>
    <?php echo $form->error($model,'guest_company_id'); ?>      
    </div>
    
   <div class="row">
   
   <?php  echo $form->labelEx($model,'New Guest'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
      
	<input type="text" name="CheckinInfo[guest_id]" id="CheckinInfo_guest_id" onkeyup="suggest(this.value)" autocomplete="off" style="width: 280px;" />
     <div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/arrow.png" style="position : relative; top: -10px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
      </div>
      
     
	
	<?php 
	echo $form->hiddenField($model, 'flight_name');
	echo $form->error($model,'mst_room_id'); ?>    
    </div>
    
    <div class="row">
  		<span style="margin-left:20px;"><b> Mobile: </b></span> &nbsp;<span id="guest_mobile"></span><br />
        <span style="margin-left:20px;"><b> Phone: </b></span>  &nbsp;<span id="guest_phone"></span><br />
        <span style="margin-left:20px;"><b> Address: </b></span>  &nbsp;<span id="client_address"></span><br />
        <span style="margin-left:20px;"><b> Country: </b></span>  &nbsp;<span id="country"></span><br />
        <span style="margin-left:20px;"><b> Identity: </b></span>  &nbsp;<span id="client_identity_no"></span><br />
    </div>
    
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Update' : 'Update'); ?>
	</div>
<?php $this->endWidget(); ?>
</div>

<script>
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else { 
		$('#CheckinInfo_guest_id').addClass('load');
		 var company_id = $("#CheckinInfo_guest_company_id :selected").val();
		 inputString += '&'+company_id;	
			
			$.post("Autosuggest", {queryString: ""+inputString+""}, function(data){
				if(data.length > 10) { 
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#CheckinInfo_guest_id').removeClass('load');
				}
				else {
					$('#suggestions').fadeOut();
					$('#CheckinInfo_flight_name').val('');					
					$('#guest_mobile').html('');		
					$('#guest_phone').html('');			
					$('#client_address').html('');	
					$('#country').html('');								
					$('#client_identity_no').html('');	
					$('#CheckinInfo_guest_id').removeClass('load');	
					}
			});
		}
	}

	function fill(id, name, mobile, phone, address, country, email, identity_id, identity_no) { 	
		if(name==''){mobile=''; phone=''; address=''; country=''; email=''; identity_id = '1'; identity_no='';	}
		
		$('#CheckinInfo_flight_name').val(id);
		$('#CheckinInfo_guest_id').val(name);	
		$('#guest_mobile').html(mobile);		
		$('#guest_phone').html(phone);			
		$('#client_address').html(address);	
		$('#country').html(country);
		//$('#client_identity_id [value="'+ identity_id+'"]').attr('selected',true);			
		$('#client_identity_no').html(identity_no);		
		//alert(name+'--'+identity_id);
		
		
		setTimeout("$('#suggestions').fadeOut();", 300);
	}

</script>
