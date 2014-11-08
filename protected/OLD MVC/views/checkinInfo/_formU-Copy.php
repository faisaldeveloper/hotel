

<div class="form">



<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'checkin-info-form',

	'enableAjaxValidation'=>false,

)); ?>



	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary($model); ?>





<div class="row">

		<?php $hotel_branch_id = yii::app()->user->branch_id;?>

		<?php //echo $form->labelEx($guest_info,'branch_id'); ?>

		<?php //echo $form->hiddenField($guest_info,'branch_id',array('value'=>$hotel_branch_id)); ?>

		<?php //echo $form->error($guest_info,'branch_id'); ?>

	</div>

    

    

    <div class="row">

		<?php $user_id = yii::app()->user->id;?>

		<?php //echo $form->labelEx($guest_info,'branch_id'); ?>

		<?php //echo $form->hiddenField($guest_info,'user_id',array('value'=>$user_id)); ?>

		<?php //echo $form->error($guest_info,'user_id'); ?>

	</div>

   	<div class="row">

		<?php $hotel_branch_id = yii::app()->user->branch_id;?>

		<?php //echo $form->labelEx($model,'branch_id'); ?>

		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>

		<?php echo $form->error($model,'branch_id'); ?>

	</div>



<div id="mceleft">

<fieldset>

    <legend class="mcelegend">Stay Information:</legend>

    <table width="620" height="116">

      <tr>

        <td><table width="563" class="mcetable">

          <tr class="mcetr">

            <td width="131"><?php echo $form->labelEx($model,'chkin_date'); ?></td>

            <td width="34"><?php echo $form->textField($model,'chkin_date',array('value'=>$date = date('Y-m-d'))); ?> <?php echo $form->error($model,'chkin_date'); ?></td>

            <td width="85"><?php //echo $form->labelEx($model,'chkin_time'); ?>

              <?php echo $form->hiddenField($model,'chkin_time',array('size'=>5,'value'=>$date = date('H:m'))); ?>

              <?php //echo $form->error($model,'chkin_time'); ?></td>

            <td colspan="2"><?php echo $form->labelEx($model,'reservation_id'); ?>

		<?php echo $form->textField($model,'reservation_id',array(

		'ajax' => array(

		'type'=>'POST', //request type

		'url'=>CController::createUrl('CheckinInfo/dynamicResData'), //url to call.

		//Style: CController::createUrl('currentController/methodToCall')

		

		//'update'=>'#GuestInfo_guest_address', //selector to update //get id method

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

		<?php echo $form->error($model,'reservation_id'); ?></td>

            <td width="134"><a href=<?php echo Yii::app()->baseUrl.'/ReservationInfo/res_admin'?>>Reserverations</a></td>

          </tr>

          <tr class="mcetr">

            <td><?php echo $form->labelEx($model,'chkout_date'); ?></td>

            <td colspan="2"><?php //echo $form->textField($model,'chkout_date'); ?>

              <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(

    

    'name'=>'CheckinInfo[chkout_date]',

    //'id'=>'user_Birthdate',

    'model'=>$model,

	'attribute'=>'chkout_date',

    

    // additional javascript options for the date picker plugin

    'options'=>array(

        'showAnim'=>'fold',

		'dateFormat'=>'yy-mm-dd',

		'changeYear'=> true,

		'changeMonth'=> true,

    ),

    'htmlOptions'=>array(

        'style'=>'height:20px;',



    ),

));



?>

              <?php echo $form->error($model,'chkout_date'); ?>

              <?php //echo $form->labelEx($model,'chkout_time'); ?>

              <?php //echo $form->textField($model,'chkout_time'); ?>

              <?php //echo $form->error($model,'chkout_time'); ?></td>

            <td width="34"><?php echo $form->labelEx($model,'drop_service'); ?></td>

            <td width="117"><?php echo $form->checkBox($model,'drop_service',array('value' => 'Y', 'uncheckValue'=>'N', 

		'onclick'=>

		"javascript:

		if($('#CheckinInfo_drop_service').attr('checked')){

			

			$('#CheckinInfo_flight_name').show();

			$('#CheckinInfo_flight_time').show();



			}else{

				$('#CheckinInfo_flight_name').hide();

				$('#CheckinInfo_flight_time').hide();

				}

			

		

		

		")); ?>

              <?php //echo $form->error($model,'drop_service'); ?></td>

            <td colspan="2"><?php echo $form->labelEx($model,'flight_name'); ?></td>

          </tr>

          <tr class="mcetr">

            <td><?php echo $form->labelEx($model,'total_days'); ?></td>

            <td><?php echo $form->textField($model,'total_days',array('size'=>'5','value'=>'2')); ?> <?php echo $form->error($model,'total_days'); ?></td>

            <td>&nbsp;</td>

            <td colspan="2"><?php //echo $form->labelEx($model,'flight_time'); ?>

              <?php echo $form->textField($model,'flight_time',array('size'=>'10','style'=>'Display:none')); ?>

              <?php //echo $form->error($model,'flight_time'); ?></td>

            <td><?php //echo $form->textField($model,'flight_name',array('size'=>30,'maxlength'=>30)); ?>

              <?php echo $form->dropDownList($model,'flight_name', CHtml::listData(Flights::model()->findAll(), 'flight_name', 

		'flight_name'),array('prompt'=>'Select Flight','style'=>'display:none')); 

		?> <?php echo $form->error($model,'flight_name'); ?></td>

          </tr>

        </table></td>

      </tr>

    </table>

</fieldset>



<fieldset>

  <legend class="mcelegend">Guest Person Information:</legend>

 <table width="623" class="mcetable">

  <tr class="mcetr">

    <td width="120">	<?php echo $form->labelEx($model,'sale_person_id'); ?></td>

    <td>



		<?php //echo $form->textField($model,'sale_person_id'); ?>

        <?php echo $form->dropDownList($model,'sale_person_id', CHtml::listData(SalePerson::model()->findAll(), 'sale_person_id', 

		'sale_person_name'),array('prompt'=>'Select Person')); ?>

		<?php echo $form->error($model,'sale_person_id'); ?>

	

    </td>

    <td><?php echo $form->labelEx($model,'guest_company_id'); ?></td>

    <td colspan="2"><?php //echo $form->textField($guest_info,'guest_company_id'); ?>

      <?php echo $form->dropDownList($model,'guest_company_id', CHtml::listData(Company::model()->findAll(), 'comp_id', 

		'comp_name'),array('prompt'=>'Select Company')); 

		?> <?php echo $form->error($model,'guest_company_id'); ?></td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    </tr>

  <tr class="mcetr">

    <td><?php //echo $form->labelEx($guest_info,'guest_name'); ?></td>

    <td colspan="3"><?php //echo $form->dropDownList($guest_info,'guest_salutation_id', CHtml::listData(Salutation::model()->findAll(), 'salutation_id', 

		//'salutation_name'),array('prompt'=>'Salutation')); 

		?>

      <?php //echo $form->error($guest_info,'guest_salutation_id'); ?>

      <?php //echo $form->textField($guest_info,'guest_name',array('size'=>40,'maxlength'=>50)); ?>

      <?php //echo $form->error($guest_info,'guest_name'); ?>

      

    </td>

    <td colspan="2"><?php echo $form->labelEx($model,'chkin_id'); ?>      

      <?php echo $form->textField($model,'chkin_id',array('size'=>'10')); ?>

      <?php echo $form->error($model,'chkin_id'); ?></td>

    <td>&nbsp;</td>

    </tr>

  <tr class="mcetr">

    <td><?php //echo $form->labelEx($guest_info,'guest_mobile'); ?>

		</td>

    <td><?php /*echo $form->textField($guest_info,'guest_mobile',array(

		'ajax' => array(

		'type'=>'POST', //request type

		'url'=>CController::createUrl('CheckinInfo/dynamicProfile'), //url to call.

		//Style: CController::createUrl('currentController/methodToCall')

		

		//'update'=>'#GuestInfo_guest_address', //selector to update //get id method

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

		)));*/ 

		

		?>

		<?php //echo $form->error($guest_info,'guest_mobile'); ?>

        

        <?php //Guest Id Field Will set id Found else it will get some default value which will call function to add 

     //new record and get id?>

		<?php //echo $form->labelEx($model,'guest_id'); ?>

		<?php echo $form->textField($model,'guest_id'); ?><?php //echo $form->error($model,'guest_id'); ?>

        

        </td>

    <td><?php //echo $form->labelEx($guest_info,'guest_gender'); ?>

		</td>

    <td><?php //echo $form->textField($guest_info,'guest_gender',array('size'=>10,'maxlength'=>10)); ?>

		<?php //echo $form->radioButtonList($guest_info,'guest_gender',array('0'=>"Male",'1'=>"Female")); ?>

		<?php /*echo $form->radioButtonList($guest_info,'guest_gender',array(

                            'M'=>'Male',

                            'F'=>'Female',

                            

                    ),array(

                        'separator'=>'&nbsp;',

                        'labelOptions'=>array('style'=>'display: inline; margin-right: 10px; font-weight: normal;'),

                ));*/ ?>

		<?php //echo $form->error($guest_info,'guest_gender'); ?></td>

    <td colspan="3"></td>

    </tr>

  <tr class="mcetr">

    <td><?php //echo $form->labelEx($guest_info,'guest_address'); ?>

      </td>

    <td colspan="6"><?php //echo $form->textField($guest_info,'guest_address',array('size'=>50,'maxlength'=>50)); ?>

      <?php //echo $form->textField($guest_info,'guest_address',array('size'=>70,'maxlength'=>50)); ?>

      <?php //echo $form->error($guest_info,'guest_address'); ?></td>

  </tr>

  <tr class="mcetr">

    <td><span class="mcenametd"><?php //echo $form->labelEx($guest_info,'guest_phone'); ?></span></td>

    <td class="mcenametd"><?php //echo $form->textField($guest_info,'guest_phone'); ?>

		<?php //echo $form->error($guest_info,'guest_phone'); ?></td>

    <td class="mcenametd"><?php //echo $form->labelEx($guest_info,'guest_email'); ?></td>

    <td class="mcenametd"><?php //echo $form->textField($guest_info,'guest_email',array('size'=>40,'maxlength'=>50)); ?> <?php //echo $form->error($guest_info,'guest_email'); ?></td>

    <td class="mcenametd">&nbsp;</td>

    <td class="mcenametd">&nbsp;</td>

    <td class="mcenametd">&nbsp;</td>

    </tr>

  <tr class="mcetr">

    <td><?php //echo $form->labelEx($guest_info,'guest_country_id'); ?></td>

    <td><?php //echo $form->textField($guest_info,'guest_country_id'); ?>

            <?php //echo $form->dropDownList($guest_info,'guest_country_id', CHtml::listData(Country::model()->findAll(), 'country_id', 

		//'country_name'),array('prompt'=>'Select Country')); 

		?>

        

		<?php //echo $form->error($guest_info,'guest_country_id'); ?> </td>

    <td><?php echo $form->labelEx($model,'newspaper_id'); ?></td>

    <td> <?php echo $form->dropDownList(CheckinInfo::model(),'newspaper_id', CHtml::listData(Newspapers::model()->findAll(), 'newspaper_id', 

		'newspaper_name'),array('prompt'=>'Select News Paper')); 

		?>

		<?php echo $form->error($model,'newspaper_id'); ?></td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    </tr>

  <tr class="mcetr">

    <td><?php //echo $form->labelEx($guest_info,'guest_identity_id'); ?>

		</td>

    <td width="106"><?php //echo $form->textField($guest_info,'guest_identity_id'); ?>

        <?php //echo $form->dropDownList($guest_info,'guest_identity_id', CHtml::listData(Identity::model()->findAll(), 'identity_id', 

		//'identity_description'),array('prompt'=>'Select Identity')); 

		?>

        

		<?php //echo $form->error($guest_info,'guest_identity_id'); ?></td>

    <td><?php //echo $form->labelEx($guest_info,'guest_identity_no'); ?></td>

    <td><?php //echo $form->textField($guest_info,'guest_identity_no'); ?> 

	<?php //echo $form->error($guest_info,'guest_identity_no'); ?></td>

    <td width="96">&nbsp;</td>

    <td width="157">&nbsp;</td>

    <td width="1">&nbsp;</td>

    </tr>

  <tr class="mcetr">

    <td><?php //echo $form->labelEx($guest_info,'guest_identity_issu'); ?></td>

    <td><?php //echo $form->textField($guest_info,'guest_identiy_expire'); ?>

         <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(

    

    'name'=>'GuestInfo[guest_identity_issu]',

    //'id'=>'user_Birthdate',

    'model'=>$guest_info,

    

    // additional javascript options for the date picker plugin

    'options'=>array(

        'showAnim'=>'fold',

		'dateFormat'=>'yy-mm-dd',

    ),

    'htmlOptions'=>array(

        'style'=>'height:20px;',



    ),

));



?>

		<?php //echo $form->error($guest_info,'guest_identity_issu'); ?></td>

    <td width="103"><?php //echo $form->labelEx($guest_info,'guest_identiy_expire'); ?>

		</td>

    <td width="97"><?php //echo $form->textField($guest_info,'guest_identiy_expire'); ?>

         <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(

    

    'name'=>'GuestInfo[guest_identiy_expire]',

    //'id'=>'user_Birthdate',

    'model'=>$guest_info,

    

    // additional javascript options for the date picker plugin

    'options'=>array(

        'showAnim'=>'fold',

		'dateFormat'=>'yy-mm-dd',

    ),

    'htmlOptions'=>array(

        'style'=>'height:20px;',



    ),

));



?>

		<?php //echo $form->error($guest_info,'guest_identiy_expire'); ?></td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    </tr>

  <tr class="mcetr">

    <td>Place Of Issue: </td>

    <td><input type="text" class="mceinput"/></td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td colspan="4">&nbsp;</td>

  </tr>

  <tr class="mcetr">

    <td><?php //echo $form->labelEx($guest_info,'guest_dob'); ?>

		</td>

    <td><?php //echo $form->textField($guest_info,'guest_dob'); ?>

        <?php /*$this->widget('zii.widgets.jui.CJuiDatePicker', array(

    

    'name'=>'GuestInfo[guest_dob]',

    //'id'=>'user_Birthdate',

    'model'=>$guest_info,

    

    // additional javascript options for the date picker plugin

    'options'=>array(

        'showAnim'=>'fold',

		'dateFormat'=>'yy-mm-dd',

    ),

    'htmlOptions'=>array(

        'style'=>'height:20px;',



    ),

));

*/

?>

		<?php //echo $form->error($guest_info,'guest_dob'); ?></td>

    <td><?php //echo $form->labelEx($model,'guest_status_id'); ?>

		</td>

    <td><?php //echo $form->textField($model,'guest_status_id'); ?>

    	 <?php echo $form->dropDownList(CheckinInfo::model(),'guest_status_id', CHtml::listData(GuestStatus::model()->findAll(), 'guest_status_id', 

		'status_description'),array('prompt'=>'Select Status')); 

		?>

		<?php echo $form->error($model,'guest_status_id'); ?></td>

    <td>.

		</td>

    <td colspan="4">&nbsp;</td>

    </tr>

  <tr class="mcetr">

    <td><?php echo $form->labelEx($model,'comming_from'); ?>

		</td>

    <td><?php echo $form->textField($model,'comming_from',array('size'=>20,'maxlength'=>20)); ?>

		<?php echo $form->error($model,'comming_from'); ?></td>

    <td><?php echo $form->labelEx($model,'next_destination'); ?>

		</td>

    <td><?php echo $form->textField($model,'next_destination',array('size'=>20,'maxlength'=>20)); ?>

		<?php echo $form->error($model,'next_destination'); ?></td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    </tr>

</table>    

 </fieldset>

 

<fieldset>

  <legend class="mcelegend">Room Rate Information:</legend>

  <table width="623" class="mcetable">

  <tr class="mcetr">

    <td width="13%" class="mcetd"><?php echo $form->labelEx($model,'room_type'); ?></td>

    <td colspan="4"><?php echo $form->textField($model,'room_type',array('size'=>8,'maxlength'=>20,'readonly'=>'readonly')); ?><?php echo $form->error($model,'room_type'); ?></td>

    <td width="25%" class="mcetd"><?php echo $form->labelEx($model,'rate'); ?>

		</td>

        <script>

        function get_wgst(){

					

			var ch_val = $('#CheckinInfo_gst').attr('checked');

			if(ch_val=="checked"){

			var rate = document.getElementById('CheckinInfo_rate').value;

			var days = document.getElementById('CheckinInfo_total_days').value;

			

			var r_gst = document.getElementById('r_gst').value;

			

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

		function rate_update_total(){

			

			var ch_val = $('#CheckinInfo_gst').attr('checked');

			if(ch_val=="checked"){

			//var total_charges = document.getElementById('CheckinInfo_total_charges').value;

			var day = document.getElementById('CheckinInfo_total_days').value;

			document.getElementById('CheckinInfo_total_charges').value = "";

								//document.getElementById('CheckinInfo_rate').value="0";

								

			var rate = document.getElementById('CheckinInfo_rate').value;

			var gst = document.getElementById('r_gst').value;

			var gst_amount = rate * gst / 100;

			

			

			//alert(rate);

			

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

        </script>

    <td colspan="2"> <?php echo $form->textField($model,'rate',array('size'=>'8','onblur'=>'rate_update_total()')); ?>

      <?php echo $form->error($model,'rate'); ?></td>

    <td width="1%">&nbsp;</td>

  </tr>

  <tr class="mcetr">

    <td class="mcetd"><?php echo $form->labelEx($model,'room_name'); ?></td>

    <td colspan="4"><?php echo $form->textField($model,'room_name',array('size'=>'8',

		'ajax' => array(

		'type'=>'POST', //request type

		'url'=>CController::createUrl('CheckinInfo/dynamicRate'), //url to call.

		//Style: CController::createUrl('currentController/methodToCall')

		

		//'update'=>'#GuestInfo_guest_address', //selector to update //get id method

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

		 ?> <?php echo $form->error($model,'room_name'); ?>

      <?php //echo $form->labelEx($model,'room_id'); ?>

      <?php echo $form->hiddenField($model,'room_id'); ?>

      <?php //echo $form->error($model,'room_id'); ?></td>

    <td class="mcetd"><?php echo $form->labelEx($model,'bed_tax'); ?>

    </td>

    <script>

    function btax(){

		

		var ch_val = $('#CheckinInfo_bed_tax').attr('checked');

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

		//alert(tt)

		document.getElementById('CheckinInfo_total_charges').value = n_val;

		}

				

		}

    </script>

    <td width="3%"><span class="mcetd">

	<?php echo $form->checkBox($model,'bed_tax',array('value' => 'Y', 'uncheckValue'=>'N','onclick'=>'btax()')); ?> 

	<?php echo $form->error($model,'bed_tax'); ?></span></td>

    <td width="22%"><input type="text" id="b_tax" name="b_tax" value="" class=" mceinput" style="width:30px" /></td>

    <td>&nbsp;</td>

  </tr>

  <tr class="mcetr">

    <td><?php echo $form->labelEx($model,'total_person'); ?></td>

        <script>

        function t_p(){

			

			var adlt = $('#CheckinInfo_total_person').val();

			document.getElementById('b_tax').value = adlt;

			}

        </script>

    <td width="6%"><?php echo $form->error($model,'total_person'); ?>

	<?php echo $form->textField($model,'total_person',array('size'=>'2px','onblur'=>'t_p()')); ?></td>

    <td width="18%">Childrens

      <input type="text" id="childs" name="childs" value="" disabled="disabled" style="width:20px;" /></td>

    <td width="8%">&nbsp;</td>

    <td>&nbsp;</td>

    <td>Extra Bed :</td>

    <script>

    function tamount_ext(){

	

			

		var e_bed = parseInt( $('#extra_bed').val() ); 

		$('#CheckinInfo_extra_bed').val(e_bed)

		var t_charges = parseInt( $('#CheckinInfo_total_charges').val() ); 

		var charg_ext = e_bed + t_charges;

		document.getElementById('CheckinInfo_total_charges').value= charg_ext;

			

		}

		

	function show(){

		var ch_val = $('#e_bd').attr('checked');

		if(ch_val=="checked"){

			document.getElementById('extra_bed').disabled = false;

			

			}else{

				document.getElementById('extra_bed').disabled = true;

				var e_bed = parseInt( $('#extra_bed').val() ); 

				var t_charges = parseInt( $('#CheckinInfo_total_charges').val() ); 

				var charg_ext = t_charges - e_bed;

				document.getElementById('CheckinInfo_total_charges').value= charg_ext;

				document.getElementById('extra_bed').value = 0;

				

			

				

				}

		}	

    </script>

    <td colspan="2"><input type="checkbox" id="e_bd" onclick="show()"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="extra_bed" name="extra_bed" style="width:50px;" onblur="tamount_ext()" disabled="disabled" />

     <?php echo $form->hiddenField($model,'extra_bed',array('size'=>10,'maxlength'=>25,'value'=>'')); ?>

      </td>

    <td>&nbsp;</td>

  </tr>

  <tr class="mcetr">

    <td>Payment </td>

    <td colspan="4"><span class="mcetd">

      <input type="checkbox" name="input4" value="" class="mceinput" />

    </span>Cash<span class="mcetd">

    <input type="checkbox" name="input5" value="" class="mceinput" />

    </span>Credit Card <span class="mcetd">

    <input type="checkbox" name="input6" value="" class="mceinput" />

    </span>Btp <span class="mcetd">

    <input type="checkbox" name="input7" value="" class="mceinput" />

    </span>All</td>

    <td><?php echo $form->labelEx($model,'gst'); ?></td>

    <td><span class="mcetd">

	<?php echo $form->checkBox($model,'gst',array('value' => 'Y', 'uncheckValue'=>'N','onclick'=>'get_wgst()')); ?> 

	<?php echo $form->error($model,'gst'); ?> </span></td>

    <td>

    <input id="r_gst" name="r_gst" disabled="disabled" value="" style="width:25px;" />%

    <input type="text"  name="gst_amount" id="gst_amount" value="" class=" mceinput mcerateinput1" style="width:50px" /></td>

    <?php echo $form->hiddenField($model,'gst_amount',array('size'=>10,'maxlength'=>25,'value'=>'')); ?>

    <td>&nbsp;</td>

  </tr>

  <tr class="mcetr">

    <td><?php //echo $form->labelEx($guest_info,'guest_remarks'); ?></td>

    <td colspan="4"><?php //echo $form->textField($guest_info,'guest_remarks',array('size'=>20,'maxlength'=>50)); ?> <?php //echo $form->error($guest_info,'guest_remarks'); ?></td>

    <td><?php echo $form->labelEx($model,'total_charges'); ?></td>

    <td colspan="2"><?php echo $form->textField($model,'total_charges',array('size'=>'8')); ?><?php echo $form->error($model,'total_charges'); ?></td>

    <td>&nbsp;</td>

  </tr>

  <tr class="mcetr">

    <td>&nbsp;</td>

    <td colspan="4">&nbsp;</td>

    <td><?php echo $form->labelEx($model,'amount_paid'); ?></td>

    <td colspan="2"><?php echo $form->textField($model,'amount_paid',array('size'=>'8')); ?><?php echo $form->error($model,'amount_paid'); ?></td>

    <td>&nbsp;</td>

  </tr>

  <tr class="mcetr">

    <td>&nbsp;</td>

    <td colspan="3">&nbsp;</td>

    <td>&nbsp;</td>

    <td>Balance:</td>

    <td colspan="2"><input type="text" id="balance" name="balance" style="width:75px"  disabled="disabled"/></td>

    <td>&nbsp;</td>

  </tr>

  <tr class="mcetr">

    <td><?php //echo $form->labelEx($model,'rate_type'); ?></td>

    <td colspan="3" ><?php echo $form->hiddenField($model,'rate_type',array('value'=>'1')); ?>

      <?php //echo $form->error($model,'rate_type'); ?></td>

    <td >

      <?php $user_id = yii::app()->user->id;?>

      <?php echo $form->hiddenField($model,'chkout_status',array('value'=>'N')); ?>

      <?php echo $form->hiddenField($model,'chkin_user_id',array('value'=>$user_id)); ?>

      

    </td>

    <td>&nbsp;</td>

    <td colspan="2">&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

   <tr class="mcetr">

    <td>&nbsp;</td>

    <td colspan="3"><div class="row buttons">

		<?php echo CHtml::submitButton($model->isNewRecord ? 'Check-IN' : 'Save'); ?>

	</div></td>

    <td width="4%">&nbsp;</td>

    <td colspan="3"><span class="mcetd">

      <input type="checkbox" name="input9" value="" class="mceinput" />

    </span>Charge Previous Night</td>

    <td>&nbsp;</td>

  </tr>

</table>



  </fieldset>

  </div>

  <div id="mceright">

  <div id="mcerightbutton">

  <table>

  <tr>

  <td><input type="submit" class="button" value="Room Change" /></td>

 </tr>

 

  <tr>

  <td><input type="submit" class="button" value="Button" /></td>

 </tr>

 

  <tr>

  <td><input type="submit" class="button" value="Button" /></td>

 </tr>

 

  <tr>

  <td><input type="submit" class="button" value="Button" /></td>

 </tr>

 

  <tr>

  <td><input type="submit" class="button" value="Button" /></td>

 </tr>

 

  <tr>

  <td><input type="submit" class="button" value="Button" /></td>

 </tr>

 

  <tr>

  <td><input type="submit" class="button" value="Button" /></td>

 </tr>

 

  <tr>

  <td><input type="submit" class="button" value="Button" /></td>

 </tr>

 

  <tr>

  <td><input type="submit" class="button" value="Button" /></td>

 </tr>

 

  <tr>

  <td><input type="submit" class="button" value="Button" /></td>

 </tr></table>

 </div>

  </div>

<?php $this->endWidget(); ?>



</div><!-- form -->

<script>

		function testit(){

			//$('input:radio[name=GuestInfo[guest_gender]]:nth(1)').attr('checked',true);

			

			//alert($('input:radio[name=GuestInfo[guest_gender]]:checked').val());

			//$('input:radio[name=GuestInfo[guest_gender]]').attr('checked',false);

			//$('input:radio[name=GuestInfo[guest_gender]]')[1].checked = true;

			//alert($('input:radio[name=GuestInfo[guest_gender]]:checked').val());

			

			//$('input:checkbox[name=CheckinInfo[gst]]').checked = true;

			//document.getElementById('CheckinInfo_gst').checked=true;

			//$('input:checkbox[name=CheckinInfo[gst]]').attr('checked', true);

			//alert(vl);

			//$('input[name=foo]').attr('checked', true);

			//$('input[name=foo]').attr('checked', true);

			//$("form #CheckinInfo_gst").attr('checked', true);

			$('#GuestInfo_guest_gender_0').attr('checked','checked');

			$('#CheckinInfo_gst').attr('checked','checked');

			

			alert($('#GuestInfo_guest_gender_0').attr('type'));

			alert($('#CheckinInfo_gst').attr('type'));





			}

			

		</script>