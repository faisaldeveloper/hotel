<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'reservation_id'); ?>
		<?php echo $form->textField($model,'reservation_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'res_type'); ?>
		<?php //echo $form->textField($model,'res_type',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'group_name'); ?>
		<?php echo $form->textField($model,'group_name',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_id'); ?>
		<?php //echo $form->textField($model,'company_id'); ?>
        <?php echo $form->dropDownList($model,'company_id', CHtml::listData(Company::model()->findAll(), 'comp_id', 
		'comp_name'),array(
		'prompt'=>'Select Company'));?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'to_person'); ?>
		<?php //echo $form->textField($model,'to_person',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'designation'); ?>
		<?php //echo $form->textField($model,'designation',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chkin_date'); ?>
		<?php echo $form->textField($model,'chkin_date'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'chkin_time'); ?>
		<?php //echo $form->textField($model,'chkin_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chkout_date'); ?>
		<?php //echo $form->textField($model,'chkout_date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    
    'name'=>'ReservationInfo[chkout_date]',
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
		<?php //echo $form->label($model,'chkout_time'); ?>
		<?php //echo $form->textField($model,'chkout_time'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'c_date'); ?>
		<?php //echo $form->textField($model,'c_date'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'total_days'); ?>
		<?php //echo $form->textField($model,'total_days'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pick_service'); ?>
		<?php //echo $form->textField($model,'pick_service',array('size'=>2,'maxlength'=>2)); ?>
        <?php echo $form->checkBox($model,'pick_service',array('value' => 'Y', 'uncheckValue'=>'N'));?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'flight_name'); ?>
		<?php //echo $form->textField($model,'flight_name',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'flight_time'); ?>
		<?php //echo $form->textField($model,'flight_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drop_service'); ?>
		<?php //echo $form->textField($model,'drop_service',array('size'=>2,'maxlength'=>2)); ?>
        <?php echo $form->checkBox($model,'drop_service',array('value' => 'Y', 'uncheckValue'=>'N'));?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'drop_flight_name'); ?>
		<?php //echo $form->textField($model,'drop_flight_name',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'drop_flight_time'); ?>
		<?php //echo $form->textField($model,'drop_flight_time'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'client_salutation_id'); ?>
		<?php //echo $form->textField($model,'client_salutation_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'client_name'); ?>
		<?php echo $form->textField($model,'client_name',array('size'=>30,'maxlength'=>30)); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'client_address'); ?>
		<?php echo $form->textField($model,'client_address',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'client_country_id'); ?>
		<?php //echo $form->textField($model,'client_country_id'); ?>
        <?php echo $form->dropDownList($model,'client_country_id', CHtml::listData(Country::model()->findAll(), 'country_id','country_name'),array('prompt'=>'Select Country')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'client_mobile'); ?>
		<?php echo $form->textField($model,'client_mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'client_phone'); ?>
		<?php echo $form->textField($model,'client_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'client_email'); ?>
		<?php echo $form->textField($model,'client_email',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'client_identity_id'); ?>
		<?php //echo $form->textField($model,'client_identity_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'client_identity_no'); ?>
		<?php echo $form->textField($model,'client_identity_no'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'reservation_status'); ?>
		<?php //echo $form->textField($model,'reservation_status'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'cancel_status'); ?>
		<?php //echo $form->textField($model,'cancel_status',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'cancel_date'); ?>
		<?php //echo $form->textField($model,'cancel_date'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'cancel_reason'); ?>
		<?php //echo $form->textField($model,'cancel_reason',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'cancel_time'); ?>
		<?php //echo $form->textField($model,'cancel_time'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'cancel_by'); ?>
		<?php //echo $form->textField($model,'cancel_by'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'chkin_status'); ?>
		<?php //echo $form->textField($model,'chkin_status',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'noshow_status'); ?>
		<?php //echo $form->textField($model,'noshow_status',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'client_remarks'); ?>
		<?php //echo $form->textField($model,'client_remarks',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'room_charges'); ?>
		<?php //echo $form->textField($model,'room_charges'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'discount'); ?>
		<?php //echo $form->textField($model,'discount'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'gst'); ?>
		<?php //echo $form->textField($model,'gst',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'advance'); ?>
		<?php //echo $form->textField($model,'advance'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'user_id'); ?>
		<?php //echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'sale_person_id'); ?>
		<?php //echo $form->textField($model,'sale_person_id'); ?>
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