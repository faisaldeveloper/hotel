<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hms-branches-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'hotel_id'); ?>
		<?php //echo $form->textField($model,'hotel_id'); ?>
		
		<?php echo $form->dropDownList($model,'hotel_id', CHtml::listData(HotelTitle::model()->findAll(), 'id', 'title'),array('prompt'=>'Select Hotel',
		'ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('HotelTitle/dynamiccities'), //url to call.
		//Style: CController::createUrl('currentController/methodToCall')
		'update'=>'#hotel_id', //selector to update
		//'data'=>'js:javascript statement' 
		//leave out the data key to pass all form values through
		))); 
		?>
		<?php echo $form->error($model,'hotel_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'branch_address',array('size'=>50,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'branch_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'branch_phone'); ?>
		<?php echo $form->error($model,'branch_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'branch_fax'); ?>
		<?php echo $form->textField($model,'branch_fax'); ?>
		<?php echo $form->error($model,'branch_fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'branch_email'); ?>
		<?php echo $form->textField($model,'branch_email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'branch_email'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'room_limit'); ?>
		<?php //echo $form->textField($model,'room_limit',array('size'=>50,'maxlength'=>50));
			if($model->isNewRecord) { $limit_arr = array('empty'=>'Select Limit', '5'=>'5', '10'=>'10', '20'=>'20', '50'=>'50', '100'=>'100'); }
			else  { $limit_arr = array('5'=>$model->room_limit);} 
		 ?>
        <?php	echo $form->dropDownList($model, 'room_limit', $limit_arr); 
		
		?>        
		<?php echo $form->error($model,'room_limit'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'active_date'); ?>
		<?php //echo $form->textField($model,'active_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(    
						'name'=>'HmsBranches[active_date]',
						//'id'=>'user_Birthdate',
						'model'=>$model,
						'attribute'=>'active_date',
						
						// additional javascript options for the date picker plugin
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat'=>'yy-mm-dd',
							'changeYear'=> true,
							'changeMonth'=> true,
						),
						'htmlOptions'=>array(
							'style'=>'height:20px;',
									
					),
					));

				?>
		
		<?php echo $form->error($model,'active_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expiry_date'); ?>
		<?php //echo $form->textField($model,'expiry_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(    
						'name'=>'HmsBranches[expiry_date]',
						//'id'=>'user_Birthdate',
						'model'=>$model,
						'attribute'=>'expiry_date',
						
						// additional javascript options for the date picker plugin
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat'=>'yy-mm-dd',
							'changeYear'=> true,
							'changeMonth'=> true,
						),
						'htmlOptions'=>array(
							'style'=>'height:20px;',
									
					),
					));

				?>
		
		<?php echo $form->error($model,'expiry_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->