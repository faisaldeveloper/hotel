<?php

$this->breadcrumbs=array(

	'Room Masters'=>array('index'),

	$model->mst_room_id=>array('view','id'=>$model->mst_room_id),

	'Update',

);



$this->menu=array(

	//array('label'=>'List RoomMaster', 'url'=>array('index')),

	array('label'=>'Create RoomMaster', 'url'=>array('create')),

	array('label'=>'View RoomMaster', 'url'=>array('view', 'id'=>$model->mst_room_id)),

	array('label'=>'Manage RoomMaster', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Update RoomMaster -') ?>  <?php echo $model->mst_room_name; ?></h1>



<?php 

$arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2, Yii::app()->user->getId());

$arrayKeys = array_keys($arrayAuthRoleItems);

$role = strtolower ($arrayKeys[0]);



if($role =='frontdesk') echo $this->renderPartial('_form2', array('model'=>$model)); 

else { echo $this->renderPartial('_form', array('model'=>$model));  }



?>