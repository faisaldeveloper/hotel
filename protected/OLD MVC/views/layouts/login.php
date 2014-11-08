<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
 	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
<style type="text/css">
<?php if(Yii::app()->language=='ar'){?>
input{
	 direction: rtl;
}
<?php }?>
#box{    
margin: 0;
box-shadow: 0px 4px 9px #000000;
line-height: 100%;
border-radius: 1em;

/*-webkit-box-shadow: 0 1px 15px rgba(0, 0, 0, .4);
-moz-box-shadow: 1px 1px 3px rgba(0, 0, 0, .4);*/
background:#FAFAFA;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#a9a9a9', endColorstr='#7a7a7a');
background: -webkit-gradient(linear, left top, left bottom, from(#f0f0f0), to(#fafafa));
background: -moz-linear-gradient(top, #FAFAFA, #CCC);
border: solid 5px #FFF;
width:450px;
height:auto;
margin-left:auto;
margin-right:auto;
}
  </style>
</head>

<body>
<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
 
      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
 
      <!-- Be sure to leave the brand out there if you want it shown -->
      <a class="brand" href="#"><?php echo Yii::t('loginlayout','Hotel Management System');?></a>
 
      <!-- Everything you want hidden at 940px or less, place within here -->
      <div class="nav-collapse collapse">
      <ul class="nav">
      <li class="active"><a href="#"><?php echo Yii::t('loginlayout','Home');?></a></li>
      <li><a href="http://elodger.com" target="new"><?php echo Yii::t('loginlayout','Elodger Website');?></a></li>
      <li><a href="products.html"><?php echo Yii::t('loginlayout','Our Products');?></a></li>
      
      
      
    </ul>
    <ul class="nav" style="float:right">
    <li>
    <?php
if(Yii::app()->language=='ar'){
echo Chtml::link(Yii::t('layout','English'),'#',array('submit'=>array('site/login','lang'=>'en'),'confirm'=>'This change is for this session only. Permanent change required configuration changes.'));
}else{
echo Chtml::link(Yii::t('layout','Arabic'),'#',array('submit'=>array('site/login','lang'=>'ar'),'confirm'=>'This change is for this session only. Permanent change required configuration changes.'));
}
?>
</li>
    </ul>
        <!-- .nav, .navbar-search, .navbar-form, etc -->
      </div>
 
    </div>
  </div>
</div>



<?php echo $content; ?>
 
 <hr class="featurette-divider">
 
 <!------------------------>
 
</body>
</html>