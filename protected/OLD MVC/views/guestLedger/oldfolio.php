<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'old-folio-form',
	'enableAjaxValidation'=>false,
)); ?>

<style>
a:link, a:visited {
	text-decoration:underline;
	text-shadow:#900;
	font-family:Tahoma, Geneva, sans-serif;
	font-size:12px;
	font-weight:bold;
    color: #900;
}
</style>
<script src="<?php echo Yii::app()->baseUrl."/js/jquery.inputmask.js"?>"></script>
<script>
$(document).ready(function(){
$("#GuestLedger_chkin_id").inputmask("99999",{placeholder:"", clearIncomplete: false });
});
</script>


<div class="row">
		<?php echo $form->label($model,'Enter a Folio No'); ?>
		<?php echo $form->textField($model,'chkin_id',array('size'=>15,'maxlength'=>30)); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Search' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

<?php 
if(!empty($chkin_id)){
	echo "1 Result Found: ".CHtml::link('View Bill', 'ViewBill/'.$chkin_id, array('class' => 'hello','target'=>'_blank'));
	}
else echo "No result Found. Please enter a Valid Folio No";

?>