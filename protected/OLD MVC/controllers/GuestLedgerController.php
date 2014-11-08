<?php
class GuestLedgerController extends SBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	/**
	 * @return array action filters
	 */
	public function filters()
	{ 
		/* return array(
			'accessControl + Dothis', // perform access control for CRUD operations
		);  */
	}
	
	
	/* public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'admin', 'dothis'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	} */
	
	public function actionCash(){
		
	}
	public function actionDivideBill($id=0){
		
		if($id==0){	echo "nothing is selected"; exit;	}
		
				
		$sql = "select service_id from hms_services where service_description LIKE 'ROOM RENT'";
		$roomrent_service_id = Yii::app()->db->createCommand($sql)->queryScalar();
		
		$sql = "select service_id from hms_services where service_description LIKE 'GST'";
		$gst_service_id = Yii::app()->db->createCommand($sql)->queryScalar(); 
		
		if(isset($_POST['GuestLedger'])){
			$model = new GuestLedger();
			$model->attributes=$_POST['GuestLedger'];			
			
			//update previous debit value 
			$debit = $model->debit; 
			$room_rent1 = $_POST['GuestLedger']['room_rent1']; 
			$room_rent2 = $_POST['GuestLedger']['room_rent2'];
			
			//not update GST	
			$gst_rate =  ServiceGst::model()->find("gst_service_id = $gst_service_id AND branch_id=". yii::app()->user->branch_id)->gst_percent;		
			$new_gst1 = $room_rent1 * ($gst_rate/100);
			$new_gst2 = $room_rent2 * ($gst_rate/100);
			
			//THIS TOTAL IS USED TO PREVENT THE SCRIPT TO RUN ONCE THE BILL IS SPLIT
			$sql = "select count(id) from hms_guest_ledger where debit!= $debit AND service_id =".$roomrent_service_id. " and chkin_id = ". $model->chkin_id;
			$total_rows = Yii::app()->db->createCommand($sql)->queryScalar();
			$res = 0;
					
			$gl = GuestLedger::model()->findAll("(service_id = $roomrent_service_id || service_id = $gst_service_id) AND chkin_id = ". $model->chkin_id);
			foreach($gl as $row){
				$gl_id = $row[id];
				$gl_service_id = $row[service_id];
				
				if($total_rows ==0 && $room_rent1 > 0 && $room_rent1 < $debit){
				$res = Yii::app()->db->createCommand()->update('hms_guest_ledger',array('debit'=>$room_rent1),'service_id=:service_id AND id=:id',	
				array(':service_id'=>$roomrent_service_id, ':id'=>$gl_id));
				Yii::app()->db->createCommand()->update('hms_guest_ledger',array('debit'=>$new_gst1), 'service_id=:service_id AND id=:id',
				array(':service_id'=>$gst_service_id, ':id'=>$gl_id));
				}
	
				if($res && $gl_service_id = $roomrent_service_id){
					$model_new = new GuestLedger;
					$model_new->attributes=$_POST['GuestLedger'];
					$model_new->service_id = $roomrent_service_id; 
					$model_new->debit = $room_rent2;
					$model_new->c_date = $row[c_date];
					$model_new->save();
				}
				if($res && $gl_service_id = $gst_service_id){
					$model_new_gst = new GuestLedger;
					$model_new_gst->attributes=$_POST['GuestLedger'];
					$model_new_gst->service_id = $gst_service_id; 
					$model_new_gst->debit = $new_gst2;
					$model_new_gst->c_date = $row[c_date];
					$model_new_gst->save();
				}
	
			}//end foreach
				$this->redirect(array('CheckinInfo/admin'));
		}
		
		$model = GuestLedger::model()->findByAttributes(array('chkin_id'=>$id, 'service_id'=>$roomrent_service_id));
		$this->render('dividebill',array('model'=>$model));
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id){
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionCharts(){
		$this->layout = '//layouts/column1';
		$this->render('google_charts');
	}
	
	public function actionCodewise(){
		$model = new GuestLedger();
		
		if(isset($_POST['GuestLedger'])){
			$res = Yii::app()->db->createCommand("select value from settings where unit LIKE 'taxcontrol'")->queryScalar();			
			 if($res==1){ Yii::app()->session->add('taxcontrol','ON');	 }  //control is on	
			 if($res==0){ Yii::app()->session->add('taxcontrol','OFF');	 }  //control is on
						
			$c_date = $_POST['GuestLedger']['c_date'];				
			$this->render('codewise', array('c_date'=>$c_date)); exit();
		}
		$this->render('codewisesummary', array('model'=>$model));		
	}
	///////////////////////////////////////////////////
	public function actionChargeCode(){
		$model = new GuestLedger();
		
		if(isset($_POST['GuestLedger'])){		
			$res = Yii::app()->db->createCommand("select value from settings where unit LIKE 'taxcontrol'")->queryScalar();			
			 if($res==1){ Yii::app()->session->add('taxcontrol','ON');	 }  //control is on	
			 if($res==0){ Yii::app()->session->add('taxcontrol','OFF');	 }  //control is on
			 		
			$from_date = $_POST['GuestLedger']['from_date'];
			$to_date = $_POST['GuestLedger']['to_date'];				
			$this->render('codewise_tax', array('from_date'=>$from_date, 'to_date'=>$to_date)); exit();
		}
		$this->render('codewisesummary_tax', array('model'=>$model));	
	}
	///////////////////////////////////////////////////////////
	public function actionBtc(){
		
		$model=new GuestLedger('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GuestLedger']))
			$model->attributes=$_GET['GuestLedger'];
							
		$this->render('btcPayments',array('model'=>$model,));
	}
	
	public function actionPayBTC($id){ //overdue payment against this company id	
		$model=new GuestLedger();	
		$model->company_id = $id;	
		if(isset($_POST['GuestLedger'])){
			
			$folioids = $_POST['GuestLedger']['folioids'];
			$company_id = $_POST['GuestLedger']['company_id'];
			
			if(!empty($folioids)){
				$res = explode("-",$folioids);
				////get the amount of remaining balance against each folio and update row
				for($i=0; $i< count($res);$i++){
					$re = GuestLedger::model()->find("btc=3 AND chkin_id = ".$res[$i]);
					$bal = $re->balance;
					$sql = "update hms_guest_ledger set credit='$bal', balance=0 where btc=3 AND chkin_id = ".$res[$i];
					Yii::app()->db->createCommand($sql)->execute();					
				}
				//print_r($_POST['GuestLedger']); ///print_r($model->getErrors());
				$this->redirect(array("btc"));
			}
			else{ 
			     //echo $model->validate();
				 $errores = "Please Select a Folio"; // $this->render('index', array('model' => $errores));
				 $this->render( 'getbtcpayment', array( 'model' => $model,'errors'=>$errores ));
				 Yii::app()->end();
			}
		}
		$this->render( 'getbtcpayment', array( 'model' => $model));
		
	}
	
	
	public function actionViewBill($id)	{		
		$model = GuestLedger::model()->find("chkin_id = $id");		
		
		$this->layout = '//layouts/report';
		$dashboard = Yii::app()->db->createCommand("select value from settings where unit = 'bill_template'")->queryScalar();
		if($dashboard ==1)//crown plaza		
			$this->render('viewBill',array('model'=>$model,));	
		else 	
			$this->render('viewBill - Copy',array('model'=>$model,));	
	}
	
	public function actionDayClose(){
		
		$DayEnd=new DayEnd;
		if(isset($_POST['DayEnd']))
		{
			$DayEnd->attributes=$_POST['DayEnd'];
			
			$branch_id = yii::app()->user->branch_id;					
			$res = DayEnd::model()->find("branch_id= $branch_id");
			
			$today_date = $DayEnd->today_date = date("Y-m-d");
			$active_date = $DayEnd->active_date = date('Y-m-d', strtotime($res->active_date . ' + 1 day'));
			$night_post = $DayEnd->night_post;
			
			if(count($res) == 0){	$model->save();	}
			else{
				$sql = "update day_end set today_date='$today_date',active_date='$active_date',night_post='$night_post'";
				$sql .=" where branch_id= $branch_id";			
				Yii::app()->db->createCommand($sql)->query();				
				$this->redirect('Dayclose');			
			}
		}
		
		$this->render('dayclose',array(	'model'=>$DayEnd,));		
	}
	
	////////////////////
	public function DayClose2(){ // this functionis being called from creatRoomPost after night post operation is completed.
		
			$DayEnd=new DayEnd;
			$branch_id = yii::app()->user->branch_id;					
			$res = DayEnd::model()->find("branch_id= $branch_id");
			
			$today_date = $DayEnd->today_date = date("Y-m-d");
			$active_date = $DayEnd->active_date = date('Y-m-d', strtotime($DayEnd->today_date . ' + 1 day'));
			$night_post = 1;
			
			if(count($res) == 0){ 	$model->save();	}
			else{
				$sql = "update day_end set today_date='$today_date',active_date='$active_date',night_post='$night_post'";
				$sql .=" where branch_id= $branch_id";			
				Yii::app()->db->createCommand($sql)->query();				
			}		
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new GuestLedger;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['GuestLedger']))
		{
			$model->attributes=$_POST['GuestLedger'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('create',array(	'model'=>$model,));
	}		
	//////////////////	
	public function actionMergebills(){
		
		if($_POST && count($_POST['CheckinInfo']['merge']) > 0){
			$this->layout = '//layouts/report';
			//print_r($_POST);
			$fid = $_POST['CheckinInfo']['merge'];			
			$this->render('mergefolio', array('folionos'=>$fid,));
			exit();
		}
		$this->layout='//layouts/column1';
		$this->render('mergebills');
	}
	//////////////////////////////////
	
	public function actionSplit($id=7){
		
		if($_POST){
			$this->layout = '//layouts/report';
			$fid = $_POST['foliono'];
			$this->render('splitfolio', array('foliono'=>$fid,));
			exit();
		}
		
		$this->layout='//layouts/column1';
		
		$model=new GuestLedger('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GuestLedger']))
			$model->attributes=$_GET['GuestLedger'];
		
		$this->render('split',array('model'=>$model,));
		
	}
	
	public function actionDothis(){	
						
			$id = $_REQUEST['billno'];			
			$sql = "select * from hms_guest_ledger where chkin_id = $id";
			$res = Yii::app()->db->createCommand($sql)->query();
			
			 $i=0; $str="";$total_dr = 0; $total_cr = 0;
			 
			$str="<table id=\"mytable\" width=\"500\" ><tr>
			<td width=\"25\"><b>Sr#</b></td>
			<td width=\"40\"><b>Select</b></td>
			<td width=\"150\"><b>Service</b></td>
			<td width=\"200\"><b>Details</b></td>
			<td width=\"40\"><b>Dr</b></td>
			<td width=\"45\"><b>Cr</b></td>
			</tr>";
		   foreach($res as $row){
			   $i++;
			   $id = $row['id'];
			   $s_id = $row['service_id'];
			   $service_id = Services::model()->find("service_id = ".$s_id)->service_description;		   
			   $remarks = $row['remarks'];
			   $debit = $row['debit'];
			   $credit = $row['credit'];
			   
			   $total_dr +=	$debit;			
			   $total_cr += $credit;
			
				$str .="<tr>";
				$str .="<td>$i</td>";
				$str .="<td><input type=\"checkbox\" name=\"cbk\" id=\"cbk-$i\" value=\"$id\" /></td>";
				$str .="<td>$service_id</td>";
				$str .="<td>$remarks</td>";
				$str .="<td>$debit</td>";
				$str .="<td>$credit</td>";
				$str .="</tr>";		   
			}  
			
				$str .="<tr id=\"total_bill\">";
				$str .="<td colspan=\"3\"></td>";				
				$str .="<td><b>Total</b></td>";
				$str .="<td><b>$total_dr</b></td>";
				$str .="<td><b>$total_cr</b></td>";
				$str .="</tr>"; 
						 
		$str .="</table>";
		$str .="<div><input type=\"button\" name=\"btn\"  value=\" Add to Folio 1 \" onclick=\"process($i, 1)\" />";
		$str .="<input type=\"button\" name=\"btn\"  value=\" Add to Folio 2 \" onclick=\"process($i, 2)\" />";
		$str .="<input type=\"button\" name=\"btn\"  value=\" Add to Folio 3 \" onclick=\"process($i, 3)\" />";
		$str .="</div>";	
			echo $str;
	}
		
	public function actionMyprint(){		
		$chkstr = $_POST['chkstr'];
		
		if(isset($_POST['mychkin_id']) && !empty($_POST['mychkin_id']) && !empty($chkstr)){
			$id = $_POST['mychkin_id'];	
						
			$this->layout = '//layouts/report';
			$this->render('splitbill',array('chkstr'=>$chkstr,'chkin_id'=>$id));
		}
		else
			throw new CHttpException(400,'Error, Folio No or service not selected. Please refresh the page to try again.');
	}
	//// end of faisal code
	
