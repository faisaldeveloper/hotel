<?php
class CheckinInfoController extends SBaseController
{
	
	public $layout='//layouts/column1';	
	
	private $username = "leroyal1"; // username
	private $secret_key = "f3ac8d6ae868c09e599e6c32a50fdfb1"; // 32 characters secret key, get it from api page
	private $smsurl = "http://websms.maaliksoft.com:80/api/sendsms.php?"; // change websmsdomain.com to your provided 
	
	public function filters(){
		return array(
			//'accessControl', // perform access control for CRUD operations
		);
	}		
	
	///////////////send sms api functins
	public function actionwebsmsSend($phone, $msg, $debug=false){		  
		  $username = $this->username;
		  $secret_key = $this->secret_key;
		  $smsurl = $this->smsurl;
	
		  $url = 'username='.$username;
		  $url.= '&secret='.$secret_key;
		  $url.= '&to='.urlencode($phone);
		  $url.= '&text='.urlencode($msg);
	
		  $urltouse =  $smsurl.$url;
		  if ($debug) { //echo "Request: <br>$urltouse<br><br>"; 
		  }
	
		  //Open the URL to send the message
		  $response = $this->actionhttpRequest($urltouse);
		  if ($debug) {
			  /*  echo "Response: <br><pre>".
			   str_replace(array("<",">"),array("&lt;","&gt;"),$response).
			   "</pre><br>"; */			   
			   }	
		  return($response);
	}
/////
	public function actionhttpRequest($url){
		$pattern = "/http...([0-9a-zA-Z-.]*).([0-9]*).(.*)/";
		preg_match($pattern,$url,$args);
		$in = "";
		$fp = fsockopen("$args[1]", $args[2], $errno, $errstr, 30);
		if (!$fp) {
		   return("$errstr ($errno)");
		} else {
			$out = "GET /$args[3] HTTP/1.1\r\n";
			$out .= "Host: $args[1]:$args[2]\r\n";
			$out .= "User-agent: PHP Web SMS client\r\n";
			$out .= "Accept: */*\r\n";
			$out .= "Connection: Close\r\n\r\n";
	
			fwrite($fp, $out);
			while (!feof($fp)) {
			   $in.=fgets($fp, 128);
			}
		}
		fclose($fp);
		return($in);
	}
	///////////////////////////////////////////
	
	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */	 
	 public function actionRecheckin(){
		 $model=new CheckinInfo('search');
		 $this->render('recheckin_id', array('model'=>$model));	
	 }

	 /////////////////////////////////////////////////////
	 public function actionGuestChange(){
		 $model=new CheckinInfo('search');
		 
		 Yii::app()->getClientScript()->registerCssFile("/hotel/css/sbox.css");
		// Yii::app()->clientScript->registerCoreScript('jquery');			 
		 
		 if(isset($_POST['CheckinInfo'])){			
			$chkin_id = $_POST['CheckinInfo_chkin_id'];
			$new_guest_id = $_POST['CheckinInfo']['flight_name'];
			$new_guest_name = $_POST['CheckinInfo']['guest_id'];
			$new_company_id = $_POST['CheckinInfo']['guest_company_id'];
			$branch_id = yii::app()->user->branch_id;			
			/////echo "$chkin_id - $new_guest_id";			
			if(!empty($new_guest_id)){
	$sql1 = "update hms_checkin_info set guest_id = '$new_guest_id', guest_company_id = '$new_company_id' where chkin_id = '".$chkin_id."'";
	$sql2 = "update hms_guest_ledger set guest_name = '$new_guest_name', company_id = '$new_company_id' where chkin_id = '".$chkin_id."'";
			
			$connection=Yii::app()->db;
			$transaction=$connection->beginTransaction();
			try{
				$connection->createCommand($sql1)->execute();
				$connection->createCommand($sql2)->execute();							
				$transaction->commit();
			}catch(Exception $e){ 	$transaction->rollback(); }		
			
			$this->redirect(array('CheckinInfo/admin')); 
		 }// end if not empty
		 }		 
		 $this->render('guestchange', array('model'=>$model));	
	 }
	 


	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */	 
	 public function actionView($id){		//guestinfo file is in view folder
					if( Yii::app()->request->isAjaxRequest ) {
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;
				 
							echo CJSON::encode( array(
							  'status' => 'failure',
							  'content' => $this->renderPartial( '../checkinInfo/view', array(
							  'model' => $this->loadModel($id) ), true, true ),
							));
							exit;
						  }		
	}
	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	public function actionGuestInfo($id){		//guestinfo file is in view folder
					if( Yii::app()->request->isAjaxRequest ) {
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;
				 
							echo CJSON::encode( array(
							  'status' => 'failure',
							  'content' => $this->renderPartial( '../guestInfo/view', array(
							  'model' => GuestInfo::model()->findByPk($id) ), true, true ),
							));
							exit;
						  }		
	}
	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	public function actionRoomInfo($id){		//guestinfo file is in view folder
					if( Yii::app()->request->isAjaxRequest ) {
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;
				 
							echo CJSON::encode( array(
							  'status' => 'failure',
							  'content' => $this->renderPartial( '../roomMaster/view', array(
							  'model' => RoomMaster::model()->findByPk($id) ), true, true ),
							));
							exit;
						  }		
	}
	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	public function actionBillInfo($id){		//guestinfo file is in view folder
					if( Yii::app()->request->isAjaxRequest ) {
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;
				 
							echo CJSON::encode( array(
							  'status' => 'failure',
							  'content' => $this->renderPartial( '../guestLedger/view', array(
							  'chkin_id' => $id), true, true ),
							));
							exit;
						  }		
	}	
/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */		
	public function actionViewRegCard($id){		
		$model = CheckinInfo::model()->find("chkin_id = $id");		
		$this->layout = '//layouts/report';
		$this->render('viewRegCard',array('model'=>$model,));		
	}
	
