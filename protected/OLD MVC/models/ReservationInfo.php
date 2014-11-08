<?php
class ReservationInfo extends CActiveRecord{
	
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hms_reservation_info';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public $my_client_name = array();
	public $client_salutation_id = array();
	public $total_reservations;
	//public $left_reservations;
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('res_type,total_reservations,  company_id, to_person, designation, chkin_date, chkout_date, c_date, total_days, client_salutation_id, client_name, client_identity_id, client_country_id, client_mobile,room_type, reservation_status, cancel_status, cancel_by, chkin_status, noshow_status, user_id, sale_person_id, branch_id',  'required'),
			
			array('company_id, total_days,total_reservations, client_salutation_id, client_country_id, client_identity_id, reservation_status, cancel_by, room_charges, discount, advance, user_id, sale_person_id, branch_id', 'numerical', 'integerOnly'=>true),
			
			
			array('res_type, pick_service, drop_service, cancel_status, chkin_status, noshow_status, gst', 'length', 'max'=>2),
			array('group_name, client_name, client_email,client_mobile, guest_mobile, guest_phone', 'length', 'max'=>30),
			array('flight_name, drop_flight_name', 'length', 'max'=>20),
			array('to_person', 'length', 'max'=>100),
			array('designation', 'length', 'max'=>120),
			array('client_address', 'length', 'max'=>255),
			array('designation, cancel_reason, client_remarks', 'length', 'max'=>50),
			array('client_phone, flight_time, drop_flight_time, room_type, room_name, client_remarks, room_charges, total_reservations, left_reservatons, mode_of_payment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('reservation_id, res_type, group_name, company_id, to_person, designation, chkin_date, chkout_date, c_date, total_days, pick_service, flight_name, flight_time, drop_service, drop_flight_name, drop_flight_time, client_salutation_id, client_name, client_gender, client_address, client_country_id, client_mobile, client_phone, guest_mobile, guest_phone, client_email, client_identity_id, client_identity_no, reservation_status, cancel_status, cancel_date, cancel_reason, cancel_by, chkin_status, noshow_status, client_remarks, room_charges, discount, gst, advance, user_id, sale_person_id, branch_id, total_reservations,', 'safe'),
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
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'clientCountry' => array(self::BELONGS_TO, 'Country', 'client_country_id'),
			'clientIdentity' => array(self::BELONGS_TO, 'Identity', 'client_identity_id'),
			'reservationStatus' => array(self::BELONGS_TO, 'ReservationStatus', 'reservation_status'),
			'clientSalutation' => array(self::BELONGS_TO, 'Salutation', 'client_salutation_id'),
			'salePerson' => array(self::BELONGS_TO, 'SalePerson', 'sale_person_id'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'cancelBy' => array(self::BELONGS_TO, 'User', 'cancel_by'),
			'flights' => array(self::BELONGS_TO, 'Flights', 'flight_name'),
			'dropFlights' => array(self::BELONGS_TO, 'Flights', 'drop_flight_name'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'reservation_id' => 'Confirm # ',
			
			
			'res_type' => Yii::t('views','Res Type'),
			'group_name' => Yii::t('views','Group Name'),
			'company_id' => Yii::t('views','Company'),
			'to_person' => Yii::t('views','To Person'),
			'designation' => Yii::t('views','Designation'),
			'chkin_date' => Yii::t('views','CheckIn'),			
			'chkout_date' => Yii::t('views','CheckOut'),			
			'c_date' => Yii::t('views','C Date'),
			'total_days' => Yii::t('views','Total Days'),
			'pick_service' => Yii::t('views','Pick'),
			'flight_name' => Yii::t('views','Flight Name'),
			'flight_time' => Yii::t('views','Flight Time'),
			'drop_service' => Yii::t('views','Drop'),
			'drop_flight_name' => Yii::t('views','Drop F-Name'),
			'drop_flight_time' => Yii::t('views','Drop F-Time'),
			'client_salutation_id' => Yii::t('views','Salutation'),
			'client_name' => Yii::t('views','Name'),
			'client_address' => Yii::t('views','Address'),
			'client_country_id' => Yii::t('views','Country'),
			'client_mobile' => Yii::t('views','Mobile'),
			'client_phone' => Yii::t('views','Phone'),
			'guest_mobile' => Yii::t('views','Mobile'),
			'guest_phone' => Yii::t('views','Phone'),
			
			'client_email' => Yii::t('views','Email'),
			'client_identity_id' => Yii::t('views','Identity'),
			'client_identity_no' => Yii::t('views','Identity No'),
			'reservation_status' => Yii::t('views','Status'),
			'room_type' => Yii::t('views','Room Type'),
			'room_name' => Yii::t('views','Room No'),			
			'cancel_status' => Yii::t('views','Cancel Status'),
			'cancel_date' => Yii::t('views','Cancel Date'),
			'cancel_reason' => Yii::t('views','Cancel Reason'),			
			'cancel_by' => Yii::t('views','Cancel By'),
			'chkin_status' => Yii::t('views','Chkin Status'),
			'noshow_status' => Yii::t('views','Noshow Status'),
			'client_remarks' => Yii::t('views','Instructins'),
			'room_charges' => Yii::t('views','Rate'),
			
			'discount' => Yii::t('views','Discount'),
			'gst' => Yii::t('views','Gst'),
			'advance' => Yii::t('views','Advance'),
			'mode_of_payment'=>  Yii::t('views','M.O.P'),
			'user_id' => Yii::t('views','User'),
			'sale_person_id' => Yii::t('views','Sale Person'),
			'branch_id' => Yii::t('views','Branch'),
		);
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search(){
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		
		//$criteria->limit = 10; 
		
		$hotel_branch_id = yii::app()->user->branch_id;
		$curr_date = date('Y-m-d 00:00:00');	
		$prev_date = date("Y-m-d H:i:s",strtotime($curr_date) - 60*60*24*10); //10 days back to show cancel reservations
		
		$criteria->condition="";
		if(!isset($_GET['ReservationInfo_sort'])){
		$criteria->order = "reservation_id ASC";		
		}		
		
		if(!empty($_GET['ReservationInfo']['chkin_date']) || !empty($_GET['ReservationInfo']['reservation_status'])){
			$res_status = $_GET['ReservationInfo']['reservation_status'];
			if(empty($res_status))$res_status = 1;			
			$criteria->condition=" chkin_date >= '$prev_date' AND chkin_status='N' AND reservation_status=$res_status AND  t.branch_id = $hotel_branch_id";
		}
		else{
		$criteria->condition=" chkin_date >= '$curr_date' AND chkin_status='N' AND (reservation_status='1') AND  t.branch_id = $hotel_branch_id";
		}
		
		$criteria->compare('reservation_id',$this->reservation_id);
		$criteria->compare('res_type',$this->res_type,true);
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('company.comp_name',$this->company_id, true);
		$criteria->compare('to_person',$this->to_person,true);
		$criteria->compare('designation',$this->designation,true);
		$criteria->compare('chkin_date',$this->chkin_date,true);		
		$criteria->compare('chkout_date',$this->chkout_date,true);		
		$criteria->compare('c_date',$this->c_date,true);
		$criteria->compare('total_days',$this->total_days);
		$criteria->compare('pick_service',$this->pick_service,true);
		$criteria->compare('flight_name',$this->flight_name,true);
		$criteria->compare('flight_time',$this->flight_time,true);
		$criteria->compare('drop_service',$this->drop_service,true);
		$criteria->compare('drop_flight_name',$this->drop_flight_name,true);
		$criteria->compare('drop_flight_time',$this->drop_flight_time,true);
		$criteria->compare('client_salutation_id',$this->client_salutation_id);
		$criteria->compare('client_name',$this->client_name,true);
		//$criteria->compare('client_gender',$this->client_gender,true);
		$criteria->compare('client_address',$this->client_address,true);
		$criteria->compare('client_country_id',$this->client_country_id);
		$criteria->compare('client_mobile',$this->client_mobile, true);
		$criteria->compare('client_phone',$this->client_phone, true);
		$criteria->compare('client_email',$this->client_email,true);
		$criteria->compare('client_identity_id',$this->client_identity_id);
		$criteria->compare('client_identity_no',$this->client_identity_no);
		$criteria->compare('reservationStatus.res_id',$this->reservation_status, true);
		
		//$criteria->compare('room_type',$this->room_type);
		//$criteria->compare('room_name',$this->room_name);
		
		$criteria->compare('cancel_status',$this->cancel_status,true);
		$criteria->compare('cancel_date',$this->cancel_date,true);
		$criteria->compare('cancel_reason',$this->cancel_reason,true);		
		$criteria->compare('cancel_by',$this->cancel_by);
		$criteria->compare('chkin_status',$this->chkin_status,true);
		$criteria->compare('noshow_status',$this->noshow_status,true);
		$criteria->compare('client_remarks',$this->client_remarks,true);
		$criteria->compare('room_charges',$this->room_charges);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('gst',$this->gst,true);
		$criteria->compare('advance',$this->advance);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('sale_person_id',$this->sale_person_id);
		$criteria->compare('branch_id',$this->branch_id);
		
		$criteria->with = array('company'=>array('select'=>'company.comp_name'), 'reservationStatus'=>array('select'=>'reservationStatus.res_description'));
		
		//
		
		//$criteria->order = 'chkin_date ASC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			//'sort'=>false,			
			'pagination'=>array('pageSize'=>25),
		));
	}
	
