<?php
class RoomTypeRateController extends SBaseController
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
	 * Lists all models.
	 */
	public function actionIndex(){		
		$dataProvider=new CActiveDataProvider('Company');
		$this->render('index',array('dataProvider'=>$dataProvider,));
	}
	
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate(){
		$model=new RoomTypeRate;
		$company_model = new Company;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['RoomTypeRate']))
		{
			$model->attributes=$_POST['RoomTypeRate'];		
			$company_model->attributes=$_POST['Company'];				
			//echo "<pre>";	print_r($_POST['RoomTypeRate']);	echo "</pre>"; 
			
			$model->company_id = $_POST['RoomTypeRate']['company_id'];
			$rate_from = $company_model->rate_from = $_POST['Company']['rate_from'];
			$rate_to = $company_model->rate_to = $_POST['Company']['rate_to'];
			$rate_date = $company_model->rate_date = $_POST['Company']['rate_date'];			
						
			Yii::app()->db->createCommand()->update('hms_company_info',array('rate_from'=>$rate_from, 'rate_to'=>$rate_to, 'rate_date'=>$rate_date),
			'comp_id=:company_id',array(':company_id'=>$model->company_id));
			
			$model->room_rate_status ='C';
			$model->room_comments ='comments';
			$model->branch_id = $_POST['RoomTypeRate']['branch_id'];
			$model->user_id = $_POST['RoomTypeRate']['user_id'];
			
			$valid = true;
			for($i=0; $i < count($_POST['RoomTypeRate']['room_rate']); $i++){
				$model->room_type_id = $_POST['RoomTypeRate']['room_type_id'][$i];
				$model->rate_type_id = $_POST['RoomTypeRate']['rate_type_id'][$i];	
				$model->room_rate = $_POST['RoomTypeRate']['room_rate'][$i];
				$model->comp_allow_gst = $_POST['RoomTypeRate']['comp_allow_gst'][$i];	
				if($model->room_rate=='') { $model->validate(); $valid = false; break;}		
			}
			
			
			if($valid){				
				for($i=0; $i < count($_POST['RoomTypeRate']['room_rate']); $i++){			
							$model->setIsNewRecord(true);
							$model->setPrimaryKey(NULL);				
							
							$model->room_type_id = $_POST['RoomTypeRate']['room_type_id'][$i];
							$model->rate_type_id = $_POST['RoomTypeRate']['rate_type_id'][$i];
							$model->room_rate = $_POST['RoomTypeRate']['room_rate'][$i];
							$model->comp_allow_gst = $_POST['RoomTypeRate']['comp_allow_gst'][$i];					
							
							$model->save(false);							
						}// end for				
				$this->redirect(array('admin','model'=>$model));
			}// end if
		}// end post
		$this->render('create',array('model'=>$model,'company_model'=>$company_model));
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function actionView($id){ ////this id is row id of the hms_room-type-rate
	 
		$file=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../css/bootstrap/css/gridview_css.css';
		$url = Yii::app()->getAssetManager()->publish($file);
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($url);
		
		$comp_id = RoomTypeRate::model()->find("room_type_rate_id = ".$id)->company_id;		
		$model = Yii::app()->db->createCommand( "select * from hms_room_type_rate where company_id = $comp_id")->query();
				
		$company_name=Company::model()->find("comp_id = ".$comp_id)->comp_name;
		$this->render('view',array('model'=>$model,'company_name'=>$company_name,'company_id'=>$comp_id));
	}
	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function actionUpdate($id){ //this id is row id of the hms_room-type-rate
	
	$model= new RoomTypeRate; //::model()->find("company_id = ".$id);	
	$comp_id = RoomTypeRate::model()->find("room_type_rate_id = ".$id)->company_id;	
	$company_model = Company::model()->find("comp_id = ".$comp_id);
	
		if(isset($_POST['RoomTypeRate'])){
			
			$rate_from = $company_model->rate_from = $_POST['Company']['rate_from'];
			$rate_to = $company_model->rate_to = $_POST['Company']['rate_to'];
			$rate_date = $company_model->rate_date = $_POST['Company']['rate_date'];			
						
			Yii::app()->db->createCommand()->update('hms_company_info',array('rate_from'=>$rate_from, 'rate_to'=>$rate_to, 'rate_date'=>$rate_date),
			'comp_id=:company_id',array(':company_id'=>$comp_id));
			//write update code here 
			$total = $_POST['RoomTypeRate']['room_type_rate_id'];
			
			for($i=0; $i < count($total); $i++){
				$row_id = $_POST['RoomTypeRate']['room_type_rate_id'][$i];
				$rate = $_POST['RoomTypeRate']['room_rate'][$i];
				if(empty($rate))$rate =0;
				//echo "<br>$row_id- $rate";
				
				//exit;
				if($row_id !=''){					
					$sql = "update hms_room_type_rate set room_rate = ".$rate ." where room_type_rate_id = ".$row_id;					
					Yii::app()->db->createCommand($sql)->query();
				}
				else {
							$model->attributes=$_POST['RoomTypeRate'];
							//echo "insert query required"; print_r($model->attributes);	
							$model->setIsNewRecord(true);
							$model->setPrimaryKey(NULL);							
							
							$model->room_type_id = $_POST['RoomTypeRate']['room_type_id'][$i];
							$model->rate_type_id = $_POST['RoomTypeRate']['rate_type_id'][$i];
							$model->room_rate = $rate;
							$model->comp_allow_gst = 1;						
							$model->save(false);
				}
			}
			
			
		}
		
		$this->render('update',array('model'=>$model,'company_id'=>$comp_id,'company_model'=>$company_model));
	} 
	
	/////////////////////////////////////////////////////
	
	public function getitemstoupdate($id) 
        { 
		$datareader=HmsRoomType::model()->findAll();
		$i=0;
		foreach($datareader as $row){
		/*$model[$i]=new RoomTypeRate;
		$model[$i]->room_type_id=$row['room_type_id'];
		$model[$i]->label=$row['room_name'];*/
		$room_type_id=$row['room_type_id'];
		$model[$i]=RoomTypeRate::model()->find("company_id = $id and room_type_id=$room_type_id");
		
		if($model[$i]->room_type_id > 0){
		// do nothing because object array($model[$i]) is created;	
		}else{//first insert new row
		$RoomTypeRate = new RoomTypeRate;
		$RoomTypeRate->company_id = $id;
		$RoomTypeRate->branch_id = yii::app()->user->branch_id;
		$RoomTypeRate->user_id = yii::app()->user->id;
		$RoomTypeRate->rate_type_id = "1";
		$RoomTypeRate->room_type_id = $room_type_id;
		$RoomTypeRate->room_rate = "0";
		
	///////////////////////////	
	$comp=Company::model()->find("comp_id=".$id);
	if( trim(strtolower($comp->comp_name)) == "walk in" || trim(strtolower($comp->comp_name)) == "walk-in" ){
	$RoomTypeRate->room_rate_status = "G";
	}else{
	$RoomTypeRate->room_rate_status = "C";
	}
	/////////////////////////				
	
		if($RoomTypeRate->save()){//create object array($model[$i]) after insertion
        $model[$i]=RoomTypeRate::model()->find("company_id = $id and room_type_id=$room_type_id");    
            }else{//if error in insertion then show error
			print_r($RoomTypeRate->getErrors());
			Yii::app()->end();
        }
		
		}//end if($model[$i]->room_type_id > 0){
		
		$model[$i]->label=$row['room_name'];
		$i++;
		}//end foreach
		
        return $model;
    }
	
	public function update2($id)
	{
		//$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$success=0;
		$items=$this->getitemstoupdate($id);
                        $valid=true;
                        foreach($items as $i=>$item)
                        {
						
                            if(isset($_POST['RoomTypeRate'][$i])){
								$item->attributes=$_POST['RoomTypeRate'][$i];
	                            $valid=$item->validate() && $valid;
	                            if($valid){
									$success++;
                                    if($item->save(false)){
									
										if($success==count($items)){
										$this->redirect(array('view','id'=>$item->company_id));
										}
									} 
										
	                            }//end if $valid
							
							}//end if is set
                        }//end foreach
					
		
        $this->render('update',array(
			'model'=>$items,
		));
	
	}
	public function getitemstocreate() 
        {
		$datareader=HmsRoomType::model()->findAll();
		$i=0;
		foreach($datareader as $row){
		$model[$i]=new RoomTypeRate;
		$model[$i]->room_type_id=$row['room_type_id'];
		$model[$i]->label=$row['room_name'];
		$i++;
		}
		
		return $model;
    }
	
	
	public function create($id)
	{
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$items=$this->getitemstocreate();
		
				
		if(isset($_POST['RoomTypeRate'])){
			
		
		$transaction=yii::app()->db->beginTransaction();
			
		
		$success=0;
                        $valid=true;
                        foreach($items as $i=>$item)
                        {
						
                    if(isset($_POST['RoomTypeRate'][$i])){
						
					$item->attributes=$_POST['RoomTypeRate'][$i];
					
					//$item->user_id = $_POST['RoomTypeRate']['user_id'];
					
					$item->rate_type_id=1;
					$item->room_type_id=$items[$i]->room_type_id;
					$item->company_id=$id;
					
					$comp=Company::model()->find("comp_id=".$id);
					if( trim(strtolower($comp->comp_name)) == "walk in" || trim(strtolower($comp->comp_name)) == "walk-in" ){
					$item->room_rate_status = "G";
					}else{
					$item->room_rate_status = "C";
					}
					
					
					$item->branch_id=yii::app()->user->branch_id;
					$item->user_id=yii::app()->user->id;
					
					
					//$item->check = $items[$i]->check;
					//$item->one = $items[$i]->one;
					
                                $valid=$item->validate() && $valid;
                                if($valid)
                                {
                                        $item->save(false); 
										$success++;                          
                                }
                        }
			}//end is set post
														
                    
			if($success==count($items)){
			$transaction->commit();
			$this->redirect(array('view','id'=>$item->company_id));
			}else{
			$transaction->rollBack();	
			}
			
			}
			//echo "<br>Check is ".$item[0]->check;
			
                $this->render('create',array(
			'model'=>$items,
		));
		
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
			//this is faisal custmo code
			$company_id = RoomTypeRate::model()->find("room_type_rate_id = $id")->company_id;		
			$res = RoomTypeRate::model()->findAll("company_id = $company_id");	
			foreach($res as $row){
					$this->loadModel($row['room_type_rate_id'])->delete();
			}
			
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RoomTypeRate('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RoomTypeRate']))
			$model->attributes=$_GET['RoomTypeRate'];
		$this->render('admin',array(
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
		$model=RoomTypeRate::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='room-type-rate-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
