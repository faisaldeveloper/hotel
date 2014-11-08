<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2 class="error_header"><?php echo Yii::t('views','Error') ?>  <?php echo $code; ?></h2>

<div class="error error_message">
<?php echo CHtml::encode($message); ?>

<p>May be you should <a href="#" onClick="window.history.go(-1); return false;">go back</a> or <?php echo CHtml::link("Logout", Yii::app()->baseUrl.'/Site/logout',array('style'=>"color:#f37d36;")); ?></p>
</div>