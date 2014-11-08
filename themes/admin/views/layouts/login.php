<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	
	
	<!-- blueprint CSS framework -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/icons.css" />
	 
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/tables.css" />
   
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/mbmenu.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/mbmenu_iestyles.css" />
   
    
    <?php
	//echo "<br>".Yii::app()->basePath."<br>";
	$jqueryslidemenupath = Yii::app()->assetManager->publish(Yii::app()->basePath.'/scripts/jqueryslidemenu/');
	
	//Register jQuery, JS and CSS files
	Yii::app()->clientScript->registerCoreScript('jquery');
	Yii::app()->clientScript->registerCssFile($jqueryslidemenupath.'/jqueryslidemenu.css');	
	Yii::app()->clientScript->registerScriptFile($jqueryslidemenupath.'/jqueryslidemenu.js');
?>

	

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<?php $this->widget('ext.jsStyledAlert.JsStyledAlertWidget');?>
<div class="container" id="page">
<div style="clear:both"></div>

    
	<!--<div id="topnav">
		<div class="topnav_text"><a href='#'>Home</a> | <a href='#'>My Account</a> | <a href='#'>Settings</a> | <a href='#'>Logout</a> </div>
	</div>-->
    
	<div id="header">
		<div id="logo">WelCome To <?php echo CHtml::encode(Yii::app()->name); ?> Login page</div>
	</div><!-- header -->
    <!--
--->
    
    
    
   
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,)); ?>
          <!-- breadcrumbs -->
	<?php endif?>
 <div id="statusMsg"> 
<?php
  /*   foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    } */
?>

</div>
	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Maaliksoft.com<br/>
		All Rights Reserved.<br/>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->


<style>
/*
#qnav {
display:none;
color:#999;
font-size:18px;
line-height:20px;
padding:0px;
background:#fff;
position: fixed;
top:260px;
left: 170px;
height:0px;
width:0px;
z-index:200;
}
*/
#darken {  
position:fixed;  
top:0;  
left:0;  
width:100%;  
height:100%;  
display:none;  
z-index:199;  
background:#CCC;
opacity:.5;  
filter:alpha(opacity=50); /* Transparency in IE */  
}  
</style>

<div style="display: none;" id="darken"></div>

<div style="display: none; position:absolute; left:600px; top:250px" id="qnav">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif"  />
</div>



</body>
</html>