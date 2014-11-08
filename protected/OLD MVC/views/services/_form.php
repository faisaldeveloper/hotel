<?php
$col_names = array(); $i=0; $cols = array();
		$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'hotel' AND TABLE_NAME = 'hms_guest_ledger'";
		$result = Yii::app()->db->createCommand($sql)->query();		
		foreach($result as $key => $value){ array_push($col_names, $value['COLUMN_NAME']); $i++;	}
		foreach($col_names as $key => $value){
			$cols[$value] = $value;
		}
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'services-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary($model); ?>
    
    <div class="row">
		<?php echo $form->labelEx($model,'service_code'); ?>
		<?php echo $form->textField($model,'service_code',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'service_code'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'service_description'); ?>
		<?php echo $form->textField($model,'service_description',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'service_description'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'servise_type'); ?>
		<?php //echo $form->textField($model,'servise_type'); 	?>
        <?php echo $form->radioButtonList($model,'servise_type',array(
                            'Dr'=>'Debit',
                            'Cr'=>'Credit',
                            
                    ),array(
                        'separator'=>'&nbsp;',
                        'labelOptions'=>array('style'=>'display: inline; margin-right: 10px; font-weight: normal;'),
                )); ?>
		<?php echo $form->error($model,'servise_type'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'service_rate'); ?>
		<?php echo $form->textField($model,'service_rate'); ?>
		<?php echo $form->error($model,'service_rate'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'order_by'); ?>
		<?php //echo $form->textField($model,'order_by');
		echo $form->dropDownList($model,'order_by', $cols); 
		 ?>
		<?php echo $form->error($model,'order_by'); ?>
	</div>
    
    
	<div class="row">
		<?php $hotel_branch_id = yii::app()->user->branch_id;?>
		<?php //echo $form->labelEx($model,'branch_id'); ?>
		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>
		<?php echo $form->error($model,'branch_id'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->