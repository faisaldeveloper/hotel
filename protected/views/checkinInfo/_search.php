<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'chkin_id'); ?>
		<?php //echo $form->textField($model,'chkin_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'guest_id'); ?>
		<?php //echo $form->textField($model,'guest_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'reservation_id'); ?>
		<?php //echo $form->textField($model,'reservation_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chkin_date'); ?>
		<?php //echo $form->textField($model,'chkin_date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    
    'name'=>'CheckinInfo[chkin_date]',
    //'id'=>'user_Birthdate',
    'model'=>$model,
	'attribute'=>'chkin_date',
    
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
	</div>

	<div class="row">
		<?php echo $form->label($model,'chkout_date'); ?>
		<?php //echo $form->textField($model,'chkout_date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    
    'name'=>'CheckinInfo[chkout_date]',
    //'id'=>'user_Birthdate',
    'model'=>$model,
	'attribute'=>'chkout_date',
    
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
	</div>

	<div class="row">
		<?php //echo $form->label($model,'chkin_time'); ?>
		<?php //echo $form->textField($model,'chkin_time'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'chkout_time'); ?>
		<?php //echo $form->textField($model,'chkout_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drop_service'); ?>
		<?php //echo $form->textField($model,'drop_service',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->checkBox($model,'drop_service',array('value' => 'Y', 'uncheckValue'=>'N'))?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'flight_name'); ?>
		<?php //echo $form->textField($model,'flight_name',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'flight_time'); ?>
		<?php //echo $form->textField($model,'flight_time'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'total_days'); ?>
		<?php //echo $form->textField($model,'total_days'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'room_id'); ?>
		<?php //echo $form->textField($model,'room_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'room_type'); ?>
		<?php //echo $form->textField($model,'room_type',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'room_name'); ?>
		<?php echo $form->textField($model,'room_name',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'guest_company_id'); ?>
		<?php //echo $form->textField($model,'guest_company_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'rate_type'); ?>
		<?php //echo $form->textField($model,'rate_type'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'total_person'); ?>
		<?php //echo $form->textField($model,'total_person'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'total_charges'); ?>
		<?php //echo $form->textField($model,'total_charges'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'amount_paid'); ?>
		<?php //echo $form->textField($model,'amount_paid'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'chkout_status'); ?>
		<?php //echo $form->textField($model,'chkout_status',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'chkin_user_id'); ?>
		<?php //echo $form->textField($model,'chkin_user_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'chkout_user_id'); ?>
		<?php //echo $form->textField($model,'chkout_user_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'guest_status_id'); ?>
		<?php //echo $form->textField($model,'guest_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chkin_id'); ?>
		<?php echo $form->textField($model,'chkin_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'sale_person_id'); ?>
		<?php //echo $form->textField($model,'sale_person_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'comming_from'); ?>
		<?php //echo $form->textField($model,'comming_from',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'next_destination'); ?>
		<?php //echo $form->textField($model,'next_destination',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'newspaper_id'); ?>
		<?php //echo $form->textField($model,'newspaper_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rate'); ?>
		<?php echo $form->textField($model,'rate'); ?>
	</div>

	
	<div class="row">
		<?php //echo $form->label($model,'gst'); ?>
		<?php //echo $form->textField($model,'gst',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'bed_tax'); ?>
		<?php //echo $form->textField($model,'bed_tax',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'branch_id'); ?>
		<?php //echo $form->textField($model,'branch_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->