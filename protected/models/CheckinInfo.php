<?php
class CheckinInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CheckinInfo the static model class
	 */
	 
	public $gst_amount;
	public $extra_bed;
	public $bed_tax;
	public $e_bd;
	public $b_tax;
	public $recheckin_status;
	public $ajax_status;
	public $guest_id;
	
	
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hms_checkin_info';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('guest_id, chkin_date, chkout_date, total_days, room_id, room_type, room_name, guest_company_id, rate_type, total_person, total_charges, chkout_status, guest_status_id, reg_no, sale_person_id, rate, prev_night, branch_id', 'required'),
			
			
			array('guest_id, reservation_id, total_days, room_id, guest_company_id, rate_type, total_person, amount_paid, chkin_user_id, chkout_user_id, guest_status_id, sale_person_id, newspaper_id, rate, branch_id', 'numerical', 'integerOnly'=>true),
			
			
			array('drop_service, chkout_status, gst, bed_tax, prev_night', 'length', 'max'=>2),
			array('flight_name', 'length', 'max'=>30),
			array('reg_no','unique'),
			array('room_type, room_name, comming_from, next_destination', 'length', 'max'=>20),
			array('flight_time, cash, debit_card, credit_card, btc, created_time', 'safe'),
			array('rate', 'numerical', 'min'=>'1'),
			array('total_charges', 'numerical',),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gst_show, guest_id, reservation_id, chkin_date, chkout_date, drop_service, flight_name, flight_time, total_days, room_id, room_type, room_name, guest_company_id, rate_type, total_person, total_charges, amount_paid, chkout_status, chkin_user_id, chkout_user_id, guest_status_id, chkin_id, sale_person_id, comming_from, next_destination, newspaper_id, rate, comments, gst, bed_tax, prev_night, ajax_status, guest_id, branch_id', 'safe'),
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
			'guest' => array(self::BELONGS_TO, 'GuestInfo', 'guest_id'),
			'flight' => array(self::BELONGS_TO, 'Flights', 'flight_name'),
			
			'roomtype' => array(self::BELONGS_TO, 'HmsRoomType', 'room_type'),
			'room' => array(self::BELONGS_TO, 'RoomMaster', 'room_name'),			
			'newspaper' => array(self::BELONGS_TO, 'Newspapers', 'newspaper_id'),
			'company' => array(self::BELONGS_TO, 'Company', 'guest_company_id'),
			'guestStatus' => array(self::BELONGS_TO, 'GuestStatus', 'guest_status_id'),
			'salePerson' => array(self::BELONGS_TO, 'SalePerson', 'sale_person_id'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
			'chkinUser' => array(self::BELONGS_TO, 'User', 'chkin_user_id'),
			'chkoutUser' => array(self::BELONGS_TO, 'User', 'chkout_user_id'),
			'guestledger' => array(self::HAS_MANY, 'GuestLedger', 'chkin_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'guest_id' => Yii::t('views','Guest'),
			'reservation_id' => Yii::t('views','Reservation'),
			'chkin_date' => Yii::t('views','Check-In'),
			'chkout_date' => Yii::t('views','Check-Out'),	
			'drop_service' => Yii::t('views','Drop Service'),
			'flight_name' => Yii::t('views','Flight Name'),
			'flight_time' => Yii::t('views','Flight Time'),
			'total_days' => Yii::t('views','Total Nights'),
			'room_id' => Yii::t('views','Room'),'Room',
			'room_type' => Yii::t('views','Room Type'),
			'room_name' => Yii::t('views','Room Name'),
			'guest_company_id' => Yii::t('views','Company'),
			'rate_type' => Yii::t('views','Rate Type'),
			'total_person' => Yii::t('views','Person'),
			'total_charges' => Yii::t('views','Total Charges'),
			'amount_paid' => Yii::t('views','Amount Paid'),
			'chkout_status' => Yii::t('views','Chkout Status'),
			'chkin_user_id' => Yii::t('views','Chkin User'),
			'chkout_user_id' => Yii::t('views','Chkout User'),
			'guest_status_id' => Yii::t('views','Status'),
			'chkin_id' => Yii::t('views','Folio No'),
			'sale_person_id' => Yii::t('views','Sale Person'),
			'comming_from' => Yii::t('views','Comming From'),
			'next_destination' => Yii::t('views','Next Destination'),
			'newspaper_id' => Yii::t('views','Newspaper'),
			'rate' => Yii::t('views','Rate'),
			'cash' => Yii::t('views','Cash'),
			'credit_card' => Yii::t('views','C/Card'),
			'debit_card' => Yii::t('views','D/Card'),
			'btc' => Yii::t('views','BTC'),
			'comments'=> Yii::t('views','Comments'),
			'prev_night'=> Yii::t('views','Charge Previous Night'),
			'gst' => Yii::t('views','GST'),
			'gst_show' => Yii::t('views','Gst Show'),
			'bed_tax' => Yii::t('views','Bed Tax'),
			'branch_id' => Yii::t('views','Branch'),
			
			
			
		);
	}
	///////////////////////
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		
		if(!isset($_GET['CheckinInfo_sort'])){
		$criteria->order = "room.mst_room_name ASC";
		//$criteria->order = "t.chkin_id desc";
		}
		
		$hotel_branch_id = yii::app()->user->branch_id;
		//filter results for branch and whos check out status = NO
		$criteria->condition="chkout_status = 'N' AND t.branch_id = $hotel_branch_id";
		$criteria->compare('t.chkin_id',$this->chkin_id);
		$criteria->compare('guest.guest_name',$this->guest_id,true);
		$criteria->compare('reservation_id',$this->reservation_id);
		$criteria->compare('chkin_date',$this->chkin_date,true);
		$criteria->compare('chkout_date',$this->chkout_date,true);		
		$criteria->compare('drop_service',$this->drop_service,true);
		$criteria->compare('flight_name',$this->flight_name,true);
		$criteria->compare('flight_time',$this->flight_time,true);
		$criteria->compare('total_days',$this->total_days);
		$criteria->compare('room.mst_room_name',$this->room_name, true);
		$criteria->compare('roomtype.room_name',$this->room_type,true);
		//$criteria->compare('room_name',$this->room_name,true);
		$criteria->compare('company.comp_name',$this->guest_company_id, true);
		$criteria->compare('rate_type',$this->rate_type);
		$criteria->compare('total_person',$this->total_person);
		$criteria->compare('total_charges',$this->total_charges);
		$criteria->compare('amount_paid',$this->amount_paid);
		$criteria->compare('chkout_status',$this->chkout_status,true);
		$criteria->compare('chkin_user_id',$this->chkin_user_id);
		$criteria->compare('chkout_user_id',$this->chkout_user_id);
		$criteria->compare('guest_status_id',$this->guest_status_id);
		$criteria->compare('sale_person_id',$this->sale_person_id);
		$criteria->compare('comming_from',$this->comming_from,true);
		$criteria->compare('next_destination',$this->next_destination,true);
		$criteria->compare('newspaper_id',$this->newspaper_id);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('comments',$this->comments);
		$criteria->compare('gst',$this->gst,true);
		$criteria->compare('gst',$this->prev_night,true);
		$criteria->compare('bed_tax',$this->bed_tax,true);
		$criteria->compare('branch_id',$this->branch_id);
		
		$criteria->with=array('guest'=>array('select'=>'guest.guest_name'), 'company'=>array('select'=>'company.comp_name'),'room'=>array('select'=>'room.mst_room_name'), 'roomtype'=>array('select'=>'roomtype.room_name'));
		
		
		//1$criteria->order = 'chkin_id DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>50)
		));
	}
	
	
	/////////////////////////////////
	public function taxcontrol(){
		
		$criteria=new CDbCriteria;		
		if(!isset($_GET['CheckinInfo_sort'])){
		$criteria->order = "t.chkin_id ASC";
		//$criteria->order = "t.chkin_id desc";
		}
		
		$hotel_branch_id = yii::app()->user->branch_id;
		//filter results for branch and whos check out status = NO
		$criteria->condition="chkout_status = 'Y' AND t.branch_id = $hotel_branch_id";	
		
		//$criteria->compare('t.chkin_id',$this->chkin_id);
		$criteria->compare('guest.guest_name',$this->guest_id,true);
		$criteria->compare('reservation_id',$this->reservation_id);
		$criteria->compare('t.chkin_date',$this->chkin_date,true);
		$criteria->compare('t.chkout_date',$this->chkout_date,true);		
		$criteria->compare('room.mst_room_name',$this->room_name, true);
		$criteria->compare('roomtype.room_name',$this->room_type,true);
		//$criteria->compare('room_name',$this->room_name,true);
		$criteria->compare('company.comp_name',$this->guest_company_id, true);		
		$criteria->compare('chkin_id',$this->chkin_id);		
		$criteria->compare('gst_show',$this->gst_show);
		
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('t.created_time',$this->created_time, true);
		
		$criteria->with=array('guest','guestledger','company','room', 'roomtype');
		
		//$criteria->order = 'chkin_id ASC';
		
		return new CActiveDataProvider($this, array(
		'criteria'=>$criteria,
		'pagination'=>array('pageSize'=>10),
		));
	}
	
	
	////////////////////////////////////////
	
	 public function beforeSave(){	
	 	
		if(isset($_POST['CheckinInfo']['chkin_date'])){			
			$this->chkin_date = date('Y-m-d', strtotime($_POST['CheckinInfo']['chkin_date']))." 00:00:00";
		}	
		if(isset($_POST['CheckinInfo']['chkout_date'])){			
			$this->chkout_date = date('Y-m-d', strtotime($_POST['CheckinInfo']['chkout_date'])) ." 00:00:00";
		}
		if($this->isNewRecord)	{	$this->created_time = date("Y-m-d H:i:s"); }
		return parent::beforeSave();
	} 
	///////////////////////////////////////////////	
	 protected function afterFind(){
		$chkin = explode(" ",$this->chkin_date);
		$chkout = explode(" ",$this->chkout_date);
		if($this->created_time != "0000-00-00 00:00:00"){
			$createdtime = explode(" ", $this->created_time);
			$this->created_time = date('d-m-Y', strtotime($createdtime[0]));
		}
		else $this->created_time = "-";
		$this->chkin_date =date('d-m-Y', strtotime($chkin[0]));
		$this->chkout_date = date('d-m-Y', strtotime($chkout[0]));
		
		return parent::afterFind();
	}
	
	/* public function afterFind(){
        if($this->prev_night==1) $this->prev_night=true;
        if($this->prev_night==0) $this->prev_night=false;
        return parent::afterFind();
	} */
	
	public function search2()
	{
		$criteria=new CDbCriteria;	
		if(!isset($_GET['CheckinInfo_sort'])){
		$criteria->order = "room.mst_room_name ASC";
		//$criteria->order = "t.chkin_id desc";
		}
			
		$hotel_branch_id = yii::app()->user->branch_id;				
		$date = DayEnd::model()->find("branch_id= $hotel_branch_id")->active_date;
		
		
		//filter results for branch and whos check out status = NO
		$criteria->condition="chkout_status = 'Y' AND chkout_date LIKE '$date%' AND t.branch_id = $hotel_branch_id";		
		$criteria->with=array('guest'=>array('select'=>'guest.guest_name'), 'company'=>array('select'=>'company.comp_name'),'room'=>array('select'=>'room.mst_room_name'), 'roomtype'=>array('select'=>'roomtype.room_name'));
				
		//$criteria->order = 'chkin_id DESC';
		return new CActiveDataProvider($this, array('criteria'=>$criteria,));
	}
