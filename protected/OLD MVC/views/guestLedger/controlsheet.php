<?php
$this->breadcrumbs=array('Account Ledgers'=>array('index'),	$model->id,);
$this->menu=array(
	array('label'=>'List AccountLedger', 'url'=>array('index')),
	array('label'=>'Create AccountLedger', 'url'=>array('create')),
	array('label'=>'Update AccountLedger', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AccountLedger', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AccountLedger', 'url'=>array('admin')),
);
?>
<h1><?php echo Yii::t('views','Control Sheet') ?> </h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'controsheet-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('target'=>'_blank'),
)); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'created_date'); ?>
		<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(    
					'name'=>'AccountLedger[created_date]',					
					'attribute'=>'created_date',
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
		<?php echo $form->error($model,'created_date'); ?>
	</div>
	
    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? ' OK ' : 'Save', array('id'=>'btn_submit')); ?>
	</div>
<?php $this->endWidget(); ?>