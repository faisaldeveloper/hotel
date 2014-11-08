<?php
class AjaxcallsController extends Controller
{
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	////////////////
	public function actionFtest(){
		

$sql = "select distinct(chkin_id) from hms_guest_ledger where 1 limit 0 , 1000";
$res = Yii::app()->db->createCommand($sql)->query(); $i=0;
		foreach($res as $row){
		
		$sql2 = "select MAX(id) from hms_guest_ledger where chkin_id = ". $row['chkin_id'];
		$maxid = Yii::app()->db->createCommand($sql2)->queryScalar();
		
		$sql3 = "select service_id from hms_guest_ledger where id = ". $maxid;
		$service_id = Yii::app()->db->createCommand($sql3)->queryScalar();
		
		if($service_id !=19 && $service_id !=48 && $service_id !=11){
			echo "<br> - $maxid - ". $row['chkin_id'] . " - " . $service_id;
			$i++;
		}
		}
		
		echo "<br> - total : ". $i;
}
	
	//////////////////
	public function actionDays(){
		$sql = "select * from hms_guest_ledger where (debit=0 AND credit =0 AND balance =0) and room_status ='D' group by chkin_id";	
		$res = Yii::app()->db->createCommand($sql)->query();
		$old_chkin_id = 0; $i=0;
		foreach($res as $row){
		$lg = $row['id'];
		$chkin_id = $row['chkin_id'];
		$c_date = $row['c_date'];
		$name = $row['guest_name'];
		$debit = $row['debit'];
		$service_id = $row['service_id'];
		//$old_chkin_id = $chkin_id;
		
		
		list($days,  $rate) = $this->Cal($chkin_id);
		$total_charges = $this->Cal2($chkin_id); // actual charges calculated.
		
		//echo "<br /> $chkin_id - $c_date - $name - $days - $rate - $total_charges";
		$x1 = $days * $rate; // total amount calculated on the basis of days stayed.
		if($x1 == $total_charges){$s = "Y"; } else $s = "N";
			if($s=="N"  and $chkin_id !=0){
				$i++;
				echo "<br /> $i - $service_id - $chkin_id ---> $days - $rate - $x1 - [$total_charges] - $s";
				
			}
		
		$sql2 = "delete from hms_guest_ledger where id = $lg";
		// if($debit==0) Yii::app()->db->createCommand($sql2)->execute();
		}		
	}
	//////////////////////////////
	protected function Cal2($id){
		$sql = "select debit from hms_guest_ledger where chkin_id = $id and service_id = 1";	
		$t = 0;
		$res = Yii::app()->db->createCommand($sql)->query();
		foreach($res as $row){	$t += $row['debit']; }
		return $t;		
	}
	
	protected function Cal($id){
		$sql = "select * from hms_checkin_info where chkin_id = $id";	
		$res = Yii::app()->db->createCommand($sql)->query();
		foreach($res as $row){				
				$days = $row['total_days'];
				$rate = $row['rate'];
		}
		return array($days, $rate);		
	}
	
