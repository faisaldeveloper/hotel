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

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/menu/jqueryslidemenu.css" />




<!--[if lte IE 7]>
<style type="text/css">
html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
</style>
<![endif]-->


<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/menu/jquery-1.2.6-min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/menu/jqueryslidemenu.js"></script>



	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>

<body>
<?php
//$username=Yii::app()->user->name;
//$usermodel=User::model()->find("username='$username'");
//$userid = $usermodel->id;


//yii::import("application.modules.srbac.models.Assignments");

//$assignments=Assignments::model()->find("itemname like 'Tset%' and userid='$userid'");
//echo "id is ".$assignments->userid;

//Yii::app()->user->checkAccess("UserIndex");

?>
<div id="topper">


<div id="myslidemenu" class="jqueryslidemenu" style="width:950px; margin:auto">


<ul>
<?php
	
if(Yii::app()->user->checkAccess("UserIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/site/index">Administrator</a>
	<ul>
	<?php
	
if(Yii::app()->user->checkAccess("UserIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/user/admin">Users</a></li>

<?php
}
if(Yii::app()->user->checkAccess("UserIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/srbac/authitem/frontpage">User Rights</a></li>
<?php 
} 
?>
 </ul>  
</li>
<?php 
}
?>
<!-------super admin Ctrl--------->

<?php

if(Yii::app()->user->checkAccess("HotelTitleIndex")){
	
?>
<li><a href="#">Hotel Title</a>
<ul>
<li><a href="<?php echo Yii::app()->baseUrl;?>/HotelTitle/admin">Add New Hotel</a></li>
<li><a href="<?php echo Yii::app()->baseUrl;?>/hmsBranches/admin">Hotel Branches Setup</a></li>
</ul>
	<?php
}	
	?>
	


<!--------End Super Admin Ctrl------->
<?php

if(Yii::app()->user->checkAccess("HmsFloorIndex")){
	
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/site/contact">Hotel Setup</a>
<ul>
	<?php
	
if(Yii::app()->user->checkAccess("HmsFloorIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/hmsFloor/admin">Floor Info</a></li>
<?php } ?>
<?php
	
if(Yii::app()->user->checkAccess("HmsRoomTypeIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/hmsRoomType/admin">Room Types</a></li>
<?php } ?>

<?php
	
if(Yii::app()->user->checkAccess("RoomTypeRateIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/roomTypeRate/admin">Add Room Rates</a></li>
<?php } ?>

<?php
	
if(Yii::app()->user->checkAccess("RoomMasterIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/roomMaster/admin">Room Master</a></li>
<?php } ?>

<?php
	
if(Yii::app()->user->checkAccess("ServicesIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/services/admin">Services Ctrl</a></li>
<?php } ?>

<?php
	
if(Yii::app()->user->checkAccess("serviceGstIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/serviceGst/admin">Service Gst Info</a></li>
<?php } ?>

<?php
	
if(Yii::app()->user->checkAccess("FlightsIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/Flights/admin">Flight Management</a></li>
<?php } ?>
<?php
	
if(Yii::app()->user->checkAccess("IdentityIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/Identity/admin">Identity Ctrl</a></li>
<?php } ?>
<?php
	
if(Yii::app()->user->checkAccess("GuestStatusIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/guestStatus/admin">Guest Status</a></li>
<?php } ?>
<?php
	
if(Yii::app()->user->checkAccess("SalutationIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/Salutation/admin">Salutation Ctrl</a></li>
<?php } ?>
<?php
	
if(Yii::app()->user->checkAccess("NewspapersIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/Newspapers/admin">Newspapers Ctrl</a></li>
<?php } ?>
<?php
	
if(Yii::app()->user->checkAccess("SalePersonIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/salePerson/admin">Sales Person Ctrl</a></li>
<?php } ?>
</ul>
</li>
<?php 
}
?>
<!-------Configration Ctrl--------->

<?php
if(Yii::app()->user->checkAccess("CountryIndex")){
?>
<li><a href="#">Configration</a>
<ul>
<?php
if(Yii::app()->user->checkAccess("CompanyIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/Company/admin">Company Info</a></li>
<?php 
}
?>
<?php
if(Yii::app()->user->checkAccess("CountryIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/Country/admin">Country Setup</a></li>
<?php } ?>
<?php
if(Yii::app()->user->checkAccess("ExchangeRateIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/ExchangeRate/admin">Exchange Rate</a></li>
<?php } ?>
<?php
if(Yii::app()->user->checkAccess("ReportTextIndex")){
?>
<li><a href="<?php echo Yii::app()->baseUrl;?>/ReportText/admin">Reporting Text</a></li>
<?php } ?>
</ul>
<?php
}	
?>
	

<?php
if(Yii::app()->user->checkAccess("GuestInfoIndex")){
?>
<li><a href="#">Guest Info</a>
    <ul>
    	<li><a href="<?php echo Yii::app()->baseUrl;?>/GuestInfo/create">New Guest</a></li>
        <li><a href="<?php echo Yii::app()->baseUrl;?>/GuestInfo/admin">Guest List</a></li>
    </ul>
</li>
<?php } ?>

<?php
if(Yii::app()->user->checkAccess("CheckinInfoIndex")){
?>
<li><a href="#">Check-IN</a>
	<ul>
	<li><a href="<?php echo Yii::app()->baseUrl;?>/CheckinInfo/create">New Check-IN</a></li>
    <li><a href="<?php echo Yii::app()->baseUrl;?>/CheckinInfo/admin">Check-IN List</a></li>
    </ul>
</li>
<?php } ?>

<?php
if(Yii::app()->user->checkAccess("ReservationInfoIndex")){
?>
<li><a href="#">Reservation</a>
<ul>
	<li><a href="<?php echo Yii::app()->baseUrl;?>/ReservationInfo/create">New Reservation</a></li>
    <li><a href="<?php echo Yii::app()->baseUrl;?>/ReservationInfo/admin">Reservation List</a></li>
    </ul>
</li>

<?php } ?>
<!--------End Configration Ctrl------->











<?php 
$login=""; $logout="";
if(Yii::app()->user->isGuest){
$logout="none";
}else{
$login="none";

}

?>
<li style="display:<?php echo $login;?>"><a href="<?php echo Yii::app()->baseUrl;?>/site/login">Login</a></li>

<li style="display:<?php echo $logout;?>"><a href="<?php echo Yii::app()->baseUrl;?>/site/logout">Logout(<?php echo Yii::app()->user->name;?>)</a></li>


<!--
<li style="display:<?php echo 'non';?>"><a href="#">Folder 1</a>
  <ul>
  <li><a href="#">Sub Item 1.1</a></li>
  <li><a href="#">Sub Item 1.2</a></li>
  <li><a href="#">Sub Item 1.3</a></li>
  <li><a href="#">Sub Item 1.4</a></li>
  </ul>
</li>
<li><a href="#">Item 3</a></li>
<li><a href="#">Folder 2</a>
  <ul>
  <li><a href="#">Sub Item 2.1</a></li>
  <li><a href="#">Folder 2.1</a>
    <ul>
    <li><a href="#">Sub Item 2.1.1</a></li>
    <li><a href="#">Sub Item 2.1.2</a></li>
    <li><a href="#">Folder 3.1.1</a>
		<ul>
    		<li><a href="#">Sub Item 3.1.1.1</a></li>
    		<li><a href="#">Sub Item 3.1.1.2</a></li>
    		<li><a href="#">Sub Item 3.1.1.3</a></li>
    		<li><a href="#">Sub Item 3.1.1.4</a></li>
    		<li><a href="#">Sub Item 3.1.1.5</a></li>
		</ul>
    </li>
    <li><a href="#">Sub Item 2.1.4</a></li>
    </ul>
  </li>
  </ul>
</li> -->

</ul>
<br style="clear: left" />

</div>


</div>


<div class="container" id="page">

	<div id="header">
    <div id="logo" style="height:60px;">
		<div style="float:right; width:200px; height:71px; margin-top:0px; background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/mce_logo.png); background-repeat:no-repeat"></div>
        
        <?php //echo CHtml::encode(Yii::app()->name); ?>
        <?php //echo yii::app()->user->clinic_branch_id."-".yii::app()->user->clinic_id;
		if(Yii::app()->user->isGuest){
		$test="";
		$logo="";
		}else{
			$cid=yii::app()->user->hotel_id;
			$clinicname=HotelTitle::model()->findAll("id=$cid");
			foreach($clinicname as $rw){
					$test=$rw['title'];
					$logo =$rw['logo_image'];	
				}
			//$test = $cid;
		
		}
		//echo $test;
	
		

		?>
        
		<div style="float:left; width:300px; height:75px; margin-top:0px; background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/hotel_logos/<?php echo $logo;?>); background-repeat:no-repeat"></div>
		
       
      
      </div>
      
		<div id="logo"><?php //echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
	?>
	<div id="mainmenu">
		<?php 
		
		/*$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		));
		*/
		
		/*
		$this->widget('ext.cssmenu.CssMenu',array(
    'items'=>array(
        array('label'=>'Home', 'url'=>array('site/index')),
        array('label'=>'Products', 'url'=>array('product/index'), 
		'items'=>array(
            array('label'=>'New Arrivals', 'url'=>array('product/new')),
            array('label'=>'Most Popular', 'url'=>array('product/index')),
        )),
       array('label'=>'Login', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest),
    ),
));

*/
	?>
	
	
</div>

	<!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

<?php 

			/*$session=new CHttpSession;
  			$session->open();
			
  			$hotel_branch_id = $session['hotel_branch_id'];
			
			$session->close();
			echo " Branch Id is  ".$hotel_branch_id;
			
			*/
			
			if(isset(Yii::app()->user->branch_id)){
			//echo "Branch id is   ".Yii::app()->user->branch_id;	
			}
			
			
?>
	<?php echo $content; ?>
	

<div id="footer">

		Copyright &copy; <?php echo date('Y'); ?> by Maaliksoft.<br/>
		All Rights Reserved.<br/>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>