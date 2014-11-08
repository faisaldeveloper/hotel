<?php
$this->breadcrumbs=array(
	'Reservation Info'=>array('index'),
	//$model->reservation_id=>array('view','id'=>$model->reservation_id),
	'Reservation Reports',
);

$this->menu=array(
	//array('label'=>'List ReservationInfo', 'url'=>array('index')),
	array('label'=>'Create Reservation', 'url'=>array('create')),
	//array('label'=>'View ReservationInfo', 'url'=>array('view', 'id'=>$model->reservation_id)),
	array('label'=>'Reservation List', 'url'=>array('admin')),
);


?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admissions-form',
	'enableAjaxValidation'=>false,
	
	'htmlOptions'=>array('target'=>'_blank'),

	
)); ?>

<fieldset>

<?php
if($_GET['id']==1){
echo "<legend><h1>Expected Reeservation Report</h1></legend>";
}else if($_GET['id']==2){
echo "<legend><h1>Cancel Reservation Report</h1></legend>";	
}

?>
       <table width="318" border="1">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo CHtml::label('From : ','from_date'); ?></td>
    <td><div style="float:left">
      <?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		//'model'=>$model,
		//'attribute'=>'doadmission',
    	'name'=>'from_date',
    	// additional javascript options for the date picker plugin
    	'options'=>array(
        'showAnim'=>'fold',
		'dateFormat'=>'yy-mm-dd',
		'changeMonth'=>true,
    	'changeYear'=>true,
		'yearRange'=>'-100:+0'
    	),
    	'htmlOptions'=>array(
        //'style'=>'height:20px;'
    	),
		));
		?>
    </div></td>
    <td>&nbsp;</td>
    <td><span class="lbl100"><?php echo CHtml::label('To : ','from_date'); ?></span></td>
    <td><span style="float:left">
      <?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		//'model'=>$model,
		//'attribute'=>'doadmission',
    	'name'=>'to_date',
    	// additional javascript options for the date picker plugin
    	'options'=>array(
        'showAnim'=>'fold',
		'dateFormat'=>'yy-mm-dd',
		'changeMonth'=>true,
    	'changeYear'=>true,
		'yearRange'=>'-100:+0'
    	),
    	'htmlOptions'=>array(
        //'style'=>'height:20px;'
    	),
		));
		?>
    </span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3"><?php echo CHtml::submitButton('Create'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</fieldset>
		
        <div class="row buttons" style="text-align:center">
		
		</div>
    
    
<?php $this->endWidget(); ?>
</div>



