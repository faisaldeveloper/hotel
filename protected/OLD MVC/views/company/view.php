<?php
$this->breadcrumbs=array('Companys'=>array('index'),$model->comp_id,);
//this var is defined in framework/web/CCoontroler.php
/*$this->myMenu = "<div align=\"right\">";
$this->myMenu .= "<a href=\"/hotel/Company/create\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/add.png\" title=\"Add New Company\"  /></a>";
$this->myMenu .= "<a  href=\"/hotel/Company/admin\"><img class=\"myclass\" src=\"" .yii::app()->baseUrl ."/images/manage.png\" title=\"Mangage Companies\" /></a>";
$this->myMenu .= "</div>";*/
/* $this->menu=array(
	//array('label'=>'List Company', 'url'=>array('index')),
	array('label'=>'' , 'url'=>array('create'), 'linkOptions'=>array('class'=>'myclass')),	
	array('label'=>'', 'url'=>array('update', 'id'=>$model->comp_id), 'linkOptions'=>array('class'=>'myclass')),
	array('label'=>'', 'url'=>'#', 'linkOptions'=>array('class'=>'myclass','submit'=>array('delete','id'=>$model->comp_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'', 'url'=>array('admin'), 'linkOptions'=>array('class'=>'myclass')),
); */
?>
<table class="mytbl" style="background-color:transparent;" width="200" border="0">
  <tr>
    <td width="750px"><h1><?php echo Yii::t('views','View Company') ?>  - <?php echo $model->comp_name; ?></h1></td>    
    <td><?php echo $this->myMenu;?></td>
  </tr>  
</table>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'comp_id',
		'comp_name',
		'comp_contact_person',
		'person_designation',
		'person_mobile',
		'comp_address',
		'comp_phone',
		'comp_fax',
		'comp_email',
		'comp_website',
		'comp_allow_credit',
		//'country_id',
		array('label'=>'Country','value'=>$model->country->country_name),
		//'branch_id',
		//'user_id',
	),
)); ?>
