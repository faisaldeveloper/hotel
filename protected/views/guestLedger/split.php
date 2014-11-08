<style>
.ajaxload{
	background-image:url(<?php echo Yii::app()->baseUrl; ?>/images/loading.gif);	
}
.folio1{
		background-color:#FCC;
		margin-top:8px;
		border:2px; 
		border-top-left-radius: .5em;
		border-top-right-radius: .5em;
		border-bottom-left-radius: .5em;
		border-bottom-right-radius: .5em;		
}
.folio2{
		background-color: #0CC;
		margin-top:8px;
		border:2px; 
		border-top-left-radius: .5em;
		border-top-right-radius: .5em;
		border-bottom-left-radius: .5em;
		border-bottom-right-radius: .5em;		
}
</style>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl."/js/jquery.inputmask.js"?>"></script>
<script type="text/javascript">

function searchFolio(){
	var x = document.getElementById('search_old_folio').value;
	$("#billno").val($("#billno option:first").val());


	  $.ajax({
                        url: '/hotel/GuestLedger/Dothis',
                        data: {'billno':x},
                        success: function(data){ //alert(data); $("#ajax-loading").hide();
                                $("#folio_contents").html(data);
									$("#folio_contents1").html("");
									$("#folio_contents2").html("");
									$("#folio_contents3").html("");	
									
									$("#folio_contents1").html(getContents(1));	
									$("#folio_contents2").html(getContents(2));							
									$("#folio_contents3").html(getContents(3));
									
									$("#chkstr-1").val('');
									$("#chkstr-2").val('');
									$("#chkstr-3").val('');
									
									
                },
                error: function(){
                // what i do on error=?
                }}); 
}

//$(document).ready(function(){ 	$("#search_old_folio").inputmask("0999-9999999",{ placeholder:"_", clearIncomplete: false }); }

</script>
<h1><?php echo Yii::t('views','Split Folio') ?></h1>

