<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	
	
	<!-- blueprint CSS framework -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icons.css" />
	 
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tables.css" />
   
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu_iestyles.css" />
   
    
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
<div id="myslidemenu" class="jqueryslidemenu">
	<!-- <div id="mainmenu"> -->
		<?php 
		//'template'=>'<strong>{menu}</strong><span>Sweet Home</span>',
		$this->widget('zii.widgets.CMenu',array(
		'activeCssClass'=>'active',
		'activateParents'=>true,
		'linkLabelWrapper' => 'span',
		'encodeLabel'=>false,
		'htmlOptions' => array( 'style' => 'position: relative; z-index: 1' ),

			'items'=>array
			(
				array('label'=>'Home', 'url'=>array('/site/index'),'linkOptions'=>array('id'=>'menuCompany'),
      'itemOptions'=>array('id'=>'itemCompany'),),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
				
				array('label'=>'Accounts', 'url'=>array('accounts/index'), 'items'=>array
				(
						array('label'=>'Subcontractors', 'url'=>array('subcontractors/admin'), 
						'items'=>array(
						array('label'=>'Create', 'url'=>array('subcontractors/create')),
						array('label'=>'Manage', 'url'=>array('subcontractors/admin')),
						)),
						
						array('label'=>'Vendors', 'url'=>array('vendors/admin'),
						'items'=>array(
						array('label'=>'Create', 'url'=>array('vendors/create')),
						array('label'=>'Manage', 'url'=>array('vendors/admin')),
						)),
						
						array('label'=>'Clients', 'url'=>array('clients/admin'),
						'items'=>array(
						array('label'=>'Create', 'url'=>array('clients/create')),
						array('label'=>'Manage', 'url'=>array('clients/admin')),
						)),
						
						array('label'=>'Drivers', 'url'=>array('drivers/admin'),
						'items'=>array(
						array('label'=>'Create', 'url'=>array('drivers/create')),
						array('label'=>'Manage', 'url'=>array('drivers/admin')),
						)),
						
						array('label'=>'Guards', 'url'=>array('guards/admin'),
						'items'=>array(
						array('label'=>'Create', 'url'=>array('guards/create')),
						array('label'=>'Manage', 'url'=>array('guards/admin')),
						)),
						
						array('label'=>'Employees', 'url'=>array('employees/admin'),
						'items'=>array(
						array('label'=>'Create', 'url'=>array('employees/create')),
						array('label'=>'Manage', 'url'=>array('employees/admin')),
						)),
						
						
					array('label'=>'Accounts', 'url'=>array('accounts/admin'),
						'items'=>array(
						array('label'=>'Create', 'url'=>array('accounts/create')),
						array('label'=>'Manage', 'url'=>array('accounts/admin')),
						)),
					
					array('label'=>'Vouchers', 'url'=>array('ledgers/admin'),
					'items'=>array(
						array('label'=>'Create J/V', 'url'=>array('ledgers/create/1')),
						array('label'=>'Create BPV', 'url'=>array('ledgers/create/2')),
						array('label'=>'Create BRV', 'url'=>array('ledgers/create/3')),
						array('label'=>'Create CPV', 'url'=>array('ledgers/create/4')),
						array('label'=>'Create CRV', 'url'=>array('ledgers/create/5')),
						array('label'=>'Manage Vouchers', 'url'=>array('ledgers/admin')),
						)
					),
					array('label'=>'Chart of Accounts', 'url'=>array('/site/contact'), 'items'=>array
					(
						array('label'=>'Home', 'url'=>array('/site/index')),
						array('label'=>'About', 'url'=>array('/site/page',)),
						array('label'=>'Contact', 'url'=>array('/site/contact'), 'items'=>array
						(
							array('label'=>'Home', 'url'=>array('/site/index')),
							array('label'=>'About', 'url'=>array('/site/page',)),
							array('label'=>'Contact', 'url'=>array('/site/contact')),
						)), 
					)),				
				)),		
				
				
				
				
				
				
				array('label'=>'Rental', 'url'=>array('crews/admin'), 'items'=>array
				(
						array('label'=>'Crews', 'url'=>array('crews/admin'), 
						'items'=>array(
						array('label'=>'Create', 'url'=>array('crews/create')),
						array('label'=>'Manage', 'url'=>array('crews/admin')),
						)),
						
						
				)),		
				
				
				
				
				
				array('label'=>'Inventory', 'url'=>array('inventory/stock'), 'items'=>array
				(
					array('label'=>'Create Inventory', 'url'=>array('inventory/create2')
					
					),
					
					array('label'=>'Issue Inventory', 'url'=>array('issues/create2')
					
					),
					
					array('label'=>'Remaining Stock', 'url'=>array('inventory/stock')
					
					),
					
					array('label'=>'Manage Inventory', 'url'=>array('inventory/admin')
					
					),
					
					array('label'=>'Manage Issuance', 'url'=>array('issues/admin')
					
					),
							
				)),
				
				
				
				
				
				
				
				array('label'=>'Vehicles', 'url'=>array('vehicles/admin'), 'items'=>array
				(
					array('label'=>'Create Vehicles', 'url'=>array('vehicles/create')
					
					),
					
					array('label'=>'Vehicle Documents', 'url'=>array('documents/create')
					
					),
					
					
					array('label'=>'Manage Vehicles', 'url'=>array('vehicles/admin')
					
					),
					
					array('label'=>'Manage Documents', 'url'=>array('documents/admin')
					
					),
					
					
				)),
				
				
				array('label'=>'Settings', 'url'=>'javascript:void(0)', 'items'=>array
				(
					array('label'=>'Create Vehicle Types', 'url'=>array('vehicletypes/create')
					
					),
					
					array('label'=>'Vehicle Documents', 'url'=>array('documents/create')
					
					),
					
					
					array('label'=>'Manage Vehicles', 'url'=>array('vehicles/admin')
					
					),
					
					array('label'=>'Manage Documents', 'url'=>array('documents/admin')
					
					),
					
					
				)),		
						
						
						
						
						
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
		<br style="clear: left" />
	</div>
    
	<div id="topnav">
		<div class="topnav_text"><a href='#'>Home</a> | <a href='#'>My Account</a> | <a href='#'>Settings</a> | <a href='#'>Logout</a> </div>
	</div>
	<div id="header">
		<div id="logo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png"></img><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
    <!--
<?php 
/*
$this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>array(
                array('label'=>'Dashboard', 'url'=>array('/site/index'),'itemOptions'=>array('class'=>'test')),
                array('label'=>'Theme Pages',
                  'items'=>array(
                    array('label'=>'Graphs & Charts', 'url'=>array('/site/page', 'view'=>'graphs'),'itemOptions'=>array('class'=>'icon_chart')),
					array('label'=>'Form Elements', 'url'=>array('/site/page', 'view'=>'forms')),
					array('label'=>'Interface Elements', 'url'=>array('/site/page', 'view'=>'interface')),
					array('label'=>'Error Pages', 'url'=>array('/site/page', 'view'=>'Demo 404 page')),
					array('label'=>'Calendar', 'url'=>array('/site/page', 'view'=>'calendar')),
					array('label'=>'Buttons & Icons', 'url'=>array('/site/page', 'view'=>'buttons_and_icons')),
                  ),
                ),
                array('label'=>'Gii Generated Module',
                  'items'=>array(
                    array('label'=>'Items', 'url'=>array('/theme/index')),
                    array('label'=>'Create Item', 'url'=>array('/theme/create')),
					array('label'=>'Manage Items', 'url'=>array('/theme/admin')),
                  ),
                ),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
            ),
    )); 
	
	*/ ?> --->
    
    
    
    <?php /* ?>
	<div id="mainmenu">
    
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Dashboard', 'url'=>array('/site/index')),
				array('label'=>'Graphs', 'url'=>array('/site/page', 'view'=>'graphs'),'itemOptions'=>array('class'=>'icon_chart')),
				array('label'=>'Form', 'url'=>array('/site/page', 'view'=>'forms')),
				array('label'=>'Interface', 'url'=>array('/site/page', 'view'=>'interface')),				
				array('label'=>'Buttons & Icons', 'url'=>array('/site/page', 'view'=>'buttons_and_icons')),
				array('label'=>'Error Pages', 'url'=>array('/site/page', 'view'=>'Demo 404 page')),
			),
		)); ?>
	</div> <!--mainmenu -->
	
	<?php */ ?>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
 <div id="statusMsg">
<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

</div>
	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by webapplicationthemes.com<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
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