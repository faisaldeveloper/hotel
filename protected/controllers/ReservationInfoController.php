<?php
class ReservationInfoController extends Controller //SBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/mycolumn1';
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
		);
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	 
	 public function actionPdf($id)
	{
		$this->renderPartial('pdf');
	}
	
	public function actionView($id)
	{
			$model = new ReservationInfo;
					if( Yii::app()->request->isAjaxRequest ) {
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;
				 
							echo CJSON::encode( array(
							  'status' => 'failure',
							  'content' => $this->renderPartial( 'view', array(
								'model' => $this->loadModel($id) ), true, true ),
							));
							exit;
						  }
		//$this->render('view',array('model'=>$this->loadModel($id),));
	}
	///////////////////////////////
	public function actionReservationsForecast($id)
	{
		if($_POST){
		$data = $_POST;
		$data['id']=$id;
		$d = $data['id']=$id;
		$model = new ReservationInfo;
		if($d==1){
		$this->renderPartial('expectedarrivals',array('model'=>$model, 'data'=>$data));	
		}else if($d==2){
			$this->renderPartial('canceledRes',array('model'=>$model, 'data'=>$data));	
		}
		exit();
		}
		
		$this->render('report');
	}
	
		////////////////////////////////////////////////
	
		public function actionViewReservationcard($id){
		
		$model = ReservationInfo::model()->find("reservation_id = $id");		
		$this->layout = '//layouts/report';
		$this->render('viewReservationCard',array(
			'model'=>$model,
		));		
	}
	
	public function actionViewGReservationcard($gname){
		
		$branch_id = yii::app()->user->branch_id;
		$model = ReservationInfo::model()->find("group_name = $id and branch_id=$branch_id");		
		$this->layout = '//layouts/report';
		$this->render('viewGReservationCard',array(
			'model'=>$model,
		));
		
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate(){
		$model=new ReservationInfo;
		$guest_info = new GuestInfo;
		$chkout_date_msg = '';
		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);		
		if(isset($_POST['ReservationInfo'])){
				$model->attributes=$_POST['ReservationInfo'];								
				if($model->res_type=="I"){
									
					echo "<pre>";  print_r($_POST['ReservationInfo']); echo "</pre>";	exit();				
					
					//faisal code
					$reservation_status = $_POST['ReservationInfo']['reservation_status'];
					if($reservation_status !=1){
						$model->room_type = Null;
						$model->room_name = Null;
					}else{
						$model->room_type = $_POST['ReservationInfo']['room_type'];
						$model->room_name = $_POST['ReservationInfo']['room_name'];
						
						//room status upate
				  	$sql = "update hms_room_master set mst_room_status='R' where mst_room_id = $model->room_name";
				    $connection=Yii::app()->db->createCommand($sql)->execute();					
					}
					if($model->save()){$this->redirect(array('admin','model'=>$model));}
					else {$chkout_date_msg = 'old'; }
				}else{
											
						$total_clients = count($_POST['ReservationInfo']['client_name']);						
						//echo "----------------".$total_clients;
						//exit();
						
						for($i=0; $i < $total_clients; $i++){
							
							$model->setIsNewRecord(true);
							$model->setPrimaryKey(NULL);							
							$g_salutation = $_POST['ReservationInfo']['client_salutation_id'];
							$g_client_name = $_POST['ReservationInfo']['client_name'];							
							
							if($g_salutation =='' || $g_client_name =='') continue;
							
							
							$model->client_salutation_id=$g_salutation;
							$model->client_name=$g_client_name;
							
							if($model->save(false)){}
						} //end for loop
					
					
						$this->redirect(array('admin','model'=>$model));
					}
					//$this->redirect(array('view','id'=>$model->reservation_id));
		}		
		$this->render('create',array('model'=>$model,'guest_info'=>$guest_info, 'chkout_date_msg'=>$chkout_date_msg	));
	}
	
	//today
	public function actionToday(){
		$this->layout = '//layouts/column1';
		$this->render('today');	
	}
	
	//calendar
	public function actionCalendar(){
		$this->render('calendar');	
	}
	
	
	
	///////////////////////////////
