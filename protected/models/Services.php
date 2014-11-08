<?php
/**
 * This is the model class for table "hms_services".
 *
 * The followings are the available columns in table 'hms_services':
 * @property integer $service_id
 * @property string $service_description
 * @property integer $servise_type
 * @property integer $service_rate
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property HmsGuestLedger[] $hmsGuestLedgers
 * @property HmsServiceGst[] $hmsServiceGsts
 * @property HmsBranches $branch
 */
class Services extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Services the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hms_services';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_code, service_description, servise_type, service_rate, branch_id', 'required'),
			array('service_rate, branch_id', 'numerical', 'integerOnly'=>true),
			array('service_description,servise_type', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('service_id, service_code, service_description, servise_type, service_rate, order_by, branch_id', 'safe'),
		);
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'GuestLedgers' => array(self::HAS_MANY, 'GuestLedger', 'service_id'),
			'ServiceGst' => array(self::HAS_MANY, 'ServiceGst', 'gst_service_id'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'service_id' => Yii::t('views', 'Service'),
			'service_code'=> Yii::t('views','Service Code'),
			'service_description' => Yii::t('views', 'Service Description'),
			'servise_type' => Yii::t('views', 'Servise Type'),
			'service_rate' => Yii::t('views', 'Service Rate'),
			'order_by' => Yii::t('views', 'Order By'),
			'branch_id' => Yii::t('views', 'Branch'),
		);
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		
		//$hotel_branch_id = yii::app()->user->branch_id;
		//$criteria->condition="branch_id = $hotel_branch_id";
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('service_code',$this->service_code);
		$criteria->compare('service_description',$this->service_description,true);
		$criteria->compare('servise_type',$this->servise_type);
		$criteria->compare('service_rate',$this->service_rate);
		$criteria->compare('branch_id',$this->branch_id);
		return new CActiveDataProvider($this, array('criteria'=>$criteria,));
	}
	
	/////////////////////
	
	///////////////////////////////////////////////
	 public function beforeSave(){		
	 		
		///account creation for guest
		if(!empty($_POST['Services']['service_description'])){ 
				$service_description = mysql_real_escape_string($this->service_description);				
				$res = Yii::app()->db->createCommand("select id from account_name where name = '$service_description'")->query();
				if(count($res)==0)
				Yii::app()->db->createCommand("insert into account_name (name, account_type_id) values('$service_description', '4')")->execute();
				$res = Yii::app()->db->createCommand("select id from account_name where name = '$service_description'")->query();
				foreach ($res as $row){ $id = $row['id'];}
				$this->acc_no = 	$id; 		  
			}		
			return parent::beforeSave();
	} 
}