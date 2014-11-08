<?php
$this->breadcrumbs=array('Companys'=>array('index'),'Manage',);
//this var is defined in framework/web/CCoontroler.php
/////////////////////////////////////////////
$this->beginWidget( 'zii.widgets.jui.CJuiDialog', array(
  'id' => 'update-dialog',
   'options' => array(
    'title' => 'Dialog',
    'autoOpen' => false,
	'show'=>'slideDown',
	'hide'=>'explode fast',
    'modal' => true,
    'width' => '950',
	'position'=>'left top',
	//'dialogClass'=>'alert',
	'minWidth'=> '950',
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
///////////////////////////////////////////
 $this->myMenu = "<div align=\"right\">";
$this->myMenu .= "<a href=\"/hotel/Company/create\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/add.png\" title=\"Add New Company\"  /></a>";
//$this->myMenu .= "<a  href=\"/hotel/Company/admin\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/manage.png\" title=\"Mangage Companies\" /></a>";
$this->myMenu .= "</div>"; 

?>
<table class="mytbl" style="background-color:transparent;" width="200" border="0">
  <tr>
    <td width="750px"><h1>Manage Companies</h1></td>    
    <td><?php echo $this->myMenu;?></td>
  </tr>  
</table>
<?php 
$template ='';
if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}
if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}
//if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'company-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'comp_id',
		array('header'=>'Sr:','class'=>'IndexColumn'),
		'comp_name',
		'comp_contact_person',
		//'person_designation',
		'person_mobile',
		'comp_phone',
		//'comp_fax',
		//'comp_address',
		//'comp_email',
		//'comp_website',
		'comp_allow_credit',
		//'country_id',
		//array('name'=>'country_id', 'value'=>'$data->country->country_name'),
		/*
		'branch_id',
		'user_id',
		*/
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
              .dialog( { title: 'View Company' } )
              .dialog( 'open' ); }",
        	),
			
					//Update Record
					'update' => array(
					'click' => "function( e ){				
					e.preventDefault();			
					$( '#update-dialog' ).children( ':eq(0)' ).empty(); // Stop auto POST
				   
					updateDialog( $( this ).attr( 'href' ) );
					$( '#update-dialog' )
					  .dialog( { title: 'Update Company' } )
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
	  
	 	$( '#update-dialog' ).dialog( { show: 'slideDown' }).dialog( { width: '950' });
		$( '#update-dialog div.update-dialog-content' )
		.html( 
		'<div style=\"margin:50px 100px 50px 50px;\"><img src=\"/hotel/images/loading.gif\"  /></div>'
		 );  
		
	}",
  'success' => "function( data )
  {
	  
	 if( data.status == 'msg' ){
		$( '#update-dialog' ).dialog( { show: 'slideDown' }).dialog( { width: '950' });
		$( '#update-dialog div.update-dialog-content' )
		.html(data.msg);  		
	}else  if( data.status == 'failure' )
    {
		$( '#update-dialog' ).dialog( { show: 'slideDown' }).dialog( { width: '950' });
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
      	setTimeout(function(){
			$( '#update-dialog' ).dialog( 'close' ).children( ':eq(0)' ).empty();
		}, 1000);
		
		
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



