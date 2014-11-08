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

	 $currentURL = $_SERVER["REQUEST_URI"]; 
	 $urlCount = count(explode("/", $currentURL));
	 //echo "--". $urlCount;
	 if($urlCount == 3){$imgPath = "images/";}
	 else if($urlCount == 4){$imgPath = "../images/";}
	 else if($urlCount == 5){$imgPath = "../../images/";}
	 else if($urlCount == 6){$imgPath = "../../../images/";}
	 else {$imgPath = "../images/";}
 
?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
   
    
    
    
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

</style>
</head>

<body> 
<!----shadow-layout-main--<br />-->
<div class="container" id="page">


<div id="header" style=" background: repeat url(<?php echo $imgPath; ?>45.png);  border:2px; border-top-left-radius: .5em; border-top-right-radius: .5em;">
		<div id="logo" align="left" style="padding:0px !important;">        
         <?php //echo yii::app()->user->clinic_branch_id."-".yii::app()->user->clinic_id;
				if(Yii::app()->user->isGuest){
				$test="";
				$logo="";
				}else{
					$hid=yii::app()->user->hotel_id;
					$clinicname=HotelTitle::model()->findAll("id=$hid");
					foreach($clinicname as $rw){
							$hotel_name=$rw['title'];
							$logo =$rw['logo_image'];	
						}
					//$test = $cid;		
				}if(!isset($logo) || empty($logo))$logo="hotel-logo.png";	
				$logo_path = Yii::app()->request->baseUrl."/hotel_logos/".$logo;
				//echo "$logo_path";
				
				if(strpos($hotel_name,"hotel")){$hotel_name =$hotel_name; }
				else $hotel_name .=" Hotel";
		
		?>    
        
         <?php 
		
		$hotel_branch_id = yii::app()->user->branch_id;		
		$total_rooms = RoomMaster::model()->findAll("branch_id=$hotel_branch_id");
		$available_rooms = RoomMaster::model()->findAll("mst_room_status = 'V' AND branch_id=$hotel_branch_id");
		$total_res = ReservationInfo::model()->findAll("reservation_status = 1 AND chkin_status='N' AND branch_id=$hotel_branch_id");		
		$occupied_rooms = CheckinInfo::model()->findAll("chkout_status = 'N' AND branch_id=$hotel_branch_id");
			
			//$spc = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$res_summary1 = "Total Rooms: ".count($total_rooms)."<br>";
			$res_summary1 .= "Available: ".count($available_rooms)."<br>";
			$res_summary = "Checkins: ".count($occupied_rooms)."<br>";
			$res_summary .= "Reservations: ".count($total_res)."<br>";
			
			
			?>
		
        
        <table style="margin-bottom:0px !important;">  
        <tr>
        <td><div class="header-logo-txt"><?php echo ucwords($hotel_name); ?>'s Administration</div></td>
        <td style="width:113px; text-align:right; vertical-align:bottom;  padding-bottom:10px;">
          <span class="summary-text"><?php echo "<b>$res_summary1</b>"; ?></span></td>
          <td style="width:113px; text-align:right; vertical-align:bottom; padding-bottom:10px;">
          <span class="summary-text"><?php echo "<b>$res_summary</b>"; ?></span></td>
        </tr>
        </table>
              
        </div><!-- logo -->
        
      
        
	</div><!-- header -->
    
    <!-- Muntazir style -->
    <style type="text/css">
.mceheader {
	width:100%; 
	height:50px;
background: rgb(73,155,234); /* Old browsers */
background: -moz-linear-gradient(top, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(73,155,234,1)), color-stop(100%,rgba(32,124,229,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(73,155,234,1) 0%,rgba(32,124,229,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(73,155,234,1) 0%,rgba(32,124,229,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(73,155,234,1) 0%,rgba(32,124,229,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(73,155,234,1) 0%,rgba(32,124,229,1) 100%); /* W3C */

}
.top_menu_header{
	width:960px;
	height:20px; 
	color:#FFF;
	text-decoration:none;
	float:left;
	margin-left:4%;
	font-size:14px;
	margin-top:3px;
	}
</style>


<div class="mceheader">
 <div class="top_menu_header">
 <?php  
$imghtml=CHtml::image(Yii::app()->request->baseUrl.'/images/icons/home.png', 'image', array('style'=>'margin-top:5px')); 
echo CHtml::link($imghtml, array('site/index'), array('title'=>'Dashboard'));
?>
<span id="sub_contents">
<?php include "menu.php";  ?>
</span>

</div>
</div>

	
    
  
	<?php //if(isset($this->breadcrumbs)):?>
		<?php //$this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs,)); ?><!-- breadcrumbs -->
	<?php //endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer" style=" background: repeat url(<?php echo $imgPath; ?>45.png); padding: 5px 0 5px 0;  border:2px; border-bottom-left-radius: .5em; border-bottom-right-radius: .5em; text-align:center; color:#FFF;">
	<?php echo Yii::t('zii','Copyright'); ?> &copy; <?php echo date('Y'); ?> by Maaliksoft and Powered by <a href="http://www.elodger.com" target="_blank">Elodger</a><br/>
		<?php //echo Yii::t('zii','All Rights Reserved.'); ?>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
