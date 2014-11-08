<?php

$this->menu=array(

	//array('label'=>'List CheckinInfo', 'url'=>array('index')),

	array('label'=>'Create CheckinInfo', 'url'=>array('create')),

);











//this var is defined in framework/web/CCoontroler.php

$this->myMenu = "<div align=\"right\">";

$this->myMenu .= "<a id=\"New Checkin\" class=\"update-dialog-create\"   href=\"/hotel/CheckinInfo/createAjax\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/add.png\" title=\"Add New Check-In\"  /></a>";

//$this->myMenu .= "<a  href=\"/hotel/CheckinInfo/admin\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/manage.png\" title=\"Mangage Check-Ins\" /></a>";

$this->myMenu .= "</div>";

?>

<table class="mytbl" style="background-color:transparent;" width="200" border="0">

  <tr>

    <td width="750px"><h1>Manage Tax Control for Checkout Guests</h1></td>    

    <td><?php //echo $this->myMenu;?></td>

  </tr>  

</table>



<?php echo CHtml::button('Hide Entry',array('class'=>'addtotaxcontrol-button'));?>



<?php echo CHtml::button('Show Entry',array('class'=>'removefromtaxcontrol-button'));?>



<?php 

$tax_status = "";

$sval = Yii::app()->session['taxcontrol'];

if(isset($sval) && $sval == 'ON'){ $btnval = 'Turn Off Tax Filter'; $tax_status = "Tax Status = ON";} 

else { $btnval = 'Turn On Tax Filter'; $tax_status = "Tax Status = OFF";}



$aa = "Tax Control is Currently ".$sval ." &nbsp;&nbsp; ";

echo CHtml::button($btnval,array('class'=>'gstsession-button'));?>



<?php 





$template ='';

if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}

if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}

if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}



$model=new CheckinInfo('search');		

$model->unsetAttributes();  // clear any default values

if(isset($_GET['CheckinInfo']))		

$model->attributes=$_GET['CheckinInfo'];



echo "<h2 id=\"tax_status\">$tax_status</h2>";

		

$this->widget('zii.widgets.grid.CGridView', array(

	'id'=>'checkin-info-grid',

	'dataProvider'=>$model->taxcontrol(),

	'selectableRows'=>2,

	'filter'=>$model,

	//'beforeAjaxUpdate'=>'js:alert("before")',

	'afterAjaxUpdate'=>'function(id,data){

	  $("#darken").hide();

	  $("#qnav").hide();

	}',

	'columns'=>array(

		//'chkin_id',

		array('header'=>'Sr:','class'=>'IndexColumn'),

		array('id'=>'selectedItems','class'=>'CCheckBoxColumn'),

		//'gst_show',

		array('name'=>'gst_show','filter'=>array('0'=>'Hidden','>0'=>'Show'), 'value'=>'($data->gst_show==0)?"Hidden":"Showing"'),

			

		/*  array(

			'header' => 'Folio',

			'class' => 'CButtonColumn',

			'template'=>'{Folio}',

			'buttons'=>array(

				'Folio' => array(

					'label'=>'Folio',

					'imageUrl'=>Yii::app()->request->baseUrl.'/images/calculator.gif',

					'url'=>'Yii::app()->baseUrl."/GuestLedger/admin/$data->chkin_id"',

					'options'=>array('title'=>'Folio'),

					//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',

					),				

				),//end buttons

			),//end Actions  */

		

		//'chkin_id',

		

		//'guest_id',		

		array('name'=>'guest_id', 'value'=>'ucwords($data->guest->guest_name)'),

		

		//'guest_company_id',

		array('name'=>'guest_company_id', 'value'=>'$data->company->comp_name'),

				

		//'room_name',

		array('name'=>'room_name', 'value'=>'$data->room->mst_room_name'),

		

		//'room_type',

		array('name'=>'room_type', 'value'=>'$data->roomtype->room_name'),

		

		/*  array(

                'name'   => 'gst_show',

                'value'  => 'isset($data->gst_show)?$data->gst_show:"N/A"',

               // 'filter' => CHtml::listData($status, 'id','value' ), //CHtml::listData('is_active',$status),

                ), */

		

		//'reservation_id',

		//'chkin_date',

		array('name'=>'chkin_date', 'value'=>'date("d/m/y",strtotime($data->chkin_date))'),

		

		//'chkout_date',

		array('name'=>'chkout_date', 'value'=>'date("d/m/y",strtotime($data->chkout_date))'),

		

		'created_time',

		

		 /* array(

			  'header'=>'Date', // give new column a header

			  'type'=>'HTML', // set it to manual HTML

			  'value'=>'$data->getC_date()' // here is where you call the new function

    	),  */

		

		

		/*

		'chkin_time',

		

		*/

		/* array(

			'header' => 'Reg Card',

			'class' => 'CButtonColumn',

			'template'=>'{regcard}',

			'buttons'=>array

				(

				'regcard' => array

					(

					'label'=>'Reg Card',

					'imageUrl'=>Yii::app()->request->baseUrl.'/images/regcard.png',

					'url'=>'Yii::app()->baseUrl."/CheckinInfo/viewRegCard/$data->chkin_id"',

					'options'=>array('title'=>'View Registration Card', 'target'=>'_blank'),

					//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',

					),				

				),//end buttons

			),//end Actions */

		

		

		/* array(

			'class'=>'CButtonColumn',

			'template'=>$template ,			

			'buttons'=>array(			

			// view Record

			'view' => array(

          	'click' => "function( e ){

            e.preventDefault();

            $( '#update-dialog' ).children( ':eq(0)' ).empty(); // Stop auto POST

			

            updateDialog( $( this ).attr( 'href' ) );

            $( '#update-dialog' )

              .dialog( { title: 'View Guest' } )

              .dialog( 'open' ); }",

        	),

			), //end button array 			

		),*/

	),

)); ?>





