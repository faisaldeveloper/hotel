<?php
class CompanyController extends SBaseController
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
	public function actionView($id)
	{
		if( Yii::app()->request->isAjaxRequest ) {
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;				 
							echo CJSON::encode( array(
							  'status' => 'failure',
							  'content' => $this->renderPartial( 'view', array(
							  'model' => $this->loadModel($id) ), true, true ),
							));	exit;
		}		
		//$this->render('view',array('model'=>$this->loadModel($id),));
	}
	
	
	public function actionRates()
	{
		
		$model=new Company;
		$this->render('rates', array('model'=>$model));
		
		//$this->render('view',array('model'=>$this->loadModel($id),));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		//$this->layout='//layouts/main';
		$model=new Company;
		
		$cs = Yii::app()->clientScript;
 		$cs->scriptMap['form.css'] = false;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Company']))
		{			
			$model->attributes=$_POST['Company'];			
			if($model->save())
				$this->redirect(array('admin','model'=>$model));
		}
		$this->render('create',array('model'=>$model,));
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
		if(isset($_POST['Company']))
		{
			$model->attributes=$_POST['Company'];			
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
		
		//$this->render('update',array('model'=>$model,));
		
				if( Yii::app()->request->isAjaxRequest ) {
							// Stop jQuery from re-initialization
							Yii::app()->clientScript->scriptMap['jquery.js'] = false;				 
							echo CJSON::encode( array(
							  'status' => 'failure',
							  'content' => $this->renderPartial( '_form', array(
								'model' => $model,'guest_info'=>$result ), true, true ),
							));	exit;
						  }else{
							$this->render( 'update', array( 'model' => $model));
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
		$dataProvider=new CActiveDataProvider('Company',
			array(
				'criteria'=>array(
        		'condition'=>'branch_id='.$bid,
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
		
		
		$model=new Company('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Company']))
			$model->attributes=$_GET['Company'];
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
		$model=Company::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='company-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
