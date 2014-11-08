<?php
/* @var $this SettingsController */
/* @var $model Settings */
/* @var $form CActiveForm */
?>
<style>
div.form label {
    text-align: right;
    width: 183px;
}
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo Yii::t('views','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>
<?php echo $form->errorSummary($model); ?>
<?php
/*$options = array(//dropDownList
'data'=>array('model'=>'AccountName','condition'=>'','id'=>'id','name'=>'name',),
'html_options'=>array(),
);*/

/*$options = array(//dropDownCode
'data'=>array('ar'=>'Arabic','en'=>'English'),
'html_options'=>array(),
);*/

/*$options = array(//else
'html_options'=>array('size'=>10,'maxlength'=>2),
);*/
//echo $options = json_encode($options);




?>
	<div class="row">
		<?php echo $form->labelEx($model,$model->unit); ?>
		<?php echo $form->textField($model,'description',array('size'=>50,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php 
		$options = json_decode($model->htmlcode,true);
		if($model->fieldtype=='dropDownList'){
		$arr=CHtml::listData(CActiveRecord::model($options['data']['model'])->findAll(), 'id','name');
		echo $form->dropDownList($model,'value',CHtml::listData(CActiveRecord::model($options['data']['model'])->findAll($options['data']['condition']), $options['data']['id'],$options['data']['name']),$options['html_options']);
		}else if($model->fieldtype=='dropDownCode'){
		$arr=$options['data'];
		echo $form->dropDownList($model,'value',$arr,$options['html_options']);
		}else{
		echo $form->textField($model,'value',$options['html_options']);
		}
		
		?>
		<?php echo $form->error($model,'value'); ?>
	</div>

	<?php /*?><div class="row">
		<?php echo $form->labelEx($model,'fieldtype'); ?>
		<?php echo $form->textField($model,'fieldtype',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fieldtype'); ?>
	</div><?php */?>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div class="row">
		<?php echo $model->htmlcode; ?>
	</div>