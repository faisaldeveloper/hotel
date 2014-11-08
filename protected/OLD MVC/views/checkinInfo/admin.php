<?php
$this->breadcrumbs=array('Checkin Infos'=>array('index'),	'Manage',);

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
	//'dialogClass'=>'alert',
	'minWidth'=> '1020',
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
<script>
function deleteConfirm(selector){
var length = selector.closest('table').children('thead').children('tr').children('td').length;
//var length = $('table.items>thead>tr>td').length;

var msg='';
msg += 'Do you really want to delete this record?'+
   '\n';
for(i=1;i<=length-1;i++){
var title = selector.parent().parent().parent().parent().children(':nth-child(1)').children(':nth-child(1)').children(':nth-child('+i+')').text();
var tdval = selector.parent().parent().children(':nth-child('+i+')').text();

if(tdval.length>0){msg += title+'  = '+tdval+'\n';}

}

return msg;
}
</script>
<style>
.addimg{
	padding: 0px 5px 0px 10px; 
	
}
</style>

<table class="mytbl" style="background-color:transparent;" width="200" border="0">
  <tr>
    <td width="750px"><h1>Manage Checkins</h1></td>    
    <td><?php echo $this->myMenu;?></td>
  </tr>  
</table>

<?php 


$template ='';
if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}
if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}
//if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'checkin-info-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	
	//'cssFile' => Yii::app()->request->baseUrl.'/css/bootstrap/css/gridview_css.css',
	'columns'=>array(
		//'chkin_id',
		//array('header'=>'Sr:','class'=>'IndexColumn'),			
		//'chkin_id',
		//'guest_id',
		array('name'=>'room_name', 'value'=>'$data->room->mst_room_name'),			
		array('name'=>'guest_id', 'value'=>'ucwords($data->guest->guest_name)'),		
		//'guest_company_id',
		array('name'=>'guest_company_id', 'value'=>'$data->company->comp_name'),				
		//'room_name',
		
		array('name'=>'chkin_id', 'type'=>'raw', 'header'=>'Payable', 'value'=>'number_format(CheckinInfo::payable($data->chkin_id),2)'),
		array('name'=>'cash', 'type'=>'raw', 'header'=>'MOP', 'value'=>'CheckinInfo::mop($data->chkin_id)'),
			
		//'room_type',
		//array('name'=>'room_type', 'value'=>'$data->roomtype->room_name'),		
		
		//'reservation_id',
		//'chkin_date',
		array('name'=>'chkin_date', 'value'=>'date("d/m/y",strtotime($data->chkin_date))'),
		
		//'chkout_date',
		array('name'=>'chkout_date', 'value'=>'date("d/m/y",strtotime($data->chkout_date))'),
		
		/*
		'chkin_time',		
		*/
		 array(
			'header' => 'Folio_Actions',
			'class' => 'CButtonColumn',
			'template'=>'{Folio}{Split}{regcard}',
			
			'buttons'=>array(
				'Folio' => array(
					'label'=>'Folio',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/calculator.gif',
					'url'=>'Yii::app()->baseUrl."/GuestLedger/admin/$data->chkin_id"',
					'options'=>array('title'=>'View This Folio'),
					//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
					),	
					
				'Split' => array(
					'label'=>'Split',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/scissor_icon.gif',
					'url'=>'Yii::app()->baseUrl."/GuestLedger/divideBill/$data->chkin_id"',
					'options'=>array('title'=>'Split Bill', 'class'=>'addimg' ),
					//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
					),	
					
					'regcard' => array
					(
					'label'=>'Reg Card',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/regcard.png',
					'url'=>'Yii::app()->baseUrl."/CheckinInfo/viewRegCard/$data->chkin_id"',
					'options'=>array('title'=>'View Registration Card', 'class'=>'addimg', 'target'=>'_blank'),
					//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
					),							
								
				),//end buttons
			),//end Actions 
			
						
					
		
		
		array(
		'header' => 'Actions',
			'class'=>'CButtonColumn',
			'template'=>$template ,
			"deleteConfirmation"=>"js: deleteConfirm($(this))",
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
			
					//Update Record
					'update' => array(
					'click' => "function( e ){				
					e.preventDefault();			
					$( '#update-dialog' ).children( ':eq(0)' ).empty(); // Stop auto POST
				   
					updateDialog( $( this ).attr( 'href' ) );
					$( '#update-dialog' )
					  .dialog( { title: 'Update Checkin' } )
					  .dialog( 'open' ); 
					  
					  }",
					),
			
			
			), //end button array			
			
		),
	),
)); ?>


<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////
$updateJS = CHtml::ajax( array(
  'url' => "js:url",
  'data' => "js:form.serialize() + action",
  'type' => 'post',
  'dataType' => 'json',
  'beforeSend'=>"function(){ 
	  
	 	$( '#update-dialog' ).dialog( { show: 'slideDown' }).dialog( { width: '1020' });
		$( '#update-dialog div.update-dialog-content' )
		.html( 
		'<div style=\"margin:50px 100px 50px 50px;\"><img src=\"/hotel/images/loading.gif\"  /></div>'
		 );  
		
	}",
  'success' => "function( data )
  {
	  
	 if( data.status == 'msg' ){
		$( '#update-dialog' ).dialog( { show: 'slideDown' }).dialog( { width: '1020' });
		$( '#update-dialog div.update-dialog-content' )
		.html(data.msg);  		
	}else  if( data.status == 'failure' )
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
		  if(data.msg > 0)
		  window.open('/hotel/CheckinInfo/viewRegCard/'+data.msg, '_blank') ;		
		  
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


<?php
Yii::app()->clientScript->registerScript('Transfer',"
$('.transferSelected-button').click(function(){
        // get the ids
        var ids =  $.fn.yiiGridView.getSelection('checkin-info-grid');
		//var bill_no = $('#t_folio').value;        
       if(window.confirm('Are you sure you want to Post Auto Posting?'))
        {   
               			
				$(\"#ajax-loading\").show();				
                $.ajax({
                        url: '".Yii::app()->createUrl('/GuestLedger/CreateRoomPost/')."',
                        data: ids,
                        success: function(data){ alert(data); $(\"#ajax-loading\").hide();
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

?>

<script>
$(document).ready(function(){
$(".mcetable tr:even").css('background-color','#FAFAFA');
});
</script>


