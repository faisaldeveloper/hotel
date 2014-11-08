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
 <!--   <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap.css" />-->
    
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
	color: #F98817;
}
.logo-round-corner{
	border:2px; 
	border-top-left-radius: .5em;
	border-top-right-radius: .5em;
	border-bottom-left-radius: .5em;
	border-bottom-right-radius: .5em;
}

.grid-view table.items th
{/*
	color: white;
	background: url(<?php //echo $imgPath; ?>gbgt.png) repeat-x scroll left top white !important;
	text-align: center;*/
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
				
				
				$branch_id = yii::app()->user->branch_id;
				$res67 = DayEnd::model()->find("branch_id= $branch_id");
				$act_date = $res67->active_date;

		?>    
        
         <?php 		 
		 //.yii::app()->user->roles;		
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
        <tr><td style="width:80px;">
		<img class="logo-round-corner" src="<?php echo $logo_path ?>" height="70px" width="150px" alt="logo" /> 
		</td>
        <td><div class="header-logo-txt">
			<?php echo ucwords($hotel_name); ?>'s Administration
              		 </div>
                     <br /><span style="font-family:Verdana, Geneva, sans-serif; color:#FFF;">Business day:  
					 <?php echo date("F j, Y", strtotime ($act_date)); ?></span>
                     </td>
        <td style="width:113px; text-align:right; vertical-align:bottom;  padding-bottom:10px;">
          <span class="summary-text"><?php echo "<b>$res_summary1</b>"; ?></span></td>
          <td style="width:113px; text-align:right; vertical-align:bottom; padding-bottom:10px;">
          <span class="summary-text"><?php echo "<b>$res_summary</b>"; ?></span></td>
        </tr>
        </table>
              
        </div><!-- logo -->
        
      
        
	</div><!-- header -->

<div id="myslidemenu" class="jqueryslidemenu" style="background-image:url(css/gbg.png) !important; width: 100% !important; ">


 <?php 
$arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2, Yii::app()->user->getId());
$arrayKeys = array_keys($arrayAuthRoleItems);
$role = strtolower ($arrayKeys[0]);
//echo "--".$role;
	
	include "menu.php"; //all menu items are placed in this file.		
		//if($role =='auditor')  $menu_array = $menu_array_frontdesk;
	 $menu_array = array();	 
	if($role =='auditor')  $menu_array = $menu_array_auditor;
	if($role =='manager' || $role== 'authority' || $role== 'administrator')  $menu_array = $menu_array_manager;	
	if($role =='frontdesk')  $menu_array = $menu_array_frontdesk; 
  $this->widget('zii.widgets.CMenu',$menu_array); 	 
	 ?>
	 
	

 
</div><!-- myslidemenu-->

	<div id="mainmenu">	
	</div><!-- mainmenu -->
    
  
	<?php //if(isset($this->breadcrumbs)): $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs,));  endif?>

	<?php echo $content; ?>
	<div class="clear"></div>

	<div id="footer" style=" background: repeat url(<?php echo $imgPath; ?>45.png);  border:2px; border-bottom-left-radius: .5em; border-bottom-right-radius: .5em;">
		<?php echo Yii::t('zii','Copyright'); ?> &copy; <?php echo date('Y'); ?> by Maaliksoft.<br/>
		<?php echo Yii::t('zii','All Rights Reserved.'); ?> <br/>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->


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
