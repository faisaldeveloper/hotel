<?php
//$this->breadcrumbs=array(	$this->module->id,);
?>
<h1><?php //echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i> - [Super Amin] - Dashboard</h1>

<div class="span-23 showgrid">
<div class="dashboardIcons span-16" >


<div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/hmcontrol/Hoteltitle/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/newhotel.jpg" alt="Hotels" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/hmcontrol/Hoteltitle/admin">Hotels</a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/hmcontrol/Hmsbranches/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/branch.jpg" alt="Branches" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/hmcontrol/Hmsbranches/admin">Branches</a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/hmcontrol/User/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/accounts.png" alt="Users" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/hmcontrol/User/admin">Users</a></div>
    </div>   
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/srbac/authitem/frontpage"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-people.png" alt="User Rights" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/srbac/authitem/frontpage">User Rights</a></div>
    </div>
         
</div><!-- END OF .dashIcons -->
</div>
