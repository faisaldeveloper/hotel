<?php
/**
 * This is the model class for table "hms_flight_info".
 *
 * The followings are the available columns in table 'hms_flight_info':
 * @property integer $flight_id
 * @property string $flight_name
 * @property string $flight_arrival
 * @property string $flight_departure
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property HmsBranches $branch
 */
class Flights extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Flights the static model class
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
		return 'hms_flight_info';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('flight_name, flight_arrival, branch_id', 'required'),
			array('branch_id', 'numerical', 'integerOnly'=>true),
			array('flight_name', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('flight_id, flight_name, flight_arrival, flight_departure, branch_id', 'safe', 'on'=>'search'),
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
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'flight_id' => Yii::t('views', 'Flight'),
			'flight_name' => Yii::t('views', 'Flight Name'),
			'flight_arrival' => Yii::t('views', 'Flight Time'),
			'flight_departure' => Yii::t('views', 'Flight Departure'),
			'branch_id' => Yii::t('views', 'Branch'),
		);
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	 /**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	 /**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		//$criteria->compare('flight_id',$this->flight_id);
		$criteria->compare('flight_name',$this->flight_name,true);
		$criteria->compare('flight_arrival',$this->flight_arrival,true);
		$criteria->compare('flight_departure',$this->flight_departure,true);
		//$criteria->compare('branch_id',$this->branch_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}