	///
	public function actionInhouse(){		
		$branch_id = yii::app()->user->branch_id;
		$model = CheckinInfo::model()->find("branch_id = $branch_id");		
		$this->layout = '//layouts/report';
		$this->render('inhouse',array('model'=>$model,));		
	}
/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	 public function actionRechkin($id)
	{
		$model=$this->loadModel($id);
		$guest_info = new GuestInfo;	
		
		$guest_id = $model->guest_id;
		$model->reservation_id = $guest_id;
		
		$model->recheckin_status = 'Y';
		
		$result = GuestInfo::model()->find("guest_id=:guest_id",array(":guest_id"=>$guest_id));
		
		$guest_info->guest_name = $result->guest_name;
		$guest_info->guest_salutation_id = $result->guest_salutation_id;
		$guest_info->guest_gender = $result->guest_gender;
		$guest_info->guest_mobile = $result->guest_mobile;
		$guest_info->guest_address=$result->guest_address;
		$guest_info->guest_phone=$result->guest_phone;
		$guest_info->guest_email=$result->guest_email;
		$guest_info->guest_country_id=$result->guest_country_id;
		$guest_info->guest_company_id=$result->guest_company_id;
		$guest_info->guest_identity_id=$result->guest_identity_id;
		$guest_info->guest_identity_no=$result->guest_identity_no;
		$guest_info->guest_identity_issu=$result->guest_identity_issu;
		$guest_info->guest_identiy_expire=$result->guest_identiy_expire;
		$guest_info->guest_remarks=$result->guest_remarks;
		$guest_info->branch_id =$result->branch_id;
		$guest_info->user_id=$result->user_id;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['CheckinInfo']))
		{
			$model->attributes=$_POST['CheckinInfo'];
			$model->room_name = $model->room_id;
			$model->room_type = Yii::app()->db->createCommand("select mst_roomtypeid from hms_room_master where mst_room_id =".$model->room_id)->queryScalar();
			
			$model->comments = $_POST['CheckinInfo']['comments']; //$model->chkin_date;
			$ledger = new GuestLedger;	
			$ledger->attributes=$_POST['GuestLedger'];
			$ledger->room_id = $model->room_id;
			$model->chkout_status='N';	
			$chkin_id = $model->chkin_id;	
			$chkout_date = 	 $model->chkout_date;			 
			// echo "".$model->room_id."--". $model->chkout_date; 
			 //exit();
			 //update rooms status, room # in guestledger table and in checkin table
			if($this->UpdateRoomStatus2($model->room_id, $chkin_id, $chkout_date) && $model->save()){					
						$this->redirect(array('admin'));	
					//$this->redirect(array('view','id'=>$model->chkin_id));
			}  
		}
		$this->render('update',array('model'=>$model,'guest_info'=>$guest_info));
	}	
	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	public function UpdateRoomStatus2($new_room_id, $chkin_id, $chkout_date){
		
			//$new_room_id = $model->room_name; 
			$new = RoomMaster::model()->find("mst_room_id=:mr_id",array(":mr_id"=>$new_room_id));
			$new->mst_room_status = "O";
			
			$chkout_date = date('Y-m-d 00:00:00', strtotime($chkout_date));			
			// change room status in ledger table			
			$sql = "update hms_guest_ledger set room_status = 'O', chkout_date = '$chkout_date' where chkin_id = ".$chkin_id;					
			$res = Yii::app()->db->createCommand($sql)->query();			
			
			if($new->save() && $res) return true;
			else return false;		
	}
	
	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	public function actionUpdate($id){
		
		$model=$this->loadModel($id);
		$guest_info = new GuestInfo;		
		$guest_id = $model->guest_id;		
		
		$result = GuestInfo::model()->find("guest_id=:guest_id",array(":guest_id"=>$guest_id));		
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['CheckinInfo']) && isset($_POST['GuestInfo'])){
			$result = GuestInfo::model()->find("guest_id=:guest_id",array(":guest_id"=>$guest_id));	
			$old_guest_mobile = $result->guest_mobile;
			
			
							
			$model->attributes=$_POST['CheckinInfo'];		
			$result->attributes=$_POST['GuestInfo']; 
			
			$result->guest_company_id = $_POST['CheckinInfo']['guest_company_id'];	
			//check guest mobile no. if it doesnt match with an existing guest then create new guest.
			
			$sql = "select guest_id from hms_guest_info where guest_mobile = '".$old_guest_mobile."'";
			$res = Yii::app()->db->createCommand($sql)->query();					
			if(count($res) == 0){
				$add_guest = new GuestInfo;
				$add_guest->attributes = $_POST['GuestInfo'];
				$add_guest->guest_company_id = $model->guest_company_id;
				if($add_guest->guest_salutation_id==1) $add_guest->guest_gender = 'M';
				if($add_guest->guest_salutation_id==2) $add_guest->guest_gender = 'F';							
				if($add_guest->save()) {$model->guest_id = $add_guest->guest_id;} //assign new guest id to current checkin row
				else { echo "errors"; exit; }	// Adding new record into guest table				
			}	
			else{$result->save(); } //updateing old guest record


			$chkin_id = $model->chkin_id;
			//update guest ledger company id for current checkin id
		 	$sql2 = "update hms_guest_ledger set company_id = '".$model->guest_company_id."' where chkin_id = '$chkin_id'";
			yii::app()->db->createCommand($sql2)->execute();			


			 //update rooms status, room # in guestledger table and in checkin table
			 //the following code in no more in use.....Use Room shift to change room
			//if($this->UpdateRoomStatus($id, $model->room_id) && $model->save() && $guest_info->save()){
				//if($model->save()){	$this->redirect(array('admin')); }  
				if($model->save()){
						  if( Yii::app()->request->isAjaxRequest ){
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;			 
							echo CJSON::encode( array(
							  'status' => 'success',
							  'content' => 'successfully created',
							));
							exit;
						  }else{$this->redirect(array('admin'));	  }
				}//end model save 	
				
		}
		//$this->render('update',array('model'=>$model,'guest_info'=>$result));
		
				if( Yii::app()->request->isAjaxRequest ) {
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;				 
							echo CJSON::encode( array(
							  'status' => 'failure',
							  'content' => $this->renderPartial( '_form', array(
								'model' => $model,'guest_info'=>$result ), true, true ),
							));	exit;
						  }else{
							$this->render( 'update', array( 'model' => $model,'guest_info'=>$result));
				  }
	}
	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	public function UpdateRoomStatus($id, $new_room_id){
		//get old room id to change its status.
			$chk_res = CheckinInfo::model()->findByPk($id);
			$old_room_id =  $chk_res->room_name;
			//update status of old room			
			$old = RoomMaster::model()->find("mst_room_id=:mr_id",array(":mr_id"=>$old_room_id));
			$old->mst_room_status = "V";						
			//get new room id
			//$new_room_id = $model->room_name; 
			$new = RoomMaster::model()->find("mst_room_id=:mr_id",array(":mr_id"=>$new_room_id));
			$new->mst_room_status = "O";
			
			//change guest ledger room no
			$GL_res = GuestLedger::model()->find("room_status = 'O' AND room_id =".$old_room_id);
			$sql = "update hms_guest_ledger set room_id = ".$new_room_id ." where chkin_id = ".$GL_res->chkin_id;					
			if($GL_res->chkin_id > 0)Yii::app()->db->createCommand($sql)->query();				
			
			if($old->save() && $new->save()) return true;
			else return false;		
	}
	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	public function actionIndex(){
		$bid = yii::app()->user->branch_id;
		$dataProvider=new CActiveDataProvider('CheckinInfo',array(
				'criteria'=>array(
        		'condition'=>'branch_id='.$bid,
				),
			));
		$this->render('index',array('dataProvider'=>$dataProvider,	));
	}
