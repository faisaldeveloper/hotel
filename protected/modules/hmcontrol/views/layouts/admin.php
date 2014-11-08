<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    
    <?php
	//echo "<br>".Yii::app()->basePath."<br>";
	$jqueryslidemenupath = Yii::app()->assetManager->publish(Yii::app()->basePath.'/scripts/jqueryslidemenu/');
	
	//Register jQuery, JS and CSS files
	Yii::app()->clientScript->registerCoreScript('jquery');
	Yii::app()->clientScript->registerCssFile($jqueryslidemenupath.'/jqueryslidemenu.css');	
	Yii::app()->clientScript->registerScriptFile($jqueryslidemenupath.'/jqueryslidemenu.js');
?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php    
$currentURL = $_SERVER["REQUEST_URI"]; 
	 $urlCount = count(explode("/", $currentURL));
	 //echo "--". $urlCount;
	 if($urlCount == 3){$imgPath = "images/";}
	 else if($urlCount == 4){$imgPath = "../images/";}
	 else if($urlCount == 5){$imgPath = "../../images/";}
	 else if($urlCount == 6){$imgPath = "../../../images/";}
	 else {$imgPath = "../images/";}
 
?>

	<title><?php echo CHtml::encode($this->pageTitle); ?>-T</title>
   
    
<style type="text/css">
.header-logo-txt {
	font-family: Verdana, Geneva, sans-serif;
	font-size: medium;
	font-style: normal;
	font-weight: bold;
	text-transform: capitalize;
	color: #FFF;
}
.jqueryslidemenu ul
{
	/*background-image:url(../menu/gbg.png) !important;*/
	}
.jqueryslidemenu{ 
background:  url(<?php echo $imgPath; ?>gbg.png) repeat-x left top !important; 
/*background-image:url(../menu/gbg.png) !important;*/
}
.jqueryslidemenu ul li a{ 
background:  url(<?php echo $imgPath; ?>gbg.png) repeat-x left top !important;
}
.jqueryslidemenu ul li ul li a:hover{ /*sub menus hover style*/
/*background: #eff9ff;*/

background: url(<?php echo $imgPath; ?>gbg.png) repeat-x left top !important;

}

.jqueryslidemenu ul li ul li a { background: url(<?php echo $imgPath; ?>gbg.png) repeat-x left top !important; }
.summary-text {
	/* [disabled]font-family: Verdana, Geneva, sans-serif; */
	font-size: 11px;
	font-style: normal;
	color: #093;
}
.logo-round-corner{
	border:2px; 
	border-top-left-radius: .5em;
	border-top-right-radius: .5em;
	border-bottom-left-radius: .5em;
	border-bottom-right-radius: .5em;
}

.grid-view table.items th
{
	color: white;
	background: url(<?php echo $imgPath; ?>gbgt.png) repeat-x scroll left top white !important;
	text-align: center;
}
.grid-view table.items tr.odd
{
	/*background: #E5F1F4;*/
	background: #E7FCF0;
}

.grid-view table.items
{
	background: white;
	border-collapse: collapse;
	width: 100%;
	/*border: 1px #D0E3EF solid !important;
	border-top-left-radius: .5em  !important;
	border-top-right-radius: .5em  !important;
	border-bottom-left-radius: .5em !important;
	border-bottom-right-radius: .5em !important;*/
}
</style>
</head>

<body>
<!----admin-layout-<br />-->
<div class="container" id="page">

	<!--<div id="header">-->
    <div id="header" style=" background: repeat url(<?php echo $imgPath; ?>45.png);  border:2px; border-top-left-radius: .5em; border-top-right-radius: .5em;">
		
		<div id="logo" align="left" style="padding:0px !important;">        
         <?php //echo yii::app()->user->clinic_branch_id."-".yii::app()->user->clinic_id;
				/* if(Yii::app()->user->isGuest){
				$test="";
				$logo="";
				}else{
					$hid=yii::app()->user->hotel_id;
					$clinicname=HotelTitle::model()->findAll("id=$hid");
					foreach($clinicname as $rw){
							$test=$rw['title'];
							$logo =$rw['logo_image'];	
						}
					//$test = $cid;		
				}if(!isset($logo) || empty($logo))$logo="hotel-logo.png";	
				$logo_path = Yii::app()->request->baseUrl."/hotel_logos/".$logo; */
				//echo "$logo_path";
				
				$logo_path = Yii::app()->request->baseUrl."/hotel_logos/hotel-logo.png";
		?>        
		<img src="<?php echo $logo_path; ?>" height="70px" width="150px" alt="logo" />         
        </div><!-- logo -->
        
	</div> <!-- header -->

<div id="myslidemenu" class="jqueryslidemenu">
 
 <?php 

 $this->widget('zii.widgets.CMenu',array(
   'items'=>array(
      array('label'=>Yii::t('zii','Home'), 'url'=>array('/hmcontrol/')), 
	  
	  ////////// General Setup
	  array('label'=>Yii::t('zii','Setup'), 'url'=>array('/hmcontrol/hoteltitle/admin'), 
	  	 'items'=>array(
		   array('label'=>Yii::t('zii','Hotel Setup'), 'url'=>array('/hmcontrol/Hoteltitle/admin',)), 
           array('label'=>Yii::t('zii','Hotel Branch'), 'url'=>array('/hmcontrol/Hmsbranches/admin',)),
		   array('label'=>Yii::t('zii','User'), 'url'=>array('/hmcontrol/User/admin',)),          
		   array('label'=>Yii::t('zii','User Rights'), 'url'=>array('/srbac/authitem/frontpage',)),			   
		  )),		
	  //////////////////////////////     
       array('label'=>Yii::t('zii','Login'), 'url'=>array('/hmcontrol/Site/login'), 'visible'=>Yii::app()->user->isGuest),
       array('label'=>Yii::t('zii','Logout').'('.ucfirst(Yii::app()->user->name).')', 'url'=>array('/hmcontrol/Site/logout'), 'visible'=>!Yii::app()->user->isGuest)),
     )); 	 
	 ?> 
</div><!-- myslidemenu-->
	<div id="mainmenu">	
	</div><!-- mainmenu -->    
  
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'homeLink'=>CHtml::link('Home', array('/hmcontrol')),
		'links'=>$this->breadcrumbs,)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<?php echo Yii::t('zii','Copyright'); ?> &copy; <?php echo date('Y'); ?> by Maaliksoft.<br/>
		<?php echo Yii::t('zii','All Rights Reserved.'); ?> <br/>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
