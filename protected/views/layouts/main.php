<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />  
    
      
    
    <!----------------H1 Fonts---------------->
    
  <!--  <link href='http://fonts.googleapis.com/css?family=Glass+Antiqua' rel='stylesheet' type='text/css'>-->
    
    
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
	 
	 if(empty(yii::app()->user->branch_id) || empty(yii::app()->user->hotel_id))
	 Yii::app()->controller->redirect(array ('site/login'));
 
?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
   
<style type="text/css">
<?php if(Yii::app()->language=='ar'){?>
input{
	 direction: rtl;
}
<?php }?>
@font-face {
  font-family: 'Glass Antiqua';
  font-style: normal;
  font-weight: 400;
  src: local('Glass Antiqua'), local('GlassAntiqua-Regular'), url(<?php echo Yii::app()->baseUrl; ?>/css/fonts/Glass_Antiqua.woff) format('woff');
}

.header-logo-txt {
	font-family: Verdana, Geneva, sans-serif;
	font-size: medium;
	font-style: normal;
	font-weight: bold;
	text-transform: capitalize;
	color: #FFFFFF;
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
	font-size: 12px;
	font-style: normal;
	/* color: #F98817; */
	color: #FFAA0D;
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
}
.grid-view .summary {
    color: #000;
}
</style>
</head>

<body> 

<!----shadow-layout-main--<br />-->
<div class="container" id="page">

<div id="header" style=" background: repeat url(<?php echo $imgPath; ?>45.png);  border:2px;">
		<div id="logo" align="left" style="padding:0px !important;">        
         <?php //echo yii::app()->user->clinic_branch_id."-".yii::app()->user->clinic_id;
		 $branch_id = $hotel_branch_id = yii::app()->user->branch_id;
		 $hid=yii::app()->user->hotel_id;
				if(Yii::app()->user->isGuest){	$logo="";}
				else{					
					$clinicname=HotelTitle::model()->findAll("id=$hid");
					foreach($clinicname as $rw){
							$hotel_name=$rw['title'];
							$logo =$rw['logo_image'];	
						}				
				}
				if(!isset($logo) || empty($logo))$logo="hotel-logo.png";	
				$logo_path = Yii::app()->request->baseUrl."/hotel_logos/".$logo;				
				$act_date = $active_date = DayEnd::model()->find("branch_id= $branch_id")->active_date;
				
				$dayClose_status = "";
				$today_date = date("Y-m-d H:i:s");				
				$act_date .=" 07:00:00";						
				if((strtotime($act_date)+(24*60*60)) < strtotime($today_date)){
					$dayClose_status = " - <font color=\"#FF0000\"><blink>Day is Not Closed Yet.</blink></font>";
					//$this->redirect( array( 'view', 'id' => $model->id ) );	
					//echo "<script></script8>";
				}
		 
		?>    
      
         <?php 			 
		$total_rooms = RoomMaster::model()->findAll("branch_id=$hotel_branch_id");		
		$available_rooms = RoomMaster::model()->findAll("mst_room_status = 'V' AND branch_id=$hotel_branch_id");
		$total_res = ReservationInfo::model()->findAll("reservation_status = 1 AND chkin_date LIKE '$active_date%' AND chkin_status='N' AND branch_id=$hotel_branch_id");		
		$occupied_rooms = CheckinInfo::model()->findAll("chkout_status = 'N' AND branch_id=$hotel_branch_id");			
			
			$res_summary1 = "Total Rooms: ".count($total_rooms)."<br>";
			$res_summary1 .= "Available: ".count($available_rooms)."<br>";
			$res_summary = "Checkins: ".count($occupied_rooms)."<br>";
			$res_summary .= "Reserved: ".count($total_res)."<br>";			
			?>
		
        
        <table width="867" style="margin-bottom:0px !important;">  
        <tr><td width="100" style="width:100px;">
		<img class="logo-round-corner" src="<?php echo $logo_path ?>" height="70px" width="auto" style="margin-left:10px" alt="logo" /> 
		</td>
        <td width="301"><div class="header-logo-txt">
			<?php echo ucwords($hotel_name); ?>
              		 </div>
                     <br /><span style="font-family:Verdana, Geneva, sans-serif; color:#FFF;">Date:  
					 <?php echo date("F j, Y", strtotime ($act_date)). "". $dayClose_status; 
					 //echo date("F j, Y");
					 ?></span>
                     </td>
                     <td width="216">
                
                     </td>
        <td width="113" style="width:113px; text-align:right; vertical-align:bottom;  padding-bottom:25px;">
          <span class="summary-text"><?php echo "<b>$res_summary1</b>"; ?></span></td>
          <td width="113" style="width:113px; text-align:right; vertical-align:bottom; padding-bottom:25px;">
          <span class="summary-text"><?php echo "<b>$res_summary</b>"; ?></span></td>
        </tr>
        </table>
              
        </div><!-- logo -->       
	</div><!-- header -->

<div id="myslidemenu" class="jqueryslidemenu" style="background-image:url(<?php echo $imgPath; ?>gbg.png) !important; width: 100% !important; ">
 <?php  
	$res = Yii::app()->db->createCommand("select value from settings where unit LIKE 'taxcontrol'")->queryScalar();			
	if($res==1){ Yii::app()->session->add('taxcontrol','ON');	 }  //control is on	
	if($res==0){ Yii::app()->session->add('taxcontrol','OFF');	 }  //control is OFF
			 

 
$arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2, Yii::app()->user->getId());
$arrayKeys = array_keys($arrayAuthRoleItems);
$role = strtolower ($arrayKeys[0]);
//echo "--".$role;

//echo "---".Yii::app()->user->checkAccess('GuestLedgerNightpost');


	include "menu.php"; //all menu items are placed in this file.		
		//if($role =='auditor')  $menu_array = $menu_array_frontdesk;
	 $menu_array = array();	 
	if($role =='auditor')  $menu_array = $menu_array_auditor;
	if($role =='manager' || $role== 'authority' || $role== 'administrator')  $menu_array = $menu_array_manager;	
	if($role =='frontdesk')  $menu_array = $menu_array_frontdesk; 
	if($role =='taxcontroller')  $menu_array = $menu_array_taxcontrol; 
	
	
	//$menu_array = $menu_array_auditor;
  $this->widget('zii.widgets.CMenu',$menu_array); 	 
	 ?>
	 
	

 
</div><!-- myslidemenu-->

	<div id="mainmenu">	
	</div><!-- mainmenu -->
    
  
	<?php //if(isset($this->breadcrumbs)): $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs,));  endif?>

	<?php echo $content; ?>
	<div class="clear"></div>

	<div id="footer" style=" background: repeat url(<?php echo $imgPath; ?>45.png);  border:2px; text-align:center; color:#CCC;">
		<?php echo Yii::t('views','Copyright'); ?> &copy; <?php echo date('Y'); ?> by Maaliksoft.<br/>
		<?php echo Yii::t('views','All Rights Reserved.'); ?> <br/>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
<style>
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
