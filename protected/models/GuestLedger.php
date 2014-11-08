<?php
class GuestLedger extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GuestLedger the static model class
	 */
	
	public $service_name;
	public $t_folio;
	public $from_date;
	public $to_date;
	
	public $room_rent1;
	public $room_rent2;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hms_guest_ledger';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('chkin_id, guest_name, room_status, room_id, chkin_date, chkout_date, c_time, service_id, debit,
			 //credit, balance, cash_paid, credit_card, credit_card_no, btc, company_id, user_id, branch_id,remarks', 'required'),
			 
			array('service_id, debit, credit, balance, remarks', 'required'),
			array('chkin_id, room_id, service_id, cash_paid, credit_card_no, company_id, user_id, branch_id,remarks', 'numerical', 'integerOnly'=>true),
			array('debit, credit, balance', 'numerical'),
			array('guest_name', 'length', 'max'=>30),
			array('room_status, credit_card, btc, late_out', 'length', 'max'=>2),
			
			
			//array('chkin_id', 'unique'),
			//array('chkin_id', 'CCompositeUniqueKeyValidator', 'keyColumns' => 'chkin_id, guest_name, service_id'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, room_rent1, room_rent2, chkin_id, guest_name, room_status, room_id, chkin_date, chkout_date, c_date, c_time, service_id, remarks, debit, credit, balance, cash_paid, credit_card, credit_card_no, btc, company_id, user_id, late_out, branch_id', 'safe'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'room' => array(self::BELONGS_TO, 'RoomMaster', 'room_id'),
			'service' => array(self::BELONGS_TO, 'Services', 'service_id'),
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
			'checkininfo' => array(self::BELONGS_TO, 'CheckinInfo', 'chkin_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' =>  Yii::t('views', 'ID'),
			'chkin_id' =>  Yii::t('views', 'Folio No'),
			'guest_name' =>  Yii::t('views', 'Guest Name'),
			'room_status' =>  Yii::t('views', 'Room Status'),
			'room_id' =>  Yii::t('views', 'Room'),
			'chkin_date' =>  Yii::t('views', 'Chkin Date'),
			'chkout_date' =>  Yii::t('views', 'Chkout Date'),
			'c_date' =>  Yii::t('views', 'C Date'),
			'c_time' =>  Yii::t('views', 'C Time'),
			'service_id' =>  Yii::t('views', 'Service'),
			'remarks' =>  Yii::t('views', 'Bill No'),
			'debit' =>  Yii::t('views', 'Amount'),
			'credit' =>  Yii::t('views', 'Credit'),
			'balance' =>  Yii::t('views', 'Balance'),
			'cash_paid' =>  Yii::t('views', 'Cash Paid'),
			'credit_card' =>  Yii::t('views', 'Credit Card'),
			'credit_card_no' =>  Yii::t('views', 'Credit Card No'),
			'btc' =>  Yii::t('views', 'Btc'),
			'company_id' =>  Yii::t('views', 'Company'),
			'user_id' =>  Yii::t('views', 'User'),
			'late_out' =>  Yii::t('views', 'Late Out'),
			'branch_id' =>  Yii::t('views', 'Branch'),
			
			'room_rent1' =>  Yii::t('views', 'Room Rent 1'),
			'room_rent2' =>  Yii::t('views', 'Room Rent 2'),
		);
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id=0)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		
		$date = date("Y-m-d");
		$sdate = date("Y-m-d", (strtotime($date) - 60*60*24*2));
		//echo "-------c_date BETWEEN '$sdate 00:00:00' AND '$date 00:00:00'   AND room_id  <= 0 || room_id  is Null";	
		if($id>0){		$criteria->condition="chkin_id = $id and room_status = 'O'";	}
		else { $criteria->condition="c_date BETWEEN '$sdate 00:00:00' AND '$date 23:59:59'   AND (room_id  <= 0 || room_id  is NULL)";  }
		
		$criteria->compare('id',$this->id);
		$criteria->compare('chkin_id',$this->chkin_id);
		$criteria->compare('guest_name',$this->guest_name,true);
		$criteria->compare('room_status',$this->room_status,true);
		$criteria->compare('room_id',$this->room_id);
		$criteria->compare('chkin_date',$this->chkin_date,true);
		$criteria->compare('chkout_date',$this->chkout_date,true);
		$criteria->compare('c_date',$this->c_date,true);
		$criteria->compare('c_time',$this->c_time,true);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('debit',$this->debit);
		$criteria->compare('credit',$this->credit);
		$criteria->compare('balance',$this->balance);
		$criteria->compare('cash_paid',$this->cash_paid);
		$criteria->compare('credit_card',$this->credit_card,true);
		$criteria->compare('credit_card_no',$this->credit_card_no);
		$criteria->compare('btc',$this->btc,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('late_out',$this->late_out,true);
		$criteria->compare('branch_id',$this->branch_id);
		
		$criteria->order = 'id ASC';
		return new CActiveDataProvider($this, array('criteria'=>$criteria,));
	}
	///////////////////////////////////////////////////////////////
	
	public function search_view($id=0)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		
		$date = date("Y-m-d");
		$sdate = date("Y-m-d", (strtotime($date) - 60*60*24*2));
		//echo "-------c_date BETWEEN '$sdate 00:00:00' AND '$date 00:00:00'   AND room_id  <= 0 || room_id  is Null";	
		if($id>0){		$criteria->condition="chkin_id = $id";	}
		else { $criteria->condition="c_date BETWEEN '$sdate 00:00:00' AND '$date 23:59:59'   AND (room_id  <= 0 || room_id  is NULL)";  }
		
		$criteria->compare('id',$this->id);
		$criteria->compare('chkin_id',$this->chkin_id);
		$criteria->compare('guest_name',$this->guest_name,true);
		$criteria->compare('room_status',$this->room_status,true);
		$criteria->compare('room_id',$this->room_id);
		$criteria->compare('chkin_date',$this->chkin_date,true);
		$criteria->compare('chkout_date',$this->chkout_date,true);
		$criteria->compare('c_date',$this->c_date,true);
		$criteria->compare('c_time',$this->c_time,true);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('debit',$this->debit);
		$criteria->compare('credit',$this->credit);
		$criteria->compare('balance',$this->balance);
		$criteria->compare('cash_paid',$this->cash_paid);
		$criteria->compare('credit_card',$this->credit_card,true);
		$criteria->compare('credit_card_no',$this->credit_card_no);
		$criteria->compare('btc',$this->btc,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('late_out',$this->late_out,true);
		$criteria->compare('branch_id',$this->branch_id);
		
		$criteria->order = 'id ASC';
		return new CActiveDataProvider($this, array('criteria'=>$criteria,'pagination'=>false));
	}
	
	
	
	////Faisal code
	public function btc()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$branch_id = Yii::app()->user->branch_id;		
		$walkin = Company::model()->find("(comp_name LIKE 'walk in' || comp_name LIKE 'walkin') AND branch_id = ". $branch_id)->comp_id;
		
		$criteria=new CDbCriteria;
		$criteria->select = 'id, company_id, sum(balance) AS balance';		
		$criteria->condition = 'balance > 0 AND company_id !='.$walkin; //company_id for Walkin 
		$criteria->group = 'company_id';		
			
		//$criteria->compare('btc',3);
		$criteria->compare('company.comp_name',$this->company_id, true);
		
		$criteria->with=array('company');
		
	
		return new CActiveDataProvider($this, array('criteria'=>$criteria,));
	}
		
	///////////////////////
	 public function beforeSave(){	
	 	$branch_id = yii::app()->user->branch_id;	 
		$ad = DayEnd::model()->find("branch_id= $branch_id");
		$time = date("H:i:s", time());
		//$model=new CheckinInfo;		
		//echo "---->>". $this->c_date; $ch = '';
		if(!isset($this->c_date) || empty($this->c_date)){
				if(isset($_POST['CheckinInfo']['prev_night']) && $_POST['CheckinInfo']['prev_night']=='Y'){			//if($ad->night_post==1)
					//$this->c_date = date('Y-m-d H:i:s',strtotime('-1 day',strtotime($ad->active_date)));
					$active_date = explode(" ",$ad->active_date);
					$this->c_date = $active_date[0]." ". $time;	
				}else{
					 $active_date = explode(" ",$ad->active_date);
					 $this->c_date = $active_date[0]." ". $time;					
					//$this->c_date = date('Y-m-d', strtotime($this->c_date))." ". $time;
				}
				//$this->c_date =  date('Y-m-d H:i:s');																																																						
		}
		else { //this code is for dividebill.php in guestledger view....where room rent is being split	
			$c_date = explode(" ",$this->c_date);
			if(count($c_date) == 1)	{$this->c_date = date('Y-m-d', strtotime($c_date[0]))." ". $time; }
			else { $this->c_date = date('Y-m-d H:i:s', strtotime($this->c_date)); }
		}
		
		//echo "--$ch--". $this->c_date;	exit;
		
		$chkin = explode(" ",$this->chkin_date);
		$this->chkin_date = date('Y-m-d', strtotime($chkin[0]))." 00:00:00";
		$chkout = explode(" ",$this->chkout_date);
		$this->chkout_date = date('Y-m-d', strtotime($chkout[0])) ." 00:00:00";
		
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
///////////////////////////////////////////////////////
	public static function getDrTotal($chkin_id){
		
		$sql = "select debit from hms_guest_ledger where chkin_id = $chkin_id";
		$res = Yii::app()->db->createCommand($sql)->query();
		$t =0;
		foreach($res as $row){$t +=$row['debit'];}	
		return $t;	
	}
	
	public static function getCrTotal($chkin_id){
		$sql = "select credit from hms_guest_ledger where chkin_id = $chkin_id";
		$res = Yii::app()->db->createCommand($sql)->query();
		$t =0;
		foreach($res as $row){$t +=$row['credit'];}	
		return $t;		
	}
	/////////////////
	
}