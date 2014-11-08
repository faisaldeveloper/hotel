<?php

$this->breadcrumbs=array(

	'HMS Branches',

);



$this->menu=array(

	array('label'=>'Create Branches', 'url'=>array('create')),

	array('label'=>'Manage Branches', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Hms Branches') ?> </h1>



<?php $this->widget('zii.widgets.CListView', array(

	'dataProvider'=>$dataProvider,

	'itemView'=>'_view',

)); ?>

