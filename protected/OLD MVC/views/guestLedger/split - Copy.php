<?php

$this->breadcrumbs=array(

	'Guest Ledgers'=>array('index'),

	$model->id,

);

?>



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

<h1>Split Folio</h1>



<?php 

		$branch_id = yii::app()->user->branch_id;

		$sql = "select chkin_id, guest_name from hms_guest_ledger where room_status = 'O' and  branch_id = $branch_id Group by chkin_id";

		$models = Yii::app()->db->createCommand($sql)->query();	

		

			

		$list = CHtml::listData($models, 'chkin_id', 'guest_name');		

		echo CHtml::dropDownList('billno', $select, 

               $list,

              array('empty' => '(Select Guest Name',

			  'onchange' => CHtml::ajax(

						array(

							'type' => 'POST',

							'url' => CController::createUrl('GuestLedger/Dothis'),

							'data' => 'js:$(this).serialize()',



							

							'beforeSend' => 'function(){ $("#city_loader").addClass("ajaxload"); }',

							//'complete' => 'function(data){alert(data); }',

							'success' => 'function(data){

								

	var a = "<table id=\'mytable\' width=\'500\' ><tr id=\'ftr\'><td width=\'25\'><b>Sr</b></td>";

	a += "<td width=\'40\'><b>Select</b></td><td width=\'150\'><b>Service</b></td><td width=\'200\'><b>Details</b></td>";

	a += "<td width=\'40\'><b>Dr</b></td><td width=\'45\'><b>Cr</b></td></tr>";

	

	a+= "<tr id=\'total_bill2\'><td colspan=\'3\'></td><td><b>Total</b></td><td><b>0</b></td><td><b>0</b></td></tr></table>"; 						

						

									$("#folio_contents2").html(a);

									$("#folio_contents2").hide();

									$("#folio_contents").html(data);

								}',

							//'update'=>'#folio_contents', //selector to update //get id method

							'error'=>'function(xhr, ajaxOptions, thrownError){alert(xhr.status+\'--\'+thrownError); }',

							

							//'update' => '#' . CHtml::activeId($model, 'mycon')

						)//array

				)//ajax

			  

			  ));

		

	?>

   

    

    

<div id="folio_contents" class="folio1"> </div>

      

   <div id="folio_contents2" class="folio2" style="display:none;">

   <table id="mytable" width="500" >

   			<tr id="ftr">

			<td width="25"><b><?php echo Yii::t('views','Sr#') ?></b></td>

			<td width="40"><b>Select</b></td>

			<td width="150"><b>Service</b></td>

			<td width="200"><b>Details</b></td>

			<td width="40"><b>Dr</b></td>

			<td width="45"><b>Cr</b></td>

			</tr>

            

            <tr id="total_bill2">

				<td colspan="3"></td>				

				<td><b>Total</b></td>

				<td><b>0</b></td>

				<td><b>0</b></td>

			</tr> 

     </table>

   

   </div>

   

   <?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'split-folio-form',

	'enableAjaxValidation'=>false,

	

	'htmlOptions'=>array('target'=>'_blank'),

)); ?>

 

   <input type="hidden" name="foliono" id="foliono" value="0" />

   

   <div id="ajax_div" style="display:none;"><input type="submit" name="btn" value=" Print "  /> </div>

   

<?php $this->endWidget(); ?>   

   

   

   

   <script>

   function printthis(){

	 var a = $("#foliono").val();   

	 alert(a);

   }

   //////////////////////////////

   function process(total){	

	$("#folio_contents2").show();	

	var chkstr ='';

	var notsckstr ='';

		for(i=total;i>0;i--){		

			//if($('#cbk-'+i).is(':checked')){

			var node = $("#folio_contents").find('#cbk-'+i);

			if(node.is(':checked')){

				value = $('#cbk-'+i).val();

				chkstr += value+',';

				//call a function to send ajax call to make entry in the table

				

				//calculate dr total

				var tr = $('#cbk-'+i).parent().parent();

				var x = billCalculation(tr);				

				

				//$('#cbk-'+i).parent().parent().remove();			

				var cloned = $('#cbk-'+i).parent().parent();

				 //$('#folio_contents2').append(cloned);

				 

				 $(cloned).insertAfter('#ftr');

				 billCal2(cloned);

			}	

			else {notsckstr += $('#cbk-'+i).val()+',';}		

		}

		//$("#folio_contents2").html(chkstr+'-+-'+notsckstr);

		processAjax(chkstr,notsckstr);	

		$("#ajax_div").show();	

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

   function billCalculation(tr){

	  var dr = tr.find("td")[4].innerHTML;

	  var cr = tr.find("td")[5].innerHTML;

	  

	  var totalbill = $("#total_bill").find("b")[1].innerHTML;

	  totalbill = parseInt(totalbill) - parseInt(dr) + parseInt(cr);

	  $("#total_bill").find("b")[1].innerHTML = totalbill;

				//alert('---'+totalbill); 

   }

   

   function billCal2(tr){

	  var dr = tr.find("td")[4].innerHTML;

	  var cr = tr.find("td")[5].innerHTML;

	  

	  var totalbill = $("#total_bill2").find("b")[1].innerHTML;

	  //alert('cal'+totalbill);

	  totalbill = parseInt(totalbill) + parseInt(dr) - parseInt(cr);

	  $("#total_bill2").find("b")[1].innerHTML = totalbill;

   }

   

   </script>