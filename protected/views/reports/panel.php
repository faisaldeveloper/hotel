<?php
$this->breadcrumbs=array(
	//'Reports'=>array('index'),
	//$model->reservation_id=>array('view','id'=>$model->reservation_id),
	'Reports Panel',);
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admissions-form',
	'enableAjaxValidation'=>false,	
	'htmlOptions'=>array('target'=>'_blank'),	
)); 

if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
$rep_no = 	$_REQUEST['id'];
}
?>

<script>
$(document).ready(function(){
		//document.getElementById('report_type') = true;
		var a = '<?php echo $rep_no ; ?>';
		if(a > 0){	
		 	$("select[id^=report_type]").val(a);
			$("#datesRow").show();
			
			var d = new Date();
			//alert(d.getMonth());
			var day = d.getDate();
			var mon = d.getMonth()+1;
			var year = d.getFullYear(); 
			
			var dte = year+'-'+mon+'-'+day+ ' 0:0';
			
			$("#from_date").val(dte);
			$("#to_date").val(dte);
		}
});
</script>
<fieldset>
<legend class="mcelegend" style="color:#900;">HMS - Reports Panel</legend>
   <table width="100%" border="1">
   <tr>
    <td colspan="7">&nbsp;</td>
    </tr>
    
     <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;<label> Report Type:</label></td>
    <td colspan="4">&nbsp;    	
        <select name="report_type" id="report_type" onchange="toggleDates(this.value)">
        
                        <optgroup value="" label="-- Checkin/Checkout Reports --"> 
                         <!--	<option value="1">Daliy In-House Report</option> -->
                            <option value="7">Corporate Checkin Report</option>
                            <option value="8">Corporate Checkout Report</option>
                            <option value="25">Group In-House Report</option>
                          <!--  <option value="27">Expected Corporate Checkout Report</option>-->
                          <!--  <option value="28">Expected General Checkout Report</option>-->
                           <!-- <option value="29">Overall Expected Checkout Report</option>-->
                            <option value="9">All Checkins Report</option>
                            <option value="10">All Checkouts Report</option>            
                        </optgroup>
                        
                        
                         <optgroup value="" label="-- Reservation Reports --"> 
                            <option value="33">Expected Arrivals</option>
                             <option value="55">Room Forecast</option>
                           <!--  <option value="2">Expected Arrivals</option>-->
                             <option value="3">Cancelled Reservations</option>  
                             <option value="23">Group Reservations Report</option>
                             <option value="14">No-Show Report</option>           
                        </optgroup>
                        
                        
                        <optgroup value="" label="-- Guests Reports --"> 
                           <!--  <option value="21">Guest Record Report</option>-->
                             <option value="42">Guest PickUp Report</option>
                             <option value="22">Guest Drop Report</option>  
                             <option value="26">Company Wise Sale Report</option>
                             <option value="30">Guest History Report</option>
                             <option value="36">Police Report For Check In Guest</option>           
                            <!-- <option value="35">Police Report For Check Out Guest</option>       -->                      
                             <option value="36">Nationality Wise Report</option>
                             <option value="37">Long Staying Report</option>                            
                             
                        </optgroup>
                        
                                                
                        
                        <optgroup value="" label="-- Corporate Reports --">
                            <!-- <option value="1">Daliy In-House Report</option>
                             <option value="6">Daily Occupancy Report</option> -->
                             <option value="91">Company Overdue Report</option>
                             <option value="92">Room wise Overdue Report</option>
                             <option value="93">Market Segment Report</option>
                             <option value="12">Sales Report</option>          
                             <option value="51">Sales Person Wise Report</option>
                             <!-- <option value="52">Company Account Report</option> -->                   
                        </optgroup>
                        
                        
                         <optgroup value="" label="-- Rooms Reports --">  
                            <option value="11">Room Status Report</option>
                            <option value="121">Room Shift Report</option>
                            <option value="13">Out of Order Room Report</option>
                        </optgroup>
                        
                        
                        <optgroup value="" label="-- Other Reports --">     
                            <option value="4">Listed Companies Report</option>  
                             <!--<option value="5">Company Rates</option>-->
                       </optgroup>
       
        </select>
    </td>
    </tr>
    
    <tr>
    <td colspan="7">&nbsp;</td>
    </tr>
    
  <tr id="datesRow" style="display:none;">
    <td>&nbsp;</td>
    <td><?php echo CHtml::label('From : ','from_date'); ?></td>
    <td><div style="float:left">
      <?php
		$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
			'name'=>'from_date', 
			//'model'=>$model,
			//'attribute'=>'chkin_date',
			'options'=>array(
				'hourGrid' => 6,
				'dateFormat'=>'yy-mm-dd',
				'hourMin' => 0,
				'hourMax' => 23,
				'timeFormat' => 'h:m',
				'changeMonth' => true,
				'changeYear' => false,
				),
				
			));		
		?>
    </div></td>
    <td>&nbsp;</td>
    <td><span class="lbl100"><?php echo CHtml::label('To : ','from_date'); ?></span></td>
    <td><span style="float:left">
      <?php
		$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
			'name'=>'to_date', 
			//'model'=>$model,
			//'attribute'=>'chkin_date',
			'options'=>array(
				'hourGrid' => 6,
				'dateFormat'=>'yy-mm-dd',
				'hourMin' => 0,
				'hourMax' => 23,
				'timeFormat' => 'h:m',
				'changeMonth' => true,
				'changeYear' => false,
				),
				
			));		
		?>
    </span></td>
    <td>&nbsp;</td>    
  </tr>
  
  
  <tr>  <td colspan="7">&nbsp;</td>   </tr>
    
    <tr id="con" style="display:none;">
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
     <td>&nbsp;</td> 
    <td align="right">&nbsp;Criteria</td>     
    <td colspan="3" align="left">&nbsp;<input type="text" name="con" value="" /> </td>
    </tr>
  
   <tr>  <td colspan="7">&nbsp;</td>   </tr>
  
  <tr>    
    <td colspan="7"><span style="margin-left:325px;"><?php echo CHtml::submitButton(' Create Report '); ?></span></td>  
  </tr>
</table>
</fieldset>
<!--<a href="<?php //echo $this->createUrl("report");?>" target="_blank"><h1>Click here to generate your report!</h1></a>-->
		
        <div class="row buttons" style="text-align:center">
		
		</div>
    
    
<?php $this->endWidget(); ?>
</div>
<script>
function toggleDates(x){
	if(x==2 || x==3 || x==4 || x==7 || x==8 || x==9 || x==10 || x==12 || x==14 || x==22 || x==23 || x==25  || x==26 || x==27 || x==28 || x==29 || x==33 || x==34 || x==35 || x==36 || x==42 || x==46 || x==51 || x==55 || x==93 || x==121){
		$("#datesRow").show();
		if(x==36)$("#con").show();
		if(x==25 || x==4){$("#datesRow").hide(); $("#con").show(); }
	}
	else if(x==52)$("#con").show();
	else{ 
		$("#datesRow").hide();
		$("#con").hide();
	}
}
</script>
