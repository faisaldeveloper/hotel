<?php
class ReportsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	public function actionRoomoverdue(){
		$this->layout = '//layouts/report';
		$this->render('room_overdue'); 
	}
	
	public function actionCodewisesummary($id){
		$this->layout = '//layouts/report';
		$res = explode(":",$id);
		$id = $res[0];
		$date = $res[1];
		
		$this->getTaxSession();
		
		$this->render('auditor_chargecodewise', array('service_id'=>$id, 'c_date'=>$date));
		
	}
	////////////////
	public function actionCodewisesummary2($id){
		$this->layout = '//layouts/report';
		$res = explode(":",$id);
		$id = $res[0];
		$res2 = explode("~",$res[1]);
		$from_date = $res2[0];
		$to_date = $res2[1];
		
		$this->getTaxSession();
		$this->render('auditor_chargecodewise2', array('service_id'=>$id, 'from_date'=>$from_date, 'to_date'=>$to_date));
		
	}
	////////////////////////////////////////////
	public function actionPanel()
	{
		//error_reporting(0);
		if($_POST){
			
			$this->layout = '//layouts/report';
				
			$report_type = $_POST['report_type'];
			$from_date = $_POST['from_date'];			
			$to_date = $_POST['to_date'];
			$con = $_POST['con'];
			
			 $this->getTaxSession();  
			/* 
			$file=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../css/report.css';
			$url = Yii::app()->getAssetManager()->publish($file);
			$cs = Yii::app()->getClientScript(); 
			$cs->registerCssFile($url); */
			
			$data = array('report_type'=>$report_type,'to_date'=>$to_date,'from_date'=>$from_date, 'criteria'=>$con);
			
			//foreach($_POST as $k =>$v)echo "<br>$k=$v";
			if($_POST[report_type]=='1'){ //Daily inHouse report
				$this->render('inhouse'); exit();
			}
			else if($_POST[report_type]=='2'){ //expectedarrivals
				$this->render('expectedarrivals', array('data'=>$data)); exit();	
			}
			else if($_POST[report_type]=='3'){//canceledRes
				$this->render('canceledRes', array('data'=>$data)); exit();
			}
			else if($_POST[report_type]=='4'){ //listedcompanies
				$this->render('listedcompanies', array('data'=>$data)); exit();
			}
			else if($_POST[report_type]=='5'){ //comapany rates
			
			}
			else if($_POST[report_type]=='6'){ //Daily Occupancy Report
				$this->render('dailyoccupancy'); exit();
			}
			else if($_POST[report_type]=='7'){ //corporatecin
				$this->render('corporatecin', array('data'=>$data)); exit();
			}
			else if($_POST[report_type]=='8'){ //corporatecout
				$this->render('corporatecout', array('data'=>$data)); exit();
			}
			else if($_POST[report_type]=='9'){ //corporatecout
				$this->render('allcheckins', array('data'=>$data)); exit();
			}
			else if($_POST[report_type]=='10'){ //corporatecout
				$this->render('allcheckouts', array('data'=>$data)); exit();
			}
			else if($_POST[report_type]=='11'){ //room status
				$this->render('roomstatus', array('data'=>$data)); exit();
			}
			else if($_POST[report_type]=='12'){ //sales report
				$this->render('salesreport', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='13'){ //Out of Order Room Report
				$this->render('roomoutoforder', array('data'=>$data)); exit();
				
			}
				else if($_POST[report_type]=='14'){ //No Show Report
					$this->render('noshowreport', array('data'=>$data)); exit();
					
			}
			else if($_POST[report_type]=='21'){ //Guest status
				$this->render('gueststatus', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='22'){ //Guest Drop
				$this->render('guestdrop', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='23'){ //Birthday
				$this->render('groupreservations', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='31'){ //change credit summary
				$this->render('c_c_summary', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='24'){ //Guest In House Report
				$this->render('guestinhouse', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='25'){ //Group In House Report
				$this->render('groupinhouse', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='41'){ //Market Segment Wise Report
				$this->render('Marketsegmentwise', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='46'){ //Market Segment Wise Report
				$this->render('chargecodewise', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='26'){ //Company Wise Report
				$this->render('companywise', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='27'){ //Expected Corporate Checkout Report
				$this->render('expectedcorporate_checkout', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='28'){ //Expected General Checkout Report
				$this->render('ecpectegeneral_checkout', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='29'){ //Overall Expecterd Checkout
				$this->render('overallexpected_checkout', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='30'){ //Guest History Report
				$this->render('guesthistory', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='32'){ //House Count Wise Report
				$this->render('housecount', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='51'){ //Sales Person Wise Report
				$this->render('salespersonwise', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='121'){ //Room Shifting Report
				$this->render('roomshifting', array('data'=>$data)); exit();
				
			}
			
			else if($_POST[report_type]=='33'){ //reservation
				$this->render('reservation', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='52'){ //Production Report Sales Person Wiset
				$this->render('company_ledger', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='53'){ //Market Segment Report Company Wise
				$this->render('ms_companywise', array('data'=>$data)); exit();				
			}			
			else if($_POST[report_type]=='55'){ //Sales Person Wise Report
				//$this->render('roomforecast', array('data'=>$data)); exit();
				$this->render('forecast', array('data'=>$data)); exit();
			}
			else if($_POST[report_type]=='34'){ //Police Report For Checkin Guest
				
				//echo "alled "; print_r($data);
				$this->render('policecheckin', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='35'){ //Police Report For Checkout Guest
				$this->render('policecheckout', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='42'){ //PickUp Summary Report
				$this->render('guestpick' , array('data'=>$data)); exit();
				
			}
			
			else if($_POST[report_type]=='36'){ //Nationaily Wise Report
				$this->render('nationalitywise', array('data'=>$data)); exit();				
			}
			else if($_POST[report_type]=='37'){ //Long staying  Report
				$this->render('longstaying', array('data'=>$data)); exit();				
			}
			else if($_POST[report_type]=='38'){ //Long staying  Report
				$this->render('selectguest_birthday', array('data'=>$data)); exit();				
			}
			else if($_POST[report_type]=='91'){ //Long staying  Report
				$this->render('companyoverdue'); exit();				
			}else if($_POST[report_type]=='92'){ //Long staying  Report
				$this->render('room_overdue'); exit();			
			}else if($_POST[report_type]=='93'){ //Long staying  Report
				$this->render('marketsegmentwise', array('data'=>$data)); exit();				
			}
			
			else{
				echo "Some Error Occured while processing your request"; exit; 
			}
		
			//$model = new ReservationInfo;
		
		
		}
		
		$this->render('panel'); 
	}
	
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array('model'=>$this->loadModel($id),));
	}
	
	///////////////////
	public function actionCompanyguestdetails($id){		
		$this->layout = '//layouts/report';
		
		$file=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../css/report.css';
			$url = Yii::app()->getAssetManager()->publish($file);
			$cs = Yii::app()->getClientScript(); 
			$cs->registerCssFile($url);
			$this->getTaxSession();
			
		$this->render('companyguestdetails',array('company_id'=>(int)$id));
	}
	
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		
		//echo "testing ";
		//$dataProvider=new CActiveDataProvider('Test');
		//$this->render('index',array('dataProvider'=>$dataProvider,));  
		
		//$user = User::model()->findAll("id > 0");
		
		$hotel_branch_id = yii::app()->user->branch_id;		
		$total_rooms = RoomMaster::model()->findAll("branch_id=$hotel_branch_id");
		$total_res = ReservationInfo::model()->findAll("reservation_status = 1 AND branch_id=$hotel_branch_id");		
		$occupied_rooms = CheckinInfo::model()->findAll("branch_id=$hotel_branch_id");		
		//print_r($rooms);
		//foreach($user as $k => $v) echo "<br>$k=$v";
		echo count($rooms). "-" . count($total_res). "-" . count($occupied_rooms);		
		$dataProvider =$user;
		$this->render('index',array('dataProvider'=>$dataProvider,));  
		
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Test('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Test']))
			$model->attributes=$_GET['Test'];
		$this->render('admin',array('model'=>$model,));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Test::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='test-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	///////////////////////////THIs IS FOR FRONT DESK USERS
	public function actionShow_panel()
	{
		error_reporting(0);
		if($_POST){
			
			$this->layout = '//layouts/report';
				
			$report_type = $_POST['report_type'];
			$from_date = $_POST['from_date'];			
			$to_date = $_POST['to_date'];
			$con = $_POST['con'];
			
			$file=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../css/report.css';
			$url = Yii::app()->getAssetManager()->publish($file);
			$cs = Yii::app()->getClientScript(); 
			$cs->registerCssFile($url);
			
			$this->getTaxSession();
						
			$data = array('report_type'=>$report_type,'to_date'=>$to_date,'from_date'=>$from_date, 'criteria'=>$con);
			
			//foreach($_POST as $k =>$v)echo "<br>$k=$v";
			if($_POST[report_type]=='1'){ //Daily inHouse report
				$this->render('inhouse'); exit();
			}
			else if($_POST[report_type]=='2'){ //expectedarrivals
				$this->render('expectedarrivals', array('data'=>$data)); exit();	
			}
			else if($_POST[report_type]=='3'){//canceledRes
				$this->render('canceledRes', array('data'=>$data)); exit();
			}
			else if($_POST[report_type]=='4'){ //listedcompanies
				$this->render('listedcompanies'); exit();
			}
			else if($_POST[report_type]=='5'){ //comapany rates
			
			}
			else if($_POST[report_type]=='6'){ //Daily Occupancy Report
				$this->render('dailyoccupancy'); exit();
			}
			else if($_POST[report_type]=='7'){ //corporatecin
				$this->render('corporatecin', array('data'=>$data)); exit();
			}
			else if($_POST[report_type]=='8'){ //corporatecout
				$this->render('corporatecout', array('data'=>$data)); exit();
			}
			else if($_POST[report_type]=='9'){ //corporatecout
				$this->render('allcheckins', array('data'=>$data)); exit();
			}
			else if($_POST[report_type]=='10'){ //corporatecout
				$this->render('allcheckouts', array('data'=>$data)); exit();
			}
			else if($_POST[report_type]=='11'){ //room status
				$this->render('roomstatus', array('data'=>$data)); exit();
			}
			
			else if($_POST[report_type]=='13'){ //Out of Order Room Report
				$this->render('roomoutoforder', array('data'=>$data)); exit();
				
			}
				else if($_POST[report_type]=='14'){ //No Show Report
					$this->render('noshowreport', array('data'=>$data)); exit();
					
			}
			else if($_POST[report_type]=='21'){ //Guest status
				$this->render('gueststatus', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='22'){ //Guest Drop
				$this->render('guestdrop', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='23'){ //Birthday
				$this->render('groupreservations', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='31'){ //change credit summary
				$this->render('c_c_summary', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='24'){ //Guest In House Report
				$this->render('guestinhouse', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='25'){ //Group In House Report
				$this->render('groupinhouse', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='41'){ //Market Segment Wise Report
				$this->render('Marketsegmentwise', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='46'){ //Market Segment Wise Report
				$this->render('chargecodewise', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='26'){ //Company Wise Report
				$this->render('companywise', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='27'){ //Expected Corporate Checkout Report
				$this->render('expectedcorporate_checkout', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='28'){ //Expected General Checkout Report
				$this->render('ecpectegeneral_checkout', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='29'){ //Overall Expecterd Checkout
				$this->render('overallexpected_checkout', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='30'){ //Guest History Report
				$this->render('guesthistory', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='32'){ //House Count Wise Report
				$this->render('housecount', array('data'=>$data)); exit();
				
			}
			
			else if($_POST[report_type]=='121'){ //Room Shifting Report
				$this->render('roomshifting', array('data'=>$data)); exit();
				
			}
			
			else if($_POST[report_type]=='33'){ //reservation
				$this->render('reservation', array('data'=>$data)); exit();
				
			}
			
			else if($_POST[report_type]=='53'){ //Market Segment Report Company Wise
				$this->render('ms_companywise', array('data'=>$data)); exit();
				
			}
			
			else if($_POST[report_type]=='55'){ //Sales Person Wise Report
				//$this->render('roomforecast', array('data'=>$data)); exit();
				$this->render('forecast', array('data'=>$data)); exit();
			}
			
			else if($_POST[report_type]=='34'){ //Police Report For Checkin Guest
				
				//echo "alled "; print_r($data);
				$this->render('policecheckin', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='35'){ //Police Report For Checkout Guest
				$this->render('policecheckout', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='42'){ //PickUp Summary Report
				$this->render('guestpick' , array('data'=>$data)); exit();
				
			}
			
			else if($_POST[report_type]=='36'){ //Nationaily Wise Report
				$this->render('nationalitywise', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='37'){ //Long staying  Report
				$this->render('longstaying', array('data'=>$data)); exit();
				
			}
			else if($_POST[report_type]=='38'){ //Long staying  Report
				$this->render('selectguest_birthday', array('data'=>$data)); exit();
				
			}
			
			else{
				$this->render('panel2'); 
			}
		
			//$model = new ReservationInfo;
		
		
		}
		
		$this->render('panel2'); 
	}
	
	//////////////////
	protected function getTaxSession(){
	 $res = Yii::app()->db->createCommand("select value from settings where unit LIKE 'taxcontrol'")->queryScalar();			
			 if($res==1){ Yii::app()->session->add('taxcontrol','ON');	 }  //control is on	
			 if($res==0){ Yii::app()->session->add('taxcontrol','OFF');	 }  //control is on		
	}
	
	//////////////////////////////
}
