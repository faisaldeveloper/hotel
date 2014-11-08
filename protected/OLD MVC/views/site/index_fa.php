<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i> Dashboard</h1>
<?php 

/* $sql = "select chkin_id, service_id from 'hms_guest_ledger' where id = (select MAX(id) FROM `hms_guest_ledger` WHERE  id > 8000)";

$sql = "select distinct(chkin_id) from hms_guest_ledger where 1 limit 0 , 100";

$res = Yii::app()->db->createCommand($sql)->execute();
//echo "----------".count($res);
//print_r($res);


foreach($res as $row){
echo "<br> - ". $row['chkin_id'];
}

exit; */
?>
<style>

a{
	font-family:"Arial Black", Gadget, sans-serif;
	font-weight:600;
	color:#900;
	
}
</style>

<div class="span-23 showgrid">
<div class="dashboardIcons span-16" style="width:100%">

   
     <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/GuestInfo/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-information.png" alt="Guests" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/GuestInfo/admin"><?php echo Yii::t('views','Manage Guests'); ?></a></div>
    </div>
    
     <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/ReservationInfo/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-chain.png" alt="reservations" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/ReservationInfo/admin"><?php echo Yii::t('views','Reservations'); ?></a></div>
    </div>    
   
    
     <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/CheckinInfo/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-footprints.png" alt="checkin" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/CheckinInfo/admin"><?php echo Yii::t('views','Check-ins'); ?></a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/RoomMaster/roomsgrid"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-house.png" alt="roomtype" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/RoomMaster/roomsgrid"><?php echo Yii::t('views','Rooms Grid'); ?></a></div>
    </div>   
    
    <!--<div class="dashIcon span-3">
        <a href="<?php //echo Yii::app()->baseUrl; ?>/HmsRoomType/admin"><img src="<?php //echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-house.png" alt="roomtype" /></a>
        <div class="dashIconText"><a href="<?php //echo Yii::app()->baseUrl; ?>/HmsRoomType/admin">Room Types</a></div>
    </div>   --> 
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/Services/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-dinner.png" alt="Services" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/Services/admin"><?php echo Yii::t('views','Services'); ?></a></div>
    </div>     
    
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/Company/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-dribble2.png" alt="companyinfo" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/Company/admin"><?php echo Yii::t('views','Company Info'); ?></a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/Country/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-earth.png" alt="countries" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/Country/admin"><?php echo Yii::t('views','Country Setup'); ?></a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/Flights/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-plane.png" alt="Flight Info" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/Flights/admin"><?php echo Yii::t('views','Flight Info'); ?></a></div>
    </div>
    
   <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/CheckinInfo/inhouse"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-files.png" alt="in-house" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/CheckinInfo/inhouse"  target="_blank"><?php echo Yii::t('views','In-House Report'); ?></a></div>
    </div>
    
     <?php /*?><div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/Newspapers/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-tags-cash.png" alt="newspapers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/Newspapers/admin">Newspapers</a></div>
    </div>    
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/Identity/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-contact.png" alt="identity" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/Identity/admin">Identity Docs</a></div>
    </div><?php */?>
    
   <?php /*?> <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/SalePerson/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-talk.png" alt="salesperson" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/SalePerson/admin">Sales Persons</a></div>
    </div><?php */?>


    
</div><!-- END OF .dashIcons -->

</div>
