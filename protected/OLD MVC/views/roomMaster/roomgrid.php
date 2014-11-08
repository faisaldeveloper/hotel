<?php
if(!isset(yii::app()->user->user_id)){
	// echo "<script>window.location=\"/hotel/index.php"; </script9>";
//exit();
}

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
    $( 'a.update-dialog-create' ).live( 'click', function( e ){
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
		$total_rooms = RoomMaster::model()->findAll("branch_id=$hotel_branch_id Order by mst_room_name");
		$available_rooms = RoomMaster::model()->findAll("mst_room_status = 'V' AND branch_id=$hotel_branch_id");
		$total_res = ReservationInfo::model()->findAll("reservation_status = 1 AND chkin_status='N' AND branch_id=$hotel_branch_id");		
		$occupied_rooms = CheckinInfo::model()->findAll("chkout_status='N' AND branch_id=$hotel_branch_id");
			
			$spc = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$res_summary = "Total Rooms: ".count($total_rooms).$spc;
			$res_summary .= "Available Rooms: ".count($available_rooms).$spc;
			$res_summary .= "Checkins: ".count($occupied_rooms).$spc;
			$res_summary .= "Reservations: ".count($total_res).$spc;
			
			
	////////////////////////
	function getGuestID($roomID){
			
			$hotel_branch_id = yii::app()->user->branch_id;	
			//here room_name is used as room_id coz of design fault.	
			$chkininfo_res = CheckinInfo::model()->findAll("room_name = $roomID AND chkout_status='N' AND branch_id=$hotel_branch_id");			
				
				foreach ($chkininfo_res as $row) {$guest_id = $row[guest_id];}				
				//echo "<script>alert('". $roomID."-" .$guest_id  ."')</script9>";
				return	$guest_id;
	}
	
	///////
	function getGuestName($guest_id){
				$guest_res = GuestInfo::model()->findAll("guest_id = '$guest_id'"); 
				foreach ($guest_res as $row) {$guest_name = $row[guest_name];}
				$str = "<a style=\"color:#FFF;  id=\"Guest details\"  class=\"update-dialog-create\"  \" href=\"".Yii::app()->baseUrl ."/CheckinInfo/GuestInfo/". $guest_id ."\"> ". ucwords(strtolower($guest_name)). "</a>";
				return	$str;
	}
	
	//////////guest folio a
	function getFolioNo($roomID, $GuestID){
	$hotel_branch_id = yii::app()->user->branch_id;	
	//$chkin_id = GuestLedger::model()->find("room_id = '$roomID' AND room_status='O' AND branch_id=$hotel_branch_id")->chkin_id;	
	//return $chkin_id;	
	return CheckinInfo::model()->find("room_id = '$roomID' AND guest_id='$GuestID' AND branch_id=$hotel_branch_id")->guest_folio_no;
	}

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
<h1> <?php echo Yii::t('views','Rooms Grid') ?> </h1>


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
				
	//find occupied rooms_ids	
	$occupied_room_ids_arr = array();
	foreach ($occupied_rooms as $row) {	array_push($room_master_id_arr, $row[room_name]);	}				
				
	for($div=0; $div < count($total_rooms); $div++){		
		$guest='';
		if($room_status_arr[$div]=='V'){ $status = "Availabe"; $bg_color = "background-color:#060;"; }
		else if($room_status_arr[$div]=='D'){ $status = "Dirty"; $bg_color = "background-color:#FFAD5B;"; }
		else if($room_status_arr[$div]=='R'){ $status = "Reserved"; $bg_color = "background-color:#06C;"; }
		else { 
			$status = ""; $bg_color = "background-color:#930;";			
			$guest='99';
			if($room_master_id_arr[$div]==$room_master_id_arr[$div]){ 
				$GuestID = getGuestID($room_master_id_arr[$div]);
				$guest = getGuestName($GuestID);
			}
		}	//end for loop	
		////////
		$folio = getFolioNo($room_master_id_arr[$div], $GuestID);
		if($status =="Availabe"){ $url = Yii::app()->baseUrl."/CheckinInfo/CreateAjax?myroomid=". $room_master_id_arr[$div]; }
		if($status =="Dirty"){$url =  Yii::app()->baseUrl."/roomMaster/UpdateAjax/". $room_master_id_arr[$div];	}
	?>
     <div id="<?php echo $room_master_id_arr[$div]; ?>" class="dashIcon span-3 round-corner" style="color:#FFF !important; width:130px; height:75px; <?php echo $bg_color; ?>">  
     	
        <div class="dashIconText"  style=" color:#FFF !important;"><span ><a id="Room details" href="<?php echo Yii::app()->baseUrl; ?>/CheckinInfo/RoomInfo/<?php echo $room_master_id_arr[$div]; ?>" class="room-no update-dialog-create">        		 
		<?php echo $room_arr[$div]; ?>
        </a></span>
        <p> 
        <?php if($status =="Availabe"){ ?>
         <a id="New Checkin" href="<?php echo $url; ?>" class="room-no update-dialog-create"><?php echo $status; ?> </a>
         <?php }else  if($status =="Dirty"){ ?>
          <p> <?php //echo $status; ?> 
           <a id="Update_Room" href="<?php echo $url; ?>" class="room-no update-dialog-create"><?php echo $status; ?> </a>
          <?php }?>
         
        <?php echo ucwords($guest);?>      
       <p style="margin-top:-14px !important;"><a id="Bill details" href="<?php echo Yii::app()->baseUrl; ?>/CheckinInfo/BillInfo/<?php echo $folio; ?>" class="room-no update-dialog-create"><?php if(isset($folio))echo "Bill#: ".$folio;?></a></p>
        </p>
        </div>        
     </div>
    
    <?php } ?>


</div>
</div>
<div style="clear:both;"></div>
<div align="center" style=" border-color:#009; margin-bottom:70px; margin-left:120px;">
<div class="mini-box " style="background-color:#060;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo Yii::t('views','Available') ?> </div>
<div class="mini-box" style="background-color:#930;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo Yii::t('views','Occupied') ?></div>
<div class="mini-box" style="background-color:#FFAD5B;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo Yii::t('views','Dirty') ?> </div>
<div class="mini-box" style="background-color:#06C;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo Yii::t('views','Reserved') ?></div>
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
  'success' => "function( data )
  { //alert(data);
	 
    if( data.status == 'failure' )
    {
		$( '#update-dialog' ).dialog( { show: 'slideDown' }).dialog( { width: '1020' });
		$( '#update-dialog div.update-dialog-content' ).html( data.content );
	  
      	$( '#update-dialog div.update-dialog-content form input[type=submit]' )
        .die() // Stop from re-binding event handlers
        .live( 'click', function( e ){ // Send clicked button value
          e.preventDefault();
          updateDialog( false, $( this ).attr( 'name' ) );
     	});
    }
    else
    {
      $( '#update-dialog div.update-dialog-content' ).html( data.content );
      
	  if( data.status == 'success' ) // Update all grid views on success
      {
        $( 'div.grid-view' ).each( function(){ // Change the selector if you use different class or element
          $.fn.yiiGridView.update( $( this ).attr( 'id' ),{} );
        });
      }
	  
	   if( data.status == 'updateRoom' ){
		   var id = data.id;
		  
	   
       $('#'+id).css('background-color','#060');
	   var a = $('#'+id+' p:eq(1)').html('<a class=\"room-no update-dialog-create\" href=\"/hotel/CheckinInfo/CreateAjax?myroomid='+ id +'\" id=\"New Checkin\">Availabe </a>');
      
	
	/* 	jQuery( function($){
			$( 'a.update-dialog-create' ).bind( 'click', function( e ){
			  e.preventDefault();
			  $( '#update-dialog' ).children( ':eq(0)' ).empty();
			  updateDialog( $( this ).attr( 'href' ) );
			  $( '#update-dialog' )
				.dialog( { title: $( this ).attr( 'id' ) } )
				.dialog( 'open' );
				
			});
		});
 */
	  
	  
	  
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

<script>
/* $(document).ready(function(){
	var a = $('#3 p:eq(1)').html();
	alert('-- '+a);
	//<a class="room-no update-dialog-create" href="/hotel/CheckinInfo/CreateAjax?myroomid=8" id="New Checkin">Availabe </a>
});
 */</script>