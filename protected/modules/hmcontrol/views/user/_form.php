<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hotel_id'); ?>
		<?php //echo $form->textField($model,'hotel_id'); ?>
		<?php echo $form->dropDownList($model,'hotel_id', CHtml::listData(HotelTitle::model()->findAll(), 'id', 'title'),array('prompt'=>'Select Hotel',
		 'onchange' => CHtml::ajax(
						array(
							'type' => 'POST',
							'url' => CController::createUrl('User/dynamicBranch'),
							
							//'beforeSend' => 'function(){ $("#city_loader").addClass("loading"); }',
    	//'complete' => 'function(data){alert(data); }',
		//'update'=>'#GuestInfo_guest_address', //selector to update //get id method
		'error'=>'function(xhr, ajaxOptions, thrownError){alert(xhr.status+\'--\'+thrownError); }',
							
							'update' => '#' . CHtml::activeId($model, 'hotel_branch_id')
						)
				)
		
		//'ajax' => array(
		//'type'=>'POST', //request type
		//'url'=>CController::createUrl('HotelTitle/dynamiccities'), //url to call.
		//Style: CController::createUrl('currentController/methodToCall')
		//'update'=>'#hotel_id', //selector to update
		//'data'=>'js:javascript statement' 
		//leave out the data key to pass all form values through
		//)
		)); 
		?>
        
		 <?php
			/* echo
			$form->dropDownList(
					$model, 'hotel_id', DropdownHelper::getOptionAll(
							'HotelTitle', 'id', 'title'
					), array(
				'prompt' => '-Select Hotel-',
				'onchange' => CHtml::ajax(
						array(
							'type' => 'POST',
							'url' => CController::createUrl('dynamicBranch'),
							'update' => '#' . CHtml::activeId($model, 'HmsBranches')
						)
				)
					)
			); */
    	?>

        
		<?php echo $form->error($model,'hotel_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hotel_branch_id'); ?>
		<?php //echo $form->textField($model,'hotel_branch_id'); ?>
        
        <?php
			echo
			$form->dropDownList(
					$model, 'hotel_branch_id', array() /* array(
				'onchange' => CHtml::ajax(
						array(
							'type' => 'POST',
							//'url' => CController::createUrl('dynamicArea'),
							//'update' => '#' . CHtml::activeId($model, 'area')
						)
				)
					) */
			);
    ?>
        
		<?php echo $form->error($model,'hotel_branch_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

