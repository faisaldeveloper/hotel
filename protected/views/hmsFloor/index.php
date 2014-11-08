<?php

$this->breadcrumbs=array(

	'Hms Floors',

);



$this->menu=array(

	array('label'=>'Create Floor', 'url'=>array('create')),

	array('label'=>'Manage Floor', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Floors') ?></h1>



<?php $this->widget('zii.widgets.CListView', array(

	'dataProvider'=>$dataProvider,

	'itemView'=>'_view',

)); ?>

