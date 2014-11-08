<?php

$this->breadcrumbs=array(

	'Checkin Infos'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List CheckinInfo', 'url'=>array('index')),

	array('label'=>'Manage CheckinInfo', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Create CheckinInfo') ?></h1>



<?php echo $this->renderPartial('_formAP', array('model'=>$model)); ?>