//////////////////auto room posting or NIGHT POSTING //////////////////
	public function actionCreateRoomPost(){					
					
					$branch_id = yii::app()->user->branch_id;
					$ad = DayEnd::model()->find("branch_id= $branch_id");
					//YOU CAN GET ACTIVE DATE FROM DAYEND TABLE		
					$active_date = $ad->active_date; date('Y-m-d');		
					$status_msg = "Night Post action has already completed for today.";
					$total_guest_night_posted_to = 0;
			
			//===========================================
		$msg ='';
		$room_rent_service_id = Yii::app()->db->createCommand()->select('service_id')->from('hms_services')->where("service_description like 'room rent'")->queryScalar();
		if(!$room_rent_service_id>0){		$msg .='<br>Please Define Room Rent Service first';			}
		
		$gst_service_id = Yii::app()->db->createCommand()->select('service_id')->from('hms_services')->where("service_description like 'gst'")->queryScalar();				
		if(!$gst_service_id>0){$msg .='Please Define GST Service first';}		
		
		$bed_tax_service_id = Yii::app()->db->createCommand()->select('service_id')->from('hms_services')->where("service_description like 'bed tax'")->queryScalar();
		if(!$bed_tax_service_id>0){		$msg .='<br>Please Define Bed Tax Service first';	}	
		
		$extra_bed_service_id = Yii::app()->db->createCommand()->select('service_id')->from('hms_services')->where("service_description like 'Extra Bed'")->queryScalar();
		if(!$extra_bed_service_id>0){		$msg .='<br>Please Define Extra Bed Service first';			}
	
		
		//////////////////////////////////////////
				
				//AND chkin_date NOT LIKE '$active_date %' 				
				$result = CheckinInfo::model()->findAll("chkout_status = 'N' AND (night_post_date = '0000:00:00' || night_post_date !='$active_date') AND branch_id =". $branch_id);					
					// if(count($result) >= 0) {$status_msg .= "...". count($result). " Records effected";}
					//else $status_msg = "Some problem occured";					
					 foreach($result as $row){		//outer for loop start				
							$chkin_id = $row['chkin_id'];
							$total_person = $row['total_person'];							
							$rate = $row['rate'];
							$checkin_room_id = $row['room_id'];
							$gst = $row['gst'];
							$bed_tax = $row['bed_tax'];
							$chkin_date= date("Y-m-d", strtotime($row['chkin_date']));
							$chkout_date=  date("Y-m-d", strtotime($row['chkout_date']));
							
							//extra bed 
							$extra_bed = $row['extra_bed'];
							$guestid = $row['guest_id'];						
							$guest_name = GuestInfo::model()->find("guest_id=:id",array(":id"=>$guestid))->guest_name;								
						
						///following line will check that if there is already room rent entered then it will not post night in ledger some times it entered double night so that i handle this bug with this
						//$check = GuestLedger::model()->find("chkin_id=:folio and c_date=:c_date and service_id =:service_id and branch_id=:branch_id",array(":folio"=>$chkin_id,":c_date"=>$active_date,":service_id"=>1,":branch_id"=>$branch_id));
						
						//$status_msg .= "1st query runs successfully.";
						$check = GuestLedger::model()->find("chkin_id=$chkin_id and c_date NOT LIKE '$active_date %' and branch_id= $branch_id");
						if($check->id > 0 ) { //foreach($check as $row2){
										$total_guest_night_posted_to++;
										$ledger = new GuestLedger;	
										$ledger->attributes=$_POST['GuestLedger'];
										//-----------------
										$ledger->chkin_id = $chkin_id;
										$ledger->guest_name = $guest_name;
										$ledger->room_status= "O";
										$ledger->room_id = $checkin_room_id ; //$check->room_id; //get room id from checkin table
										$ledger->chkin_date = $chkin_date . " 00:00:00";
										$ledger->chkout_date = $chkout_date. " 00:00:00";
										//$ledger->c_date = $date = date('Y-m-d H:i:s'); //value is assigned in beforeSave
										$ledger->c_time = $date = date('H:i:s');
										$ledger->remarks="-";
										//-----------------------
										$ledger->cash_paid =0;
										$ledger->credit_card = 0;
										$ledger->credit_card_no = 0;
										$ledger->btc = 0;
										$ledger->company_id = $check->company_id;
										$ledger->user_id = yii::app()->user->id;
										$ledger->late_out = "N";
										$ledger->branch_id = yii::app()->user->branch_id;	
					$gst_rate = ServiceGst::model()->find("gst_id = 1 AND branch_id=". yii::app()->user->branch_id)->gst_percent;										
										$gst_amount = $rate * $gst_rate / 100;	
										$ledger->credit = 0;
										$ledger->balance = 0;		
										
											
										$res22 = Yii::app()->db->createCommand("select acc_no from hms_guest_info where guest_id = '$guestid'")->query();				
										foreach ($res22 as $row){ $guest_acc_id = $row['acc_no'];}
										
										// CHECK BED TAX IMPOSITION VALUE IN SETTING TABLE
				$add_bed_tax = Yii::app()->db->createCommand("select value from settings where unit = 'bed_tax'")->queryScalar();	
										//---------------------	
			$connection=Yii::app()->db;
			$transaction=$connection->beginTransaction();
			try{									
								for($i=0; $i < 3; $i++){
									$ledger->setIsNewRecord(true);
									$ledger->setPrimaryKey(NULL);
									$ledger->day_close = 2;
									
									if($rate > 0){			//room rate								
										$ledger->service_id = $room_rent_service_id ; //1;
										$ledger->debit = $rate;	
										$service_acc_id = $this->getServiceAccountId(1);
										$this->accountLedgerEntry($guest_acc_id, $service_acc_id,  $rate, $chkin_id);																
										if($ledger->save(false)){$rate =0; }																	
									}
									else if($gst == "Y"){ //gst
										$ledger->service_id = $gst_service_id;		//2								
										$ledger->debit = $gst_amount;	
										$service_acc_id = $this->getServiceAccountId(2);
										$this->accountLedgerEntry($guest_acc_id, $service_acc_id,  $gst_amount, $chkin_id);																				
										if($ledger->save(false)){$gst = "N";}	
									}
									else if($bed_tax == "Y" and $add_bed_tax == 1){ //bed tax
										$ledger->service_id = $bed_tax_service_id; //21;										
										$ledger->debit = $total_person;;
										$service_acc_id = $this->getServiceAccountId(21);
										$this->accountLedgerEntry($guest_acc_id, $service_acc_id,  $total_person, $chkin_id);																					
										if($ledger->save(false)){$bed_tax = "N";}			
									}	
																			
								}//end inner for loop	
								$status_msg = "Night Post Operation Completed Successfully"; //count($result)." rows affected";		
								//update checkin info table Night_post_date column to keep recor
								$sql = "update hms_checkin_info set night_post_date = '".$active_date. "' where chkin_id = $chkin_id";						
								Yii::app()->db->createCommand($sql)->query();	
								//update lsat night post date 
								$sql = "update day_end set last_night_post = '".date('Y-m-d H:i:s'). "' where branch_id = $branch_id";						
								Yii::app()->db->createCommand($sql)->query();							
			
			$transaction->commit();
			}catch(Exception $e){ 	$transaction->rollback(); }	
										
													
								}//end if check->id							
						
						}///end outer for each loop
									
						//$this->actionDayClose2();
						if($total_guest_night_posted_to > 0) $status_msg = "Night Post Operation Completed [$total_guest_night_posted_to] for Guests";
							 		
				 echo $status_msg;
	}
