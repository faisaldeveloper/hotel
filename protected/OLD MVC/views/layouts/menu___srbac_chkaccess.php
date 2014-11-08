<?php
//$mitems  = array();

//if(Yii::app()->user->checkAccess('HmsFloorView')) $mitems[0] = array('label'=>Yii::t('views','Floor'), 'url'=>array('/HmsFloor/admin',));
/////////////----------------				Manager Menu
$menu_array_manager = array( //back office menu
	'items'=>array(
      array('label'=>Yii::t('views','Dashboard'), 'url'=>array('/index.php')), 
	  	  
	  ////////// General Setup
	  array('label'=>Yii::t('views','Setup'), 'url'=>array('/HmsFloor/admin'), 
	  	 'items'=>array(
		 	
		   array('label'=>Yii::t('views','Manage Floors'), 'url'=>array('/HmsFloor/admin',)),
           array('label'=>Yii::t('views','Manage Room Types'), 'url'=>array('/HmsRoomType/admin',)),
           array('label'=>Yii::t('views','Manage Rooms'), 'url'=>array('/RoomMaster/admin',)),
		   array('label'=>Yii::t('views','Manage Company Rates'), 'url'=>array('/RoomTypeRate/admin',)),
		   
		   //array('label'=>Yii::t('views','Manage Service'), 'url'=>array('/Services/admin', )),
           array('label'=>Yii::t('views','Manage GST'), 'url'=>array('/ServiceGst/admin', )),
           array('label'=>Yii::t('views','Manage Flights'), 'url'=>array('/Flights/admin',)),
		   
		   //array('label'=>Yii::t('views','Identity Docs'), 'url'=>array('/Identity/admin',)),
           array('label'=>Yii::t('views','Manage Salutations'), 'url'=>array('/Salutation/admin'), ),	   
		  )),
	/////////////////////
		//auditor's task
		array('label'=>Yii::t('views','Auditor\'s Task'), 'url'=>array('/HmsFloor/admin'), 
	  	 'items'=>array(
		 	 array('label'=>Yii::t('views','Night Post'), 'url'=>array('/GuestLedger/Nightpost',)),   
		  	 array('label'=>Yii::t('views','DayClose'), 'url'=>array('/GuestLedger/DayClose',)),
			 array('label'=>Yii::t('views','Charge Code-wise Summary'), 'url'=>array('/GuestLedger/Codewise',)),	
			 array('label'=>Yii::t('views','Control Sheet'), 'url'=>array('/GuestLedger/controlsheet',)),	
			 //array('label'=>Yii::t('views','Manage Tax Control'), 'url'=>array('/CheckinInfo/taxcontrol', )),   
			
			 array('label'=>Yii::t('views','BTC Payment'), 'url'=>array('/GuestLedger/btc',)),	     
		  )),
		  
		  
		  ////Rooms
		  array('label'=>Yii::t('views','Rooms'), 'url'=>array('/RoomMaster/Roomsgrid'),
	  	'items'=>array(
			array('label'=>Yii::t('views','Rooms Grid'), 'url'=>array('/RoomMaster/roomsgrid',)),
			array('label'=>Yii::t('views','Occupied Rooms'), 'url'=>array('/RoomMaster/Occupiedgrid',)),
			array('label'=>Yii::t('views','Vacant Rooms'), 'url'=>array('/RoomMaster/Vacantgrid',)),
			array('label'=>Yii::t('views','Manage Rooms'), 'url'=>array('/RoomMaster/admin',)),	
			array('label'=>Yii::t('views','Room Shift'), 'url'=>array('/RoomMaster/Roomshift',)),			 
	  		)), 
		
		//Guests
		 array('label'=>Yii::t('views','Guests'), 'url'=>array('/GuestInfo/admin'),
	  	'items'=>array(		   
           array('label'=>Yii::t('views','Guest List'), 'url'=>array('/GuestInfo/admin',)), 
		   //array('label'=>Yii::t('views','New Guest'), 'url'=>array('/GuestInfo/create', )),   
	  	)),	
		
			
		//reservations
		 array('label'=>Yii::t('views','Reservations'), 'url'=>array('/ReservationInfo/admin'),
	  	'items'=>array(		   
           array('label'=>Yii::t('views','Reservation List'), 'url'=>array('/ReservationInfo/admin',)),
		   //array('label'=>Yii::t('views','New Reservation'), 'url'=>array('/ReservationInfo/create',)),	 
		   //array('label'=>Yii::t('views','Cancelled Reservations'), 'url'=>array('/ReservationInfo/Rsv_Cancelled',)),	   
		   array('label'=>Yii::t('views','Calendar'), 'url'=>array('/ReservationInfo/calendar',)),
		   //array('label'=>Yii::t('views','Today'), 'url'=>array('/ReservationInfo/today',)),
	  	)),
		
		//check in
		 array('label'=>Yii::t('views','Check In'), 'url'=>array('/CheckinInfo/admin'),
	  	'items'=>array(
		array('label'=>Yii::t('views','Checkin List'), 'url'=>array('/CheckinInfo/admin',)),
		array('label'=>Yii::t('views','Re-Checkin'), 'url'=>array('/CheckinInfo/recheckin',)),
		array('label'=>Yii::t('views','Inhouse Report'), 'url'=>array('/CheckinInfo/inhouse'), 'linkOptions'=>array('target'=>'_blank')),		
	  	)),
		
		//folio	  	   
		array('label'=>Yii::t('views','Folios'), 'url'=>array('/CheckinInfo/admin'),
	  	'items'=>array(		
			array('label'=>Yii::t('views','Folio List'), 'url'=>array('/CheckinInfo/admin',)),			 
			array('label'=>Yii::t('views','Split Folio'), 'url'=>array('/GuestLedger/split',)),   
	   		array('label'=>Yii::t('views','Merge Bills'), 'url'=>array('/GuestLedger/merge',)),					
			array('label'=>Yii::t('views','Old Folios'), 'url'=>array('/GuestLedger/oldfolio',)),		    	    
	  		)), 
		
		//reports
		 array('label'=>Yii::t('views','Reports'), 'url'=>array('/Reports/Panel'),
	  	'items'=>array(	   
		   array('label'=>Yii::t('views','Panel'), 'url'=>array('/Reports/Panel')),		  
	  	)),		
	  //////////////////////////////     
       array('label'=>Yii::t('views','Login'), 'url'=>array('/Site/login'), 'visible'=>Yii::app()->user->isGuest),
       array('label'=>Yii::t('views','Logout'), 'url'=>array('/Site/logout'), 'visible'=>!Yii::app()->user->isGuest)),
	);
	
	/////////////----------------				Frontdesk Menu
	
	$menu_array_frontdesk = array(
		'items'=>array(
      	array('label'=>Yii::t('views','Home'), 'url'=>array('/index.php')), 
		
				
		 ////Rooms
		  array('label'=>Yii::t('views','Rooms'), 'url'=>array('/RoomMaster/Roomsgrid'),
	  	'items'=>array(			
			array('label'=>Yii::t('views','Rooms Grid'), 'url'=>array('/RoomMaster/Roomsgrid',)),
			array('label'=>Yii::t('views','Occupied Rooms'), 'url'=>array('/RoomMaster/Occupiedgrid',)),
			array('label'=>Yii::t('views','Vacant Rooms'), 'url'=>array('/RoomMaster/Vacantgrid',)),
			array('label'=>Yii::t('views','Manage Rooms'), 'url'=>array('/RoomMaster/admin',)),
			array('label'=>Yii::t('views','Room Shift'), 'url'=>array('/RoomMaster/Roomshift',)),				 
	  		)), 
		
		//Guests
		 array('label'=>Yii::t('views','Guests'), 'url'=>array('/GuestInfo/admin'),
	  	'items'=>array(
		 array('label'=>Yii::t('views','Guest List'), 'url'=>array('/GuestInfo/admin',)), 
		   //array('label'=>Yii::t('views','New Guest'), 'url'=>array('/GuestInfo/create', )),                
	  	)),		
		
		
		//reservations
		 array('label'=>Yii::t('views','Reservations'), 'url'=>array('/ReservationInfo/admin'),
	  	'items'=>array(		   
           array('label'=>Yii::t('views','Reservation List'), 'url'=>array('/ReservationInfo/admin',)),		      		   		  
		   //array('label'=>Yii::t('views','Cancelled Reservations'), 'url'=>array('/ReservationInfo/Rsv_Cancelled',)),	
		   array('label'=>Yii::t('views','Today'), 'url'=>array('/ReservationInfo/today',)),
	  	)),
		
		
		//check in
		 array('label'=>Yii::t('views','Check In'), 'url'=>array('/CheckinInfo/admin'),
	  	'items'=>array(
		    array('label'=>Yii::t('views','Checkin List'), 'url'=>array('/CheckinInfo/admin',)),
			array('label'=>Yii::t('views','Re-Checkin'), 'url'=>array('/CheckinInfo/recheckin',)),
			array('label'=>Yii::t('views','Inhouse Report'), 'url'=>array('/CheckinInfo/inhouse'), 'linkOptions'=>array('target'=>'_blank')),	
			array('label'=>Yii::t('views','Chech-in Chart'), 'url'=>array('/GuestLedger/Charts',)),		    		 
	  	)),
	  
	  
	    //folio	  	   
		array('label'=>Yii::t('views','Folios'), 'url'=>array('/CheckinInfo/admin'),
	  	'items'=>array(		
			array('label'=>Yii::t('views','Folio List'), 'url'=>array('/CheckinInfo/admin',)),			 
			array('label'=>Yii::t('views','Split Folio'), 'url'=>array('/GuestLedger/split',)), 
			array('label'=>Yii::t('views','Merge Bills'), 'url'=>array('/GuestLedger/Mergebills',)),	  
	   		//array('label'=>Yii::t('views','Merge Bills'), 'url'=>array('/GuestLedger/merge',)),					
			array('label'=>Yii::t('views','Old Folios'), 'url'=>array('/GuestLedger/oldfolio',)),	
			    
	  		)), 
			
			//reports
		 array('label'=>Yii::t('views','Reports'), 'url'=>array('/Reports/Show_panel'),
	  	'items'=>array(	   
		   array('label'=>Yii::t('views','Panel'), 'url'=>array('/Reports/Show_panel')),		  
	  	)),	
			
			//////////////////////////////     
       array('label'=>Yii::t('views','Login'), 'url'=>array('/Site/login'), 'visible'=>Yii::app()->user->isGuest),
       array('label'=>Yii::t('views','Logout').'('.ucfirst(Yii::app()->user->name).')', 'url'=>array('/Site/logout'), 'visible'=>!Yii::app()->user->isGuest)),
	  
	);	 
	
	/////////////----------------				Auditor Menu
	
	$menu_array_auditor = array(
		'items'=>array(
      	array('label'=>Yii::t('views','Home'), 'url'=>array('/index.php')), 
		
		 ////////// General Setup
	  array('label'=>Yii::t('views','Setup'), 'url'=>array('/HmsFloor/Admin'), 'visible'=>(Yii::app()->user->checkAccess('HmsFloorAdmin') || Yii::app()->user->checkAccess('HmsRoomTypeAdmin') || Yii::app()->user->checkAccess('RoomMasterAdmin') || Yii::app()->user->checkAccess('RoomTypeRateAdmin') || Yii::app()->user->checkAccess('ServiceGstAdmin') || Yii::app()->user->checkAccess('FlightsAdmin') || Yii::app()->user->checkAccess('SalutationAdmin') ), 
	  	 'items'=>array(
		 	
		   array('label'=>Yii::t('views','Manage Floors'), 'url'=>array('/HmsFloor/Admin'), 'visible'=>Yii::app()->user->checkAccess('HmsFloorAdmin')),
           array('label'=>Yii::t('views','Manage Room Types'), 'url'=>array('/HmsRoomType/Admin'), 'visible'=>Yii::app()->user->checkAccess('HmsRoomTypeAdmin')),
           array('label'=>Yii::t('views','Manage Rooms'), 'url'=>array('/RoomMaster/Admin'), 'visible'=>Yii::app()->user->checkAccess('RoomMasterAdmin')),
		   array('label'=>Yii::t('views','Manage Company Rates'), 'url'=>array('/RoomTypeRate/Admin'), 'visible'=>Yii::app()->user->checkAccess('RoomTypeRateAdmin')),		   
		   //array('label'=>Yii::t('views','Manage Service'), 'url'=>array('/Services/Admin'), 'visible'=>Yii::app()->user->checkAccess('ServicesAdmin')),
           array('label'=>Yii::t('views','Manage GST'), 'url'=>array('/ServiceGst/Admin'), 'visible'=>Yii::app()->user->checkAccess('ServiceGstAdmin')),
           array('label'=>Yii::t('views','Manage Flights'), 'url'=>array('/Flights/Admin'), 'visible'=>Yii::app()->user->checkAccess('FlightsAdmin')),		   
		   //array('label'=>Yii::t('views','Identity Docs'), 'url'=>array('/Identity/Admin'), 'visible'=>Yii::app()->user->checkAccess('IdentityAdmin')),
           array('label'=>Yii::t('views','Manage Salutations'), 'url'=>array('/Salutation/Admin'), 'visible'=>Yii::app()->user->checkAccess('SalutationAdmin')),	   
		  )),
		
		//auditor's task
		array('label'=>Yii::t('views','Auditor\'s Task'), 'url'=>array('/GuestLedger/Nightpost'), 'visible'=>(Yii::app()->user->checkAccess('GuestLedgerNightpost') || Yii::app()->user->checkAccess('GuestLedgerDayClose') || Yii::app()->user->checkAccess('GuestLedgerCodewise') || Yii::app()->user->checkAccess('GuestLedgerControlsheet') || Yii::app()->user->checkAccess('CheckinInfoTaxcontrol') || Yii::app()->user->checkAccess('GuestLedgerChargeCode') || Yii::app()->user->checkAccess('GuestLedgerBtc')), 
	  	 'items'=>array(
		 	 array('label'=>Yii::t('views','Night Post'), 'url'=>array('/GuestLedger/Nightpost'), 'visible'=>Yii::app()->user->checkAccess('GuestLedgerNightpost')),   
		  	 array('label'=>Yii::t('views','DayClose'), 'url'=>array('/GuestLedger/DayClose'), 'visible'=>Yii::app()->user->checkAccess('GuestLedgerDayClose')),	
			 array('label'=>Yii::t('views','Charge Code-wise Summary'), 'url'=>array('/GuestLedger/Codewise'), 'visible'=>Yii::app()->user->checkAccess('GuestLedgerCodewise')),	
			 array('label'=>Yii::t('views','Control Sheet'), 'url'=>array('/GuestLedger/Controlsheet'), 'visible'=>Yii::app()->user->checkAccess('GuestLedgerControlsheet')),	
			 array('label'=>Yii::t('views','Manage Tax Control'), 'url'=>array('/CheckinInfo/Taxcontrol'), 'visible'=>Yii::app()->user->checkAccess('CheckinInfoTaxcontrol')),			    	
			 array('label'=>Yii::t('views','Charge Code-wise'), 'url'=>array('/GuestLedger/ChargeCode'), 'visible'=>Yii::app()->user->checkAccess('GuestLedgerChargeCode')),			 
			 array('label'=>Yii::t('views','BTC Payment'), 'url'=>array('/GuestLedger/Btc'), 'visible'=>Yii::app()->user->checkAccess('GuestLedgerBtc')),	   	     
		  )),
		  
		   //------------------- Rooms
		  array('label'=>Yii::t('views','Rooms'), 'url'=>array('/RoomMaster/Roomsgrid'), 'visible'=>(Yii::app()->user->checkAccess('RoomMasterRoomsgrid') || Yii::app()->user->checkAccess('RoomMasterOccupiedgrid') || Yii::app()->user->checkAccess('RoomMasterVacantgrid') || Yii::app()->user->checkAccess('RoomMasterAdmin') || Yii::app()->user->checkAccess('RoomMasterRoomshift')),
	  	'items'=>array(			
			array('label'=>Yii::t('views','Rooms Grid'), 'url'=>array('/RoomMaster/Roomsgrid'), 'visible'=>Yii::app()->user->checkAccess('RoomMasterRoomsgrid')),
			array('label'=>Yii::t('views','Occupied Rooms'), 'url'=>array('/RoomMaster/Occupiedgrid'), 'visible'=>Yii::app()->user->checkAccess('RoomMasterOccupiedgrid')),
			array('label'=>Yii::t('views','Vacant Rooms'), 'url'=>array('/RoomMaster/Vacantgrid'), 'visible'=>Yii::app()->user->checkAccess('RoomMasterVacantgrid')),
			array('label'=>Yii::t('views','Manage Rooms'), 'url'=>array('/RoomMaster/Admin'), 'visible'=>Yii::app()->user->checkAccess('RoomMasterAdmin')),
			array('label'=>Yii::t('views','Room Shift'), 'url'=>array('/RoomMaster/Roomshift'), 'visible'=>Yii::app()->user->checkAccess('RoomMasterRoomshift')),				 
	  		)), 
			
		//------------------- Guests
		  array('label'=>Yii::t('views','Guests'), 'url'=>array('/GuestInfo/Admin'), 'visible'=>Yii::app()->user->checkAccess('GuestInfoAdmin'),
	  	'items'=>array(
		 array('label'=>Yii::t('views','Guest List'), 'url'=>array('/GuestInfo/Admin',), 'visible'=>Yii::app()->user->checkAccess('GuestInfoAdmin')),		           
	  	)),	 
		
		//------------------- Reservations
		 array('label'=>Yii::t('views','Reservations'), 'url'=>array('/ReservationInfo/Admin'), 'visible'=>(Yii::app()->user->checkAccess('ReservationInfoAdmin') || Yii::app()->user->checkAccess('ReservationInfoCalendar')),
	  	'items'=>array(		   
           array('label'=>Yii::t('views','Reservation List'), 'url'=>array('/ReservationInfo/Admin'), 'visible'=>Yii::app()->user->checkAccess('ReservationInfoAdmin')),		   
		   array('label'=>Yii::t('views','Calendar'), 'url'=>array('/ReservationInfo/Calendar'), 'visible'=>Yii::app()->user->checkAccess('ReservationInfoCalendar')),
		   //array('label'=>Yii::t('views','Today'), 'url'=>array('/ReservationInfo/today',)),
	  	)),
		  
		  //------------------- Check in
		 array('label'=>Yii::t('views','Check In'), 'url'=>array('/CheckinInfo/Admin'), 'visible'=>(Yii::app()->user->checkAccess('CheckinInfoAdmin') || Yii::app()->user->checkAccess('CheckinInfoRecheckin') || Yii::app()->user->checkAccess('CheckinInfoInhouse')),
	  	'items'=>array(
		array('label'=>Yii::t('views','Checkin List'), 'url'=>array('/CheckinInfo/Admin',), 'visible'=>Yii::app()->user->checkAccess('CheckinInfoAdmin')),
		array('label'=>Yii::t('views','Re-Checkin'), 'url'=>array('/CheckinInfo/Recheckin'), 'visible'=>Yii::app()->user->checkAccess('CheckinInfoRecheckin')),
		array('label'=>Yii::t('views','Inhouse Report'), 'url'=>array('/CheckinInfo/Inhouse'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>Yii::app()->user->checkAccess('CheckinInfoInhouse')),		
	  	)),
	  
	  //------------------- Folio	  		  	   
		array('label'=>Yii::t('views','Folios'), 'url'=>array('/CheckinInfo/Admin'), 'visible'=>(Yii::app()->user->checkAccess('CheckinInfoAdmin') || Yii::app()->user->checkAccess('GuestLedgerSplit') || Yii::app()->user->checkAccess('GuestLedgerMergebills') || Yii::app()->user->checkAccess('GuestLedgerOldfolio')),
	  	'items'=>array(		
			array('label'=>Yii::t('views','Folio List'), 'url'=>array('/CheckinInfo/Admin'), 'visible'=>Yii::app()->user->checkAccess('CheckinInfoAdmin')),			 
			array('label'=>Yii::t('views','Split Folio'), 'url'=>array('/GuestLedger/Split'), 'visible'=>Yii::app()->user->checkAccess('GuestLedgerSplit')), 
			array('label'=>Yii::t('views','Merge Bills'), 'url'=>array('/GuestLedger/Mergebills'), 'visible'=>Yii::app()->user->checkAccess('GuestLedgerMergebills')),	   					
			array('label'=>Yii::t('views','Old Folios'), 'url'=>array('/GuestLedger/Oldfolio'), 'visible'=>Yii::app()->user->checkAccess('GuestLedgerOldfolio')),	
			)),	
			
				
		//reports
		 array('label'=>Yii::t('views','Reports'), 'url'=>array('/Reports/Panel'),
	  	'items'=>array(	   
		   array('label'=>Yii::t('views','Panel'), 'url'=>array('/Reports/Panel')),		  
	  	)),	
			
			//////////////////////////////     
       array('label'=>Yii::t('views','Login'), 'url'=>array('/Site/login'), 'visible'=>Yii::app()->user->isGuest),
       array('label'=>Yii::t('views','Logout').'('.ucfirst(Yii::app()->user->name).')', 'url'=>array('/Site/logout'), 'visible'=>!Yii::app()->user->isGuest)),
	  
	);	 
	
	/////////////----------------				Tax Control  Menu
	
	$menu_array_taxcontrol = array(
		'items'=>array(
      	//array('label'=>Yii::t('views','Home'), 'url'=>array('/CheckinInfo/taxcontrol')),		
		//auditor's task
		array('label'=>Yii::t('views','Tax Controller\'s Task'), 'url'=>array('/CheckinInfo/taxcontrol'), 
	  	 'items'=>array(			 
			 array('label'=>Yii::t('views','Manage Tax Control'), 'url'=>array('/CheckinInfo/taxcontrol', )),
		  )),
			//////////////////////////////     
       array('label'=>Yii::t('views','Login'), 'url'=>array('/Site/login'), 'visible'=>Yii::app()->user->isGuest),
       array('label'=>Yii::t('views','Logout').'('.ucfirst(Yii::app()->user->name).')', 'url'=>array('/Site/logout'), 'visible'=>!Yii::app()->user->isGuest)),
	  
	);	 

    
  ////////--------------      End oF Menu  
    
    ?>