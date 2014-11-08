<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hotel-title-form',
	'enableAjaxValidation'=>false,
	//=========================== Required for upload files
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	//=========================================================
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'application_title'); ?>
		<?php echo $form->textField($model,'application_title',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'application_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'logo_image'); ?>
		<?php //echo $form->textField($model,'logo_image',array('size'=>60,'maxlength'=>150)); ?>
		<?php
            $this->widget('CMultiFileUpload', array(
            'model'=>$model,
            "attribute"=>"logo_image",
            'name' => "HotelTitle[logo_image][]",
            'accept'=>'jpg|gif|png',
            'max' => 1,            
            'options'=>array(
            "onFileSelect"=>"function(e, v, m){            
            }",            
            'afterFileAppend'=>"function(e, v, m){
            var min_val = $('#min').val();
            min_val = parseInt(min_val);
            min_val = min_val+1;
            $('#min').val(min_val);
            }",
            "onFileRemove"=>"function(e, v, m){
            var min_val = $('#min').val();
            min_val = parseInt(min_val);
            min_val = min_val-1;
            $('#min').val(min_val);
            }",
            
            //'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
            ),
            //'htmlOptions' => array('style'=>'width:85px','size'=>1),
            
            ));
		?>
		
		<?php echo $form->error($model,'logo_image'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'bg_image'); ?>
		<?php //echo $form->textField($model,'bg_image',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'bg_image'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiButton',
			array(
			'name'=>'button',
			'caption'=>$model->isNewRecord ? 'Create' : 'Save',
			'value'=>'asd',
			"onclick"=>"js:function(){
			
			var req=0;
			
			var val = $('#min').val();
			val = parseInt(val);
			
			$('#HotelTitle_logo_image').css({border:'1px solid #C6D880'});
			$('#HotelTitle_logo_image').css({background:'#E6EFC2'});
			$('#file_error').html('');
			if(val==0){
			$('#HotelTitle_logo_image').css({border:'1px solid #C00'});
			$('#HotelTitle_logo_image').css({background:'#FEE'});
			
			$('#file_error').html('Logo is Required');
			req=1;
			}
			
			if(req==1){
			return false;
			}
			
			}",
			/*"htmlOptions"=>array("style"=>"color:#ffffff;width:150px;height:40px;font-size:16px")*/
			)
			);

		
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->