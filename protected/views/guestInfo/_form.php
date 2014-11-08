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
select{
	width:125px;
}

::-webkit-input-placeholder {
   color: red;
}

:-moz-placeholder { /* Firefox 18- */
   color: red;  
}

::-moz-placeholder {  /* Firefox 19+ */
   color: red;  
}

:-ms-input-placeholder {  
   color: red;  
}
	
</style>

<div class="form">
<?php $hotel_branch_id = yii::app()->user->branch_id ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'guest-info-form',
	'enableAjaxValidation'=>true,
)); 



$hotel_branch_id = yii::app()->user->branch_id;
$user_id = yii::app()->user->id;
?>

	<?php //echo $form->errorSummary($model); ?>
	
	<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>    	
	<?php echo $form->hiddenField($model,'user_id',array('value'=>$user_id)); ?> 
	<?php //echo $form->hiddenField($model,'guest_identity_id',array('value'=>1)); ?>
 <fieldset>
    <legend class="mcelegend" style="color:#900;">Guest Information :</legend>   
 
    
     <div class="row" style="float:left; margin-left:5px;">    
		<?php echo $form->labelEx($model,'guest_salutation_id'); ?>	
		<?php echo $form->dropDownList($model,'guest_salutation_id', CHtml::listData(Salutation::model()->findAll(), 'salutation_id', 
		'salutation_name')); 	?>
		<?php //echo $form->error($model,'guest_salutation_id'); ?>
	 </div>
     
      <div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'guest_name'); ?>
		<?php echo $form->textField($model,'guest_name',array('size'=>30,'maxlength'=>50)); ?>		
		<?php //echo $form->error($model,'guest_name'); ?>
         </div>
     
      <div class="row" style="float:left; margin-left:5px;">
      <?php echo $form->labelEx($model,'guest_country_id'); ?>		
            <?php echo $form->dropDownList($model,'guest_country_id', CHtml::listData(Country::model()->findAll(), 'country_id', 
		'country_name'));	?>      
		<?php //echo $form->labelEx($model,'guest_gender'); ?>		
        <?php //$model->guest_gender='M'; ?>
		<?php /*  echo $form->radioButtonList($model,'guest_gender',array(
                            'M'=>'Male',
                            'F'=>'Female',                            
                    ),array(
                        'separator'=>'&nbsp;',
                        'labelOptions'=>array('style'=>'display: inline; margin-right: 10px; font-weight: normal;'),
                ));  */?>
		<?php ////echo $form->error($model,'guest_gender'); ?>
        </div>
     
     <div style="clear:left"></div>
     
      <div class="row" style="float:left; margin-left:5px;">
        
        <?php echo $form->labelEx($model,'guest_dob'); ?>		
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(    
			'name'=>'GuestInfo[guest_dob]',
			//'id'=>'user_Birthdate',
			'model'=>$model,
			'attribute'=>'guest_dob',   
			// additional javascript options for the date picker plugin
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat'=>'dd-mm-yy',
			),
			'htmlOptions'=>array( 'style'=>'height:15px;',
    ),
));

?>
		<?php //echo $form->error($model,'guest_dob'); ?>       
	 </div>     
     
      <div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'guest_address'); ?>		
		<?php echo $form->textArea($model, 'guest_address', array('maxlength' => 50, 'rows' => 1, 'cols' => 30)); ?>
		<?php //echo $form->error($model,'guest_address'); ?>
	 </div>
     
      <div class="row" style="float:left; margin-left:5px;">    	 
        <?php echo $form->labelEx($model,'guest_phone'); ?>
		<?php echo $form->textField($model,'guest_phone'); ?>
		<?php //echo $form->error($model,'guest_phone'); ?>
      </div>
      
       <div style="clear:left"></div>
     
      <div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'guest_mobile'); ?>
		<?php echo $form->textField($model,'guest_mobile', array('maxlength' => 12)); ?>
		<?php //echo $form->error($model,'guest_mobile'); ?>
	  </div>     
     
      <div class="row" style="float:left; margin-left:5px;">
    	<?php echo $form->labelEx($model,'guest_email'); ?>
		<?php echo $form->textField($model,'guest_email',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'guest_email'); ?>
         </div>
     
      <div class="row" style="float:left; margin-left:5px;">
		  
	 </div>     
	
	</fieldset>
    
    
    
    
  <fieldset><legend class="mcelegend" style="color:#900;">Other Info</legend> 
 
      <div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'id_docs'); ?>		
        <?php echo $form->dropDownList($model,'guest_identity_id', CHtml::listData(Identity::model()->findAll(), 'identity_id', 
		'identity_description')); 	?>        
		<?php //echo $form->error($model,'guest_identity_id'); ?>
	 </div>
     
      <div class="row" style="float:left; margin-left:5px;">     
		<?php echo $form->labelEx($model,'guest_identity_no'); ?>
		<?php echo $form->textField($model,'guest_identity_no'); ?>
		<?php //echo $form->error($model,'guest_identity_no'); ?>
		</div>
     
      <div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'issue_date'); ?>		
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(    
				'name'=>'GuestInfo[guest_identity_issu]',
				//'id'=>'user_Birthdate',
				'model'=>$model,
				'attribute'=>'guest_identity_issu',				
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=>'dd-mm-yy',
					'changeYear'=> true,
					'changeMonth'=> true,
				),
				'htmlOptions'=>array( 'style'=>'height:15px;',			
				),
			));
		?>        
		<?php //echo $form->error($model,'guest_identity_issu'); ?>
	 </div>
     
      <div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'expiry_date'); ?>		
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(    
				'name'=>'GuestInfo[guest_identiy_expire]',
				//'id'=>'user_Birthdate',
				'model'=>$model,
				'attribute'=>'guest_identiy_expire',
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=>'dd-mm-yy',
				),
				'htmlOptions'=>array( 'style'=>'height:15px;',			
				),
			));
		?>
		<?php //echo $form->error($model,'guest_identiy_expire'); ?>
		</div>
        
         <div style="clear:left"></div>
     
      <div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'guest_company_id'); ?>		
         <?php 
		  $con = array("condition"=>"branch_id=$hotel_branch_id", "order"=>"comp_name");
		 echo $form->dropDownList($model,'guest_company_id', CHtml::listData(Company::model()->findAll($con), 'comp_id', 'comp_name'),array(
		// 'options' => array('1'=>array('selected'=>true)),
		 'empty'=>'Select Company'));		?>
		<?php //echo $form->error($model,'guest_company_id'); ?>
		</div>
     
      <div class="row" style="float:left; margin-left:5px;">
		<?php echo $form->labelEx($model,'guest_remarks'); ?>
		<?php echo $form->textField($model,'guest_remarks',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'guest_remarks'); ?>        
	</div>     
     
</fieldset>




	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); 
		$this->widget("zii.widgets.jui.CJuiButton",array(
		  "name"=>"button",
		  "caption"=>$model->isNewRecord ? 'Create Guest' : 'Save',
		  "value"=>"asd",
		  "htmlOptions"=>array("style"=>"")
  //color:#ffffff;background:#000;width:150px;height:40px;font-size:16px
  )  );	
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->