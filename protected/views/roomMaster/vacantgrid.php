<?php
$this->beginWidget( 'zii.widgets.jui.CJuiDialog', array(
  'id' => 'update-dialog',
   'options' => array(
    'title' => 'Dialog',
    'autoOpen' => false,
	'show'=>'slideDown',
	'hide'=>'explode fast',
    'modal' => true,
    'width' => '1020',
	'position'=>'left top',
	'dialogClass'=>'alert',
	//'minWidth'=> '400',
	'minHeight'=> '100',
    'resizable' => true,	
	'resizeStart'=>'js:function(event, ui) {			
	}',
	'beforeClose'=>"js:function(event, ui) {
	
	}",	
  ),
)); 
echo "<div class='update-dialog-content' ></div>";
$this->endWidget();   //////
//Create Record
Yii::app()->clientScript->registerScript( 'updateDialogCreate', "
jQuery( function($){
    $( 'a.update-dialog-create' ).bind( 'click', function( e ){
      e.preventDefault();
      $( '#update-dialog' ).children( ':eq(0)' ).empty();
      updateDialog( $( this ).attr( 'href' ) );
      $( '#update-dialog' )
        .dialog( { title: $( this ).attr( 'id' ) } )
		.dialog( 'open' );		
    });
});
" );
////////////////
		$hotel_branch_id = yii::app()->user->branch_id;		
		$total_rooms = RoomMaster::model()->findAll("mst_room_status = 'V' AND branch_id=$hotel_branch_id Order by mst_room_name");
		$available_rooms = RoomMaster::model()->findAll("mst_room_status = 'V' AND branch_id=$hotel_branch_id");
		
		
?>
<style type="text/css">
.room-no {
	color: #FFF;
	text-decoration:none !important;
	text-shadow:#999;
	font-weight:bold;	
}
.mini-box{
	height:20px;
	width:20px;
	border:thin;
	float:left;
	margin-top: 50px;
	margin-left:100px;	
}
.round-corner{
	border:2px; 
	border-top-left-radius: .5em;
	border-top-right-radius: .5em;
	border-bottom-left-radius: .5em;
	border-bottom-right-radius: .5em;
}
</style>
<h1><?php echo Yii::t('views','Rooms Grid') ?> </h1>
<div class="span-23 showgrid">
<div class="dashboardIcons span-16" style="width:100%">
    
 <?php 
	$room_arr = array();
	$room_master_id_arr = array();
	$room_status_arr = array();
	foreach ($total_rooms as $row) {							
					array_push($room_master_id_arr, $row[mst_room_id]);	
					array_push($room_arr, $row[mst_room_name]);		
					array_push($room_status_arr, $row[mst_room_status]);		
				}				
	
	for($div=0; $div < count($total_rooms); $div++){		
		$guest='';
		if($room_status_arr[$div]=='V'){ $status = "Availabe"; $bg_color = "background-color:#060;"; }
		else if($room_status_arr[$div]=='D'){ $status = "Dirty"; $bg_color = "background-color:#FFAD5B;"; }
		else if($room_status_arr[$div]=='R'){ $status = "Reserved"; $bg_color = "background-color:#06C;"; }			
		////////
		
	?>
     <div class="dashIcon span-3 round-corner" style="color:#FFF !important; width:130px; height:75px; <?php echo $bg_color; ?>">  
     	
        <div class="dashIconText"  style=" color:#FFF !important;">
        <span ><a id="Guest details" href="<?php echo Yii::app()->baseUrl; ?>/CheckinInfo/RoomInfo/<?php echo $room_master_id_arr[$div]; ?>" class="room-no update-dialog-create">
        <?php echo $room_arr[$div]; ?>
        </a></span>        
        <p> <a id="New Checkin" href="<?php echo Yii::app()->baseUrl; ?>/CheckinInfo/CreateAjax?myroomid=<?php echo $room_master_id_arr[$div]; ?>" class="room-no update-dialog-create"><?php echo $status; ?> </a></p>
        </div>         
     
     </div>
    
    <?php } ?>
</div>
</div>
<div style="clear:both;"></div>
<div align="center" style=" border-color:#009; margin-bottom:70px; margin-left:120px;">
<div class="mini-box " style="background-color:#060;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo Yii::t('views','Available') ?> </div>
<div class="mini-box" style="background-color:#930;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo Yii::t('views','Occupied') ?></div>
<div class="mini-box" style="background-color:#FFAD5B;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Yii::t('views','Dirty') ?> </div>
<div class="mini-box" style="background-color:#06C;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Yii::t('views','Reserved') ?> </div>
</div>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////
$updateJS = CHtml::ajax( array(
  'url' => "js:url",
  'data' => "js:form.serialize() + action",
  'type' => 'post',
  'dataType' => 'json',
  'beforeSend'=>"function(){ //alert('url:'+url);	  
	 	$( '#update-dialog' ).dialog( { show: 'slideDown' }).dialog( { width: '1020' });
		$( '#update-dialog div.update-dialog-content' )
		.html( 
		'<div style=\"margin:50px 100px 50px 50px;\"><img src=\"/hotel/images/loading.gif\"  /></div>'
		 );  
		
	}",
  'success' => "function( data ) {	 
    if( data.status == 'failure' ){
		$( '#update-dialog' ).dialog( { show: 'slideDown' }).dialog( { width: '1020' });
		$( '#update-dialog div.update-dialog-content' ).html( data.content );
	  
      	$( '#update-dialog div.update-dialog-content form input[type=submit]' )
        .die() // Stop from re-binding event handlers
        .live( 'click', function( e ){ // Send clicked button value
          e.preventDefault();
          updateDialog( false, $( this ).attr( 'name' ) );
     	});
    }
    else{
      $( '#update-dialog div.update-dialog-content' ).html( data.content );      
	  if( data.status == 'success' ) // Update all grid views on success
      {
        $( 'div.grid-view' ).each( function(){ // Change the selector if you use different class or element
          $.fn.yiiGridView.update( $( this ).attr( 'id' ),{} );
        });
      }	  
      	setTimeout(function(){
			$( '#update-dialog' ).dialog( 'close' ).children( ':eq(0)' ).empty();
		}, 2000);		
    }
  }"
)); 
$dialog_param = "function updateDialog( url, act ){
  var action = '';
  var form = $( '#update-dialog div.update-dialog-content form' );
  if( url == false ){
    action = '&action=' + act;
    url = form.attr( 'action' );
  } {$updateJS} }";
  
  
Yii::app()->clientScript->registerScript( 'updateDialog', $dialog_param); 
////////////////////////////////////////////////////////////////////////////////////////////////
?>