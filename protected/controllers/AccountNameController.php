<?php
class AccountNameController extends SBaseController
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
			'accessControl', // perform access control for CRUD operations
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			/* array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			), */
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
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new AccountName;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['AccountName']))
		{
			$model->attributes=$_POST['AccountName'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('create',array(
			'model'=>$model,
		));
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
		if(isset($_POST['AccountName']))
		{
			$model->attributes=$_POST['AccountName'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('update',array(
			'model'=>$model,
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
		$dataProvider=new CActiveDataProvider('AccountName');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AccountName('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AccountName']))
			$model->attributes=$_GET['AccountName'];
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
		$model=AccountName::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-name-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	//////////////////////////
	public function actionGetcomp_guest(){
		
		if(isset($_POST['AccountName']['account_type_id']) && !empty($_POST['AccountName']['account_type_id'])){
			
			$account_type_id = $_POST['AccountName']['account_type_id'];	
			$branch_id = yii::app()->user->branch_id;
			//$type_name =AccountType::model()->find("id = ".$account_type_id)->name;				
			$i=0;			
			if($account_type_id == 1){	//company		
				$res = Company::model()->findAll("comp_id!=2 AND branch_id = $branch_id Order by comp_name ASC");
				$str = "<option value=''>Select Company</option>";				
				foreach ($res as $row) {						
							$list[$i]['comp_id'] = $row['comp_id'];
							$list[$i]['comp_name'] = $row['comp_name'];
							$i++;
				}		
				$res = CHtml::listData($list, 'comp_id', 'comp_name');
				foreach ($res as $value => $key) {							
					$str .= "<option value='".$value."'>".$key."</option>";
				}								
			}
			if($account_type_id == 2){ // guest
				$res = GuestInfo::model()->findAll("branch_id = $branch_id Order by guest_name ASC");
				$str = "<option value=''>Select Guest</option>"; 
				foreach ($res as $row) {						
							$list[$i]['guest_id'] = $row['guest_id'];
							$list[$i]['guest_name'] = $row['guest_name'];
							$i++;
				}		
				$res = CHtml::listData($list, 'guest_id', 'guest_name');
				foreach ($res as $value => $key) {							
					$str .= "<option value='".$value."'>".$key."</option>";
				}				
			}
			if($account_type_id == 3){ // general
				$str = "<option value='3'>General Account</option>"; 
			}
			////AccountName_guest_comp_id			
			$arr = array();
			$arr["AccountName_guest_comp_id"] = $str;
			echo json_encode($arr);
		}
	}
	/////////////////////////////////////////
	
	public function actionChoosecsv(){
		 $model=new CsvFile;
		 
		 if(isset($_POST['CsvFile'])){			
			$fn = $_POST['CsvFile'];
			$file = Yii::getPathOfAlias('webroot')."/uploads/".$fn;
			//$file =  "/mezban/uploads/".$fn;			
			//$db = new mysqli('localhost', 'root' ,'', 'mezban');
			//$db = new mysqli('kohistangroup1.netfirmsmysql.com', 'faisal' ,'mezban@mce123', 'mezban');
			//$query = "LOAD DATA INFILE '". $file ."' INTO TABLE item fields terminated by ',' enclosed by '\"' lines terminated by '\r\n'";			
			$query = "LOAD DATA INFILE '". $file ."' INTO TABLE hms_company_info fields terminated by ',' enclosed by '\"' lines terminated by '\\r\\n'";			
			echo $query;
			//////////////////
			 try{
				$connect = new PDO('mysql:host=localhost;dbname=myhms2', 'root', '');
				$connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
			 	$connect->exec($query);					
				//$a = exec($query,$v_output,$v_status);
				//$cc = count($v_output); echo "$cc---$v_status";
				
			 }catch(PDOException $e)  {        echo $e->getMessage();    }			 
			exit();
			//$this->redirect('admin');			 
		 }		 
		 $this->render('choosecsv',array('model'=>$model));
	}
	/////////////////////////
}