/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	public function actionAdmin(){
		
		
				
	 	//$ci = CheckinInfo::model()->findAll();
		/* foreach($ci as $row){			
			$chkin_id = $row->chkin_id;
			$folio_no = $row->guest_folio_no;	
			$guest_name = $row->guest_folio_no;		
			//echo "<br>update hms_guest_ledger set chkin_id = $chkin_id where chkin_id = $folio_no";
			
			//$sql = "update hms_guest_ledger set chkin_id = $chkin_id where chkin_id = $folio_no";
			$sql = "update hms_checkin_info set guest_folio_no = $chkin_id where guest_folio_no = $folio_no";
			Yii::app()->db->createCommand($sql)->execute();
				
		} */
		
		$model=new CheckinInfo('search');		
		$model->unsetAttributes();  // clear any default values
		
		$cs = Yii::app()->clientScript;
 		$cs->scriptMap['screen.css'] = false;
		if(isset($_GET['CheckinInfo']))		$model->attributes=$_GET['CheckinInfo'];
		$this->render('admin',array('model'=>$model,));
	}
	
	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	public function actionDynamicResData(){ //called upon selecting reservation in checkin form
	    
		$model=new CheckinInfo;
		$model->attributes=$_POST['CheckinInfo'];
		$bid = yii::app()->user->branch_id;
		
		$guest_info = new GuestInfo;
		$guest_info->attributes=$_POST['GuestInfo'];
		$res_id = $_POST['CheckinInfo']['reservation_id'];
		
			//$result =Model Name::model()->find("Wrere criteria=:convert where criteria in nik name",array(":converted name"=>$model->Field From form));
			$result =ReservationInfo::model()->find("reservation_id=:resid",array(":resid"=>$res_id));
			//$result = GuestInfo::model()->find("guest_name=:guest_name",array(":guest_name"=>$guest_info->guest_name));
			$res_id = $result->reservation_id;
			
			if($res_id>0){				
					//CheckinInfo_chkin_date, CheckinInfo_chkout_date
					//$arr["CheckinInfo_reservation_id"]=$res_id;
					$arr["CheckinInfo_chkin_date"]=$result->chkin_date;
			        $arr["CheckinInfo_chkout_date"]=$result->chkout_date;				
					$arr["CheckinInfo_total_days"]=$result->total_days;
					
					$arr["CheckinInfo_drop_service"]=$result->drop_service;
					$arr["CheckinInfo_flight_name"]=$result->drop_flight_name;
					$arr["CheckinInfo_flight_time"]=$result->drop_flight_time;
					
					$arr["CheckinInfo_guest_company_id"]= $result->company_id;
					$arr["GuestInfo_guest_salutation_id"]= $result->client_salutation_id;
					$arr["GuestInfo_guest_name"]=$result->client_name;
					$arr["GuestInfo_guest_mobile"]=$result->guest_mobile;
					
					$arr["GuestInfo_guest_address"]=$result->client_address;
					$arr["GuestInfo_guest_phone"]=$result->guest_phone;
					
					$arr["GuestInfo_guest_country_id"]=$result->client_country_id;
					$arr["GuestInfo_guest_email"]=$result->client_email;
					
					$arr["GuestInfo_guest_identity_id"]=$result->client_identity_id;
					$arr["GuestInfo_guest_identity_no"]=$result->client_identity_no;					
					
					if($result->room_charges!='' || $result->room_charges != NULL){
					$arr["CheckinInfo_rate"] = $result->room_charges;
					
					$gst_rate = Yii::app()->db->createCommand("select gst_percent from hms_service_gst where branch_id = $bid")->queryScalar();
					$arr["CheckinInfo_total_charges"] = $result->room_charges + ($result->room_charges * $gst_rate / 100)+1;
					
					$arr["CheckinInfo_gst_amount"] = $result->room_charges * $gst_rate / 100;									
					}
					
					
					if($result->room_name!='' || $result->room_name != NULL){
					$arr["CheckinInfo_room_id"] = $result->room_name;}
					if($result->advance!='' || $result->advance != NULL){
					$arr["CheckinInfo_amount_paid"] = $result->advance;}
					
					$mop = $result->mode_of_payment;
					if($mop == 1){ //Cash/Credit Card
					 	$arr["CheckinInfo_cash"] = 1;
						$arr["CheckinInfo_credit_card"] = 1;
						$arr["CheckinInfo_btc"] = 0;
					}if($mop == 2){ //BTC
						$arr["CheckinInfo_cash"] = 0;
						$arr["CheckinInfo_credit_card"] = 0;
						$arr["CheckinInfo_btc"] = 1;
					}
					//CheckinInfo_cash
					//following code will print client id in hidden field if exist
				$arr["CheckinInfo_guest_id"]=0;
				
				//echo "---".$result->guest_mobile;
			if(!empty($result->guest_mobile)){
				$record = GuestInfo::model()->find("guest_mobile = '".$result->guest_mobile."'");	
				//echo "---".count($record);	
				if(count($record) >0){	$arr["CheckinInfo_guest_id"]=$record->guest_id;	}
			}
						
					
					//////////new code
					//$arr["GuestInfo_guest_room_type"]=   ;
					 $arr["GuestInfo_guest_room_type"] = RoomTypeRate::model()->findAll("company_id = ".$result->company_id);
					
					/////////////////////
					
					
				//End Code which print client id in hidden field if exist						
				echo json_encode($arr);	
			}else{
					//$arr["CheckinInfo_room_id"]="";
					//$arr["CheckinInfo_rate"]="";					
					echo json_encode($arr);	
				}		
	}
