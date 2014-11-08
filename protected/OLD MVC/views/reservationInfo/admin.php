<?php
$this->breadcrumbs=array('Reservation Infos'=>array('index'),	'Manage',);
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
	//'minWidth'=> '950',
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
?>
<script>
$(function(){
var ids = $('table thead tr:first th:nth-child(1)').attr('id');
var ind = ids.indexOf('-grid_c');
var grid_name = ids.substr(0,ind+7);
arr = Array();
arr_ind =0;
$('th[id^="'+grid_name+'"]').live('dblclick',function(){
var ind = $(this).index();
var id = this.id;
arr[arr_ind]=id;
arr_ind++;
ind=ind+1;
$("table th:nth-child("+ind+"), table td:nth-child("+ind+")").remove();
});
 $('\.summary').live('click',function(){
  
 for(i=0;i<arr.length;i++){
 //alert(arr[i]);
 
 }
 
 $('\.container').css('width','800px');
 $("h1").toggle();//nobr.testClass > h1
 $("\.pager-class").toggle();
  
 });
});
</script>

<style>
.addimg{
	padding: 0px 5px 0px 10px; 
	
}
</style>
<div>
      
<?php
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
/////////////////////////////////////////////////////////
$this->menu=array(
	//array('label'=>'List ReservationInfo', 'url'=>array('index')),
	array('label'=>'Create ReservationInfo', 'url'=>array('create')),
);
//this var is defined in framework/web/CCoontroler.php
$this->myMenu = "<div align=\"right\">";
//$this->myMenu .= "<a href=\"/hotel/ReservationInfo/create\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/add.png\" title=\"Add New Reservation\"  /></a>";
//echo CHtml::link('Create',array('ReservationInfo/createAjax'),array('class'=>'add update-dialog-create','id'=>'Create Tasks'));
$this->myMenu .= "<a id=\"New Reservation\" class=\"update-dialog-create\"  href=\"/hotel/ReservationInfo/createAjax\"><img class=\"myclass update-dialog-create\" src=\"" .yii::app()->baseUrl ."/images/add.png\" title=\"Add New Reservation\"  /></a>";
$this->myMenu .= "</div>";
?>
<table class="mytbl" style="background-color:transparent;" width="200" border="0">
  <tr>
    <td width="750px"><h1><?php echo Yii::t('views','Manage Reservations') ?></h1></td>    
    <td><?php echo $this->myMenu;?></td>
  </tr>  
</table>
<script>
$(document).ready(function(){ 
var msg = 5;
//window.open($('a[href*=\"ViewResCard/'+msg+'\"]').attr('href'),'_blank') ;	
 });
</script>
<?php 
$temp ='';
$template ='';
if(Yii::app()->user->checkAccess(get_class($model).'View')) {$template .= "{view}";}
if(Yii::app()->user->checkAccess(get_class($model).'Update')) { $template .= "{update}";}
//if(Yii::app()->user->checkAccess(get_class($model).'Create')) { $template .= "{update}";}
//if(Yii::app()->user->checkAccess(get_class($model).'Delete')) {$template .= "{delete}";}
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reservation-info-grid',
	'dataProvider'=>$model->search(),
	//'cssFile' => Yii::app()->request->baseUrl.'/css/gridview/styles.css',
	'filter'=>$model,
	'afterAjaxUpdate'=>'function(id, data){ 
 for(i=0;i<arr.length;i++){
 var val = $("#"+arr[i]).index();
 val=val+1;
 $("table th:nth-child("+val+"), table td:nth-child("+val+")").remove();
 }   
 }',
	'columns'=>array(
		//'reservation_id',
		array('name'=>'reservation_id', 'value'=>$data->reservation_id),
		//array('header'=>Sr#','class'=>'IndexColumn'),		
		//'res_type',
		
		array('name'=>'client_name', 'value'=>'ucwords($data->client_name)'),
		
		//'client_address',
		//array('name'=>'client_address', 'value'=>'ucwords($data->client_address)'),
		array('name'=>'company_id', 'value'=>'$data->company->comp_name'),	
		'to_person',
		array('name'=>'client_phone', 'value'=>$data->client_phone),
		array('name'=>'client_mobile', 'value'=>$data->client_mobile),
		
		//'guest_mobile',
		//'guest_phone',		
		//array('name'=>'to_person', 'value'=>'ucwords($data->to_person)'),
		//'designation',
		//'res_type',
		//'group_name',
		//'company_id',
		array('name'=>'chkin_date', 'value'=>'date("d/m/y",strtotime($data->chkin_date))'),
		array('name'=>'chkout_date', 'value'=>'date("d/m/y",strtotime($data->chkout_date))'),
		array('name'=>'reservation_status','filter'=>array('1'=>'Confirm','2'=>'Cancel', '3'=>'Normal'), 'value'=>'$data->reservationStatus->res_description'),
				
		/*
		'chkin_date',
		'chkin_time',		
		'sale_person_id',
		'branch_id',
		*/
		
		//view/print reservation
			array(
			'header' => 'Res_Card',
			'class' => 'CButtonColumn',
			'template'=>'{regcard}{addmember}',
			'buttons'=>array
				(
				'regcard' => array(					
					'label'=>'Reservation Card',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/regcard.png',
					'url'=>'Yii::app()->baseUrl."/ReservationInfo/ViewResCard/$data->reservation_id"',
					'options'=>array('id'=>"$data->reservation_id",'title'=>'View Reservation Card', 'target'=>'_blank'),
					//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
					),	
					
					'addmember' => array(					
					'label'=>'Add Member',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/ad.png',
					'url'=>'Yii::app()->baseUrl."/ReservationInfo/Addmember/$data->reservation_id"',
					'options'=>array('id'=>"$data->reservation_id", 'class'=>'addimg' ,'title'=>'Add New Member'),
					'visible'=>'$data->res_type=="G"',
					//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
					),				
								
				),//end buttons
			),//end Actions
		
		array(
		'header' => 'Actions',
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
              .dialog( { title: 'View Reservation' } )
              .dialog( 'open' ); }",
        	),
			//Update Record
			'update' => array(
		  	'click' => "function( e ){				
            e.preventDefault();			
            $( '#update-dialog' ).children( ':eq(0)' ).empty(); // Stop auto POST
           
		    updateDialog( $( this ).attr( 'href' ) );
            $( '#update-dialog' )
              .dialog( { title: 'Update Reservation' } )
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
    else {
      $( '#update-dialog div.update-dialog-content' ).html( data.content );	  
	  if( data.status == 'success' ) // Update all grid views on success
      {		 
		  if(data.msg > 0)
		  window.open('/hotel/ReservationInfo/ViewResCard/'+data.msg, '_blank') ;		 
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