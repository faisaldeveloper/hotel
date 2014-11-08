<?php

$this->breadcrumbs=array(

	'Checkin Infos'=>array('index'),

	'Create',

);



/* $this->menu=array(

	//array('label'=>'List CheckinInfo', 'url'=>array('index')),

	array('label'=>'Manage CheckinInfo', 'url'=>array('admin')),

); */

//this var is defined in framework/web/CCoontroler.php

$this->myMenu = "<div align=\"right\">";

$this->myMenu .= "<a href=\"/hotel/CheckinInfo/create\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/add.png\" title=\"Add New Check-In\"  /></a>";

$this->myMenu .= "<a  href=\"/hotel/CheckinInfo/admin\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/manage.png\" title=\"Mangage Check-Ins\" /></a>";

$this->myMenu .= "</div>";

?>

<table class="mytbl" style="background-color:transparent;" width="200" border="0">

  <tr>

    <td width="750px"><h1> <?php echo Yii::t('views','Create CheckinInfo') ?></h1></td>    

    <td><?php echo $this->myMenu;?></td>

  </tr>  

</table>







<?php echo $this->renderPartial('_form', array('model'=>$model,'guest_info'=>$guest_info, 'myroomid'=>$myroomid)); ?>