	////
	public function actionData(){	
	
		//Check current time and compare it with dayend current day and update dayend table set night post to 0 
		$current_date =  date("Y-m-d");
		$branch_id = yii::app()->user->branch_id;
		$res = DayEnd::model()->find("branch_id= $branch_id");	
		$active_date = $res->active_date;
		
		if(strtotime($current_date) > strtotime($active_date) || (strtotime($current_date) == strtotime($active_date) && date('H') >= 22)){
			$sql = "update day_end set night_post='0' where branch_id= $branch_id";			
			Yii::app()->db->createCommand($sql)->query();
			//echo "--:".date('H');	
		}
		//echo "-----------:".date('H')."--".strtotime($current_date)."---".strtotime($active_date);		
	}
	/////////////////////////////////////
	 public function actionDynamicDtime(){		
		$data=Flights::model()->find('flight_id=:flightid', array(':flightid'=>(int) $_POST['CheckinInfo']['flight_name']));	 
	 	//echo "------------------".$_POST['CheckinInfo']['flight_name'];
		$arr["flight_time"]=$data->flight_departure;		
		echo json_encode($arr);
	
	}
	/////////////////////////////
	public function actionUpdateLedger(){
		$x =0;
		//$sql = "select id, c_date from hms_guest_ledger where id > 6434 and c_date like '1970-01-01%'";
		$sql = "SELECT id, c_date FROM `hms_guest_ledger` WHERE c_date like '2013-10-05%' and (service_id = 1 ||  service_id = 2 || service_id = 21)";
		$res = Yii::app()->db->createCommand($sql)->queryAll();
		foreach($res as $row){
		$id = $row['id'];
		$c_date = $row['c_date'];
		$date2 = explode(" ",$c_date);
		$date = $date2[0];
		$time = $date2[1];	
		$new_date = "2013-10-04 ". $time;
		$sql = "update hms_guest_ledger set c_date = '$new_date' where id = $id";
		$res = Yii::app()->db->createCommand($sql)->execute();
		
		$x++;
		} 
		
		echo "<br>-- updated Rocords : ".$x;
		echo "<br>".CHtml::link('Go to DashBoard',array('/index.php')); 
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function actionRemoveDuplicateGuests(){
		$x =0;
		$sql = "select guest_id, guest_name from hms_guest_info where 1";
		$res = Yii::app()->db->createCommand($sql)->queryAll();
		foreach($res as $row){
		$gid = $row['guest_id'];
		$name = $row['guest_name'];
			$sql = "select guest_id from hms_checkin_info where guest_id = $gid";
			//echo "<br > - ".Yii::app()->db->createCommand($sql)->queryScalar();
			 $f = Yii::app()->db->createCommand($sql)->queryAll();
			if(count($f)==0){
				$mysql ="delete from hms_guest_info where guest_id = $gid";
				Yii::app()->db->createCommand($mysql)->execute();		
				$x++;		
			}
		} 
		
		echo "<br>-- Deleted Rocords : ".$x;
		echo "<br>".CHtml::link('Go to DashBoard',array('/index.php')); 
		echo "<br><br>".CHtml::link('Pure Duplicate Guests',array('/Ajaxcalls/PureDuplicateGuests'));
	}
	//////////////////////
	public function actionFindDuplicateGuests(){
		$x =0;
		$sql = "select guest_id, guest_name from hms_guest_info where 1";
		$res = Yii::app()->db->createCommand($sql)->queryAll();
		foreach($res as $row){
		$gid = $row['guest_id'];
		$name = $row['guest_name'];
			$sql = "select guest_id from hms_checkin_info where guest_id = $gid";
			//echo "<br > - ".Yii::app()->db->createCommand($sql)->queryScalar();
			 $f = Yii::app()->db->createCommand($sql)->queryAll();
			if(count($f)==0){
				 echo "<br > - ".$gid . " -- ". $name; $x++;
			}
		} 
		
		$this->getGuestByAttribute('mobile');		
		$this->getGuestByAttribute('identity_no');
		
		echo "<br><br><br>-- GUESTS NOT CONNECTED WITH ANY BILL : ".$x;
		
		//echo CHtml::button('Remove Duplicate Records', array('submit' => array('Ajaxcalls/RemoveDuplicateGuests')));
		if($x > 0) 
		echo "<br><br>".CHtml::link('Remove Duplicate Records',array('/Ajaxcalls/RemoveDuplicateGuests')); 
	   
		echo "<br><br>".CHtml::link('Go to DashBoard',array('/index.php')); 
		echo "<br><br>".CHtml::link('Pure Duplicate Guests',array('/Ajaxcalls/PureDuplicateGuests'));
	}
	/////////////////////////////////////////////////////////////////
	//////////////////////
	public function actionPureDuplicateGuests(){
		$x =0;
		$sql = "select guest_id, guest_name from hms_guest_info where 1";
		$res = Yii::app()->db->createCommand($sql)->queryAll();
		foreach($res as $row){
		$gid = $row['guest_id'];
		$name = $row['guest_name'];
			$sql = "select guest_id from hms_checkin_info where guest_id = $gid";
			//echo "<br > - ".Yii::app()->db->createCommand($sql)->queryScalar();
			 $f = Yii::app()->db->createCommand($sql)->queryAll();
			if(count($f)==0){
				 echo "<br > - ".$gid . " -- ". $name; $x++;
			}
		} 
		
		echo "<br><br> BY SAME NAME AND IDENTITY ID <br><br>";
		$this->getGuestByAttribute('all');
		
		echo "<br><br><br>-- GUESTS NOT CONNECTED WITH ANY BILL : ".$x;
		
		//echo CHtml::button('Remove Duplicate Records', array('submit' => array('Ajaxcalls/RemoveDuplicateGuests')));
		if($x > 0) 
		echo "<br><br>".CHtml::link('Remove Duplicate Records',array('/Ajaxcalls/RemoveDuplicateGuests')); 
	   
		echo "<br><br>".CHtml::link('Go to DashBoard',array('/index.php')); 
		echo "<br><br>".CHtml::link('Pure Duplicate Guests',array('/Ajaxcalls/PureDuplicateGuests')); 
	}
	/////////////////////////////////////////////////////////////////
	public function getGuestByAttribute($att){
		
		if($att=='mobile'){		
		$sql = "select t1.guest_id, t1.guest_name,t1.guest_mobile, t1.guest_identity_no
		   FROM hms_guest_info as t1
		   join hms_guest_info as t2
		  WHERE t1.guest_name = t2.guest_name
			and t1.`guest_mobile` = t2.`guest_mobile`
			and t1.guest_id < t2.guest_id";
		}
		if($att=='identity_no'){		
		$sql = "select t1.guest_id, t1.guest_name, t1.guest_mobile, t1.guest_identity_no
		   FROM hms_guest_info as t1
		   join hms_guest_info as t2
		  WHERE t1.guest_name = t2.guest_name
			and t1.`guest_company_id` = t2.`guest_company_id`
			and t1.guest_id < t2.guest_id";
		}
		if($att=='company_id'){		
		$sql = "select t1.guest_id, t1.guest_name, t1.guest_mobile, t1.guest_identity_no
		   FROM hms_guest_info as t1
		   join hms_guest_info as t2
		  WHERE t1.guest_name = t2.guest_name
			and t1.`guest_company_id` = t2.`guest_company_id`
			and t1.guest_id < t2.guest_id";
		}
		if($att=='all'){		
		$sql = "select t1.guest_id, t1.guest_name, t1.guest_mobile, t1.guest_identity_no
		   FROM hms_guest_info as t1
		   join hms_guest_info as t2
		  WHERE t1.guest_name = t2.guest_name
		  	and t1.`guest_mobile` = t2.`guest_mobile`
			and t1.`guest_identity_no` = t2.`guest_identity_no`
			and t1.guest_id < t2.guest_id";
		}
		
		$res = Yii::app()->db->createCommand($sql)->queryAll();
		$i=0;
		
		if(count($res) > 0 && $att=='mobile') echo "<br><br> BY SAME NAME AND MOBILE <br><br>";
		else if(count($res) > 0 && $att=='identity_no') echo "<br><br> BY SAME NAME AND IDENTITY ID <br><br>";
		foreach($res as $row){
			$i++;
			$gid = $row['guest_id'];
			$name = $row['guest_name'];
			$guest_mobile = $row['guest_mobile'];
			$guest_identity_no = $row['guest_identity_no'];	
			echo "<div> $gid - Mobile:- ".	$guest_mobile." - ID:- ".$guest_identity_no." - NAME:- ".$name." </div>";
			
			if($att=='all'){	$this->FixDuplicateGuest($gid); }
			
		}		
	}
	
	/////////////////////////////
	public function FixDuplicateGuest($gid=0){
		
		$sql = "select * from hms_guest_info where guest_id=$gid";
		$res = Yii::app()->db->createCommand($sql)->queryAll();
		foreach($res as $row){			
			$gid = $row['guest_id'];
			$guest_name = $row['guest_name'];
			$guest_mobile = $row['guest_mobile'];
			$guest_identity_no = $row['guest_identity_no'];	
		}
		
		$sql = "select * from hms_guest_info where guest_name = '$guest_name' AND guest_mobile = '$guest_mobile' AND guest_identity_no = '$guest_identity_no'";
		//echo "-- $sql--";
		$res = Yii::app()->db->createCommand($sql)->queryAll();
		$ids = array(); $x=0;
		foreach($res as $row){					 
			$gid = $row['guest_id'];
			if($x==0){$main_id = $gid; }
			else array_push($ids, $gid);	
			$x++;		
		}
		
		//echo "----". count($ids);
		for($m=0; $m < count($ids); $m++){
			//update checkin info
			$id = $ids[$m];
			$sql = "update hms_checkin_info set guest_id = '$main_id' where guest_id = ".$id;
			$res = Yii::app()->db->createCommand($sql)->execute();
			
			if($res){
				$sql = "delete from hms_guest_info where guest_id = $id";
				Yii::app()->db->createCommand($sql)->execute();	
			}
		}
		
		
	}
	////////////
	 public function actionCreateAjax()
	{
		$model = new ReservationInfo;
	 	$guest_info = new GuestInfo;
		$save=0;
		//$model2=new ReservationInfo;
		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
		//echo"one";
					//echo "<pre>";
					//print_r($_POST['ReservationInfo']);	
					//echo "</pre>";	
					//exit();
		if(isset($_POST['ReservationInfo'])){
				$model->attributes=$_POST['ReservationInfo'];
				//echo $model->res_type;
				//exit();				
				if($model->res_type=="I"){					
					$model=new ReservationInfo;
					$model->attributes=$_POST['ReservationInfo'];
					$g_client_name = $_POST['ReservationInfo']['client_name'][0];
					$g_salutation = $_POST['ReservationInfo']['client_salutation_id'][0];
					$model->client_salutation_id=$g_salutation;
					$model->client_name=$g_client_name;
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
					if($model->save()){ $save=1; }// $this->redirect('admin');}
				}else{	// if G											
						$total_clients = count($_POST['ReservationInfo']['client_name']);
						$model->attributes=$_POST['ReservationInfo'];
						//echo "----------------".$total_clients;
						//exit();						
						for($i=0; $i < $total_clients; $i++){							
							$model->setIsNewRecord(true);
							$model->setPrimaryKey(NULL);							
							$g_salutation = $_POST['ReservationInfo']['client_salutation_id'][$i];
							$g_client_name = $_POST['ReservationInfo']['client_name'][$i];								
							if($g_salutation =='' || $g_client_name =='') continue;							
							$model->client_salutation_id=$g_salutation;
							$model->client_name=$g_client_name;							
							if($model->save(false)){$save=1;}
						} //end for loop					
						// $this->redirect('admin');
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
								  'grid' => 'reservation-info-grid',
								  'content' => 'ReservationInfo successfully created',
								));
								exit;
							  }else{  $this->redirect('admin'); } //$this->redirect( array( 'view', 'id' => $model->id ) ); }
							}//end model save
						 // }//end post
						  //////=-----------------------
      
