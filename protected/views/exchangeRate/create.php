<?php

$this->breadcrumbs=array(

	'Exchange Rates'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List ExchangeRate', 'url'=>array('index')),

	array('label'=>'Manage ExchangeRate', 'url'=>array('admin')),

);

?>



<h1> <?php echo Yii::t('views','Create ExchangeRate') ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>