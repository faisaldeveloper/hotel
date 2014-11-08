<div class="form">



<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'room-type-rate-form',

	'enableAjaxValidation'=>false,

)); ?>



	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary($model); ?>



	



	





<table border="0">

  <tr>



  	<td>Sr:</td>

    <td><strong>Room Type</strong></td>

    <td><strong>Rate</strong></td>

    <td><strong>G.S.T</strong></td>

  </tr>

  <?php foreach($model as $i=>$item){ 

  

  $j++;

  

  ?>

  <tr>



  	<td><?php echo $j;?></td>

    <td>

	<?php echo $model[$i]->label; ?>

	<?php echo $form->labelEx($model[$i],"[$i]room_rate"); ?>

    </td>

    <td>

    <div class="row">

    <?php echo $form->textField($model[$i],"[$i]room_rate",array('size'=>20,'maxlength'=>20)); ?>

	<?php echo $form->error($model[$i],"[$i]room_rate"); ?>

    </div>

    </td>

    <td>

    <div class="row">

	<?php //echo $form->labelEx($model[$i],"[$i]comp_allow_gst"); ?>

	<?php echo $form->checkBox($model[$i], "[$i]comp_allow_gst"); ?>

    </div>

    </td>

  </tr>

  <?php } ?>

</table>





<div class="row">

		<?php //echo $model[$i]->label; ?>

		<?php //echo $form->labelEx($model[$i],"[$i]room_rate"); ?>

		<?php //echo $form->textField($model[$i],"[$i]room_rate",array('size'=>20,'maxlength'=>20)); ?>

		<?php //echo $form->error($model[$i],"[$i]room_rate"); ?>

</div>

	<div class="row">

		

		<?php //echo $form->labelEx($model[$i],"[$i]comp_allow_gst"); ?>

		<?php //echo $form->checkBox($model[$i], "[$i]comp_allow_gst"); ?>

		

	</div>









	

	<div class="row buttons">

		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

	</div>



<?php $this->endWidget(); ?>



</div><!-- form -->