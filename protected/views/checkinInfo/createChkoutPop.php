<?php

$this->menu=array(

	//array('label'=>'List GuestLedger', 'url'=>array('index')),

	array('label'=>'Manage GuestLedger', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Create GuestLedger') ?> </h1><?php echo "999-".$bill; ?>

<?php echo $this->renderPartial('_formchkoutPopup', array('model'=>$model, 'bill'=>$bill)); ?>



