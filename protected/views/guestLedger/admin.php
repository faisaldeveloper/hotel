<?php
$var = $bill_no = $room_id = 0;
$room_name = $guest_name = '';
if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0){ 
	$var = $_REQUEST['id'];
	$bill_no = $var;
	
	$room_id = CheckinInfo::model()->find("chkin_id = ".$var)->room_id;
	$room_name = RoomMaster::model()->find("mst_room_id = $room_id")->mst_room_name;
	$sql = "select gi.guest_name from hms_guest_info gi Left JOIN hms_checkin_info ci ON ci.guest_id = gi.guest_id where ci.chkin_id = $bill_no";
	$guest_name = Yii::app()->db->createCommand($sql)->queryScalar();
}
//echo "---".$var;
//$guest_name = GuestLedger::model()->find("chkin_id = ".$var)->guest_name;
?>
<h1>Guest Folio - <?php echo ucwords(strtolower($guest_name)) ." ($room_name)"; ?></h1>
<?php
$this->beginWidget( 'zii.widgets.jui.CJuiDialog', array(
  'id' => 'update-dialog',
  'options' => array(
    'title' => 'Dialog',
    'autoOpen' => false,
	'show'=>'slideDown',
	'hide'=>'explode',
    'modal' => true,
    'width' => '700',
	'position'=>'top',
	//'minWidth'=> '400',
	'minHeight'=> '100',
    'resizable' => true,
	'resizeStart'=>'js:function(event, ui) {
			
			
	}',
	
  ),
)); ?>
<div class="update-dialog-content"> </div>
<?php $this->endWidget(); ?>
<?php
//Create Record
Yii::app()->clientScript->registerScript('updateDialogCreate', "
jQuery( function($){
    $( 'a.update-dialog-create' ).bind( 'click', function( e ){
      e.preventDefault();
      $( '#update-dialog' ).children( ':eq(0)' ).empty();
      updateDialog( $( this ).attr( 'href' ) );
      $( '#update-dialog' )
        .dialog( { title: 'Bill Payment' } )
		.dialog( 'open' );		
    });
});
" );
?>
<?php
Yii::app()->clientScript->registerScript( 'licencetypes_submit_cs', "
jQuery( function($){
    //$( '.update-dialog-create' ).button();
});
" );
?>
<script>		
	function show(){
		var ch_val = $('#s_trans').attr('checked');
		if(ch_val=="checked"){
			document.getElementById('transfer_button').style.display = "block";			
			}else{	document.getElementById('transfer_button').style.display = "none";		}
		}	
    </script>
    
    <div style="width:650px; height:10px;"> 	
        
        <div style="float:left;">
          	<a href="<?php echo Yii::app()->request->baseUrl; ?>/GuestLedger/createS/<?php echo $var;?>" class="update-dialog-create"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/serviceinbill.png" /></a>
    	</div>
        
        
    <?php if($bill_no>0){?>    
    <div style="float:left; margin-left:20px; margin-top:10px;">
    Transfer Services:<input type="checkbox" id="s_trans" onclick="show()"/>
    	<div id="transfer_button" style="display:none">
		<?php echo CHtml::button('Teansfer',array('class'=>'transferSelected-button'));?>        
        <input type="hidden" name="myfolio" id="myfolio" value="0" />
		<input type="hidden" name="billFrom" id="billFrom" value="<?php echo $bill_no; ?>" />
        
        <script> function updateMyfolio(x){ document.getElementById('myfolio').value = x; }</script>
        <select id="t_folio" name="t_folio" onchange="updateMyfolio(this.value)"> 
        <option value="">Select Guest Name</option>
        <?php
		$hotel_branch_id = yii::app()->user->branch_id;
        $chkins = Yii::app()->db->createCommand("select * from hms_checkin_info where chkout_status = 'N' and chkin_id != ".$bill_no." and branch_id = $hotel_branch_id")->query();
	foreach($chkins as $row){
	$folio_id = $row['chkin_id'];
	$guest_id =	$row['guest_id'];
		$guest = Yii::app()->db->createCommand("select * from hms_guest_info where guest_id = $guest_id and branch_id = $hotel_branch_id")->query();
			foreach($guest as $row1){
				$guest_name = $row1['guest_name'];
				}
	$room_name=$row['room_name'];
	?>
        <option value="<?php echo $folio_id;?>"><?php echo $room_name."-".$guest_name;?></option>
      <?php 
	}
	  ?>
        </select>       
        </div>   
    </div>
    <?php }?> 
    
    </div>
<?php
Yii::app()->clientScript->registerScript('Transfer',"
$('.transferSelected-button').click(function(){
        // get the ids
        var ids =  $.fn.yiiGridView.getSelection('guest-ledger-grid');
		var bill_to = document.getElementById('myfolio').value; //$('#myfolio').value;
		var bill_from = document.getElementById('billFrom').value;
		//alert(bill_to);
        if('' == ids)
        {
                //alert(bill_no);
				alert('Please select at least one record for transfer');
                return false;
        }
        else if(window.confirm('Are you sure you want to Transfer selected item(s)?'))
        {   
                // we have array, lets split them into a string separating
                // values with commas
				
                params  = 'bill_from='+bill_from+'&bill_to='+bill_to+'&ids='+ids.join(',');
                // now just call the ajax
                $.ajax({
                        url: '".Yii::app()->createUrl('/GuestLedger/transferSelected/')."',
                        type: 'POST',
						data: params,
						
                        success: function(data){ //alert(data);
                                $.fn.yiiGridView.update('guest-ledger-grid', {
                                        data: $(this).serialize()
                                });
                },
                error: function(){
                // what i do on error=?
                }});
        }
        return false; // if you want to avoid default button action
});",CClientScript::POS_READY);
// Change gridview id and controller action as necessary
?>
<?php 
$template ='';
$arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2, Yii::app()->user->getId());
$arrayKeys = array_keys($arrayAuthRoleItems);
$role = strtolower ($arrayKeys[0]);
//echo "--".$role;
if($role!='frontdesk'){
//if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}
if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}
//if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}
}
?>

<?php
$chk_status = Yii::app()->db->createCommand("select chkout_status from hms_checkin_info where chkin_id = $bill_no")->queryScalar();
//echo "----------->".$chk_status;


 if(!isset($_REQUEST['id']) || $chk_status=='Y') { echo "<br /> <br /><br />"; 
 
 
  } ?>

<?php
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'guest-ledger-grid',
	'dataProvider'=>$model->search($var),
	'selectableRows'=>2,
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array('header'=>'Sr:','class'=>'IndexColumn'),
		array('id'=>'selectedItems','class'=>'CCheckBoxColumn'),
		//'c_date',
		array('name'=>'c_date','value'=> 'date("d-m-Y", strtotime($data->c_date))'),
		//'service_id',
		array('name'=>'service_id', 'value'=>'$data->service->service_description'),
		'remarks',
		array('name'=>'debit'),		
		array('name'=>'credit'),
		/*
		'chkin_id',
		'guest_name',
		'room_status',
		'room_id',
		'chkin_date',		
		*/
		/*array(
			'class'=>'CButtonColumn',
		),*/
		
		
		
	array(
			'header' => 'Actions',
			'class' => 'CButtonColumn',
			//'htmlOptions' => array('width'=>80),
			'template'=>$template ,
			'afterDelete'=>"function(link,success,data){ 	
			if(success) {
				$('#statusMsg').html(data); 
				$('#statusMsg').hide();
				$('#statusMsg').slideDown('slow');
			}
			}",
		'buttons'=>array(
		
			// view Record
			'view' => array(
          	'click' => "function( e ){
            e.preventDefault();
            $( '#update-dialog' ).children( ':eq(0)' ).empty(); // Stop auto POST
			
            updateDialog( $( this ).attr( 'href' ) );
            $( '#update-dialog' )
              .dialog( { title: 'View Information' } )
              .dialog( 'open' ); }",
        	),
			
			//Update Record
			'update' => array(
		  	'click' => "function( e ){
				
            e.preventDefault();
			//alert(e);
            $( '#update-dialog' ).children( ':eq(0)' ).empty(); // Stop auto POST
            updateDialog( $( this ).attr( 'href' ) );
            $( '#update-dialog' )
              .dialog( { title: 'Update Service Info' } )
              .dialog( 'open' ); 
			  
			  }",
        	),
			
			// Delete Record
			/* 'delete' => array(
          	'click' => "function( e ){ alert('cccc');
            e.preventDefault();
            $( '#update-dialog' ).children( ':eq(0)' ).empty(); // Stop auto POST
            updateDialog( $( this ).attr( 'href' ) );
            $( '#update-dialog' )
              .dialog( { title: 'Delete Service confirmation' } )
              .dialog( 'open' ); }",
        	), */			
		),//end buttons 
	),
 
 )//columns 
 
 ));
