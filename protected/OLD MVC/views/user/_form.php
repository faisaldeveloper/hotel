<div class="form">



<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'user-form',

	'enableAjaxValidation'=>false,

)); ?>



	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
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



	<!--<div class="row">

    	<?php //$hotel_id = yii::app()->user->hotel_id; ?>

		<?php //echo $form->labelEx($model,'hotel_id'); ?>

		<?php //echo $form->hiddenField($model,'hotel_id',array('value'=>$hotel_id)); ?>

		<?php //echo $form->error($model,'hotel_id'); ?>        

	</div>-->

    

    	<div class="row">

		<?php echo $form->labelEx($model,'Select Hotel'); ?>

		<?php //echo $form->textField($model,'hotel_branch_id'); ?>

      <?php echo $form->dropDownList($model,'hotel_id', CHtml::listData(HotelTitle::model()->findAll(), 'id', 'title'));?>

		<?php echo $form->error($model,'hotel_branch_id'); ?>

	</div>

    

    <div class="row">

    	<?php $hotel_branch_id = yii::app()->user->branch_id;?>

		<?php //echo $form->labelEx($model,'hotel_branch_id'); ?>

		<?php //echo $form->hiddenField($model,'hotel_branch_id',array('value'=>$hotel_branch_id)); ?>

		<?php //echo $form->error($model,'hotel_branch_id'); ?>

    </div>

            

    

    	<div class="row">

		<?php echo $form->labelEx($model,'Select Branch'); ?>

		<?php //echo $form->textField($model,'hotel_branch_id'); ?>

      <?php echo $form->dropDownList($model,'hotel_branch_id', CHtml::listData(HmsBranches::model()->findAll(), 'branch_id', 'branch_address'));?>

		<?php echo $form->error($model,'hotel_branch_id'); ?>

	</div>

    

	



	<div class="row buttons">

		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

	</div>



<?php $this->endWidget(); ?>



</div><!-- form -->