	///////////////////////search for checkin
	
	public function res_search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		
		$hotel_branch_id = yii::app()->user->branch_id;
		$criteria=new CDbCriteria;			
		
		$criteria->condition="(reservation_status='1' || reservation_status='3')  AND chkin_status = 'N' and t.branch_id = $hotel_branch_id"; 
		
		$criteria->compare('reservation_id',$this->reservation_id);
		$criteria->compare('res_type',$this->res_type,true);
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('company.comp_name',$this->company_id,true);
	
		$criteria->compare('client_name',$this->client_name,true);
		//$criteria->compare('client_gender',$this->client_gender,true);
		$criteria->compare('client_mobile',$this->client_mobile);
		$criteria->with=array('company');		
		$criteria->order = 'reservation_id DESC'; 
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}	
	////////////////////end search for check in/////
	
	///////////////////////search for cancelled resservations 
	
	public function Rsv_search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		
		$hotel_branch_id = yii::app()->user->branch_id;
		$criteria=new CDbCriteria;		
	
		//$hotel_branch_id = yii::app()->user->branch_id;
		$criteria->condition="chkin_status = 'N' and t.branch_id = $hotel_branch_id"; 
		
		$criteria->compare('reservation_id',$this->reservation_id);
		$criteria->compare('res_type',$this->res_type,true);
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('company.comp_name',$this->company_id,true);	
		$criteria->compare('client_name',$this->client_name,true);
		//$criteria->compare('client_gender',$this->client_gender,true);
		$criteria->compare('client_mobile',$this->client_mobile);
		$criteria->with=array('company');		
		$criteria->order = 'reservation_id DESC'; 
		
		return new CActiveDataProvider($this, array('criteria'=>$criteria,));
	}	
	////////////////////end search for check in/////
	
	 public function beforeSave(){		
			$chkin = $this->chkin_date;
			$chkout = $this->chkout_date;		
			$this->chkin_date = date('Y-m-d', strtotime($chkin))." 00:00:00";
			$this->chkout_date = date('Y-m-d', strtotime($chkout))." 00:00:00";				
		return parent::beforeSave();
	} 
	///////////////////////////////////////////////	
	 protected function afterFind(){
		$chkin = explode(" ",$this->chkin_date);
		$chkout = explode(" ",$this->chkout_date);
		$this->chkin_date =date('d-m-Y', strtotime($chkin[0]));
		$this->chkout_date = date('d-m-Y', strtotime($chkout[0]));
		return parent::afterFind();
	}
	
	
}