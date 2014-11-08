<div class="form">



<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'exchange-rate-form',

	'enableAjaxValidation'=>false,

)); ?>



	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary($model); ?>



	<div class="row">

		<?php //echo $form->labelEx($model,'country_id'); ?>

		<?php //echo $form->textField($model,'country_id'); ?>

         <?php //echo $form->dropDownList($model,'country_id', CHtml::listData(Country::model()->findAll(), 'country_id', 

		//'country_name'),array('prompt'=>'Select Country')); 

		?>

        

        

        <?php echo $form->dropDownList($model,'country_id', CHtml::listData(Country::model()->findAll(), 'country_id', 

		'country_name'),array('prompt'=>'Select Country',

		)); 

		

		///

		//'success'=>"function(data){

			//var obj=$.parseJSON(data);

			

			//$('#ExchangeRate_sign').val(obj.name);

			//}",

		//'data'=>'js:javascript statement' 

		//leave out the data key to pass all form values through

		//)));

		////

		

		?>

		<?php echo $form->error($model,'country_id'); ?>

	</div>

    

    <div class="row">

		<?php echo $form->labelEx($model,'sign'); ?>

		<?php echo $form->textField($model,'sign'); ?>

		<?php echo $form->error($model,'sign'); ?>

	</div>



	<div class="row">

		<?php echo $form->labelEx($model,'exchabge_rate'); ?>

		<?php echo $form->textField($model,'exchabge_rate'); ?>

		<?php echo $form->error($model,'exchabge_rate'); ?>

	</div>



	<div class="row">

		<?php $hotel_branch_id = yii::app()->user->branch_id;?>

		<?php //echo $form->labelEx($model,'branch_id'); ?>

		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>

		<?php echo $form->error($model,'branch_id'); ?>

	</div>



	<div class="row">

    	<?php $user_id = yii::app()->user->id;?>

		<?php //echo $form->labelEx($model,'user_id'); ?>

		<?php //echo $form->textField($model,'user_id'); ?>

        <?php echo $form->hiddenField($model,'user_id',array('value'=>$user_id)); ?>

		<?php echo $form->error($model,'user_id'); ?>

	</div>



	<div class="row buttons">

		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

	</div>



<?php $this->endWidget(); ?>



</div><!-- form -->