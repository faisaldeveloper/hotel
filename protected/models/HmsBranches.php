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
			array('branch_address, branch_phone, branch_fax, branch_email, hotel_id, active_date, expiry_date', 'required'),
			array('hotel_id', 'numerical', 'integerOnly'=>true),
			array('branch_email', 'length', 'max'=>50),
			array('branch_email', 'email'),
			array('branch_address', 'length', 'max'=>255),
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
			'CheckinInfos' => array(self::HAS_MANY, 'CheckinInfo', 'branch_id'),
			'CompanyInfos' => array(self::HAS_MANY, 'CompanyInfo', 'branch_id'),
			'ExchangeRates' => array(self::HAS_MANY, 'ExchangeRate', 'branch_id'),
			'FlightInfos' => array(self::HAS_MANY, 'FlightInfo', 'branch_id'),
			'Floors' => array(self::HAS_MANY, 'HmsFloor', 'branch_id'),
			'GuestDocs' => array(self::HAS_MANY, 'GuestDoc', 'branch_id'),
			'GuestInfos' => array(self::HAS_MANY, 'GuestInfo', 'branch_id'),
			'GuestLedgers' => array(self::HAS_MANY, 'GuestLedger', 'branch_id'),
			'GuestStatuses' => array(self::HAS_MANY, 'GuestStatus', 'branch_id'),
			'Identities' => array(self::HAS_MANY, 'Identity', 'branch_id'),
			'Newspapers' => array(self::HAS_MANY, 'Newspapers', 'branch_id'),
			'RateTypes' => array(self::HAS_MANY, 'RateType', 'branch_id'),
			'ReservationInfos' => array(self::HAS_MANY, 'ReservationInfo', 'branch_id'),
			'ReservationStatuses' => array(self::HAS_MANY, 'ReservationStatus', 'branch_id'),
			'RoomMasters' => array(self::HAS_MANY, 'RoomMaster', 'branch_id'),
			'RoomTypes' => array(self::HAS_MANY, 'RoomType', 'branch_id'),
			'RoomTypeRates' => array(self::HAS_MANY, 'RoomTypeRate', 'branch_id'),
			'SalePersons' => array(self::HAS_MANY, 'SalePerson', 'branch_id'),
			'Salutations' => array(self::HAS_MANY, 'Salutation', 'branch_id'),
			'ServiceGsts' => array(self::HAS_MANY, 'ServiceGst', 'branch_id'),
			'Services' => array(self::HAS_MANY, 'Services', 'branch_id'),
			'reportText' => array(self::HAS_MANY, 'ReportText', 'branch_id'),
			'users' => array(self::HAS_MANY, 'User', 'hotel_branch_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'branch_id' =>  Yii::t('views',  'Branch'), 
			'branch_address' =>  Yii::t('views',  'Branch Address'), 
			'branch_phone' =>  Yii::t('views',  'Branch Phone'), 
			'branch_fax' =>  Yii::t('views',  'Branch Fax'), 
			'branch_email' =>  Yii::t('views',  'Branch Email'), 
			'hotel_id' =>  Yii::t('views',  'Hotel'), 
			'active_date' =>  Yii::t('views',  'Active Date'), 
			'expiry_date' =>  Yii::t('views',  'Expiry Date'), 
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
	    $criteria->compare('hotel.title',$this->hotel_id, true);
		//$criteria->compare('hotel_id',$this->hotel_id);
		$criteria->compare('active_date',$this->active_date,true);
		$criteria->compare('expiry_date',$this->expiry_date,true);
		
		$criteria->with=array('hotel');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}