<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<!-- blueprint CSS framework -->
<!--	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap.min.css" />-->
	<?php /*?><link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-responsive.min.css" />	<?php */?>
	<?php /*?><link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fullcalendar.css" /><?php */?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/maruti-style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/maruti-media.css"  class="skin-color" /> 
    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
   <?php /*?> <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main2.css" /><?php */?>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />    
            
    
    <?php		
	 $currentURL = $_SERVER["REQUEST_URI"]; 
	 $urlCount = count(explode("/", $currentURL));
	 //echo "- $currentURL -". $urlCount;
	 if($urlCount == 3){$imgPath = "images/";}
	 else if($urlCount == 4){$imgPath = "../images/";}
	 else if($urlCount == 5){$imgPath = "../../images/";}
	 else if($urlCount == 6){$imgPath = "../../../images/";}
	 else {$imgPath = "../images/";}?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
   
   <link href='http://fonts.googleapis.com/css?family=Glass+Antiqua' rel='stylesheet' type='text/css'>

</head>

<body> 

<!------Header----------->

<?php 
$spaces = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

echo "234234-234243";
?>
<div class="header2">
 <div class="top_menu">
<?php  
$imghtml=CHtml::image(Yii::app()->request->baseUrl.'/images/icons/home.png', 'image', array('style'=>'margin-top:5px')); 
echo CHtml::link($imghtml, array('view', 'id'=>$data->id));

?>

<a href="http://localhost/hotel/"><img style="margin-top:5px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/home.png" title="Home Dashboard"></a>

<span id="sub_contents">
<?php include "menu.php";  ?>
</span>

</div>
</div>

 <?php 
$arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2, Yii::app()->user->getId());
$arrayKeys = array_keys($arrayAuthRoleItems);
$role = strtolower ($arrayKeys[0]);
//echo "--".$role;
	
	//all menu items are placed in this file.		
		//if($role =='auditor')  $menu_array = $menu_array_frontdesk;
	/*  $menu_array = array();	 
	if($role =='auditor')  $menu_array = $menu_array_auditor;
	if($role =='manager' || $role== 'authority' || $role== 'administrator')  $menu_array = $menu_array_manager;	
	if($role =='frontdesk')  $menu_array = $menu_array_frontdesk;  */
  
  	//$this->widget('zii.widgets.CMenu',$menu_array); 	 
	 ?>
 	<?php echo $content; ?>
	<div class="clear"></div>
<!--<div class="row-fluid">
      <div id="footer" class="span12"> 2013 &copy; <a href="#">Maaliksoft</a> </div>
</div>-->
	
<?php $upUrl = Yii::app()->createUrl('Ajaxcalls/data'); ?>
<script>
setInterval(updateDayclose, 60*60*20*1000);

function updateDayclose(){	
	//$(this).val() = 'input';
	$.get('<?php echo $upUrl ?>',	{ what: 'input' },	function(data){		//$('#result').html(data);
	});
}
</script>

</body>
</html>
