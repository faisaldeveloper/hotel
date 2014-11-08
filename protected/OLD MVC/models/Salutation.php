<?php
/**
 * This is the model class for table "hms_salutation".
 *
 * The followings are the available columns in table 'hms_salutation':
 * @property integer $salutation_id
 * @property string $salutation_name
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property HmsGuestInfo[] $hmsGuestInfos
 * @property HmsReservationInfo[] $hmsReservationInfos
 * @property HmsBranches $branch
 */
class Salutation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Salutation the static model class
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
		return 'hms_salutation';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('salutation_name, branch_id', 'required'),
			array('branch_id', 'numerical', 'integerOnly'=>true),
			array('salutation_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('salutation_id, salutation_name, branch_id', 'safe', 'on'=>'search'),
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
			'hmsGuestInfos' => array(self::HAS_MANY, 'HmsGuestInfo', 'guest_salutation_id'),
			'hmsReservationInfos' => array(self::HAS_MANY, 'HmsReservationInfo', 'client_salutation_id'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'salutation_id' => Yii::t('views', 'Salutation'),
			'salutation_name' => Yii::t('views', 'Salutation Name'),
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
		$criteria->compare('salutation_id',$this->salutation_id);
		$criteria->compare('salutation_name',$this->salutation_name,true);
		$criteria->compare('branch_id',$this->branch_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}