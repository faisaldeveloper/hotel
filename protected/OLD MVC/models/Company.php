<?php
class Company extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Company the static model class
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
		return 'hms_company_info';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('comp_name, comp_contact_person, person_designation, person_mobile, comp_address, comp_phone, comp_fax, comp_email, country_id, branch_id, user_id', 'required'),
			array('comp_name, comp_contact_person, country_id, branch_id, user_id', 'required'),
			
			array('country_id, branch_id, user_id', 'numerical', 'integerOnly'=>true),
			//array('person_mobile,comp_phone,comp_fax','numerical'),
			array('comp_name, comp_email, comp_website', 'length', 'max'=>50),
			//array('comp_website','url'),
			array('comp_name','unique'),
			array('comp_email','email'),
			array('comp_address','length', 'max'=>255),
			array('comp_contact_person, person_designation', 'length', 'max'=>30),
			//array('person_mobile, comp_phone, comp_fax', 'number'),
			array('comp_allow_credit', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('comp_id, comp_name, rate_from, rate_to, rate_date, comp_contact_person, person_designation, person_mobile, comp_address, comp_phone, comp_fax, comp_email, comp_website, comp_allow_credit, country_id, branch_id, user_id', 'safe'),
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
			'CheckinInfos' => array(self::HAS_MANY, 'CheckinInfo', 'guest_company_id'),
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'branch' => array(self::BELONGS_TO, 'Branches', 'branch_id'),
			'GuestInfos' => array(self::HAS_MANY, 'GuestInfo', 'guest_company_id'),
			'GuestLedgers' => array(self::HAS_MANY, 'GuestLedger', 'company_id'),
			'ReservationInfos' => array(self::HAS_MANY, 'ReservationInfo', 'company_id'),
			'RoomTypeRates' => array(self::HAS_MANY, 'RoomTypeRate', 'company_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'comp_id' => Yii::t('views', 'Comp'),
			'comp_name' => Yii::t('views', 'Company'),
			'comp_contact_person' => Yii::t('views', 'Contact Person'),
			'person_designation' => Yii::t('views', 'Designation'),
			'person_mobile' => Yii::t('views', 'Person Mobile'),
			'comp_address' => Yii::t('views', 'Address'),
			'comp_phone' => Yii::t('views', 'Phone'),
			'comp_fax' => Yii::t('views', 'Fax'),
			'comp_email' => Yii::t('views', 'Email'),
			'comp_website' => Yii::t('views', 'Website'),
			'comp_allow_credit' => Yii::t('views', 'Allow Credit'),
			'country_id' => Yii::t('views', 'Country'),
			'rate_from' => Yii::t('views', 'Rate Offered By'),
			'rate_to' => Yii::t('views', 'Rate Offered To'),
			'rate_date' => Yii::t('views', 'Rate Given On'),
			'branch_id' => Yii::t('views', 'Branch'),
			'user_id' => Yii::t('views', 'User'),
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
		if(!isset($_GET['Company_sort'])){$criteria->order = "t.comp_name ASC";}
		$hotel_branch_id = yii::app()->user->branch_id;
		$criteria->condition="t.branch_id = $hotel_branch_id";
		$criteria->compare('comp_id',$this->comp_id);
		$criteria->compare('comp_name',$this->comp_name,true);
		$criteria->compare('comp_contact_person',$this->comp_contact_person,true);
		$criteria->compare('person_designation',$this->person_designation,true);
		$criteria->compare('person_mobile',$this->person_mobile);
		$criteria->compare('comp_address',$this->comp_address,true);
		$criteria->compare('comp_phone',$this->comp_phone,true);
		$criteria->compare('comp_fax',$this->comp_fax,true);
		$criteria->compare('comp_email',$this->comp_email,true);
		$criteria->compare('comp_website',$this->comp_website,true);
		$criteria->compare('comp_allow_credit',$this->comp_allow_credit,true);
		$criteria->compare('country.country_name',$this->country_id,true);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('user_id',$this->user_id);
		
		$criteria->with=array('country');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>1200)
		));
	}
	
	///////////////////////////////////////////////
	 public function beforeSave(){		
	 		
		///account creation for guest
		if(!empty($_POST['Company']['comp_name'])){ 				
				$comp_name = str_replace("'", "", $this->comp_name);
				$res = Yii::app()->db->createCommand("select id from account_name where name = '$comp_name'")->query();
				if(count($res)==0)
				Yii::app()->db->createCommand("insert into account_name (name, account_type_id) values('$comp_name', '1')")->execute();
				$res = Yii::app()->db->createCommand("select id from account_name where name = '$comp_name'")->query();
				foreach ($res as $row){ $id = $row['id'];}
				$this->acc_no = $id; 		  
			}
			return parent::beforeSave();
	} 
}