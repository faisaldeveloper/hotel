<?php
class GuestInfoController extends SBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
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
	public function actionView($id){
				
		$model = new GuestInfo;
					if( Yii::app()->request->isAjaxRequest ) {
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;
				 
							echo CJSON::encode( array(
							  'status' => 'failure',
							  'content' => $this->renderPartial( 'view', array(
							  'model' => $this->loadModel($id) ), true, true ),
							));
							exit;
						  }else{$this->render( 'view', array('model'=>$this->loadModel($id),) );}
		//$this->render('view',array(	'model'=>$this->loadModel($id),	));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{		
		  $model=new GuestInfo;
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);
		if(isset($_POST['GuestInfo'])){			
			 
			$model->attributes=$_POST['GuestInfo'];
			$model->guest_identity_issu = $_POST['GuestInfo']['guest_identity_issu'];
			$model->guest_identiy_expire = $_POST['GuestInfo']['guest_identiy_expire'];
			$model->guest_dob = $_POST['GuestInfo']['guest_dob'];	
			if($_POST['GuestInfo']['guest_salutation_id']==1 || $_POST['GuestInfo']['guest_salutation_id']==3) $model->guest_gender = "M";	
			else $model->guest_gender = "F";
			if($model->save())$this->redirect(array('admin','model'=>$model));
		}  
		$this->render('create',array('model'=>$model,));  
	}
//////////////////////////////////////////////////////
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id){
		
		$model=$this->loadModel($id);	
		$this->performAjaxValidation($model);
		if(isset($_POST['GuestInfo'])){
			$model->attributes=$_POST['GuestInfo'];
			$model->guest_identity_issu = $_POST['GuestInfo']['guest_identity_issu'];
			$model->guest_identiy_expire = $_POST['GuestInfo']['guest_identiy_expire'];
			$model->guest_dob = $_POST['GuestInfo']['guest_dob'];	
			$model->guest_phone = $_POST['GuestInfo']['guest_phone'];	
			
			if($_POST['GuestInfo']['guest_salutation_id']==1) $model->guest_gender = "M";	
			else $model->guest_gender = "F";
			
			//if($model->save())	$this->redirect(array('view','id'=>$model->guest_id));
			
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
		}
		//$this->render('update',array('model'=>$model,));
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
							$this->render( 'update', array( 'model' => $model));
				  }
	}
/////////////////////////////////////////////////////
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
		else{
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
			//Yii::app()->end();	
		}
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('GuestInfo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new GuestInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GuestInfo'])){
			$model->attributes=$_GET['GuestInfo'];
			print_r($_GET['GuestInfo']);
		}
		
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
		$model=GuestInfo::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='guest-info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	////
	 public function actionCreateAjax()
	{
		$model = new GuestInfo;	
		$this->performAjaxValidation($model);
		if(isset($_POST['GuestInfo'])){			
			$model->attributes=$_POST['GuestInfo'];
			$model->guest_identity_issu = $_POST['GuestInfo']['guest_identity_issu'];
			$model->guest_identiy_expire = $_POST['GuestInfo']['guest_identiy_expire'];
			$model->guest_dob = $_POST['GuestInfo']['guest_dob'];	
			
			if($_POST['GuestInfo']['guest_salutation_id']==1 || $_POST['GuestInfo']['guest_salutation_id']==3) $model->guest_gender = "M";	
			else $model->guest_gender = "F";
			
			if($model->save()){
					 if( Yii::app()->request->isAjaxRequest) {
								// Stop jQuery from re-initialization
								Yii::app()->clientScript->scriptMap['jquery.js'] = false;						 
									echo CJSON::encode( array(
									  'status' => 'success',
									  'grid' => 'guest-info-grid',
									  'content' => 'GuestInfo successfully created',
									));
								exit;
					}else{  $this->redirect('admin'); } //$this->redirect( array( 'view', 'id' => $model->id ) ); }	
			}
		}  									 
						  //////=-----------------------
      
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
							$this->render( 'create', array( 'model' => $model));
				  }
	}//end function
	
	
	
	/////////////
}
