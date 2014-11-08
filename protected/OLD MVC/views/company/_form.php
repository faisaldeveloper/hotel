<style>
input{
	margin-bottom:0px;
}
input[type="text"]{
	width:120px;
}
textarea{
	width:120px;
	min-height:20px;
}
	
</style>



<div class="form">
<?php $hotel_branch_id = yii::app()->user->branch_id;?>
<?php 
/* $this->widget('ext.pixelmatrix.EUniform', array(   
    'selector' => 'select, text, textarea, checkbox',    
    'theme' => 'aristo',));
 
$form = $this->beginWidget('CActiveForm', array(
'id' => 'my-form',
)); */
$cs = Yii::app()->clientScript;
 $cs->scriptMap['form.css'] = false;
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
));  
 
?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>
	<div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'comp_name'); ?>
		<?php echo $form->textField($model,'comp_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'comp_name'); ?>
	</div>
	<div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'comp_contact_person'); ?>
		<?php echo $form->textField($model,'comp_contact_person',array('size'=>30,'maxlength'=>30)); ?>
		<?php //echo $form->error($model,'comp_contact_person'); ?>
	</div>
	<div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'person_designation'); ?>
		<?php echo $form->textField($model,'person_designation',array('size'=>30,'maxlength'=>30)); ?>
		<?php //echo $form->error($model,'person_designation'); ?>
	</div>
    
    <div style="clear:left"></div>
    
    <div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'comp_address'); ?>
		<?php //echo $form->textField($model,'comp_address',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->textArea($model, 'comp_address', array('maxlength' => 225, 'rows' => 3, 'cols' => 30)); ?>
		<?php //echo $form->error($model,'comp_address'); ?>
	</div>
    
	<div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'person_mobile'); ?>
		<?php echo $form->textField($model,'person_mobile'); ?>
		<?php //echo $form->error($model,'person_mobile'); ?>
	</div>     
	
	<div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'comp_phone'); ?>
		<?php echo $form->textField($model,'comp_phone'); ?>
		<?php //echo $form->error($model,'comp_phone'); ?>
	</div>
    
    <div style="clear:left"></div>
    
	<div class="row" style="float:left; margin-left:5px; margin-top:20px">
		<?php echo $form->labelEx($model,'comp_fax'); ?>
		<?php echo $form->textField($model,'comp_fax'); ?>
		<?php //echo $form->error($model,'comp_fax'); ?>
	</div>
	<div class="row" style="float:left; margin-left:5px; margin-top:20px">
		<?php echo $form->labelEx($model,'comp_email'); ?>
		<?php echo $form->textField($model,'comp_email',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'comp_email'); ?>
	</div>

	<div class="row" style="float:left; margin-left:5px; margin-top:20px">
		<?php echo $form->labelEx($model,'comp_website'); ?>
		<?php echo $form->textField($model,'comp_website',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'comp_website'); ?>
	</div>
    
    
    <div style="clear:left"></div>
    
	<div class="row" style="float:left; margin-left:5px; margin-top:20px">
		<?php echo $form->labelEx($model,'country_id'); ?>
		<?php echo $form->dropDownList($model,'country_id', CHtml::listData(Country::model()->findAll(), 'country_id', 
		'country_name'), array('options' => array('1'=>array('selected'=>true))), array('prompt'=>'Select Country')); 
		?>
		<?php //echo $form->error($model,'country_id'); ?>
	</div>
    
    <div class="row" style="float:left; margin-left:5px; margin-top:20px">
		<?php echo $form->labelEx($model,'comp_allow_credit'); ?>
		<?php echo $form->checkBox($model,'comp_allow_credit',array('value' => 'Y', 'uncheckValue'=>'N')); ?>
		<?php //echo $form->error($model,'comp_allow_credit'); ?>
	</div>
	<div class="row" style="float:left; margin-left:5px;">
		
		<?php //echo $form->labelEx($model,'branch_id'); ?>
		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>
		<?php //echo $form->error($model,'branch_id'); ?>
	</div>
<div style="clear:left"></div>
	<div class="row" style="float:left; margin-left:5px;">
    	<?php $user_id = yii::app()->user->id;?>
		<?php //echo $form->labelEx($model,'user_id'); ?>
        <?php echo $form->hiddenField($model,'user_id',array('value'=>$user_id)); ?>
		<?php //echo $form->error($model,'user_id'); ?>
	</div>
<div style="clear:left"></div>
	<div class="">
		<?php //echo CHtml::submitButton($model->isNewRecord ? ' Create ' : 'Save', array('class'=>'btn btn-primary')); 
		  
  $this->widget("zii.widgets.jui.CJuiButton",array(
  "name"=>"button",
  "caption"=>$model->isNewRecord ? 'Create' : 'Save',
  "value"=>"asd",
  "htmlOptions"=>array("style"=>"")
  //color:#ffffff;background:#000;width:150px;height:40px;font-size:16px
  )
  );
		
		?>
      
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
<!--<input type="button" class="btn-primary" value=" sdfsdf " />-->
<script>
$("#Company_comp_name").css('width','270px'); //
$("#Company_comp_address").css('width','270px');
$("#Company_comp_email").css('width','270px');
</script>