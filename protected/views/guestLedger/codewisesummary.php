<?php

$this->breadcrumbs=array('Account Ledgers'=>array('index'),	$model->id,);





?>



<h1><?php echo Yii::t('views','Code-wise Summary') ?> </h1>



<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'codewise-form',

	'enableAjaxValidation'=>false,

	//'htmlOptions'=>array('target'=>'_blank'),

)); ?>



	<div class="row">

		<?php echo $form->labelEx($model,'created_date'); ?>

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

					'style'=>'height:15px;',					

					),

				));	

		?>

		<?php echo $form->error($model,'c_date'); ?>

	</div>

	

    <div class="row buttons">

		<?php echo CHtml::submitButton($model->isNewRecord ? ' OK ' : 'Save', array('id'=>'btn_submit')); ?>

	</div>



<?php $this->endWidget(); ?>

 