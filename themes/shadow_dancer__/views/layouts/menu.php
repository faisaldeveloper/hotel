<?php
$currentURL = $_SERVER["REQUEST_URI"]; 
$urlCount = count(explode("/", $currentURL));
 if($urlCount > 2){	 $controller_res = explode("/", $currentURL); }
 $Controller = $controller_res[2];
 
 if($Controller=="ReservationInfo"){
	 	echo $spaces;	
	 	echo CHtml::link('Reservations',array('ReservationInfo/admin'), array("style"=>"text-decoration:none; color: #FFF;")); 
	 	echo $spaces;
 		echo CHtml::link('Forecast',array('ReservationInfo/Forecast'), array("style"=>"text-decoration:none; color: #FFF;"));
 		echo $spaces; 
 		echo CHtml::link('Today',array('ReservationInfo/today'), array("style"=>"text-decoration:none; color: #FFF;")); 
 		
 }else if($Controller=="GuestInfo"){
	 	echo $spaces;	
	 	echo CHtml::link('GuestInfo',array('GuestInfo/admin'), array("style"=>"text-decoration:none; color: #FFF;"));  		 
 
 }else if($Controller=="RoomMaster"){
	 	echo $spaces;	
	 	echo CHtml::link('Manage Rooms',array('RoomMaster/admin'), array("style"=>"text-decoration:none; color: #FFF;"));
		echo $spaces;	
	 	echo CHtml::link('Rooms Grid',array('RoomMaster/Roomsgrid'), array("style"=>"text-decoration:none; color: #FFF;"));
		echo $spaces;	
	 	echo CHtml::link('Occupied Rooms',array('RoomMaster/Occupiedgrid'), array("style"=>"text-decoration:none; color: #FFF;"));
		echo $spaces;	
	 	echo CHtml::link('Vacant Rooms',array('RoomMaster/Vacantgrid'), array("style"=>"text-decoration:none; color: #FFF;"));
		echo $spaces;	
	 	echo CHtml::link('Room Shift',array('RoomMaster/Roomshift'), array("style"=>"text-decoration:none; color: #FFF;"));
		
		
		
		  		 
 
 } else if($Controller=="CheckinInfo"){
	 	echo $spaces;	
	 	echo CHtml::link('Checkin List',array('CheckinInfo/admin'), array("style"=>"text-decoration:none; color: #FFF;"));
		echo $spaces;	
	 	echo CHtml::link('Re-Checkin',array('CheckinInfo/recheckin'), array("style"=>"text-decoration:none; color: #FFF;"));
		echo $spaces;	
	 	echo CHtml::link('Inhouse Report',array('CheckinInfo/inhouse'), array('target'=>'_blank', "style"=>"text-decoration:none; color: #FFF;"));
		
				  		 
 
 }else if($Controller=="GuestInfo"){
	 	echo $spaces;	
	 	echo CHtml::link('GuestInfo',array('GuestInfo/admin'), array("style"=>"text-decoration:none; color: #FFF;"));  		 
 
 }else if($Controller=="GuestInfo"){
	 	echo $spaces;	
	 	echo CHtml::link('GuestInfo',array('GuestInfo/admin'), array("style"=>"text-decoration:none; color: #FFF;"));  		 
 
 }else if($Controller=="GuestInfo"){
	 	echo $spaces;	
	 	echo CHtml::link('GuestInfo',array('GuestInfo/admin'), array("style"=>"text-decoration:none; color: #FFF;"));  		 
 }

?>

