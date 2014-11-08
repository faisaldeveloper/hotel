<?php
class RoomMasterController extends SBaseController
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
		return array(
			//'accessControl', // perform access control for CRUD operations
		);
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionRoomshift(){
		
		$model = new RoomMaster;
		
		if(isset($_POST['RoomMaster'])){
			//you will get folio no and (NEW)->mst_room_id
			//print_r($_POST);
			$new_room_id = $_POST['RoomMaster']['mst_room_id'];
			$chkin_id = $_POST['RoomMaster_old_room'];
			$reason = $_POST['RoomMaster_reason']; 
			
			$date = date('Y-m-d H:i:s');
			$user_id = Yii::app()->user->id;
			$branch_id = yii::app()->user->branch_id;
			$sql = "select guest_id, room_id From hms_checkin_info where chkin_id = $chkin_id";
			$res = Yii::app()->db->createCommand($sql)->query();
			foreach($res as $row){	$old_room_id = $row['room_id']; $guest_id = $row['guest_id'];}
			
			//echo "$sql----old :". $old_room_id. " New: ".$new_room_id;
			//make insert entry into room shift table and update checkin and guest_ledger table.
			$vals = "'".$chkin_id."',"."'".$guest_id."',"."'".$old_room_id."',"."'".$new_room_id."',"."'".$reason."',"."'".$date."',"."'".$user_id."',"."'".$branch_id."'";
			$sql1 = "insert into hms_room_shift (chkin_id, guest_id, old_room_id, new_room_id, reason, shift_date, user_id, branch_id) values(".$vals.")";
			$sql2 = "update hms_checkin_info set room_id = '$new_room_id', room_name = '$new_room_id' where chkin_id = '".$chkin_id."'";
			$sql3 = "update hms_room_master set mst_room_status = 'O' where mst_room_id = $new_room_id";
			$sql4 = "update hms_room_master set mst_room_status = 'D' where mst_room_id = $old_room_id";
			//.$sql5 = "update hms_guest_ledger set room_id = '$new_room_id' where chkin_id = '".$chkin_id."'";
			//echo $sql1."----".$sql2."<br>----".$sql3."<br>----".$sql4; exit();
			
			$connection=Yii::app()->db;
			$transaction=$connection->beginTransaction();
			try{
				$connection->createCommand($sql1)->execute();
				$connection->createCommand($sql2)->execute();
				$connection->createCommand($sql3)->execute();
				$connection->createCommand($sql4)->execute();
				//$connection->createCommand($sql5)->execute();				
				$transaction->commit();
			}catch(Exception $e){ 	$transaction->rollback(); }						
			
		}
		$this->render('roomshift',array('model'=>$model));
	}
		/**
	 /////////////////////////////////////////////////////////////////////////////////
	 */	
	public function actionRoomsgrid(){	
		$this->layout = '//layouts/column1';		
		$this->render('roomgrid');		
	}	
	
	public function actionOccupiedgrid(){	
		$this->layout = '//layouts/column1';		
		$this->render('occupiedgrid');		
	}	
	
	public function actionVacantgrid(){	
		$this->layout = '//layouts/column1';		
		$this->render('vacantgrid');		
	}	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new RoomMaster;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);			
		//$HmsBranches=HmsBranches::model()->find("room_limit  = ".$_GET['id']);
	$bid = yii::app()->user->branch_id;
	$room_limit = Yii::app()->db->createCommand("select room_limit from hms_branches where branch_id = $bid")->queryScalar();	
	$room_defined = Yii::app()->db->createCommand("select count(branch_id) from hms_room_master where branch_id = $bid")->queryScalar();		
		//echo "--rml->".$room_limi. $room_defined;		
		//////////////////
		if(isset($_POST['RoomMaster']))	{
			if($room_defined < $room_limit){
				$model->attributes=$_POST['RoomMaster'];
				if($model->save())	$this->redirect(array('admin','model'=>$model));
			}
			else{			
			 throw new CHttpException(400,'Can\'t Define Room. You have reached the maximum Room limit');
			
			}
		}
		
		$this->render('create',array(	'model'=>$model,));
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
		// $this->performAjaxValidation($model);
		if(isset($_POST['RoomMaster']))
		{
			$model->attributes=$_POST['RoomMaster'];
			if($model->save())
				//$this->redirect(array('view','id'=>$model->mst_room_id));
				//$this->actionAdmin();
				$this->redirect(array('admin'));
		}
		$this->render('update',array('model'=>$model,));
	}
	
	////////////////////////////////////////////////////////////
	public function actionUpdateAjax($id){
		$model=$this->loadModel($id);		
		
			if(isset($_POST['RoomMaster'])){			
				$model->attributes=$_POST['RoomMaster'];				
				if($model->save()){
						 if( Yii::app()->request->isAjaxRequest) {									
									Yii::app()->clientScript->scriptMap['jquery.js'] = false;						 
										echo CJSON::encode( array(
										  'status' => 'updateRoom',
										  'id' => $id,
										  'grid' => 'guest-info-grid',
										  'content' => 'RoomMaster successfully updated',
										));
									exit;
						}else{  $this->redirect('/RoomMaster/Roomsgrid'); } 
				}
				else{$this->redirect('/RoomMaster/Roomsgrid'); } 
			}  									 
			//////=-----------------------
						  
			 if( Yii::app()->request->isAjaxRequest ) {				 						
					Yii::app()->clientScript->scriptMap['jquery.js'] = false;				 
					echo CJSON::encode( array(
						 'status' => 'failure',
						 'content' => $this->renderPartial( '../roomMaster/updateajax', array('model'=>$model,
						 'room_no' => $id), true, true ),
						));
						exit;
				}	
	}
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
		$dataProvider=new CActiveDataProvider('RoomMaster',
			array(
				'criteria'=>array(
        		'condition'=>'branch_id='.$bid,
				),
			));
		$this->render('index',array('dataProvider'=>$dataProvider,));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RoomMaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RoomMaster']))
			$model->attributes=$_GET['RoomMaster'];
		$this->render('admin',array('model'=>$model,));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=RoomMaster::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='room-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