///////////////////////////////
public static function payable($cid){
	$sql = "select SUM(debit) as total from hms_guest_ledger where chkin_id = $cid";	
	$sql_cr = "select SUM(credit) as total from hms_guest_ledger where chkin_id = $cid";	
	$total = Yii::app()->db->createCommand($sql)->queryScalar();
	$total_cr = Yii::app()->db->createCommand($sql_cr)->queryScalar();
return $total - $total_cr;
}
////////////////////////////
public static function mop($cid){	
	$mop = '';
	$sql = "select * from hms_checkin_info where chkin_id = $cid";	
	$res = Yii::app()->db->createCommand($sql)->query();			
	foreach($res as $row){
		if($row['cash'] == 'Y')$mop .='Cash';
		if($row['credit_card'] =='Y')$mop .='/CC';
		if($row['crdit_card'] =='Y')$mop .='/DC';
		if($row['btc'] == 'Y')$mop .='BTC';	
	}
	$mop = trim($mop,"/");
return $mop;
}
///////////////////////////
	public function findCheckedIn($num){
		$limit = "";
		if($num==1)$limit = "Limit 0,0";		
				
		$sql = "select ci.chkin_id, gi.guest_name, rm.mst_room_name FROM hms_checkin_info ci
		LEFT JOIN hms_guest_info gi ON ci.guest_id = gi.guest_id 
		LEFT JOIN hms_room_master rm ON ci.room_id = rm.mst_room_id 
		WHERE ci.chkout_status = 'N' ORDER BY ci.room_id ".$limit;
		
		$rs = Yii::app()->db->createCommand($sql)->query();	
		$list = array();
		
		 foreach($rs as $key=>$row){
		  $value = $row['chkin_id'];
		 // if(strlen($row['title'])>20){$end = "...";}else{$end="";}
		  $name = $row['mst_room_name']." - ".$row['guest_name'];
		  $list[$value]=$name;
		  }
		return $list;
		
	   //return CHtml::listData($res,'chkin_id','guest_name');
	}
	
	
	
	/////////////////////////////////
}