public function actionAddmember($id){	

	$model=$this->loadModel($id);
	//Yii::app()->clientScript->scriptMap['jquery.js'] = false;
	
	if(isset($_POST['ReservationInfo'])){	
		$model = new ReservationInfo;
		$model->attributes=$_POST['ReservationInfo'];
		$model->total_reservations = 1;
		$model->setIsNewRecord(true);
		$model->setPrimaryKey(NULL);		
		if($model->save()){ $this->redirect(array('admin')); }
	}
	$this->render( 'addmember', array( 'model' => $model));				
}
	
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);
		if(isset($_POST['ReservationInfo']))
		{
			$model->attributes=$_POST['ReservationInfo'];
			$model->total_reservations = 1;
			
			
			//faisal code
					$reservation_status = $_POST['ReservationInfo']['reservation_status'];
					if($reservation_status==2){ //
						$model->cancel_date = date("Y-m-d H:i:s");
					}
					//$model->reservation_status = $reservation_status;
					//1st get old reserved room id and then room status upate
					//$old_id = 	ReservationInfo::model()->find('reservation_id = '.$model->reservation_id)->room_name;				
					
					/* if($reservation_status !=1){
						//$model->room_type = Null;
						$model->room_name = Null;				
						if(isset($old_id) && $old_id !=NULL){
							$sql = "update hms_room_master set mst_room_status='V' where mst_room_id = $old_id";
				    		$connection=Yii::app()->db->createCommand($sql)->execute();
						}
					}else{
						$model->room_type = $_POST['ReservationInfo']['room_type'];
						$model->room_name = $_POST['ReservationInfo']['room_name'];						
						if(isset($old_id) && $old_id !=NULL){
							$sql = "update hms_room_master set mst_room_status='V' where mst_room_id = $old_id";
							$connection=Yii::app()->db->createCommand($sql)->execute();
						}
						if(!empty($model->room_name)){
							$sql = "update hms_room_master set mst_room_status='R' where mst_room_id = $model->room_name";
							$connection=Yii::app()->db->createCommand($sql)->execute();		
						}
					} */
			
			//if($model->save())	$this->redirect(array('view','id'=>$model->reservation_id));
			//echo "<pre>"; print_r($_POST['ReservationInfo']); "</pre>"; exit;
				if($model->save()){
						  if( Yii::app()->request->isAjaxRequest ){
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;			 
							echo CJSON::encode( array(
							  'status' => 'success',
							  'content' => 'successfully created',
							));
							exit;
						  }else{$this->redirect( array( 'view', 'id' => $model->id ) );	  }
				}//end model save 			
				//$this->redirect(array('view','id'=>$model->id));
		} // end if isset post
			
						if( Yii::app()->request->isAjaxRequest ) {
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;
				 
							echo CJSON::encode( array(
							  'status' => 'failure',
							  'content' => $this->renderPartial( '_form', array(
								'model' => $model ), true, true ),
							));
							exit;
						  }else{
							$this->render( 'update', array( 'model' => $model, 'guest_info'=>$guest_info ) );
				  }
		//$this->render('update',array('model'=>$model,));
	}