      				  if( Yii::app()->request->isAjaxRequest ) {
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;
				 
							echo CJSON::encode( array(
							  'status' => 'failure',
							  'content' => $this->renderPartial( 'ReservationInfo/_form', array(
								'model' => $model ), true, true ),
							));
							exit;
						  }else{
							$this->render( 'ReservationInfo/create', array( 'model' => $model, 'guest_info'=>$guest_info ) );
				  }
	}//end function
	
	public function actionAddrates(){
		
		$company_id_arr = array();
		$room_rate_arr = array(0=>6000, 1=>7000, 2=>7000, 3=>8000, 4=>8500, 5=>9500, 6=>9500, 7=>10500, 8=>9500, 9=>10500, 10=>10500, 11=>11500, 12=>18500, );
		$sql = "select comp_id from hms_company_info where 1 limit 0, 1110";
		$res = YiI::app()->db->createCommand($sql)->queryAll();		
		
		ini_set('max_execution_time', 3000); //300 seconds = 5 minutes
		foreach($res as $row){ array_push($company_id_arr, $row['comp_id']); }
		
		
		
		for($i=0; $i< count($company_id_arr); $i++){
			
			
			for($j=0; $j<count($room_rate_arr); $j++){
				$room_type_id = $j+1;
				$rate_type_id = 1;
				$room_rate = $room_rate_arr[$j];
				$company_id = $company_id_arr[$i];
				
				$room_rate_status = 'C';
				$room_comments = 'Comments';
				$comp_allow_gst = 0;
				$branch_id = 7;
				$user_id = 15;
				
				$sql = "insert into hms_room_type_rate (`room_type_id`, `rate_type_id`,  `room_rate`,  `company_id`,  `room_rate_status`,  `room_comments`,  `comp_allow_gst`,  `branch_id`,  `user_id`)";
				
				$sql .=" values ('$room_type_id', '$rate_type_id',  '$room_rate',  '$company_id',  '$room_rate_status',  '$room_comments',  '$comp_allow_gst',  '$branch_id',  '$user_id')"; 
				
				//echo "<br>".$sql ;	
				yii::app()->db->createCommand($sql)->execute();			
			}
			//exit;
		}
		
	}
	//////////////////////////////////
	
	public function actionCompanyissues(){
	
	$sql = "SELECT gi.guest_id, gi.guest_name, ci.chkin_id, gi.guest_company_id as comp_id, ci.guest_company_id, gl.company_id from hms_guest_info gi left join hms_checkin_info ci ON ci.guest_id = gi.guest_id left join hms_guest_ledger gl ON ci.chkin_id = gl.chkin_id  where ci.guest_company_id !=gl.company_id group by ci.chkin_id";	
	
	$i=0;
	$res = yii::app()->db->createCommand($sql)->query();	
	foreach($res as $row){
	
		$i++;
		$guest_id = $row['guest_id'];
		$guest_name = $row['guest_name'];
		$chkin_id = $row['chkin_id']; 
		$guest_company_id = $row['comp_id']; 
		$guest_company_id1 = $row['guest_company_id']; 
		$company_id	 = $row['company_id'];
		
		if($guest_company_id == $guest_company_id1 && $guest_company_id != $company_id){
		echo "<br />$i - $guest_id - $guest_name - $chkin_id - $guest_company_id - $guest_company_id1 - $company_id";
		
		//update guest ledger company id for current checkin id
		// $sql2 = "update hms_guest_ledger set company_id = '$guest_company_id' where chkin_id = '$chkin_id'";
		//yii::app()->db->createCommand($sql2)->execute();
		
		}
	}
	
	}
	
	/////////////////
	/*
	`room_type_rate_id`, `room_type_id`, `rate_type_id`,  `room_rate`,  `company_id`,  `room_rate_status`,  `room_comments`,  `comp_allow_gst`,  `branch_id`,  `user_id`;
	*/
	
	/////////////////////
	
}
