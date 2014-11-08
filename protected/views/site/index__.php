<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i> Dashboard</h1>



<div class="span-23 showgrid">
<div class="dashboardIcons span-16" style="width:100%">



<!--<div class="dashIcon span-3">
        <a href="<?php //echo Yii::app()->baseUrl; ?>/subcontractors/admin"><img src="<?php //echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-people.png" alt="Subcontractors" /></a>
        <div class="dashIconText"><a href="<?php //echo Yii::app()->baseUrl; ?>/subcontractors/admin">Subcontractors</a></div>
    </div>-->
    
     <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/GuestInfo/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-information.png" alt="Guests" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/GuestInfo/admin">Guests Info</a></div>
    </div>
    
     <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/ReservationInfo/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-chain.png" alt="reservations" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/ReservationInfo/admin">Reservations</a></div>
    </div>    
   
    
     <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/CheckinInfo/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-footprints.png" alt="checkin" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/CheckinInfo/admin">Checkin</a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/RoomMaster/roomsgrid"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-house.png" alt="roomtype" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/RoomMaster/roomsgrid">Rooms Grid</a></div>
    </div>   
    
    <!--<div class="dashIcon span-3">
        <a href="<?php //echo Yii::app()->baseUrl; ?>/HmsRoomType/admin"><img src="<?php //echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-house.png" alt="roomtype" /></a>
        <div class="dashIconText"><a href="<?php //echo Yii::app()->baseUrl; ?>/HmsRoomType/admin">Room Types</a></div>
    </div>   --> 
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/Services/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-dinner.png" alt="Services" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/Services/admin">Services</a></div>
    </div>     
    
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/Company/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-dribble2.png" alt="companyinfo" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/Company/admin">Company Info</a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/Country/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-earth.png" alt="countries" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/Country/admin">Country Setup</a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/ExchangeRate/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-tags-cash.png" alt="exchangerates" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/ExchangeRate/admin">Exchange Rates</a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/Newspapers/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-files.png" alt="newspapers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/Newspapers/admin">Newspapers</a></div>
    </div>
    
   
     <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/Flights/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-plane.png" alt="Flight Info" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/Flights/admin">Flight Info</a></div>
    </div>
   
    
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/Identity/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-contact.png" alt="identity" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/Identity/admin">Identity Docs</a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/SalePerson/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-talk.png" alt="salesperson" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/SalePerson/admin">Sales Persons</a></div>
    </div>


    
</div><!-- END OF .dashIcons -->

</div>
