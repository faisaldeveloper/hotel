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
           //array('label'=>Yii::t('views','Newspapers'), 'url'=>array('/Newspapers/admin',)),
		   
		   //array('label'=>Yii::t('views','Sales Persons'), 'url'=>array('/SalePerson/admin',)),
		  // array('label'=>Yii::t('views','User Management'), 'url'=>array('/user/admin',)),
		  // array('label'=>Yii::t('views','User Rights'), 'url'=>array('/srbac/authitem/frontpage',)),			   
		   //array('label'=>Yii::t('views','Manage Companies'), 'url'=>array('/Company/admin',)),
           array('label'=>Yii::t('views','Manage Countries'), 'url'=>array('/Country/admin', )),
           array('label'=>Yii::t('views','DB Backup'), 'url'=>array('/backup/', )),   
		   
		  )),
	/////////////////////
		//auditor's task
		array('label'=>Yii::t('views','Auditor\'s Task'), 'url'=>array('/HmsFloor/admin'), 
	  	 'items'=>array(
		 	 array('label'=>Yii::t('views','Night Post'), 'url'=>array('/GuestLedger/Nightpost',)),   
		  	 array('label'=>Yii::t('views','DayClose'), 'url'=>array('/GuestLedger/DayClose',)),
			 array('label'=>Yii::t('views','Charge Code-wise'), 'url'=>array('/GuestLedger/Codewise',)),	
			 array('label'=>Yii::t('views','Control Sheet'), 'url'=>array('/GuestLedger/controlsheet',)),
			 
			 array('label'=>Yii::t('views','Room Overdue'), 'url'=>array('/Reports/Roomoverdue'), 'linkOptions'=>array('target'=>'_blank')),	
			 //array('label'=>Yii::t('views','Manage Tax Control'), 'url'=>array('/CheckinInfo/taxcontrol', )),   
			/*  array('label'=>Yii::t('views','Manage Account Names'), 'url'=>array('/AccountName/admin', )),   	
			 array('label'=>Yii::t('views','Manage Account Types'), 'url'=>array('/AccountType/admin', )),   	
			 array('label'=>Yii::t('views','Manage Account Ledger'), 'url'=>array('/AccountLedger/admin', )),   */ 	
			/*  array('label'=>Yii::t('views','Company Ledgers'), 'url'=>array('/AccountLedger/company', )),
			 array('label'=>Yii::t('views','Guest Ledgers'), 'url'=>array('/AccountLedger/guest', )),
			 array('label'=>Yii::t('views','Service Ledgers'), 'url'=>array('/AccountLedger/service', )), */
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
		   array('label'=>Yii::t('views','Duplicate Guests'), 'url'=>array('/Ajaxcalls/FindDuplicateGuests', )),   
	  	)),	
		
			
		//reservations
		 array('label'=>Yii::t('views','Reservations'), 'url'=>array('/ReservationInfo/admin'),
	  	'items'=>array(		   
           array('label'=>Yii::t('views','Reservation List'), 'url'=>array('/ReservationInfo/admin',)),
		   //array('label'=>Yii::t('views','Expected Arrivals'), 'url'=>array('/ReservationInfo/create',)),	 
		   //array('label'=>Yii::t('views','Cancelled Reservations'), 'url'=>array('/ReservationInfo/Rsv_Cancelled',)),	   
		  // array('label'=>Yii::t('views','Calendar'), 'url'=>array('/ReservationInfo/calendar',)),
		  array('label'=>Yii::t('views','Forecast'), 'url'=>array('/ReservationInfo/Forecast',)),
		   array('label'=>Yii::t('views','Today Activites'), 'url'=>array('/ReservationInfo/today',)),
		    array('label'=>Yii::t('views','Expected Arrival Report'), 'url'=>array('/Reports/panel','id'=>33)),
	  	)),
		
		//check in
		 array('label'=>Yii::t('views','Check In'), 'url'=>array('/CheckinInfo/admin'),
	  	'items'=>array(
		array('label'=>Yii::t('views','Checkin List'), 'url'=>array('/CheckinInfo/admin',)),
		array('label'=>Yii::t('views','Re-Checkin'), 'url'=>array('/CheckinInfo/recheckin',)),
		array('label'=>Yii::t('views','Inhouse Report'), 'url'=>array('/CheckinInfo/inhouse'), 'linkOptions'=>array('target'=>'_blank')),	
		array('label'=>Yii::t('views','Chech-in Chart'), 'url'=>array('/GuestLedger/Charts',)),		
	  	array('label'=>Yii::t('views','Guest Change'), 'url'=>array('/CheckinInfo/GuestChange',)),	
		)),
		
		//folio	  	   
		array('label'=>Yii::t('views','Folios'), 'url'=>array('/GuestLedger/oldfolio'),
	  	'items'=>array(		
			array('label'=>Yii::t('views','Old Folios'), 'url'=>array('/GuestLedger/oldfolio',)),		
			//array('label'=>Yii::t('views','Folio List'), 'url'=>array('/CheckinInfo/admin',)),			 
			array('label'=>Yii::t('views','Split Folio'), 'url'=>array('/GuestLedger/split',)),   
	   		array('label'=>Yii::t('views','Merge Bills'), 'url'=>array('/GuestLedger/Mergebills',)),					
			
			//array('label'=>Yii::t('views','Split Room Rent'), 'url'=>array('/GuestLedger/divideBill',)), 
			array('label'=>Yii::t('views','Cash Entries'), 'url'=>array('/GuestLedger/Admin',)),   	    
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
		   array('label'=>Yii::t('views','Forecast'), 'url'=>array('/ReservationInfo/Forecast',)),
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
			array('label'=>Yii::t('views','Cash Entries'), 'url'=>array('/GuestLedger/Admin',)),				    
	  		)), 
			
			//reports
		 array('label'=>Yii::t('views','Reports'), 'url'=>array('/Reports/panel'),
	  	'items'=>array(	   
		   array('label'=>Yii::t('views','Panel'), 'url'=>array('/Reports/panel')),		
		   //array('label'=>Yii::t('views','Panel'), 'url'=>array('/Reports/Show_panel')),		  
	  	)),	
			
			//////////////////////////////     
       array('label'=>Yii::t('views','Login'), 'url'=>array('/Site/login'), 'visible'=>Yii::app()->user->isGuest),
       array('label'=>Yii::t('views','Logout').'('.ucfirst(Yii::app()->user->name).')', 'url'=>array('/Site/logout'), 'visible'=>!Yii::app()->user->isGuest)),
	  
	);	 
	
	/////////////----------------				Auditor Menu
	
	$menu_array_auditor = array(
		'items'=>array(
      	array('label'=>Yii::t('views','Home'), 'url'=>array('/index.php')), 
		
		//auditor's task
		array('label'=>Yii::t('views','Auditor\'s Task'), 'url'=>array('/HmsFloor/admin'), 
	  	 'items'=>array(
		 	array('label'=>Yii::t('views','Night Post'), 'url'=>array('/GuestLedger/Nightpost',)),   
		  	 array('label'=>Yii::t('views','DayClose'), 'url'=>array('/GuestLedger/DayClose',)),
			 array('label'=>Yii::t('views','Charge Code-wise'), 'url'=>array('/GuestLedger/Codewise',)),	
			 array('label'=>Yii::t('views','Control Sheet'), 'url'=>array('/GuestLedger/controlsheet',)),			 
			 array('label'=>Yii::t('views','Room Overdue'), 'url'=>array('/Reports/Roomoverdue'), 'linkOptions'=>array('target'=>'_blank')),			
			/*  array('label'=>Yii::t('views','Company Ledgers'), 'url'=>array('/AccountLedger/company', )),
			 array('label'=>Yii::t('views','Guest Ledgers'), 'url'=>array('/AccountLedger/guest', )),
			 array('label'=>Yii::t('views','Service Ledgers'), 'url'=>array('/AccountLedger/service', )), */
			 array('label'=>Yii::t('views','BTC Payment'), 'url'=>array('/GuestLedger/btc',)),	        	     
		  )),
		  
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
		/*  array('label'=>Yii::t('views','Guests'), 'url'=>array('/GuestInfo/admin'),
	  	'items'=>array(
		 array('label'=>Yii::t('views','Guest List'), 'url'=>array('/GuestInfo/admin',)), 
		   //array('label'=>Yii::t('views','New Guest'), 'url'=>array('/GuestInfo/create', )),                
	  	)),	 */
		  
		  //check in
		 array('label'=>Yii::t('views','Check In'), 'url'=>array('/CheckinInfo/admin'),
	  	'items'=>array(
		array('label'=>Yii::t('views','Checkin List'), 'url'=>array('/CheckinInfo/admin',)),
		array('label'=>Yii::t('views','Re-Checkin'), 'url'=>array('/CheckinInfo/recheckin',)),
		array('label'=>Yii::t('views','Inhouse Report'), 'url'=>array('/CheckinInfo/inhouse'), 'linkOptions'=>array('target'=>'_blank')),		
	  	)),
	  
	  //Folio
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