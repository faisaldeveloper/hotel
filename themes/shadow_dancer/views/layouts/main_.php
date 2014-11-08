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
</head>

<body>
<!----shadow-layout-main--<br />-->
<div class="container" id="page">

	<div id="header">
		<div id="logo" align="center">        
         <?php //echo yii::app()->user->clinic_branch_id."-".yii::app()->user->clinic_id;
				if(Yii::app()->user->isGuest){
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
				$logo_path = Yii::app()->request->baseUrl."/hotel_logos/".$logo;
				//echo "$logo_path";
		?>        
		<img src="<?php echo $logo_path ?>" height="150px" width="300px" alt="logo" />         
        </div><!-- logo -->
        
	</div> <!-- header -->

<div id="myslidemenu" class="jqueryslidemenu">
 
 <?php 

 $this->widget('zii.widgets.CMenu',array(
   'items'=>array(
      array('label'=>Yii::t('zii','Home'), 'url'=>array('/index.php')), 
	  
	  ////////// General Setup
	  array('label'=>Yii::t('zii','Setup'), 'url'=>array('/hmsfloor/admin'), 
	  	 'items'=>array(
		  // array('label'=>Yii::t('zii','Hotel Setup'), 'url'=>array('/hoteltitle/admin',)), 
          // array('label'=>Yii::t('zii','Hotel Branch'), 'url'=>array('/hmsbranches/admin',)),
		   array('label'=>Yii::t('zii','Floor'), 'url'=>array('/hmsfloor/admin',)),
           array('label'=>Yii::t('zii','Room Types'), 'url'=>array('/hmsroomtype/admin',)),
           array('label'=>Yii::t('zii','Room Master'), 'url'=>array('/roommaster/admin',)),
		   
		   array('label'=>Yii::t('zii','Services Management'), 'url'=>array('/services/admin', )),
           array('label'=>Yii::t('zii','Services GST'), 'url'=>array('/servicegst/admin', )),
           array('label'=>Yii::t('zii','Flight Management'), 'url'=>array('/flights/admin',)),
		   
		   array('label'=>Yii::t('zii','Identity Management'), 'url'=>array('/identity/admin',)),
           array('label'=>Yii::t('zii','Salutations'), 'url'=>array('/salutation/admin', )),
           array('label'=>Yii::t('zii','Newspapers'), 'url'=>array('/newspapers/admin',)),
		   
		   array('label'=>Yii::t('zii','Sales Persons'), 'url'=>array('/saleperson/admin',)),
		  // array('label'=>Yii::t('zii','User Management'), 'url'=>array('/user/admin',)),
		  // array('label'=>Yii::t('zii','User Rights'), 'url'=>array('/srbac/authitem/frontpage',)),	
		   
		     
		   
		  )),
		//configuration	  	   
		 array('label'=>Yii::t('zii','Configuration'), 'url'=>array('/company/admin'),
	  	'items'=>array(
		   array('label'=>Yii::t('zii','Company Setup'), 'url'=>array('/company/admin',)),
           array('label'=>Yii::t('zii','Countries'), 'url'=>array('/country/admin', )),
           array('label'=>Yii::t('zii','Exchange Rates'), 'url'=>array('/exchangerate/admin', )),
	  
	  	)),
		//Guests
		 array('label'=>Yii::t('zii','Guests'), 'url'=>array('/guestinfo/create'),
	  	'items'=>array(
		   array('label'=>Yii::t('zii','New Guest'), 'url'=>array('/guestinfo/create', )),
           array('label'=>Yii::t('zii','Guest List'), 'url'=>array('/guestinfo/admin',)),           
	  
	  	)),		
		//reservations
		 array('label'=>Yii::t('zii','Reservations'), 'url'=>array('/reservationinfo/create'),
	  	'items'=>array(
		   array('label'=>Yii::t('zii','New Reservation'), 'url'=>array('/reservationinfo/create',)),
           array('label'=>Yii::t('zii','Reservation List'), 'url'=>array('/reservationinfo/admin',)),	  
	  	)),
		//check in
		 array('label'=>Yii::t('zii','Check In'), 'url'=>array('/checkininfo/create'),
	  	'items'=>array(
		   array('label'=>Yii::t('zii','New Checkin'), 'url'=>array('/checkininfo/create',)),
           array('label'=>Yii::t('zii','Checkin List'), 'url'=>array('/checkininfo/admin',)),  
	  	)),
		
		//night audit
		 array('label'=>Yii::t('zii','Night Audit'), 'url'=>array('#'),
	  	),
		
	  //////////////////////////////     
       array('label'=>Yii::t('zii','Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
       array('label'=>Yii::t('zii','Logout').'('.ucfirst(Yii::app()->user->name).')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)),
     )); 
	 
	 ?>

 
</div><!-- myslidemenu-->

	<div id="mainmenu">	
	</div><!-- mainmenu -->
    
  
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs,)); ?><!-- breadcrumbs -->
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