<div style="float:left"> In-House Guests 
<?php 
		$branch_id = yii::app()->user->branch_id;		
		$sql = "select ci.chkin_id, gi.guest_name, rm.mst_room_name FROM hms_checkin_info ci
		LEFT JOIN hms_guest_info gi ON ci.guest_id = gi.guest_id 
		LEFT JOIN hms_room_master rm ON ci.room_id = rm.mst_room_id 
		WHERE ci.chkout_status = 'N' ORDER BY ci.room_id";
		
		$rs = Yii::app()->db->createCommand($sql)->query();	
		$list = array();
		
		 foreach($rs as $key=>$row){
		  $value = $row['chkin_id'];
		 // if(strlen($row['title'])>20){$end = "...";}else{$end="";}
		  $name = $row['mst_room_name']." - ".$row['guest_name'];
		  $list[$value]=$name;
		  }
		
			
		//$list = CHtml::listData($models, 'chkin_id', 'guest_name');	
			
		echo CHtml::dropDownList('billno', $select, $list,
              array('empty' => '(Select Guest Name',
			  'onchange' => CHtml::ajax(
						array(
							'type' => 'POST',
							'url' => CController::createUrl('GuestLedger/Dothis'),
							'data' => 'js:$(this).serialize()',							
							'beforeSend' => 'function(){  $("#search_old_folio").val(""); $("#city_loader").addClass("ajaxload"); }',
							//'complete' => 'function(data){alert(data); }',
							'success' => 'function(data){	
									$("#folio_contents").html(data);
									$("#folio_contents1").html("");
									$("#folio_contents2").html("");
									$("#folio_contents3").html("");	
									
									$("#folio_contents1").html(getContents(1));	
									$("#folio_contents2").html(getContents(2));							
									$("#folio_contents3").html(getContents(3));
									
									$("#chkstr-1").val(\'\');
									$("#chkstr-2").val(\'\');
									$("#chkstr-3").val(\'\');
																			
								}',
							//'update'=>'#folio_contents', //selector to update //get id method
							'error'=>'function(xhr, ajaxOptions, thrownError){alert(xhr.status+\'--\'+thrownError); }',							
							//'update' => '#' . CHtml::activeId($model, 'mycon')
						)//array
				)//ajax			  
			  ));		
	?>
    <?php $url = Yii::app()->createUrl("guestLedger/myprint");   ?> 
  </div>
  <div style="float:right">
  <input type="text" id="search_old_folio" name="old_folio" value="" placeholder="Search old folio" /> 
  <input type="button" name="btn" value=" Find " onclick="searchFolio()" /> 
  </div>  
  
  <div style="clear:both" ></div>
    
<div id="folio_contents" class="folio1"> </div>
      
      <form name="frm1" method="post" target="_blank" action="<?php echo  $url; ?>" > 
      
    <input type="hidden" id="chkstr-1" name="chkstr" value="" />
    <input type="hidden" id="ntchkstr-1" name="ntchkstr" value="" />
    <input type="hidden" id="mychkin_id-1" name="mychkin_id" value="" />
   <div id="folio_contents1" class="folio2" style="display:none;">
  
   </div>
   </form>
   
   
    <form name="frm2" method="post" target="_blank" action="<?php echo  $url; ?>" > 
      
    <input type="hidden" id="chkstr-2" name="chkstr" value="" />
    <input type="hidden" id="ntchkstr-2" name="ntchkstr" value="" />
    <input type="hidden" id="mychkin_id-2" name="mychkin_id" value="" />
   <div id="folio_contents2" class="folio2" style="display:none;">  
   
   </div>
    </form>
 
 
 
   <form name="frm3" method="post" target="_blank" action="<?php echo  $url; ?>" > 
      
    <input type="hidden" id="chkstr-3" name="chkstr" value="" />
    <input type="hidden" id="ntchkstr-3" name="ntchkstr" value="" />
    <input type="hidden" id="mychkin_id-3" name="mychkin_id" value="" />
   <div id="folio_contents3" class="folio2" style="display:none;">
   
   
   </div>  
   </form>
   
  
   
   
   <script>   
   function getContents(id){
	   var x = '';
	   x = '<table id="mytable'+id+'" width="500">';
	   x +='<tr id="ftr'+id+'"><td width="25"><b>Sr#'+id+'</b></td><td width="40"><b>Select</b></td><td width="150"><b>Service</b></td>';
	   x +='<td width="200"><b>Details</b></td><td width="40"><b>Dr</b></td><td width="45"><b>Cr</b></td></tr>';            
       x +='<tr id="total_bill'+id+'"><td colspan="3"></td><td><b>Total</b></td><td><b>0</b></td><td><b>0</b></td></tr>';
	   x +='<tr><td colspan="3"> <input type="submit" name="btn" value="Print" /></td></tr></table>';
	   return x;
   }
   //////////////////////////////
   function process(total, no){	
	$("#folio_contents"+no).show();
	//$("#folio_contents"+no).html(getContents(no));								
									
		
	var chkstr ='';
	var notsckstr ='';
	 	
		var bb = $("#billno").find('option:selected').val();
		if(bb==''){ bb = $("#search_old_folio").val(); }
		$('#mychkin_id-'+no).val(bb);
			//alert(total+"----"+no+"----"+bb);
		for(i=total;i>0;i--){		
			//if($('#cbk-'+i).is(':checked')){
			var node = $("#folio_contents").find('#cbk-'+i);
			if(node.is(':checked')){
				value = $('#cbk-'+i).val();
				chkstr += value+',';				
				
				//call a function to send ajax call to make entry in the table				
				//calculate dr total
				var tr = $('#cbk-'+i).parent().parent();
				var x = billCalculation(tr, no);				
				
				//$('#cbk-'+i).parent().parent().remove();			
				var cloned = $('#cbk-'+i).parent().parent();
				 //$('#folio_contents1').append(cloned);
				 
				 $(cloned).insertAfter("#ftr"+no);
				 billCal2(cloned, no);
			}	
			else {notsckstr += $('#cbk-'+i).val()+',';}		
		}
		var a = $("#chkstr-"+no).val();
		var b = chkstr;
		var s = a+b;
		//s.substring(0, s.length-1);
		
		$("#chkstr-"+no).val(s);		
		$("#ntchkstr-"+no).val(notsckstr);
		
		//alert($("#chkstr-"+no).val());
		//$("#folio_contents1").html(chkstr+'-+-'+notsckstr);
		//processAjax(chkstr,notsckstr);		
		//$("#ajax_div").show();	
   }
   
   ////////////////////////////////////////////////////////
   function processAjax(chkstr,notsckstr){
		$.ajax({
		 url: "<?php echo CController::createUrl('GuestLedger/splitFolio'); ?>",
		 type: "post",
		 data: {'checked':chkstr, 'notchecked':notsckstr},
		 
		  success: function(response, textStatus, jqXHR){            
			$("#foliono").val(response);			
        },
		
		error: function(jqXHR, textStatus, errorThrown){            
            alert("The following error occured: "+ textStatus, errorThrown);
        },
		 
		});	   
	}   
   //////////////////////////////////////////////////////
   function billCalculation(tr, no){
	  var dr = tr.find("td")[4].innerHTML;
	  var cr = tr.find("td")[5].innerHTML;
	  
	  var totalbill = $("#total_bill"+no).find("b")[1].innerHTML;
	  totalbill = parseInt(totalbill) - parseInt(dr) + parseInt(cr);
	  $("#total_bill"+no).find("b")[1].innerHTML = totalbill;
		//alert('---'+totalbill); 
   }
   
   function billCal2(tr, no){
	  var dr = tr.find("td")[4].innerHTML;
	  var cr = tr.find("td")[5].innerHTML;
	  
	  var totalbill = $("#total_bill"+no).find("b")[1].innerHTML;
	  //alert('cal'+totalbill);
	  totalbill = parseInt(totalbill) + parseInt(dr) - parseInt(cr);
	  $("#total_bill"+no).find("b")[1].innerHTML = totalbill;
   }
   
   </script>