<?php
/////////////----------------				Manager Menu
$menu_array_manager = array(
	'items'=>array(
      array('label'=>Yii::t('zii','Home'), 'url'=>array('/index.php')), 
	  
	  ////////// General Setup
	  array('label'=>Yii::t('zii','Setup'), 'url'=>array('/HmsFloor/admin'), 
	  	 'items'=>array(
		 	
		   array('label'=>Yii::t('zii','Floor'), 'url'=>array('/HmsFloor/admin',)),
           array('label'=>Yii::t('zii','Room Types'), 'url'=>array('/HmsRoomType/admin',)),
           array('label'=>Yii::t('zii','Room Master'), 'url'=>array('/RoomMaster/admin',)),
		   array('label'=>Yii::t('zii','Company Room Rates'), 'url'=>array('/RoomTypeRate/admin',)),
		   
		   array('label'=>Yii::t('zii','Services Management'), 'url'=>array('/Services/admin', )),
           array('label'=>Yii::t('zii','Services GST'), 'url'=>array('/ServiceGst/admin', )),
           array('label'=>Yii::t('zii','Flight Management'), 'url'=>array('/Flights/admin',)),
		   
		   array('label'=>Yii::t('zii','Identity Management'), 'url'=>array('/Identity/admin',)),
           array('label'=>Yii::t('zii','Salutations'), 'url'=>array('/Salutation/admin', )),
           array('label'=>Yii::t('zii','Newspapers'), 'url'=>array('/Newspapers/admin',)),
		   
		   array('label'=>Yii::t('zii','Sales Persons'), 'url'=>array('/SalePerson/admin',)),
		  // array('label'=>Yii::t('zii','User Management'), 'url'=>array('/user/admin',)),
		  // array('label'=>Yii::t('zii','User Rights'), 'url'=>array('/srbac/authitem/frontpage',)),	
		   
		    array('label'=>Yii::t('zii','Company Setup'), 'url'=>array('/Company/admin',)),
           array('label'=>Yii::t('zii','Countries'), 'url'=>array('/Country/admin', )),
           array('label'=>Yii::t('zii','Exchange Rates'), 'url'=>array('/ExchangeRate/admin', )),   
		   array('label'=>Yii::t('zii','For Tax Control'), 'url'=>array('/CheckinInfo/taxcontrol', )),   
		  )),
		
		//Guests
		 array('label'=>Yii::t('zii','Guests'), 'url'=>array('/GuestInfo/admin'),
	  	'items'=>array(		   
           array('label'=>Yii::t('zii','Guest List'), 'url'=>array('/GuestInfo/admin',)), 
		   array('label'=>Yii::t('zii','New Guest'), 'url'=>array('/GuestInfo/create', )),   
	  	)),		
		//reservations
		 array('label'=>Yii::t('zii','Reservations'), 'url'=>array('/ReservationInfo/admin'),
	  	'items'=>array(		   
           array('label'=>Yii::t('zii','Reservation List'), 'url'=>array('/ReservationInfo/admin',)),
		   array('label'=>Yii::t('zii','New Reservation'), 'url'=>array('/ReservationInfo/create',)),	 
		   array('label'=>Yii::t('zii','Cancelled Reservations'), 'url'=>array('/ReservationInfo/Rsv_Cancelled',)),	   
		   array('label'=>Yii::t('zii','Calendar'), 'url'=>array('/ReservationInfo/calendar',)),
		   array('label'=>Yii::t('zii','Today'), 'url'=>array('/ReservationInfo/today',)),
	  	)),
		//check in
		 array('label'=>Yii::t('zii','Check In'), 'url'=>array('/CheckinInfo/admin'),
	  	'items'=>array(
		array('label'=>Yii::t('zii','Checkin List'), 'url'=>array('/CheckinInfo/admin',)),
		   array('label'=>Yii::t('zii','New Checkin'), 'url'=>array('/CheckinInfo/create',)),           
		   array('label'=>Yii::t('zii','DayClose'), 'url'=>array('/GuestLedger/DayClose',)),		   
		  // array('label'=>Yii::t('zii','--------------'), 'url'=>array('',)),	   
	  	)),
		
		//folio	  	   
		array('label'=>Yii::t('zii','Folios'), 'url'=>array('/CheckinInfo/roomsgrid'),
	  	'items'=>array(
			array('label'=>Yii::t('zii','Folio Grid'), 'url'=>array('/CheckinInfo/roomsgrid',)), 
			array('label'=>Yii::t('zii','Split Folio'), 'url'=>array('/GuestLedger/split',)),   
	   		array('label'=>Yii::t('zii','Merge Bills'), 'url'=>array('/GuestLedger/merge',)),
			array('label'=>Yii::t('zii','BTC Payment'), 'url'=>array('/GuestLedger/btc',)),	
			array('label'=>Yii::t('zii','Old Folios'), 'url'=>array('/GuestLedger/oldfolio',)),		    	    
	  		)), 
		
		//reports
		 array('label'=>Yii::t('zii','Reports'), 'url'=>array('/Reports/Panel'),
	  	'items'=>array(	   
		   array('label'=>Yii::t('zii','Panel'), 'url'=>array('/Reports/Panel')),		  
	  	)),		
	  //////////////////////////////     
       array('label'=>Yii::t('zii','Login'), 'url'=>array('/Site/login'), 'visible'=>Yii::app()->user->isGuest),
       array('label'=>Yii::t('zii','Logout').'('.ucfirst(Yii::app()->user->name).')', 'url'=>array('/Site/logout'), 'visible'=>!Yii::app()->user->isGuest)),
	);
	
	/////////////----------------				Frontdesk Menu
	
	$menu_array_frontdesk = array(
		'items'=>array(
      	array('label'=>Yii::t('zii','Home'), 'url'=>array('/index.php')), 
		
		//Guests
		 array('label'=>Yii::t('zii','Guests'), 'url'=>array('/GuestInfo/admin'),
	  	'items'=>array(
		array('label'=>Yii::t('zii','Guest List'), 'url'=>array('/GuestInfo/admin',)),
		   array('label'=>Yii::t('zii','New Guest'), 'url'=>array('/GuestInfo/create', )),                
	  	)),		
		//reservations
		 array('label'=>Yii::t('zii','Reservations'), 'url'=>array('/ReservationInfo/admin'),
	  	'items'=>array(
		array('label'=>Yii::t('zii','Reservation List'), 'url'=>array('/ReservationInfo/admin',)),
		   array('label'=>Yii::t('zii','New Reservation'), 'url'=>array('/ReservationInfo/create',)),           	 
		   array('label'=>Yii::t('zii','Cancelled Reservations'), 'url'=>array('/ReservationInfo/Rsv_Cancelled',)),	   
		   array('label'=>Yii::t('zii','Calendar'), 'url'=>array('/ReservationInfo/calendar',)),
		   array('label'=>Yii::t('zii','Today'), 'url'=>array('/ReservationInfo/today',)),
	  	)),
		//check in
		 array('label'=>Yii::t('zii','Check In'), 'url'=>array('/CheckinInfo/admin'),
	  	'items'=>array(
		 array('label'=>Yii::t('zii','Checkin List'), 'url'=>array('/CheckinInfo/admin',)),
		   array('label'=>Yii::t('zii','New Checkin'), 'url'=>array('/CheckinInfo/create',)),          
		   array('label'=>Yii::t('zii','DayClose'), 'url'=>array('/GuestLedger/DayClose',)),		   
		  // array('label'=>Yii::t('zii','--------------'), 'url'=>array('',)),	   
	  	)),
	  
	  	array('label'=>Yii::t('zii','Folios'), 'url'=>array('/CheckinInfo/roomsgrid'),
	  	'items'=>array(
			array('label'=>Yii::t('zii','Folio Grid'), 'url'=>array('/CheckinInfo/roomsgrid',)), 
			array('label'=>Yii::t('zii','Split Folio'), 'url'=>array('/GuestLedger/split',)),   
	   		array('label'=>Yii::t('zii','Merge Bills'), 'url'=>array('/GuestLedger/merge',)),
			array('label'=>Yii::t('zii','BTC Payment'), 'url'=>array('/GuestLedger/btc',)),		    
	  		)), 
			
			//////////////////////////////     
       array('label'=>Yii::t('zii','Login'), 'url'=>array('/Site/login'), 'visible'=>Yii::app()->user->isGuest),
       array('label'=>Yii::t('zii','Logout').'('.ucfirst(Yii::app()->user->name).')', 'url'=>array('/Site/logout'), 'visible'=>!Yii::app()->user->isGuest)),
	  
	);	 
	
	/////////////----------------				Auditor Menu
	
	$menu_array_auditor = array(
		'items'=>array(
      	array('label'=>Yii::t('zii','Home'), 'url'=>array('/index.php')), 
	  
	  	array('label'=>Yii::t('zii','Folios'), 'url'=>array('/CheckinInfo/roomsgrid'),
	  	'items'=>array(
			array('label'=>Yii::t('zii','Folio Grid'), 'url'=>array('/CheckinInfo/roomsgrid',)), 
			array('label'=>Yii::t('zii','Split Folio'), 'url'=>array('/GuestLedger/split',)),   
	   		array('label'=>Yii::t('zii','Merge Bills'), 'url'=>array('/GuestLedger/merge',)),
			array('label'=>Yii::t('zii','BTC Payment'), 'url'=>array('/GuestLedger/btc',)),		    
	  		)), 
			
			//////////////////////////////     
       array('label'=>Yii::t('zii','Login'), 'url'=>array('/Site/login'), 'visible'=>Yii::app()->user->isGuest),
       array('label'=>Yii::t('zii','Logout').'('.ucfirst(Yii::app()->user->name).')', 'url'=>array('/Site/logout'), 'visible'=>!Yii::app()->user->isGuest)),
	  
	);	 
    
  ////////--------------      End oF Menu  
    
    ?>