<?php
class GuestInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GuestInfo the static model class
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
		return 'hms_guest_info';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('guest_salutation_id, guest_name, guest_country_id,  guest_identity_id, guest_identity_no, guest_mobile, guest_company_id, branch_id, user_id', 'required'),
			array('guest_name, guest_country_id,  guest_identity_id, guest_identity_no, guest_mobile, guest_company_id, branch_id, user_id', 'required'),
			array('guest_salutation_id, guest_country_id, guest_identity_id, guest_company_id, branch_id, user_id', 'numerical', 'integerOnly'=>true),
			array('guest_name, guest_identity_no, guest_email, guest_remarks', 'length', 'max'=>50),
			array('guest_address','length','max'=>255),
			array('guest_gender', 'length', 'max'=>10),
			//array('guest_name', 'CCompositeUniqueKeyValidator', 'keyColumns' => 'guest_name, guest_mobile'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('guest_id, guest_name, guest_address, guest_phone, guest_country_id, guest_mobile, guest_identity_id, guest_identity_no, guest_identity_issu, guest_identiy_expire, guest_gender, guest_email, guest_company_id, guest_remarks, guest_dob, branch_id, user_id', 'safe'),
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
			'CheckinInfos' => array(self::HAS_MANY, 'CheckinInfo', 'guest_id'),
			'GuestDocs' => array(self::HAS_MANY, 'GuestDoc', 'guest_id'),
			'guestCountry' => array(self::BELONGS_TO, 'Country', 'guest_country_id'),
			'guestCompany' => array(self::BELONGS_TO, 'Company', 'guest_company_id'),
			'guestSalutation' => array(self::BELONGS_TO, 'Salutation', 'guest_salutation_id'),
			'guestIdentity' => array(self::BELONGS_TO, 'Identity', 'guest_identity_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'guest_id' =>  Yii::t('views','Guest'),
			'guest_salutation_id' =>  Yii::t('views','Salutation'),
			'guest_name' =>  Yii::t('views','Guest Name'),
			'guest_address' =>  Yii::t('views','Address'),
			'guest_phone' =>  Yii::t('views','Phone'),
			'guest_country_id' =>  Yii::t('views','Country'),
			'guest_mobile' =>  Yii::t('views','Mobile'),
			'guest_identity_id' =>  Yii::t('views','Identity Doc'),
			'guest_identity_no' =>  Yii::t('views','Identity No'),
			'guest_identity_issu' =>  Yii::t('views','ID Issue Date'),
			'guest_identiy_expire' =>  Yii::t('views','ID Expiry Date'),
			'guest_gender' =>  Yii::t('views','Gender'),
			'guest_email' =>  Yii::t('views','Email'),
			'guest_company_id' =>  Yii::t('views','Company'),
			'guest_remarks' =>  Yii::t('views','Remarks'),
			'guest_dob' =>  Yii::t('views','D.O.B'),
			'branch_id' =>  Yii::t('views','Branch'),
			'user_id' =>  Yii::t('views','User'),
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
		
		$hotel_branch_id = yii::app()->user->branch_id;
		$criteria->condition="t.branch_id = $hotel_branch_id";
		$criteria->compare('t.guest_id',$this->guest_id);
		//$criteria->compare('guest_salutation_id',$this->guest_salutation_id);
		$criteria->compare('guest_name',$this->guest_name,true);
		$criteria->compare('guest_address',$this->guest_address,true);
		$criteria->compare('guest_phone',$this->guest_phone, true);
		$criteria->compare('guestCountry.country_name',$this->guest_country_id, true);
		$criteria->compare('guest_mobile',$this->guest_mobile, true);
		$criteria->compare('guest_identity_id',$this->guest_identity_id);
		$criteria->compare('guest_identity_no',$this->guest_identity_no);
		$criteria->compare('guest_identity_issu',$this->guest_identity_issu);
		$criteria->compare('guest_identiy_expire',$this->guest_identiy_expire);
		$criteria->compare('guest_gender',$this->guest_gender,true);
		$criteria->compare('guest_email',$this->guest_email,true);
		$criteria->compare('guestCompany.comp_name',$this->guest_company_id, true);
		$criteria->compare('guest_remarks',$this->guest_remarks);
		$criteria->compare('guest_dob',$this->guest_dob);
		$criteria->compare('t.branch_id',$this->branch_id);
		$criteria->compare('user_id',$this->user_id);
		
		$criteria->with=array('guestCountry'=>array('select'=>'guestCountry.country_name'),'guestCompany'=>array('select'=>'guestCompany.comp_name'));
		//$criteria->with=array('guestCompany'=>array('select'=>'guestCompany.comp_name'));
		
		$criteria->order = "guest_name ASC";
		return new CActiveDataProvider($this, array('criteria'=>$criteria,
		'pagination'=>array('pageSize'=>50)
		));
	}
	
	
	///////////////////////////////////////////////
	 public function beforeSave(){		
	 	if(!empty($_POST['GuestInfo']['guest_dob']))		$this->guest_dob = date('Y-m-d', strtotime($_POST['GuestInfo']['guest_dob']));	
		else $this->guest_dob =NULL;		
		if(!empty($_POST['GuestInfo']['guest_identity_issu']))	$this->guest_identity_issu = date('Y-m-d', strtotime($_POST['GuestInfo']['guest_identity_issu'])) ;
		else $this->guest_identity_issu =NULL;	
		if(!empty($_POST['GuestInfo']['guest_identiy_expire']))	$this->guest_identiy_expire = date('Y-m-d', strtotime($_POST['GuestInfo']['guest_identiy_expire'])) ;		
		else $this->guest_identiy_expire =NULL;	
		
		///account creation for guest
		if(!empty($_POST['GuestInfo']['guest_name'])){ 
				$guest_name = $this->guest_name."-". $this->guest_mobile;
				$res = Yii::app()->db->createCommand("select id from account_name where name = '$guest_name'")->query();
				if(count($res)==0)
				Yii::app()->db->createCommand("insert into account_name (name, account_type_id) values('$guest_name', '2')")->execute();
				$res = Yii::app()->db->createCommand("select id from account_name where name = '$guest_name'")->query();
				foreach ($res as $row){ $id = $row['id'];}
				$this->acc_no = $id; 		  
			}	
		
			return parent::beforeSave();
	} 
	///////////////////////////////////////////////	
	 protected function afterFind(){
		
		if($this->guest_dob=="0000-00-00") $this->guest_dob = '';
		else $this->guest_dob =date('d-m-Y', strtotime($this->guest_dob));
		
		if($this->guest_identity_issu=="0000-00-00") $this->guest_identity_issu = '';
		else $this->guest_identity_issu =date('d-m-Y', strtotime($this->guest_identity_issu));
		
		if($this->guest_identiy_expire=="0000-00-00") $this->guest_identiy_expire = '';
		else $this->guest_identiy_expire =date('d-m-Y', strtotime($this->guest_identiy_expire));
		
		return parent::afterFind();
	}
}