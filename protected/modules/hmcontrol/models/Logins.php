<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $hotel_id
 * @property integer $hotel_branch_id
 *
 * The followings are the available model relations:
 * @property HmsCheckinInfo[] $hmsCheckinInfos
 * @property HmsCheckinInfo[] $hmsCheckinInfos1
 * @property HmsCompanyInfo[] $hmsCompanyInfos
 * @property HmsExchangeRate[] $hmsExchangeRates
 * @property HmsGuestInfo[] $hmsGuestInfos
 * @property HmsGuestLedger[] $hmsGuestLedgers
 * @property HmsReservationInfo[] $hmsReservationInfos
 * @property HmsReservationInfo[] $hmsReservationInfos1
 * @property HmsRoomTypeRate[] $hmsRoomTypeRates
 * @property HmsBranches $hotelBranch
 * @property HotelTitle $hotel
 */
class Logins extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'logins';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,username, password,', 'required'),
			//array('hotel_id, hotel_branch_id', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password', 'safe', 'on'=>'search'),
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
			/* 'hmsCheckinInfos' => array(self::HAS_MANY, 'HmsCheckinInfo', 'chkin_user_id'),
			'hmsCheckinInfos1' => array(self::HAS_MANY, 'HmsCheckinInfo', 'chkout_user_id'),
			'hmsCompanyInfos' => array(self::HAS_MANY, 'HmsCompanyInfo', 'user_id'),
			'hmsExchangeRates' => array(self::HAS_MANY, 'HmsExchangeRate', 'user_id'),
			'hmsGuestInfos' => array(self::HAS_MANY, 'HmsGuestInfo', 'user_id'),
			'hmsGuestLedgers' => array(self::HAS_MANY, 'HmsGuestLedger', 'user_id'),
			'hmsReservationInfos' => array(self::HAS_MANY, 'HmsReservationInfo', 'user_id'),
			'hmsReservationInfos1' => array(self::HAS_MANY, 'HmsReservationInfo', 'cancel_by'),
			'hmsRoomTypeRates' => array(self::HAS_MANY, 'HmsRoomTypeRate', 'user_id'),
			'hotelBranch' => array(self::BELONGS_TO, 'HmsBranches', 'hotel_branch_id'),
			'hotel' => array(self::BELONGS_TO, 'HotelTitle', 'hotel_id'), */
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'username' => 'Username',
			'password' => 'Password',			
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}