/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	public function actionDynamicRoomrate(){// called upon selecting room in checkin form
		$model=new CheckinInfo;
		$model->attributes=$_POST['CheckinInfo'];		
		//$model=new CheckinInfo;
		$room_id = $_POST['CheckinInfo']['room_id'];
		$form_rate = $_POST['CheckinInfo']['rate'];
		$rate=0;
		$arr = array();	
		//echo "-rid-".$room_id ;exit();
			 if(!empty($room_id)){   				
					//get room rate
					 $company_id = $_POST['CheckinInfo']['guest_company_id'];
					$room_type_id = RoomMaster::model()->find("mst_room_id = ". $room_id)->mst_roomtypeid;
					//echo "--".$room_type_id ;exit();
					if($company_id > 0){	
						$res2 = RoomTypeRate::model()->find("company_id = $company_id  AND room_type_id = $room_type_id");	
						  if(count($res2) > 0) {$rate = $res2->room_rate;}//company rate is defined
						  else $rate = HmsRoomType::model()->find("room_type_id = $room_type_id")->room_rate;	
			 		}else{	$rate = HmsRoomType::model()->find("room_type_id = $room_type_id")->room_rate;	}					
			 }
			//$arr["CheckinInfo_room_name"] = $str;
			if(empty($form_rate)) $arr["CheckinInfo_rate"] = $rate;
			else $arr["CheckinInfo_rate"] = $form_rate;
			$arr["CheckinInfo_room_type"] = $room_type_id;
			echo json_encode($arr);
	}