/////////////////////////////////////////////////////////////
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
		
		$bid = yii::app()->user->branch_id;
		$dataProvider=new CActiveDataProvider('ReservationInfo',
			array(
				'criteria'=>array(
        		'condition'=>'branch_id='.$bid.' AND chkin_status=\'N\' AND cancel_status=\'N\' AND noshow_status=\'N\'',				
				),
			));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ReservationInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ReservationInfo']))
			$model->attributes=$_GET['ReservationInfo'];
		$cs = Yii::app()->clientScript;
		//$cs->scriptMap['screen.css'] = false;
		//$cs->scriptMap['admin.css'] = false;
		
		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	
	public function actionRes_admin()
	{
		$model=new ReservationInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ReservationInfo']))
			$model->attributes=$_GET['ReservationInfo'];
		$this->render('res_admin',array(
			'model'=>$model,
		));
	}
	
	public function actionRsv_Cancelled()
	{
		$model=new ReservationInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ReservationInfo']))
			$model->attributes=$_GET['ReservationInfo'];
		$this->render('rsv_cancelled',array(
			'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ReservationInfo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
////////////////////////////////////////////////////////////////////////////
	 public function actionDynamicFtime(){
		
	$data=Flights::model()->find('flight_id=:flightid', array(':flightid'=>(int) $_POST['ReservationInfo']['flight_name']));	 
	 	//echo $data->currancy_sign;
		$arr["flight_time"]=$data->flight_arrival;		
		echo json_encode($arr);	
	}
	////////////////////////////////////////////
 public function actionDynamicDtime(){		
	/* $data=Flights::model()->find('flight_id=:flightid', array(':flightid'=>(int) $_POST['ReservationInfo']['drop_flight_name']));	 
	 	//echo $data->currancy_sign;
		$arr["drop_flight_time"]=$data->flight_departure;		
		echo json_encode($arr);	   */
		
		$data=Flights::model()->find('flight_id=:flightid', array(':flightid'=>(int) $_POST['ReservationInfo']['drop_flight_name']));	 
	 	//echo $data->currancy_sign;
		$arr["drop_flight_time"]=$data->flight_arrival;		
		echo json_encode($arr);
	
	}	
	////////////////////////////////////////////////////////////////
	public function actionDynamicProfile(){
	    
		//$guest_id=0;
		//$model=new ReservationInfo;
		$comp_id = (int)$_POST['ReservationInfo']['company_id'];
		//$company_id = $model->guest_company_id;		
		//$guest_info = new GuestInfo;
		//$guest_info->attributes=$_POST['GuestInfo'];		
		//print_r($_REQUEST);			
		  //$result = Companyinfo::model()->find("comp_id=:comp_id",array(":comp_id"=>$comp_id));
			$result = Company::model()->find("comp_id=:comp_id",array(":comp_id"=>$comp_id));
			//$result = GuestInfo::model()->find("guest_mobile=:mobile ",array(":mobile"=>$guest_info->guest_mobile));
			
			//$result = GuestInfo::model()->find("guest_name=:guest_name",array(":guest_name"=>$guest_info->guest_name));
			$comp_id = $result->comp_id;
			$arr = array();
			if($comp_id>0){				
					$arr["ReservationInfo_to_person"]=$result->comp_contact_person;
					$arr["ReservationInfo_designation"]=$result->person_designation;
					$arr["ReservationInfo_client_phone"]=$result->comp_phone;
					//$arr["ReservationInfo_client_country_id"]=$result->country_id;
					$arr["ReservationInfo_client_mobile"]=$result->person_mobile;
					//$arr["ReservationInfo_client_address"]=$result->comp_address;
					//$arr["ReservationInfo_client_email"]=$result->comp_email;							
					echo json_encode($arr);	
			}		
	}
	///////////////////////////////////////////////////////////////
	protected function performAjaxValidation($model){
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='reservation-info-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	//////////////
	//////////////////////////////////////////////////////////////////////// Faisal code
	public function actionDynamicRooms(){
		
		$model=new ReservationInfo;
		$model->attributes=$_POST['ReservationInfo'];
		
		//$model=new CheckinInfo;
		$room_type_id = $_POST['ReservationInfo']['room_type'];
		$company_id = $_POST['ReservationInfo']['company_id'];
		$arr = array();	
			 if(!empty($room_type_id)){           
					
					//get room rate
					$rate=0;
					$sql8 = "select room_rate from hms_room_type_rate where room_type_id = $room_type_id AND company_id = $company_id";
					$rate = Yii::app()->db->createCommand($sql8)->queryScalar();
					
					
					$sql = "select mst_room_id, mst_room_name from hms_room_master where mst_room_status='V' AND mst_roomtypeid = $room_type_id";
					$data = Yii::app()->db->createCommand($sql)->query();						
					$n = count($data);  					
					if($n>0){
						$str = "<option value=''>Select Room -(".$n.")</option>"; 
						//echo "456-+-".CHtml::tag('option', array('value' => ''), CHtml::encode('Select Room -('.$n.')'), true);
						$i = 0;
						foreach ($data as $row) {						
							$list[$i]['mst_room_id'] = $row[mst_room_id];
							$list[$i]['mst_room_name'] = $row[mst_room_name];
							$i++;
						}		
						$data = CHtml::listData($list, 'mst_room_id', 'mst_room_name');
						foreach ($data as $value => $key) {
							//echo CHtml::tag('option', array('value' => $value), CHtml::encode($key), true);
							$str .= "<option value='".$value."'>".$key."</option>";
						}
					}
			
			}else { $str = "<option value=''>Select Room</option>"; }
			$arr["ReservationInfo_room_name"] = $str;
			if($rate)
			$arr["ReservationInfo_room_charges"] = $rate;
			else $arr["ReservationInfo_room_charges"] = '';
			echo json_encode($arr);
	}
	
	////
	 public function actionCreateAjax()
	{
		$model = new ReservationInfo;
	 	$guest_info = new GuestInfo;
		$save=0;
		$str = "";
		
		
		
		if(!isset($model->group_name))
		$model->group_name = date('Ymdhis'); 
		$model->client_mobile = 0;
		$model->guest_mobile = 0;
		if(isset($_POST['ReservationInfo'])){				
				$model->attributes=$_POST['ReservationInfo'];
				$model->gst = 'N';
				//$model->total_reservations = $_POST['ReservationInfo']['total_reservations'];
				//echo $model->res_type;
				//exit();				
				if($model->res_type=="I"){					
							$reservation_status = $_POST['ReservationInfo']['reservation_status'];
							$model->total_reservations = 1;//$_POST['ReservationInfo']['total_reservations'];
							$model->group_name = "";
							if($reservation_status !=1){
								//$model->room_type = Null;
								//$model->room_name = Null;
								$model->room_type = $_POST['ReservationInfo']['room_type'];
								$model->room_name = $_POST['ReservationInfo']['room_name'];
							}else{
								$model->room_type = $_POST['ReservationInfo']['room_type'];
								$model->room_name = $_POST['ReservationInfo']['room_name'];
								
								//room status upate
							if(!empty($model->room_name)){
								$sql = "update hms_room_master set mst_room_status='R' where mst_room_id = $model->room_name";
								$connection=Yii::app()->db->createCommand($sql)->execute();	
							}
							}
							
							//echo "<pre>";print_r($_POST); echo "</pre>"; exit();
					if($model->save()){ $new_id = $model->reservation_id; $save=1; }// $this->redirect('admin');}
					//else {echo "Some error occured ";  }
				}else{	// if G											
						$reservation_status = $_POST['ReservationInfo']['reservation_status'];
											
							if($reservation_status !=1){
								//$model->room_type = Null;
								//$model->room_name = Null;
								$model->room_type = $_POST['ReservationInfo']['room_type'];
								$model->room_name = $_POST['ReservationInfo']['room_name'];
							}else{
								$model->room_type = $_POST['ReservationInfo']['room_type'];
								$model->room_name = $_POST['ReservationInfo']['room_name'];
								
								//room status upate
							if(!empty($model->room_name)){
							$sql = "update hms_room_master set mst_room_status='R' where mst_room_id = $model->room_name";
							$connection=Yii::app()->db->createCommand($sql)->execute();					
							}
							}
						if($model->save()){ 
							$chkin_res = explode(" ", $model->chkin_date);
							$chkout_res = explode(" ", $model->chkout_date);
							$model->chkin_date = date("d-m-Y",strtotime($chkin_res[0]));
							$model->chkout_date = date("d-m-Y",strtotime($chkout_res[0])); 
							
							
							$model->pick_service = '';	
							$model->flight_name = '';	
							$model->flight_time = '';	
							$model->drop_service = '';	
							$model->drop_flight_name = '';	
							$model->drop_flight_time = '';	
							
													
							$model->client_name = '';
							$model->guest_mobile = '';
							$model->guest_phone = '';
							$model->client_address = '';
							$model->client_country_id = '';
							$model->client_email = '';
							$model->client_identity_id = '';
							$model->client_identity_no = '';
							$model->total_reservations--;
							$save=0; 
							
							$new_id = $model->reservation_id;
							if(!empty($model->group_name)){
								$sql = "select client_name from hms_reservation_info where group_name LIKE '".$model->group_name."'";
								$res=Yii::app()->db->createCommand($sql)->query();	
								$total_mem = count($res); $str = "Reservations So For: $total_mem - ";
								foreach($res as $row){$str .= ucwords(strtolower($row['client_name'])).", ";}
							}
							
							if($model->total_reservations==0){
								echo CJSON::encode( array(
									  'status' => 'success',									 
									  'msg'=>$new_id,
									  'grid' => 'reservation-info-grid',
									  'content' => 'ReservationInfo successfully created',
									));
								exit;
							}
						}// $this->redirect('admin');}	
					} //end else
					//$this->redirect(array('view','id'=>$model->reservation_id));
		} //endv if isset
							/////////////
							if($save==1){
							  if( Yii::app()->request->isAjaxRequest) {
								// Stop jQuery from re-initialization
								Yii::app()->clientScript->scriptMap['jquery.js'] = false;						 
									echo CJSON::encode( array(
									  'status' => 'success',									   
									  'msg'=>$new_id,
									  'grid' => 'reservation-info-grid',
									  'content' => 'ReservationInfo successfully created',
									));
								exit;
							  }else{  $this->redirect('admin'); } //$this->redirect( array( 'view', 'id' => $model->id ) ); }
							}//end save=1						 
						  //////=-----------------------
      
      				  if( Yii::app()->request->isAjaxRequest ) {
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;
							Yii::app()->getClientScript()->registerCssFile("/hotel/css/sbox.css");
							Yii::app()->clientScript->registerCoreScript('jquery');	
							
				 			$branch_id = Yii::app()->user->branch_id;
		$sql = "select MAX(reservation_id) from hms_reservation_info where branch_id = $branch_id";
		$model->reservation_id = Yii::app()->db->createCommand($sql)->queryScalar() +1;
							$chkout_date_msg = 'old';
							echo CJSON::encode( array(								
							  'status' => 'failure',
							  'content' => $this->renderPartial( '_form', array(
								'model' => $model, 'str'=> $str, 'chkout_date_msg'=>$chkout_date_msg ), true, true ),
							));
							exit;
						  }else{
							$this->render( 'create', array( 'model' => $model, 'guest_info'=>$guest_info ) );
				  }
	}//end function
	
	/////View Reservation Card
	public function actionViewResCard($id){
		$model = ReservationInfo::model()->find("reservation_id = $id");		
		$this->layout = '//layouts/report';
		$this->render('viewResCard',array('model'=>$model,));	
		
		//echo "the id sent is ". $id;
		
	}
	
	/////
	public function actionForecast(){
		
	$model = new ReservationInfo;
	$this->updateNoShow();	
	$this->render('forecast',array('model'=>$model,));	
	}
	
	
	private function updateNoShow(){
		
		$curr_date = date("Y-m-d 00:00:00");
		$branch_id = yii::app()->user->branch_id;	 
		$ad = DayEnd::model()->find("branch_id= $branch_id");
		$active_date = $ad->active_date;
		$prev_date =  date('Y-m-d',strtotime('-1 day',strtotime($curr_date)));
		$prev_date_3 =  date('Y-m-d',strtotime('-9 day',strtotime($curr_date)));
			
		$update = "update hms_reservation_info set noshow_status = 'Y' where  noshow_status= 'N' AND chkin_status = 'N' AND chkin_date BETWEEN '$prev_date_3' AND '$prev_date'";		
		Yii::app()->db->createCommand($update)->execute();
		
	}	
	
	////////////////////
	
		public function actionautosuggest(){		
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
								echo '<li onClick="fill(\''.addslashes($row->guest_id).'\', \''. addslashes($row->guest_name) .'\', \''. addslashes($row->guest_mobile) .'\', \''. addslashes($row->guest_phone) .'\', \''.addslashes($row->guest_address).'\', \''. addslashes($row->guest_country_id) .'\', \''. addslashes($row->guest_email) .'\', \''. addslashes($row->guest_identity_id) .'\', \''. addslashes($row->guest_identity_no) .'\');">'.$row->guest_name.'</li>';
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
}
