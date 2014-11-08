<?php

/**
 * This is the model class for table "hms_branches".
 *
 * The followings are the available columns in table 'hms_branches':
 * @property integer $branch_id
 * @property string $branch_address
 * @property integer $branch_phone
 * @property integer $branch_fax
 * @property string $branch_email
 * @property integer $hotel_id
 * @property string $active_date
 * @property string $expiry_date
 *
 * The followings are the available model relations:
 * @property HotelTitle $hotel
 * @property HmsCheckinInfo[] $hmsCheckinInfos
 * @property HmsCompanyInfo[] $hmsCompanyInfos
 * @property HmsExchangeRate[] $hmsExchangeRates
 * @property HmsFlightInfo[] $hmsFlightInfos
 * @property HmsFloor[] $hmsFloors
 * @property HmsGuestDoc[] $hmsGuestDocs
 * @property HmsGuestInfo[] $hmsGuestInfos
 * @property HmsGuestLedger[] $hmsGuestLedgers
 * @property HmsGuestStatus[] $hmsGuestStatuses
 * @property HmsIdentity[] $hmsIdentities
 * @property HmsNewspapers[] $hmsNewspapers
 * @property HmsRateType[] $hmsRateTypes
 * @property HmsReservationInfo[] $hmsReservationInfos
 * @property HmsReservationStatus[] $hmsReservationStatuses
 * @property HmsRoomMaster[] $hmsRoomMasters
 * @property HmsRoomType[] $hmsRoomTypes
 * @property HmsRoomTypeRate[] $hmsRoomTypeRates
 * @property HmsSalePerson[] $hmsSalePersons
 * @property HmsSalutation[] $hmsSalutations
 * @property HmsServiceGst[] $hmsServiceGsts
 * @property HmsServices[] $hmsServices
 * @property ReportText[] $reportTexts
 * @property User[] $users
 */
class HmsBranches extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return HmsBranches the static model class
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
		return 'hms_branches';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branch_address, branch_phone, branch_email, room_limit, hotel_id, active_date, expiry_date', 'required'),
			array('branch_phone, branch_fax, room_limit, hotel_id', 'numerical', 'integerOnly'=>true),
			array('branch_address', 'length', 'max'=>255),
			array('branch_email', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('branch_id, branch_address, branch_phone, branch_fax, branch_email, hotel_id, active_date, expiry_date', 'safe', 'on'=>'search'),
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
			'hotel' => array(self::BELONGS_TO, 'HotelTitle', 'hotel_id'),
			'hmsCheckinInfos' => array(self::HAS_MANY, 'HmsCheckinInfo', 'branch_id'),
			'hmsCompanyInfos' => array(self::HAS_MANY, 'HmsCompanyInfo', 'branch_id'),
			'hmsExchangeRates' => array(self::HAS_MANY, 'HmsExchangeRate', 'branch_id'),
			'hmsFlightInfos' => array(self::HAS_MANY, 'HmsFlightInfo', 'branch_id'),
			'hmsFloors' => array(self::HAS_MANY, 'HmsFloor', 'branch_id'),
			'hmsGuestDocs' => array(self::HAS_MANY, 'HmsGuestDoc', 'branch_id'),
			'hmsGuestInfos' => array(self::HAS_MANY, 'HmsGuestInfo', 'branch_id'),
			'hmsGuestLedgers' => array(self::HAS_MANY, 'HmsGuestLedger', 'branch_id'),
			'hmsGuestStatuses' => array(self::HAS_MANY, 'HmsGuestStatus', 'branch_id'),
			'hmsIdentities' => array(self::HAS_MANY, 'HmsIdentity', 'branch_id'),
			'hmsNewspapers' => array(self::HAS_MANY, 'HmsNewspapers', 'branch_id'),
			'hmsRateTypes' => array(self::HAS_MANY, 'HmsRateType', 'branch_id'),
			'hmsReservationInfos' => array(self::HAS_MANY, 'HmsReservationInfo', 'branch_id'),
			'hmsReservationStatuses' => array(self::HAS_MANY, 'HmsReservationStatus', 'branch_id'),
			'hmsRoomMasters' => array(self::HAS_MANY, 'HmsRoomMaster', 'branch_id'),
			'hmsRoomTypes' => array(self::HAS_MANY, 'HmsRoomType', 'branch_id'),
			'hmsRoomTypeRates' => array(self::HAS_MANY, 'HmsRoomTypeRate', 'branch_id'),
			'hmsSalePersons' => array(self::HAS_MANY, 'HmsSalePerson', 'branch_id'),
			'hmsSalutations' => array(self::HAS_MANY, 'HmsSalutation', 'branch_id'),
			'hmsServiceGsts' => array(self::HAS_MANY, 'HmsServiceGst', 'branch_id'),
			'hmsServices' => array(self::HAS_MANY, 'HmsServices', 'branch_id'),
			'reportTexts' => array(self::HAS_MANY, 'ReportText', 'branch_id'),
			'users' => array(self::HAS_MANY, 'User', 'hotel_branch_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'branch_id' => 'Branch',
			'branch_address' => 'Branch Address',
			'branch_phone' => 'Branch Phone',
			'branch_fax' => 'Branch Fax',
			'branch_email' => 'Branch Email',
			'room_limit' => 'Room Limit',
			'hotel_id' => 'Hotel',
			'active_date' => 'Active Date',
			'expiry_date' => 'Expiry Date',
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

		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('branch_address',$this->branch_address,true);
		$criteria->compare('branch_phone',$this->branch_phone);
		$criteria->compare('branch_fax',$this->branch_fax);
		$criteria->compare('branch_email',$this->branch_email,true);
		$criteria->compare('hotel_id',$this->hotel_id);
		$criteria->compare('active_date',$this->active_date,true);
		$criteria->compare('expiry_date',$this->expiry_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}