/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	public function actionDynamicProfile(){//called upon entring mobile no in checkin form
	    
		//$guest_id=0;
		//if (isset($_POST['CheckinInfo']['guest_company_id']) && $_POST['CheckinInfo']['guest_company_id'] > 2){
		$model=new CheckinInfo;
		$model->attributes=$_POST['CheckinInfo'];		
		
		$guest_info = new GuestInfo;
		$guest_info->attributes=$_POST['GuestInfo'];		
		if(!empty($guest_info->guest_mobile))				
		$result = GuestInfo::model()->find("guest_mobile = '" .$guest_info->guest_mobile. "'");
		if(!empty($guest_info->guest_identity_no))				
		$result = GuestInfo::model()->find("guest_identity_no = '" .$guest_info->guest_identity_no. "'");
		
		
			if(count($result) > 0)  
			$guest_id = $result->guest_id;
			
			if($guest_id>0){
					$arr["CheckinInfo_guest_id"]=$result->guest_id;
					$arr["CheckinInfo_guest_company_id"]=$result->guest_company_id;
					$arr["GuestInfo_guest_name"]=$result->guest_name;
					$arr["GuestInfo_guest_address"]=$result->guest_address;
					$arr["GuestInfo_guest_mobile"]=$result->guest_mobile;
					$arr["GuestInfo_guest_phone"]=$result->guest_phone;
					$arr["GuestInfo_guest_country_id"]=$result->guest_country_id;
					$arr["GuestInfo_guest_email"]=$result->guest_email;
					$arr["GuestInfo_guest_identity_id"]=$result->guest_identity_id;
					$arr["GuestInfo_guest_identity_no"]=$result->guest_identity_no;
					
					if($result->guest_gender == "M"){$arr["GuestInfo_guest_gender_0"]=$result->guest_gender;	}
					else{	$arr["GuestInfo_guest_gender_1"]=$result->guest_gender;			}
					
					//$arr["GuestInfo_guest_identity_issu"]=$result->guest_identity_issu;
					//$arr["GuestInfo_guest_identity_expire"]=$result->guest_identity_expire;
					
					$arr["GuestInfo_guest_company_id"]=$result->guest_company_id;					
					$arr["CheckinInfo_ajax_status"]=1;
					echo json_encode($arr);	
			}
			else{
					$arr["CheckinInfo_guest_id"]=0;
					$arr["GuestInfo_guest_address"]="";
					$arr["GuestInfo_guest_phone"]="";
					$arr["GuestInfo_guest_country_id"] = $guest_info->guest_country_id;
					$arr["GuestInfo_guest_email"]="";
					
					///these are commented for some reason....
					//$arr["GuestInfo_guest_identity_id"]="";
					//$arr["GuestInfo_guest_identity_no"]="";
					
					$arr["CheckinInfo_ajax_status"]="";
					/*$arr["GuestInfo_guest_gender"]="Not Defined";
					$arr["GuestInfo_guest_identity_issu"]="Not Defined";
					$arr["GuestInfo_guest_identity_expire"]="Not Defined";
					$arr["GuestInfo_guest_company_id"]="Not Defined";*/
					
					echo json_encode($arr);	
				}				
		//}		
	}	
		
		/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	public function loadModel($id){
		$model=CheckinInfo::model()->findByPk($id);
		if($model===null)	throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='checkin-info-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	protected function ajaxFailed($model, $guest_info, $myroomid, $msg){
		echo CJSON::encode( array(
		'status' => 'msg',
		'msg' => $msg,
		'content' => $this->renderPartial( '_form', array(
		'model' => $model, 'guest_info'=>$guest_info, 'myroomid'=>$myroomid), true, true ),
		));
		exit;
	}
	
	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */	
	 public function actionCreateAjax($sroomid = ''){	
							
		$cs = Yii::app()->clientScript->scriptMap['form.css'] = false;		
		$file=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../css/form__verticle.css';
		$url = Yii::app()->getAssetManager()->publish($file);
		$cs = Yii::app()->getClientScript(); 
		$cs->registerCssFile($url);
		 
		$model=new CheckinInfo;
		$model->bed_tax = "Y";
		$guest_info = new GuestInfo;		
		$save=0;
		//===========================================
		$msg ='';
		$gst_service_id = Yii::app()->db->createCommand()->select('service_id')->from('hms_services')->where("service_description like 'gst'")->queryScalar();				
		if(!$gst_service_id>0){$msg .='Please Define GST Service first';}		
		
		$bed_tax_service_id = Yii::app()->db->createCommand()->select('service_id')->from('hms_services')->where("service_description like 'bed tax'")->queryScalar();
		if(!$bed_tax_service_id>0){		$msg .='<br>Please Define Bed Tax Service first';	}
		
		$room_rent_service_id = Yii::app()->db->createCommand()->select('service_id')->from('hms_services')->where("service_description like 'room rent'")->queryScalar();
		if(!$room_rent_service_id>0){		$msg .='<br>Please Define Room Rent Service first';			}
		
		$extra_bed_service_id = Yii::app()->db->createCommand()->select('service_id')->from('hms_services')->where("service_description like 'Extra Bed'")->queryScalar();
		if(!$extra_bed_service_id>0){		$msg .='<br>Please Define Extra Bed Service first';			}
		
		$advance_service_id = Yii::app()->db->createCommand()->select('service_id')->from('hms_services')->where("service_description like 'Advance'")->queryScalar();
		if(!$advance_service_id>0){		$msg .='<br>Please Define Advance Service first';			}
			
		
		if(!empty($msg)){
			$this->ajaxFailed($model, $guest_info, $myroomid, $msg);
			
		/* echo CJSON::encode( array(
		'status' => 'msg',
		'msg' => $msg,
		'content' => $this->renderPartial( '_form', array(
		'model' => $model, 'guest_info'=>$guest_info, 'myroomid'=>$myroomid), true, true ),
		));
		exit; */
		}
		
		//=======================================		
		//this parameter is for checkin through empty room click.		
		if(!empty($_GET['myroomid'])){ $myroomid = $_GET['myroomid']; }			
		//if(isset($_POST['CheckinInfo'])){   echo "<pre>"; print_r($_POST); echo "</pre>"; exit(); }		
		//$this->performAjaxValidation($model);				
				
		///------------------------------------				
		if(isset($_POST['GuestInfo']) || isset($_POST['CheckinInfo'])){ //------------
				
				//if(isset($_POST['GuestInfo'])){   echo "<pre>"; print_r($_POST); echo "</pre>"; exit(); }
					
			$model->attributes=$_POST['CheckinInfo'];
			
			$model->gst_amount=$_POST['CheckinInfo']['gst_amount'];
			$model->extra_bed=$_POST['CheckinInfo']['extra_bed'];
			$model->b_tax=$_POST['CheckinInfo']['total_person'];
			$model->e_bd=$_POST['CheckinInfo']['e_bd'];			
			$guest_info->attributes=$_POST['GuestInfo'];			
			
			if (isset($_POST['CheckinInfo']['reservation_id'])){$res_id = $_POST['CheckinInfo']['reservation_id']; $model->reservation_id = $res_id; }
			
			if($_POST['GuestInfo']['guest_salutation_id']==1) $gender = "M"; else  $gender = "F"; 
			$guest_info->guest_gender = $gender;	
			$guest_name = $guest_info->guest_name;
			$guest_mobile = $guest_info->guest_mobile;
			$guest_identity_no = $guest_info->guest_identity_no;	
			$company_id = $guest_info->guest_company_id = $model->guest_company_id;						
			//$model->guest_id = 0;									
						 
			 if($model->guest_id==0 || empty($model->guest_id)){
					if($guest_info->save()){	 $guest_id = $model->guest_id = $guest_info->guest_id;	} 
					//else {   print_r($guest_info->getErrors());	 }		
			 }else {$guest_id = $guest_info->guest_id = $model->guest_id;}
		///-----------------------------------------------------------------------------					
			$model->chkin_date = $_POST['CheckinInfo']['chkin_date']; //$model->chkin_date;
			$model->chkout_date = $_POST['CheckinInfo']['chkout_date']; //$model->chkout_date;
			$model->comments = $_POST['CheckinInfo']['comments']; //$model->chkin_date;			
			$model->room_name = $model->room_id;	
			if((empty($model->room_type) && (!empty($model->room_id)))){
				$sql = "select mst_roomtypeid from hms_room_master where mst_room_id = ".$model->room_id;
				$model->room_type = Yii::app()->db->createCommand($sql)->queryScalar();
			}
			
			$mst_room_status = Yii::app()->db->createCommand()->select('mst_room_status')->from('hms_room_master')->where("mst_room_id =".$model->room_id)->queryScalar();
		if(!$mst_room_status != 'V'){		$msg .='<br>Room Selected in not available for guest stay';		
		$this->ajaxFailed($model, $guest_info, $myroomid, $msg);
			}		
			
			if($guest_id != '' && $guest_id >  0){ //no do ledger entries				
				///----get values from post---//
				$rent = $model->rate;		$gst = $model->gst;			
				$bed_tax = 'Y';		
				$amount_paid = $model->amount_paid;
				$extra_bed = $_POST['CheckinInfo']['extra_bed'];	
				$gst_amount = $_POST['CheckinInfo']['gst_amount'];
				///---end get values from post----////
				
				$ledger = new GuestLedger;	
				$ledger->attributes=$_POST['GuestLedger'];
				//-----------------				
				$ledger->guest_name = $guest_info->guest_name;
				$ledger->room_status= "O";
				$ledger->room_id = $model->room_id;
				$ledger->chkin_date = $model->chkin_date; 
				$ledger->chkout_date = $model->chkout_date; 
				//$ledger->c_date = $date = date('Y-m-d H:i:s'); ////value is assigned in beforeSave
				$ledger->c_time = $date = date('H:i:s');
				$ledger->remarks=".";
				//-----------------------/
				$ledger->cash_paid =0;
				$ledger->credit_card = 0;
				$ledger->credit_card_no = 0;
				$ledger->btc = 0;
				$ledger->company_id = $guest_info->guest_company_id;
				$ledger->user_id = yii::app()->user->id;
				$ledger->late_out = "N";
				$ledger->branch_id = yii::app()->user->branch_id;
				///---------------				
				$ledger->debit = 0;			$ledger->credit = 0;		$ledger->balance = 0;
				
				$guest_acc = $ledger->guest_name."-".$guest_info->guest_mobile; 
				$res22 = Yii::app()->db->createCommand("select acc_no from hms_guest_info where guest_id = '$guest_id'")->query();				
				foreach ($res22 as $row){ $guest_acc_id = $row['acc_no'];}				
				////-----------------------------Saving entries in Ledger table
			$connection=Yii::app()->db;
			$transaction=$connection->beginTransaction();
			$transaction_commit =1;
			try{				
			$gst_show = Yii::app()->db->createCommand("select MAX(gst_show) from hms_checkin_info")->queryScalar();
			$model->gst_show = $gst_show+1;
		
			$guest_folio_no = Yii::app()->db->createCommand("select MAX(guest_folio_no) from hms_checkin_info")->queryScalar();
			$model->guest_folio_no = $guest_folio_no+1;		
		
				if($model->save()){
					$ledger->chkin_id = $folio = $model->chkin_id;
				for($i=0; $i < 5; $i++){
					$ledger->setIsNewRecord(true);
					$ledger->setPrimaryKey(NULL);
					$ledger->remarks = 0;	
					$ledger->day_close = 1;				
					
					if($rent > 0){	//room rent													
							$ledger->service_id = $room_rent_service_id;							
							$ledger->debit = $rent;	
							$service_acc_id = $this->getServiceAccountId($room_rent_service_id);
							$this->accountLedgerEntry($guest_acc_id, $service_acc_id,  $rent, $folio);							
							if($ledger->save()){
								$rent =0; //now update the room status
								$res =RoomMaster::model()->find("mst_room_id=:mr_id",array(":mr_id"=>$model->room_name));
								$res->mst_room_status = "O"; 
								if($res->save()){}else{echo 'RoomMaster';print_r($res->getErrors());}
							}else{echo 'Ledger=rent > 0';print_r($ledger->getErrors());}
					}
					else if($gst == "Y"){		// gst			
							$ledger->service_id = $gst_service_id;							
							$ledger->debit = $gst_amount;
							$service_acc_id = $this->getServiceAccountId($gst_service_id);
							$this->accountLedgerEntry($guest_acc_id, $service_acc_id,  $gst_amount, $folio);							
							if($ledger->save()){$gst = "N";}else{echo 'Ledger=gst=Y';print_r($ledger->getErrors());}
					}
					else if($bed_tax == "Y"){	// bed tax
							$ledger->service_id = $bed_tax_service_id;
							$ledger->debit = $btax = $model->total_person;	
							$service_acc_id = $this->getServiceAccountId($bed_tax_service_id);
							$this->accountLedgerEntry($guest_acc_id, $service_acc_id,  $btax, $folio);						
							if($ledger->save()){$bed_tax = "N";}else{echo 'Ledger=bed_tax=Y';print_r($ledger->getErrors());}				
					}
					else if($extra_bed > 0){ //extra bed
							$ledger->service_id = $extra_bed_service_id;
							$ledger->debit = $extra_bed;	
							$service_acc_id = $this->getServiceAccountId($extra_bed_service_id);
							$this->accountLedgerEntry($guest_acc_id, $service_acc_id,  $extra_bed, $folio);						
							if($ledger->save()){$extra_bed = 0;}else{echo 'Ledger=extra_bed>0';print_r($ledger->getErrors());}										
					}	
					else if($amount_paid > 0){ //advance
							$ledger->service_id = $advance_service_id;
							$ledger->debit = 0;						
							$ledger->credit = $amount_paid;		
							$service_acc_id = $this->getServiceAccountId($advance_service_id);
							$this->accountLedgerEntry($service_acc_id, $guest_acc_id, $amount_paid, $folio);					
							if($ledger->save()){$amount_paid = 0;}	else{echo 'Ledger=amount_paid > 0';print_r($ledger->getErrors());}				
					}
				}/////////end for loop
				
				//code for previous night
				 if($model->prev_night=="Y"){
					$rent = $model->rate;
					$gst = $model->gst;	
					$bed_tax = "Y";
				for($i=0; $i < 3; $i++){
					$ledger->setIsNewRecord(true);
					$ledger->setPrimaryKey(NULL);					
					if($rent > 0){	//room rent													
							$ledger->service_id = $room_rent_service_id;							
							$ledger->debit = $rent;															
							if($ledger->save()){$rent =0;}else{echo 'Ledger=rent > 0';print_r($ledger->getErrors());}
					}else if($gst == "Y"){		// gst			
							$ledger->service_id = $gst_service_id;							
							$ledger->debit = $gst_amount;														
							if($ledger->save()){$gst = "N";}else{echo 'Ledger=gst=Y';print_r($ledger->getErrors());}
					}
					else if($bed_tax == "Y"){	// bed tax
							$ledger->service_id = $bed_tax_service_id;
							$ledger->debit = $btax = $model->total_person;													
							if($ledger->save()){$bed_tax = "N";}else{echo 'Ledger=bed_tax=Y';print_r($ledger->getErrors());}				
					}					
				
				}
				} 
				//end of code for previous night 
				
				///following code will update reservation status
			if($model->reservation_id > 0){	
				Yii::app()->db->createCommand()->update('hms_reservation_info',array('chkin_status'=>'Y'),'reservation_id=:r_id',array(':r_id'=>$model->reservation_id));							
			}	
				
			}else{ //echo 'Model=';print_r($model->getErrors());
			}//end if model save
			$transaction->commit();
			
			}catch(Exception $e){ 	
			echo "<br>into rollback";
			$transaction->rollback(); 
			$transaction_commit = 0;
			}					
						
			
			}//else{ print_r($model->getErrors());	}	//
			
			$save = $model->validate() & $guest_info->validate() & $transaction_commit;
			// echo "save value is : ".$save; 			
		}	//end if  POST
							/////////////
							
							  if($save > 0){
								if( Yii::app()->request->isAjaxRequest) {
									$new_id = $model->chkin_id;
								  // Stop jQuery from re-initialization
								  Yii::app()->clientScript->scriptMap['jquery.js'] = false;						 
									  echo CJSON::encode( array(
										'status' => 'success',
										'msg'=>$new_id,
										'grid' => 'checkin-info-grid',
										'content' => 'checkin successfully created',
									  ));
								  exit;
								}else{  $this->redirect('admin'); } //$this->redirect( array( 'view', 'id' => $model->id ) ); }
							  }//end save=1						 
						  //////=-----------------------      
      				  if( Yii::app()->request->isAjaxRequest ) {
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;
				 			$chkout_date_msg = 'old';
							echo CJSON::encode( array(
							  'status' => 'failure',
							  'content' => $this->renderPartial( '_form', array(
								'model' => $model, 'guest_info'=>$guest_info, 'myroomid'=>$myroomid, 'chkout_date_msg'=>$chkout_date_msg), true, true ),
							));
							exit;
						  }else{
							$this->render( 'create', array( 'model' => $model, 'guest_info'=>$guest_info, 'myroomid'=>$myroomid ) );
				  }
	}//end function
	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	protected function getServiceAccountId($id){
		$res22 = Yii::app()->db->createCommand("select acc_no from hms_services where service_id = '$id'")->query();
		foreach ($res22 as $row){ $service_acc_id = $row['acc_no'];}
		return $service_acc_id;
	}
	
	protected function accountLedgerEntry($guest_acc_id, $service_acc_id,  $amount, $chkin_id){	
		$branch_id = yii::app()->user->branch_id;	 
		$active_date = DayEnd::model()->find("branch_id= $branch_id")->active_date;	
		$sql = "insert into account_ledger (dr, cr, amount, chkin_id, created_date) values('$guest_acc_id','$service_acc_id','$amount','$chkin_id', '".$active_date."')";
		Yii::app()->db->createCommand($sql)->execute();		
	}
	/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */	
	public function actionTaxcontrol(){
		set_time_limit(0);
		$model=new CheckinInfo;
		$guest_info = new GuestInfo;
		
		if(Yii::app()->request->isAjaxRequest && isset($_POST['ids']) && isset($_POST['act'])){
			
			if($_POST['act']=='add') $gst_show =0;
			if($_POST['act']=='remove') $gst_show = 1;
			
			$dummay_folio = 0;
			$ids = explode(",", $_POST['ids']);
			$min_id = min($ids);
			
			for($i =0; $i < count($ids); $i++){					
				$sql = "update hms_checkin_info set gst_show = $gst_show where chkin_id = ".$ids[$i];				
				$command=Yii::app()->db->createCommand($sql)->execute();				
			}
			
			$max_gst = (int)Yii::app()->db->createCommand("Select max(gst_show) as gst_show from hms_checkin_info where chkin_id < $min_id")->queryScalar();
			$rs_gst_no = Yii::app()->db->createCommand("Select chkin_id from hms_checkin_info where chkin_id >=$min_id and gst_show>0 order by chkin_id")->queryAll();
			
			foreach($rs_gst_no as $row){
				$max_gst++;
				Yii::app()->db->createCommand("update hms_checkin_info set gst_show=$max_gst where chkin_id=".$row['chkin_id'])->execute();	
			}
			
		}
		
		$this->render( 'taxcontrol' );
	}
	
