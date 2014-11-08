<?php
$this->breadcrumbs=array('Guest Infos'=>array('index'),	'Manage',);
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
	'dialogClass'=>'alert',
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
}); " );
?>
<?php 
//this var is defined in framework/web/CCoontroler.php
$this->myMenu = "<div align=\"right\">";
$this->myMenu .= "<a id=\"New Guest\" class=\"update-dialog-create\"  href=\"/hotel/GuestInfo/createAjax\"><img class=\"myclass update-dialog-create\" src=\"" .yii::app()->baseUrl ."/images/add.png\" title=\"Add New Guest\"  /></a>";
$this->myMenu .= "</div>";
?>
<table class="mytbl" style="background-color:transparent;" width="200" border="0">
  <tr>
    <td width="750px"><h1><?php echo Yii::t('views','Manage Guests') ?> </h1></td>    
    <td><?php echo $this->myMenu;?></td>
  </tr>  
</table>
<?php 
$template ='';
if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}
if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}
//if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'guest-info-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'guest_id',
		array('header'=>'Sr:','class'=>'IndexColumn'),
		//'guest_salutation_id',
		array('name'=>'guest_name', 'value'=>'$data->guestSalutation->salutation_name.ucfirst($data->guest_name)'),
		array('name'=>'guest_company_id', 'value'=>'$data->guestCompany->comp_name'),
		//'guest_name',
		//'guest_gender',
		//'guest_address',
		//'guest_phone',
		//'guest_country_id',
		//array('name'=>'guest_phone', 'value'=>'$data->guest_phone'),
		
		'guest_mobile',
		
		//array('name'=>'guest_address', 'value'=>'ucwords($data->guest_address)'),
		//'guest_identity_id',
		//array('name'=>'guest_identity_id', 'value'=>'$data->guestIdentity->identity_description'),
		'guest_identity_no',
		
		array('name'=>'guest_country_id', 'value'=>'$data->guestCountry->country_name'),
		
		
		array(
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
			
			//Update Record
			'update' => array(
		  	'click' => "function( e ){				
            e.preventDefault();			
            $( '#update-dialog' ).children( ':eq(0)' ).empty(); // Stop auto POST
           
		    updateDialog( $( this ).attr( 'href' ) );
            $( '#update-dialog' )
              .dialog( { title: 'Update Guest' } )
              .dialog( 'open' ); 
			  
			  }",
        	),
			
			), //end of button array
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
  'beforeSend'=>"function(){ //alert('url:'+url);
	  
	 	$( '#update-dialog' ).dialog( { show: 'slideDown' }).dialog( { width: '950' });
		$( '#update-dialog div.update-dialog-content' )
		.html( 
		'<div style=\"margin:50px 100px 50px 50px;\"><img src=\"/hotel/images/loading.gif\"  /></div>'
		 );  
		
	}",
  'success' => "function( data )
  {
	 
    if( data.status == 'failure' )
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