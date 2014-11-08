<?php
$this->breadcrumbs=array(
	'Reservation Infos'=>array('index'),
	$model->reservation_id=>array('view','id'=>$model->reservation_id),
	'Update',
);
/* $this->menu=array(
	//array('label'=>'List ReservationInfo', 'url'=>array('index')),
	array('label'=>'Create ReservationInfo', 'url'=>array('create')),
	array('label'=>'View ReservationInfo', 'url'=>array('view', 'id'=>$model->reservation_id)),
	array('label'=>'Manage ReservationInfo', 'url'=>array('admin')),
); */
//this var is defined in framework/web/CCoontroler.php
$this->myMenu = "<div align=\"right\">";
$this->myMenu .= "<a href=\"/hotel/ReservationInfo/create\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/add.png\" title=\"Add New Reservation\"  /></a>";
$this->myMenu .= "<a  href=\"/hotel/ReservationInfo/admin\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/manage.png\" title=\"Mangage Reservations\" /></a>";
$this->myMenu .= "</div>";
?>
<table class="mytbl" style="background-color:transparent;" width="200" border="0">
  <tr>
    <td width="750px"><h1> <?php echo Yii::t('views','Update ReservationInfo') ?> <?php echo $model->reservation_id; ?></h1></td>    
    <td><?php echo $this->myMenu;?></td>
  </tr>  
</table>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>