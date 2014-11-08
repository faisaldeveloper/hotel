<div class="form">



<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'hms-branches-form',

	'enableAjaxValidation'=>false,

)); ?>



	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary($model); ?>

    

    

    <fieldset>

    <legend class="mcelegend" style="color:#900;">Hotel Branch Information:</legend>

    <table width="620" height="116">

 

      <tr>

        <td><table width="720" class="mcetable">

          <tr class="mcetr">

            <td width="256"><span class="row"><?php echo $form->labelEx($model,'Select Hotel'); ?></span></td>

            <td width="187"><span class="row">

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

		?> <?php echo $form->error($model,'hotel_id'); ?> </span></td>

            <td width="65">&nbsp;</td>

            <td width="192">&nbsp;</td>

          </tr>

          <tr class="mcetr">

            <td><span class="row"><?php echo $form->labelEx($model,'branch_phone'); ?></span></td>

            <td><span class="row"><?php echo $form->textField($model,'branch_phone'); ?> <?php echo $form->error($model,'branch_phone'); ?> </span></td>

            <td rowspan="2"><span class="row"><?php echo $form->labelEx($model,'branch_address'); ?></span></td>

            <td rowspan="2"><span class="row">

              <?php //echo $form->textField($model,'branch_address',array('size'=>50,'maxlength'=>50)); ?>

              <?php echo $form->textArea($model, 'branch_address', array('maxlength' => 225, 'rows' => 3, 'cols' => 30)); ?> <?php echo $form->error($model,'branch_address'); ?> </span></td>

          </tr>

          <tr class="mcetr">

            <td><span class="row"><?php echo $form->labelEx($model,'branch_fax'); ?></span></td>

            <td><span class="row"><?php echo $form->textField($model,'branch_fax'); ?> <?php echo $form->error($model,'branch_fax'); ?> </span></td>

            </tr>

          <tr class="mcetr">

            <td><span class="row"><?php echo $form->labelEx($model,'branch_email'); ?></span></td>

            <td><span class="row"><?php echo $form->textField($model,'branch_email',array('size'=>30,'maxlength'=>50)); ?> <?php echo $form->error($model,'branch_email'); ?> </span></td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

          </tr>

          <tr class="mcetr">

            <td><span class="row"><?php echo $form->labelEx($model,'active_date'); ?></span></td>

            <td><span class="row">

              <?php //echo $form->textField($model,'active_date'); 

		$this->widget('zii.widgets.jui.CJuiDatePicker', array(

    

    'name'=>'HmsBranches[active_date]',

    //'id'=>'user_Birthdate',

    'model'=>$model,

    

    // additional javascript options for the date picker plugin

    'options'=>array(

        'showAnim'=>'fold',

		'dateFormat'=>'yy-mm-dd',

    ),

    'htmlOptions'=>array(

        'style'=>'height:20px;',



    ),

));

		?>

              <?php echo $form->error($model,'active_date'); ?> </span></td>

            <td><span class="row"><?php echo $form->labelEx($model,'expiry_date'); ?></span></td>

            <td><span class="row">

            <?php //echo $form->textField($model,'expiry_date'); 

		$this->widget('zii.widgets.jui.CJuiDatePicker', array(

    

    'name'=>'HmsBranches[expiry_date]',

    //'id'=>'user_Birthdate',

    'model'=>$model,

    

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

            <?php echo $form->error($model,'expiry_date'); ?> </span></td>

          </tr>

        </table></td>

      </tr>

    </table>

</fieldset>



	<div class="row"></div>



	<div class="row"></div>



	<div class="row"></div>



	<div class="row"></div>





<div class="row"></div>



	<div class="row"></div>



	<div class="row"></div>



	<div class="row buttons">

		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

	</div>



<?php $this->endWidget(); ?>



</div><!-- form -->