////////////////end auto room posting///////////////
	public function actionCreateS($id=0){
		$model=new GuestLedger;
		
		if($id>0){
				$model->chkin_id = $id;
				$result = CheckinInfo::model()->find("chkin_id=:chkin_id",array(":chkin_id"=>$id));
				$guestid = $result->guest_id;
				$result_1 = GuestInfo::model()->find("guest_id=:id",array(":id"=>$guestid));
				$model->guest_name = $result_1->guest_name;	
				$model->room_id = $result->room_id;
				$model->chkin_date=$result->chkin_date;
				$model->chkout_date=$result->chkout_date;
				$model->company_id = $result->guest_company_id;
				$res22 = Yii::app()->db->createCommand("select acc_no from hms_guest_info where guest_id = '$guestid'")->queryRow();
				$guest_acc_id = $res22['acc_no'];
				//print_r($res22);
			}
		else{ // cash entry
				$model->chkin_id = 0;				
				$guestid = 0;				
				$model->guest_name = 0;	
				$model->room_id = 0;
				$model->chkin_date=0;
				$model->chkout_date=0;
				//$model->company_id = 0;				
				$guest_acc_id = 0;
			
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['GuestLedger'])){
			$model->attributes=$_POST['GuestLedger'];
			if(empty($model->room_id) || $model->room_id ==0)$model->room_id = NULL;
			//$model->company_id = NULL;			
			$branch_id = yii::app()->user->branch_id;
			if(!empty($_POST['GuestLedger']['service_code']) && empty($_POST['GuestLedger']['service_id'])){
				$service_code = trim($_POST['GuestLedger']['service_code']);		
				$model->service_id = Services::model()->find("service_code=". $service_code)->service_id;
			}
			
			if($model->validate()){	
					$service_id = $model->service_id;
					$service_acc_id = $this->getServiceAccountId($service_id);
					$amount =  $model->debit;			
					$s_type = Services::model()->find("service_id=".$service_id)->servise_type;			
					if($s_type=='Dr'){		
						$model->debit=$amount;			$model->credit=0;
						//$this->accountLedgerEntry($guest_acc_id, $service_acc_id,  $amount, $model->chkin_id);
					}
					if($s_type=='Cr'){
						$model->debit=0;		    $model->credit=$amount;	
						//$this->accountLedgerEntry($service_acc_id, $guest_acc_id, $amount, $model->chkin_id);
					}			
						$model->day_close = 4;
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
			}//not validated
				//$this->redirect(array('view','id'=>$model->id));
		}
		if( Yii::app()->request->isAjaxRequest ) {
				// Stop jQuery from re-initialization
				Yii::app()->clientScript->scriptMap['jquery.js'] = false;
			 
				echo CJSON::encode( array(
				  'status' => 'failure',
				  'content' => $this->renderPartial( '_formS', array(
					'model' => $model ), true, true ),
				));
				exit;
			  }else{
				$this->render( 'createS', array( 'model' => $model ) );
			  }
	}
	////////////////////////
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
	////////////////////////////////////////////////////////////////
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);		
		$service_id = $model->service_id;		
		$result_service = Services::model()->find("service_id=:id",array(":id"=>$service_id));
			$s_type = $result_service->servise_type;
			$service_name = $result_service->service_description;
			$service_code = $result_service->service_code;
			$model->service_name = $service_name;
			
			if($s_type=="Dr")$model->debit=$model->debit;
			else $model->debit=$model->credit;
				 
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['GuestLedger'])){			
			$model->attributes=$_POST['GuestLedger'];
			
			$time = date("H:i:s", time());
			$c_date = explode(" ",$model->c_date);
			if(count($c_date) == 1)	{$model->c_date = date('Y-m-d', strtotime($c_date[0]))." ". $time; ;}
			else { $model->c_date = date('Y-m-d H:i:s', strtotime($model->c_date)); }
			
			//$model->c_date = $model->c_date." 00:00:00";
			$amount = $model->debit;
			
			if($s_type=="Dr"){
				$model->debit=$amount;
				$model->credit=0;
				}else{
					$model->debit=0;
				    $model->credit=$amount;
					}
					//echo "------------>>>".$_POST['GuestLedger']['c_date'];
					$model->day_close = 3;
					if($model->save()){
						  if( Yii::app()->request->isAjaxRequest ){
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;			 
							echo CJSON::encode( array(
							  'status' => 'success',
							  'content' => 'Entry successfully updated',
							));
							exit;
						  }
						 else  $this->redirect( array( 'view', 'id' => $model->id ) );
					}
  			
		}//isset post GL
		if( Yii::app()->request->isAjaxRequest ) {
			// Stop jQuery from re-initialization
			Yii::app()->clientScript->scriptMap['jquery.js'] = false;		 
			echo CJSON::encode( array(
			  'status' => 'failure',
			  'content' => $this->renderPartial( '_formU', array('model' => $model, 'service_code'=>$service_code ), true, true ),
			));
			exit;
		  }
		  else
			$this->render( 'update', array( 'model' => $model ) );
}
////////////////////////////////////////////////////////////////////////////////////////////
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
		$dataProvider=new CActiveDataProvider('GuestLedger');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin($id=0){
		$this->layout='//layouts/column1';
		$model=new GuestLedger('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GuestLedger']))
			$model->attributes=$_GET['GuestLedger'];
		$this->render('admin',array('model'=>$model,));
	}
	
	public function actionTransferSelected()
	{
		$bill_from = $_POST['bill_from'];
		$bill_to = $_POST['bill_to'];		
		$ids = $_POST['ids'];
			
		$arr_ids = explode(',', $ids);
		
			//find name, room_id, company_id of other guest
			$gl_res = GuestLedger::model()->find("chkin_id=:id",array(":id"=>$bill_to));
			$guest_name = $gl_res->guest_name;
			$room_id = $gl_res->room_id;
			$chkin_date = $gl_res->chkin_date;
			$chkout_date = $gl_res->chkout_date;
			$company_id = $gl_res->company_id;
			
		
      		
		//echo "$bill_to--$guest_name--$room_id--$chkin_date--$chkout_date--$company_id--".count($arr_ids);
		
		//update guest ledger, set chkin_id = bill to also update other relative info
			
			for($i=0; $i< count($arr_ids); $i++){
			$sql = "update hms_guest_ledger set chkin_id='$bill_to', guest_name='$guest_name', room_id='$room_id' where id =".$arr_ids[$i];
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$command->execute();
			}
			echo "ok";			
		
	}
	/////////////////////
	public function ActionSplitFolio(){
		
		 $checked = trim($_POST['checked'],","); 
		 $unchecked = trim($_POST['notchecked'],",");
		 $id = explode(",",$checked);
		 $gl_res = GuestLedger::model()->find("id=".$id[0]); 		  		
		 $chkin_id = $gl_res->chkin_id; 
		
		$res = SplitMergeFolio::model()->find("bill_no=$chkin_id");
		if(count($res) > 0){
			$smfid = $res->id; 
			//$checked = $res->checked.",".trim($_POST['checked'],","); 
			//$unchecked = $res->unchecked;
			$sql=" update split_merge_folio set bill_no='$chkin_id', checked ='$checked', unchecked ='$unchecked' where id = $smfid";
		}
		else		
$sql = "Insert into split_merge_folio (bill_no, checked, unchecked) values ('$chkin_id','$checked','$unchecked')";
		
		
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->execute();
		echo $chkin_id; 
	}
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=GuestLedger::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='guest-ledger-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/////////////////////////
	public function actionOldfolio(){
		$model= new GuestLedger;
		//$fno = '89';
		if(isset($_POST)){
			//print_r($_POST);
			$fno = $_POST['GuestLedger']['chkin_id'];
			
			 $sval = Yii::app()->session['taxcontrol'];
			 if(isset($sval) && $sval=='ON' && !empty($fno)){ // if on gst_show is being used as folio no
				$sql = "select chkin_id from hms_checkin_info where gst_show = $fno";	
				$fno = Yii::app()->db->createCommand($sql)->queryScalar();
			}  
			
			$res = GuestLedger::model()->findByAttributes(array('chkin_id'=>$fno));	
			if(count($res) == 0)	$fno ='';	
			//$this->redirect(array('oldfolio', 'model'=>$model,'chkin_id'=>$fno ));
		}
		$this->render('oldfolio',array('model'=>$model,'chkin_id'=>$fno));
	
	}
	
	public function actionNightpost(){
		$model= new GuestLedger;
		$this->render('nightpost',array('model'=>$model));
	}
	/////////////////////////////////////////////
	////////////
	public function actionControlsheet(){
		$model = new AccountLedger;
		
		if(isset($_POST['AccountLedger'])){
			$this->layout = '//layouts/report';
			
			$file=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../css/report.css';
			$url = Yii::app()->getAssetManager()->publish($file);
			$cs = Yii::app()->getClientScript(); 
			$cs->registerCssFile($url);
			
			$res = Yii::app()->db->createCommand("select value from settings where unit LIKE 'taxcontrol'")->queryScalar();			
			 if($res==1){ Yii::app()->session->add('taxcontrol','ON');	 }  //control is on	
			 if($res==0){ Yii::app()->session->add('taxcontrol','OFF');	 }  //control is on		
			
			$created_date = $_POST['AccountLedger']['created_date'];				
			$this->render('control_sheet_report', array('created_date'=>$created_date)); exit();	
		}
		$this->render('controlsheet',array('model'=>$model,));		
	}
	////////////////////////////////////////
}
