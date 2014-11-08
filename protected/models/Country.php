<?php
/**
 * This is the model class for table "country".
 *
 * The followings are the available columns in table 'country':
 * @property integer $country_id
 * @property string $country_name
 * @property string $country_currancy
 * @property integer $country_code
 *
 * The followings are the available model relations:
 * @property HmsCompanyInfo[] $hmsCompanyInfos
 * @property HmsExchangeRate[] $hmsExchangeRates
 * @property HmsGuestInfo[] $hmsGuestInfos
 * @property HmsReservationInfo[] $hmsReservationInfos
 */
class Country extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Country the static model class
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
		return 'country';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country_name, country_currancy,currancy_sign, country_code', 'required'),
			//array('country_code', 'numerical', 'integerOnly'=>true),
			//array('country_name, country_currancy,currancy_sign, country_code', 'unique'),
			array('country_name, country_code', 'unique'),
			array('country_name, country_currancy', 'length', 'max'=>50),
			array('currancy_sign','length','max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('country_id, country_name, country_currancy,currancy_sign, country_code', 'safe', 'on'=>'search'),
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
			'CompanyInfos' => array(self::HAS_MANY, 'CompanyInfo', 'country_id'),
			'ExchangeRates' => array(self::HAS_MANY, 'ExchangeRate', 'country_id'),
			'GuestInfos' => array(self::HAS_MANY, 'GuestInfo', 'guest_country_id'),
			'ReservationInfos' => array(self::HAS_MANY, 'ReservationInfo', 'client_country_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'country_id' => Yii::t('views', 'Country'),
			'country_name' => Yii::t('views', 'Country Name'),
			'country_currancy' => Yii::t('views', 'Country Currancy'),
			'currancy_sign'=> Yii::t('views','Currancy Sign'),
			'country_code' => Yii::t('views', 'Country Code'),
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
		//$criteria->compare('country_id',$this->country_id);
		$criteria->compare('country_name',$this->country_name,true);
		$criteria->compare('currancy_sign',$this->currancy_sign,true);
		$criteria->compare('country_currancy',$this->country_currancy,true);
		$criteria->compare('country_code',$this->country_code);
		$criteria->compare('branch_id',$this->branch_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}