<?php

Yii::app()->clientScript->registerScript('Transfer',"

$('.addtotaxcontrol-button').click(function(){       

        var ids =  $.fn.yiiGridView.getSelection('checkin-info-grid');					

        if(window.confirm('Are you sure you want to Add selected item(s) in Tax Control?')){

			  $('#darken').show();

			  $('#qnav').show();

                params  = 'act=add&ids='+ids.join(',');	               

                $.ajax({

                        url: '".Yii::app()->createUrl('/CheckinInfo/Taxcontrol/')."',

                        type: 'POST',

						data: params,						

                        success: function(data){ //alert(data);

                                $.fn.yiiGridView.update('checkin-info-grid', {

                                        data: $(this).serialize()

                                });

                },

                error: function(){

                // what i do on error=?

                }});

        }return false; // if you want to avoid default button action

});",CClientScript::POS_READY);

// Change gridview id and controller action as necessary

?>

<?php

Yii::app()->clientScript->registerScript('Transfer3',"

$('.removefromtaxcontrol-button').click(function(){

       

        var ids =  $.fn.yiiGridView.getSelection('checkin-info-grid');					

        if(window.confirm('Are you sure you want to Remove selected item(s) from Tax Control?')){

			  $('#darken').show();

			  $('#qnav').show();

                params  = 'act=remove&ids='+ids.join(',');	               

                $.ajax({

                        url: '".Yii::app()->createUrl('/CheckinInfo/Taxcontrol/')."',

                        type: 'POST',

						data: params,						

                        success: function(data){ //alert(data);

                                $.fn.yiiGridView.update('checkin-info-grid', {

                                        data: $(this).serialize()

                                });

                },

                error: function(){

                // what i do on error=?

                }});

        }return false; // if you want to avoid default button action

});",CClientScript::POS_READY);

// Change gridview id and controller action as necessary

?>





<?php

Yii::app()->clientScript->registerScript('Transfer2',"

$('.gstsession-button').click(function(){

       

       var val = $('.gstsession-button').val();		

        if(window.confirm('Are you sure you want to Change Tax Filter Session?')){               

				

                params  = 'act='+val;							

                // now just call the ajax

                $.ajax({

                        url: '".Yii::app()->createUrl('/CheckinInfo/ToggleTaxControl/')."',

                        type: 'POST',

						data: params,						

                        success: function(data){ //alert(data);                                

								if(data==0){ $(\".gstsession-button\").val(\"Turn On Tax Filter\"); 

									 $(\"#tax_status\").text(\"Tax Status = OFF\"); 

								}

								else if(data==1){   $(\".gstsession-button\").val(\"Turn Off Tax Filter\"); 

									$(\"#tax_status\").text(\"Tax Status = ON\");

								}

								else { $(\".gstsession-button\").val(\" dddddddddddd \"); }

                },

                error: function(){

                // what i do on error=?

                }});

        }

        return false; // if you want to avoid default button action

});",CClientScript::POS_READY);

// Change gridview id and controller action as necessary

?>

