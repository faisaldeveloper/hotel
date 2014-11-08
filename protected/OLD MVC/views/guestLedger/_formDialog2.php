<script>
$(document).ready(function(){

$( "#closelicencetypeDialog2" ).button({
            icons: {
                primary: "ui-icon-plusthick"
            },
           //text: false
        });
		


});
</script>

<div class="form" id="licencetypeDialogForm">
 
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'licencetypes-form',
    'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false,'validateOnChange'=>false),
	
)); 
//I have enableAjaxValidation set to true so i can validate on the fly the
?>
 <div id="licence_type_error_div">
    <p class="note">Fields with3 <span class="required">*</span> are required.</p>
 </div>
    <?php echo $form->errorSummary($model); ?>
 
    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php //echo $form->textField($model,'name',array('size'=>60,'maxlength'=>180)); ?>
        widget
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'model'=>$model,
		'attribute'=>'name',
    	'name'=>'Licencetypes[name]',
    	// additional javascript options for the date picker plugin
    	'options'=>array(
        'showAnim'=>'fold',
		'dateFormat'=>'dd-mm-yy',
		'changeMonth'=>true,
    	'changeYear'=>true,
		'yearRange'=>'-100:+0'
    	),
    	'htmlOptions'=>array(
        'style'=>'float:left;',
		),
		));?>
        
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row buttons">
    
<?php echo CHtml::ajaxSubmitButton('Create Licence Type',CHtml::normalizeUrl(array('licencetypes/addnew2','render'=>false)),
					array(
					'type'=>'POST',

					'success'=>'js: function(data) {
						alert(data);
						var data2 = $.parseJSON(data);
						
						if(data2.er>0){
						$("#licence_type_error_div").html("<div style=\"color:red\">"+data2.msg+"<br></div>");
						}else{
						//$("#Drivers_licence_type_id").append(data2.msg);
						//$("#Drivers_licence_type_id").trigger("liszt:updated");
						
						$("#licencetypeDialog2").dialog("close");
						$.fn.yiiGridView.update("licencetypes-grid",{Licencetype_page:2});
                        
						}
                    }'
					
					),array('id'=>'closelicencetypeDialog2')); ?>
    </div>

<?php $this->endWidget(); ?>

</div>