/**
	 //////////////////////////////////////////////////////////////////////////////////
	 */
	public function actionToggleTaxControl(){
		if(Yii::app()->request->isAjaxRequest && isset($_POST['act'])){
			if($_POST['act'] == 'Turn On Tax Filter'){
				$key = 'taxcontrol'; $value = 'ON';
				Yii::app()->db->createCommand("update settings set value = 1 where unit LIKE 'taxcontrol'")->execute();
			}
			if($_POST['act'] == 'Turn Off Tax Filter'){
				$key = 'taxcontrol'; $value = 'OFF';
				Yii::app()->db->createCommand("update settings set value = 0 where unit LIKE 'taxcontrol'")->execute();
			}
			//Yii::app()->session->add($key,$value);	
			if($value=='ON')$value = 1;
			if($value=='OFF')$value = 0;
			echo $value;
		}
	}
	
	//////////////////////////////////////
	public function actionCheckOutPopup($id=0){
		
		$model=new GuestLedger;
		//$model=new CheckinInfo;			
		////////////////////////////////////////	
		if($id>0){
		$model->chkin_id = $id;
		$result = CheckinInfo::model()->find("chkin_id=:chkin_id",array(":chkin_id"=>$_REQUEST['id']));	
		$model->room_id = CheckinInfo::model()->find("chkin_id=". $_REQUEST['id'])->room_id;	
		$result_12 = GuestLedger::model()->findAll("chkin_id=".$id);
		$tdebit=0; $tcredit=0;
		 foreach ($result_12 as $row) {
			$tdebit += $row[debit];
			$tcredit += $row[credit];			
		}  
			$model->debit = $tdebit-$tcredit;						
			$guestid = $result->guest_id;
			$result_1 = GuestInfo::model()->find("guest_id=:id",array(":id"=>$guestid));
			$model->guest_name = $guest_name = $gname = $result_1->guest_name;	
			$guest_mobile = $result_1->guest_mobile;	//user for sms	
			$guest_salutation_id = $result_1->guest_salutation_id;
			$salutation_name = Salutation::model()->find("salutation_id=$guest_salutation_id")->salutation_name;
			//$model->room_id = $result->room_id;
			$model->chkin_date=$result->chkin_date;
			$model->chkout_date=$result->chkout_date;
			$model->company_id = $result->guest_company_id;
		}	
		$msg ='';
		///////////////////////////////////// check whether payment and btc services exist
		$paid_service_id = Yii::app()->db->createCommand()->select('service_id')->from('hms_services')->where("service_description like 'paid'")->queryScalar();
		if(!$paid_service_id>0){$msg .='Please Define Paid Service first';}
		$btc_service_id = Yii::app()->db->createCommand()->select('service_id')->from('hms_services')->where("service_description like 'Bill To Company'")->queryScalar();
		if(!$btc_service_id>0){	$msg .='Please Define Bill To Company Service first';	}
		
		if(!empty($msg)){
		echo CJSON::encode( array(
		'status' => 'msg_checkout',
		'msg_checkout' => $msg,
		'content' => $this->renderPartial( '_formchkoutPopup', array(
		'model' => $model), true, true ),
		));
		exit;
		}
		//////////////////////////////////////////// end of service check		
		if(isset($_POST['GuestLedger'])){
			
			$model->attributes=$_POST['GuestLedger'];
			$branch_id = yii::app()->user->branch_id; 		
			
			if($model->btc==3){ //btc payment modes
			$model->service_id = $btc_service_id;
			}else{$model->service_id = $paid_service_id;} //other payment modes
			
			$service_id = $model->service_id;
			$amount =  $model->debit;			
			$s_type = Services::model()->find("service_id=".$service_id)->servise_type;						
				
			if($s_type=='Dr' && $model->remarks!=''){
				$model->debit=$amount;
				$model->credit=0;
			}
			if($s_type=='Cr' && $model->remarks!=''){
				$model->debit=0;
			    $model->credit=$amount;
			}			
			if($model->btc==3){ //btc payment
				$model->credit=0;
				$model->balance=$amount;				
				//if($model->remarks=='')$model->remarks = "BTC";
			}
			
			if($model->btc==0){ //btc payment
				$model->cash_paid=1;				
			}if($model->btc==1){ //btc payment
				$model->credit_card=1;				
			}if($model->btc==2){ //btc payment
				$model->credit_card=1;				
			}
			
			
			 $model->room_status='D';
			 $model->chkout_date= date("Y-m-d H:i:s");
			 $model->c_time= date("H:i:s");
			 $model->day_close = 5;
			 
			 $fdate = explode(" ", $model->chkin_date);
			 
			 $from_date = strtotime($fdate[0]);
			 $to_date = strtotime(date("Y-m-d"));
			 $datediff = $to_date - $from_date;
			 $total_days= floor($datediff/(60*60*24));
			 if($total_days==0) $total_days= 1;
			
			$flag = 0;
			//if($amount==0)$flag = 1; // this is to stop entry with amount zero.
			//else {$model->save(); $flag=1;}
			
			if($model->save()) {$flag=1;}
						
			if($flag){				
			/////////////this code is used when btc = 3. guest first checks out payment entry is inserted...then he recheckin and then checkout again
			/////here we need to update the balance of already inserted payment entry rather as that balance is  creating
				 if($model->btc==3){
				 $sql_hms_guest_ledger = "update hms_guest_ledger set balance = 0 where btc = 3 AND balance < $amount AND chkin_id = $model->chkin_id";
				  Yii::app()->db->createCommand($sql_hms_guest_ledger)->execute();
				 }
				  //----------  update guest_ledger, hms_checkin_info, hms_room_master
				  $sql_hms_guest_ledger = "update hms_guest_ledger set chkout_date='$model->chkout_date', room_status='D' where chkin_id =  $model->chkin_id";
				  $sql_hms_checkin_info = "update hms_checkin_info set chkout_date='$model->chkout_date', total_days = '$total_days',  chkout_status='Y' where chkin_id =  $model->chkin_id";
				  $sql_hms_room_master = "update hms_room_master set mst_room_status='D' where mst_room_id = ".$model->room_id;		  
				  
				  Yii::app()->db->createCommand($sql_hms_guest_ledger)->execute();	
				  Yii::app()->db->createCommand($sql_hms_checkin_info)->execute();	
				  Yii::app()->db->createCommand($sql_hms_room_master)->execute();	
				  
				  ////account entries in accountName and accountLedger table.
				  ///check if guest account exist in acc name table...if not create it
				  $gid = GuestInfo::model()->find("guest_id = $guestid");
				  $gacc_no = $gid->guest_name.'-'. $gid->guest_mobile;
				  if($gid->acc_no == '' || $gid->acc_no == 0){ 
				  	Yii::app()->db->createCommand("insert into account_name (name, guest_comp_id, account_type_id) values('$gacc_no','$guestid','2')")->execute();	  
				  	$acc_id = AccountName::model()->find("name = '$gacc_no'")->id;
					$sq = "update hms_guest_info set acc_no = '$acc_id' where guest_id = $guestid";
					Yii::app()->db->createCommand($sq)->execute();	
				  }
				  //$guest_acc_id = AccountName::model()->find("guest_comp_id = $guestid")->id;
				  $guest_acc_id = GuestInfo::model()->find("guest_id = $guestid")->acc_no;
				  				  
				  //payment id in account_name table is 25. 
				  if($model->btc==0){ $ser_acc_id= 3617; } //cash
				   else if($model->btc==1){ $ser_acc_id= 3618; } //dc
				   else if($model->btc==2){ $ser_acc_id= 77; } //cc
				    else if($model->btc==3){ $ser_acc_id= 89; } //cc 
					
					$branch_id = yii::app()->user->branch_id;	 
					$active_date = DayEnd::model()->find("branch_id= $branch_id")->active_date;		
					
					$debug = true;					
					if(!empty($guest_name) && !empty($guest_mobile)){
					$mobile = str_replace("-", "", $guest_mobile);
					$guestname = ucwords(strtolower($guest_name));
					$msg = "Respected $guestname,\nThanks for visiting Le Royal Guest House,Best wishes from Le Royal Team. Hope we will see u again.\nle-royal1.com\n0302-8936767";					
					//uncomment this line to send sms 
					$this->actionwebsmsSend($mobile, $msg, $debug);					
					}
					
				 // $ser_acc_id= 25;
				 // $sql = "insert into account_ledger (dr, cr, amount, chkin_id, created_date) values ('$ser_acc_id','$guest_acc_id','$amount','$model->chkin_id', '".$active_date."')";
				 // Yii::app()->db->createCommand($sql)->execute();
								 			  
				  ///////////////
				  if( Yii::app()->request->isAjaxRequest ){					
					Yii::app()->clientScript->scriptMap['jquery.js'] = false;			 
					echo CJSON::encode( array('status' => 'success','content' => 'successfully created',));
					exit;
				  }
				  else{	$this->redirect( array( 'view', 'id' => $model->id));	  }
			}//end model save 
			
				//$this->redirect(array('view','id'=>$model->id));
		}
		
		if( Yii::app()->request->isAjaxRequest ){
				// Stop jQuery from re-initialization
				Yii::app()->clientScript->scriptMap['jquery.js'] = false;			 
				echo CJSON::encode( array( 'status' => 'failure', 'content' => $this->renderPartial( '_formchkoutPopup', array('model' => $model ), true, true ),));
				exit;
		}else{
				$p = 7888;
				$this->render( 'createChkoutPop', array( 'model' => $model));
		}
	
	}


	//////////////////////////////////////////////////////////////
	
		public function actionAutosuggest(){		
			$db = new mysqli('localhost', 'root' ,'', 'hotel');
   			//$db = new mysqli('kohistangroup1.netfirmsmysql.com', 'faisal' ,'mezban@mce123', 'mezban');
  
	if(!$db)	echo 'Could not connect to the database.';
	else {	
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);			
			if(strlen($queryString) >0) {
				$str = explode("&", $queryString);
				$queryString = $str[0];
				$company_id = $str[1]; 
				
				
				if(!empty($company_id)) $where = " guest_company_id = $company_id AND ";
				else $where = "";
				$res = $db->query("SELECT guest_id, guest_name, guest_mobile, guest_phone, guest_address, guest_country_id, guest_email, guest_identity_id, guest_identity_no  FROM hms_guest_info WHERE ".$where." guest_name LIKE '$queryString%' LIMIT 7");
				
				if($res) {
						echo '<ul>';
							while ($row = $res->fetch_object()) {		
							$country = $this->actionGetCountry($row->guest_country_id); 			
								echo '<li onClick="fill(\''.addslashes($row->guest_id).'\', \''. addslashes($row->guest_name) .'\', \''. addslashes($row->guest_mobile) .'\', \''. addslashes($row->guest_phone) .'\', \''.addslashes($row->guest_address).'\', \''. addslashes($country) .'\', \''. addslashes($row->guest_email) .'\', \''. addslashes($row->guest_identity_id) .'\', \''. addslashes($row->guest_identity_no) .'\');">'.$row->guest_name.'</li>';
							} 
						echo '</ul>';					
				} else  echo 'OOPS we had a problem :(';	
			} else {
				// do nothing
			}
		} else 	echo 'There should be no direct access to this script!';	
	}
		Yii::app()->end();	
		
		}
	/////////////
	
	public function actionGetCountry($id=0){
		return Country::model()->find("country_id=". $id)->country_name;	
	}
	////////////////////////////////////////////
		////////////////////////////////////////////

	/////////////
}
