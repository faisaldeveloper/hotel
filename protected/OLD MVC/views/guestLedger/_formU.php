<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'guest-ledger-form',
	'enableAjaxValidation'=>false,
)); ?>
	
	<?php echo $form->errorSummary($model);
	
	//echo "---".$model->chkin_date; ?>
	
		<?php echo $form->hiddenField($model,'chkin_id'); ?>
		<?php echo $form->hiddenField($model,'guest_name',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->hiddenField($model,'room_status',array('size'=>2,'maxlength'=>2,'value'=>'O')); ?>
		<?php echo $form->hiddenField($model,'room_id'); ?>
		<?php echo $form->hiddenField($model,'chkin_date'); ?>
		<?php echo $form->hiddenField($model,'chkout_date'); ?>	
		<?php // echo $form->hiddenField($model,'c_date',array('value'=>date('Y-m-d H:i:s'))); ?>		
		<?php echo $form->hiddenField($model,'c_time',array('value'=>date('H:m a'))); ?>		
	<div class="row">
		<?php echo $form->labelEx($model,'service_id'); ?>
        <?php //echo $form->hiddenField($model,'service_id'); 
		 echo $form->dropDownList($model,'service_id', CHtml::listData(Services::model()->findAll(array('order'=>'service_description')), 'service_id', 'service_description'),
		 array('prompt'=>'Select Service','class'=>'chzn-select')
		 );
		?>
        <?php //echo $form->textField($model,'service_name',array('disabled'=>'disabled')); ?>		
		<?php $form->error($model,'service_id'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'debit'); ?>
		<?php echo $form->textField($model,'debit'); ?>
		<?php $form->error($model,'debit'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textField($model,'remarks',array('size'=>15,'maxlength'=>30)); ?>
		<?php $form->error($model,'remarks'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'c_date'); ?>
		<?php 
		$list = array();
		$branch_id = yii::app()->user->branch_id;	
		$active_date = Yii::app()->db->createCommand("select active_date FROM day_end WHERE branch_id = $branch_id")->queryScalar();
		$yesterday = date("Y-m-d",strtotime('-1 day',strtotime($active_date)));
		$day_b4_yesterday = date("Y-m-d",strtotime('-2 day',strtotime($active_date)));
		$time = date("H:i:s", time());
		
		$list[$active_date." ". $time] = "Today";
		$list[$yesterday." ". $time] = "yesterday";
		$list[$day_b4_yesterday." ". $time] = "day_b4_yesterday";
		 
		 //echo $form->dropDownList($model,'c_date', $list);		 
		 ?>
         <?php 	
	 		$this->widget('zii.widgets.jui.CJuiDatePicker', array(    
					'name'=>'GuestLedger[c_date]',					
					'attribute'=>'c_date',
					'model'=>$model,    
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',						
						'dateFormat'=>'dd-mm-yy',
					),
					'htmlOptions'=>array( 
					'class'=>'hasDatepicker3',
					'style'=>'height:25px;',
					//'value'=>$model->c_date,
					),
				));		
			?>			
         
		<?php $form->error($model,'c_date'); ?>
	</div>
    
	
		<?php echo $form->hiddenField($model,'credit',array('value'=>'0')); ?>		
		<?php echo $form->hiddenField($model,'balance',array('value'=>'0')); ?>		
		<?php echo $form->hiddenField($model,'cash_paid',array('value'=>'0')); ?>		
		<?php echo $form->hiddenField($model,'credit_card',array('size'=>2,'maxlength'=>2,'value'=>'0')); ?>		
		<?php echo $form->hiddenField($model,'credit_card_no',array('value'=>'0')); ?>		
		<?php // echo $form->hiddenField($model,'btc',array('size'=>2,'maxlength'=>2,'value'=>'0')); ?>		
		<?php echo $form->hiddenField($model,'company_id'); ?>		
		<?php $user_id = yii::app()->user->id;?>		
        <?php echo $form->hiddenField($model,'user_id',array('value'=>$user_id)); ?>	
		<?php $hotel_branch_id = yii::app()->user->branch_id;?>		
		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->