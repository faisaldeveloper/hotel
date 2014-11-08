<?php

$this->breadcrumbs=array(

	'Companys'=>array('index'),

	'Create',

);



/* $this->menu=array(

	//array('label'=>'List Company', 'url'=>array('index')),

	array('label'=>'Manage Company', 'url'=>array('admin')),

); */

//this var is defined in framework/web/CCoontroler.php

$this->myMenu = "<div align=\"right\">";



$this->myMenu .= "<a href=\"/hotel/Company/create\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/netvibes.png\" title=\"Add New Company\"  /></a>";



$this->myMenu .= "<a  href=\"/hotel/Company/admin\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/netvibes.png\" title=\"Mangage Companies\" /></a>";



$this->myMenu .= "</div>";



?>

<table class="mytbl" style="background-color:transparent;" width="200" border="0">

  <tr>

    <td width="750px"><h1> <?php echo Yii::t('views','Manage Companies') ?></h1></td>    

    <td><?php echo $this->myMenu;?></td>

  </tr>  

</table>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>