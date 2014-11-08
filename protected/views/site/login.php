<?php
	$rs = Yii::app()->db->createCommand('select * from settings where id>0')->queryAll();
	$settings = array();
	foreach($rs as $row){
	$settings[$row['unit']]=$row['value'];	
	}
	Yii::app()->user->setState("settings",$settings);
	
	Yii::app()->user->setState("language",Yii::app()->user->settings['language']);
	
	
	
	if(isset($_GET['lang']) ){
		Yii::app()->user->setState("language",$_GET['lang']);
	}
	
	Yii::app()->language = Yii::app()->user->language;
	
$this->pageTitle=Yii::t('loginlayout',Yii::app()->name) . ' - '.Yii::t('loginlayout','Login');
$this->breadcrumbs=array(
	'Login',
);
?>


<div style="width:141px; height:102px; margin-left:47%; margin-top:5%;">
<img src="<?php echo Yii::app()->baseUrl; ?>/hotel_logos/logo.png"  />
</div>
<div id="box" style="width:300px; height:auto; margin-left:40%; margin-top:2%;"><br><br>
 
 <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'htmlOptions'=>array('class'=>'form-inline', 'style'=>'margin-left:20px;'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	),
)); ?>
<?php 
$model->username='backoffice';
$model->password='123456';
?>
		<?php echo $form->textField($model,'username', array('class'=>"input-large", 'placeholder'=>"Email")); ?>
		<?php echo $form->error($model,'username'); ?><br><br>
        
        <?php echo $form->passwordField($model,'password', array('class'=>"input-large", 'placeholder'=>"Password")); ?>
		<?php echo $form->error($model,'password'); ?> 
  
	<br><br>
  

  
  		<?php echo $form->checkBox($model,'rememberMe'); ?>
  		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
        
   <!-- <input type="checkbox"> Remember me-->
  <br><br>

  <button type="submit" class="btn btn-primary"><?php echo Yii::t('loginlayout','Sign in');?></button>
  
<?php $this->endWidget();?>

 </div>