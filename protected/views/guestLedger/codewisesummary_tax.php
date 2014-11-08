<?php

$this->breadcrumbs=array('Account Ledgers'=>array('index'),	$model->id,);





?>



<h1><?php echo Yii::t('views','Code-wise Summary') ?> </h1>



<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'codewise-form',

	'enableAjaxValidation'=>false,

	//'htmlOptions'=>array('target'=>'_blank'),

)); ?>



	

    <fieldset>

    <legend><h2> <?php echo Yii::t('views','Select Date Range') ?> </h2></legend>

    <br />

    <div class="row">

		<?php echo $form->labelEx($model,'from_date'); ?>

		<?php

			$this->widget('zii.widgets.jui.CJuiDatePicker', array(    

					'name'=>'GuestLedger[from_date]',					

					'attribute'=>'from_date',

					'model'=>$model,    

					// additional javascript options for the date picker plugin

					'options'=>array(

						'showAnim'=>'fold',						

						'dateFormat'=>'dd-mm-yy',

					),

					'htmlOptions'=>array( 

					'class'=>'hasDatepicker3',

					'style'=>'height:15px;',					

					),

				));	

		?>

		<?php echo $form->error($model,'from_date'); ?>

	

		<?php echo $form->labelEx($model,'to_date'); ?>

		<?php

			$this->widget('zii.widgets.jui.CJuiDatePicker', array(    

					'name'=>'GuestLedger[to_date]',					

					'attribute'=>'to_date',

					'model'=>$model,    

					// additional javascript options for the date picker plugin

					'options'=>array(

						'showAnim'=>'fold',						

						'dateFormat'=>'dd-mm-yy',

					),

					'htmlOptions'=>array( 

					'class'=>'hasDatepicker3',

					'style'=>'height:15px;',					

					),

				));	

		?>

		<?php echo $form->error($model,'to_date'); ?>

	</div>

    

    <div class="row"> <br />  </div>

	

    <div class="row buttons">

		<?php echo CHtml::submitButton($model->isNewRecord ? ' OK ' : 'Save', array('id'=>'btn_submit')); ?>

	</div>

    

    </fieldset>



<?php $this->endWidget(); ?>

 