?>


<div style="float:left;padding-right:20px;">
          	<a href="<?php echo Yii::app()->request->baseUrl; ?>/CheckinInfo/admin"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/checkinlist2.png" /></a>
    	</div>
        
        
  <?php if ($bill_no > 0){ ?>      
<div style="float:left;padding-right:20px;">
          	<a href="<?php echo Yii::app()->request->baseUrl; ?>/GuestLedger/split/<?php echo $var;?>" class="update-dialog-create22"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/splitfolio.png" /></a>
    	</div>

<div style="float:left;padding-right:20px;">
          	<a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/GuestLedger/ViewBill/<?php echo $var;?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/printbill2.png" /></a>
    	</div>
<div align="right" style="padding-right:15px;">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/CheckinInfo/CheckOutPopup/<?php echo $var;?>" class="update-dialog-create"><img src="<?php echo Yii::app()->baseUrl; ?>/images/checkout2.png" /></a>
</div>


<?php } ?>

<?php
$updateJS = CHtml::ajax( array(
  'url' => "js:url",
  'data' => "js:form.serialize() + action",
  'type' => 'post',
  'dataType' => 'json',
  'beforeSend'=>"function(){
	  	//alert('called');
	 	//$( '#update-dialog' ).dialog( { show: 'slideDown' }).dialog( { width: '300' });
		$( '#update-dialog div.update-dialog-content' )
		.html( 
		'<div style=\"margin:50px 100px 50px 50px;\"><img src=\"/hotel/images/loading.gif\"  /></div>'
		 );  
		
	}",
  'success' => "function( data )
  {
	 
    if( data.status == 'failure' )
    { //alert('failure of controller mean form loading or validation fail');
		$( '#update-dialog' ).dialog( { show: 'slideDown' }).dialog( { width: 'auto' });
		$( '#update-dialog div.update-dialog-content' ).html( data.content );
	  
      	$( '#update-dialog div.update-dialog-content form input[type=submit]' )
        .die() // Stop from re-binding event handlers
        .live( 'click', function( e ){ // Send clicked button value
          e.preventDefault();
          updateDialog( false, $( this ).attr( 'name' ) );
     	});
    }else if( data.status == 'msg_checkout' ){
		$( '#update-dialog' ).dialog( { show: 'slideDown' }).dialog( { width: '1020' });
		$( '#update-dialog div.update-dialog-content' )
		.html(data.msg_checkout);  
		
	}
    else
    { //alert('success of controller mean form submission and storing data in db');
      $( '#update-dialog div.update-dialog-content' ).html( data.content );
      
	  if( data.status == 'success' ) // Update all grid views on success
      {
        $( 'div.grid-view' ).each( function(){ // Change the selector if you use different class or element
          $.fn.yiiGridView.update( $( this ).attr( 'id' ),{} );
        });
      }
	  
      setTimeout( \"$( '#update-dialog' ).dialog( 'close' ).children( ':eq(0)' ).empty();\", 1000 );
    }
  }"
)); ?>
<?php
Yii::app()->clientScript->registerScript( 'updateDialog', "
function updateDialog( url, act )
{	
  var action = '';  
  var form = $( '#update-dialog div.update-dialog-content form' );
  if( url == false ) {
    action = '&action=' + act;
    url = form.attr( 'action' );
  }
  {$updateJS}
}" ); ?>
