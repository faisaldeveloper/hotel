<?php
/**
 * This is the model class for table "hms_room_master".
 *
 * The followings are the available columns in table 'hms_room_master':
 * @property integer $mst_room_id
 * @property integer $mst_room_name
 * @property integer $mst_floor_id
 * @property integer $mst_roomtypeid
 * @property string $mst_room_remarks
 * @property integer $mst_room_adults
 * @property integer $mst_room_childs
 * @property string $mst_room_status
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property HmsCheckinInfo[] $hmsCheckinInfos
 * @property HmsGuestLedger[] $hmsGuestLedgers
 * @property HmsFloor $mstFloor
 * @property HmsRoomType $mstRoomtype
 * @property HmsBranches $branch
 */
class RoomMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RoomMaster the static model class
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
		return 'hms_room_master';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mst_room_name, mst_floor_id, mst_roomtypeid, mst_room_adults, mst_room_childs, mst_room_status, branch_id', 'required'),
			array('mst_room_name, mst_floor_id, mst_roomtypeid, mst_room_adults, mst_room_childs, branch_id', 'numerical', 'integerOnly'=>true),
			array('mst_room_remarks', 'length', 'max'=>50),
			array('mst_room_name','unique'),
			array('mst_room_status', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mst_room_id, mst_room_name, mst_floor_id, mst_roomtypeid, mst_room_remarks, mst_room_adults, mst_room_childs, mst_room_status, branch_id', 'safe', 'on'=>'search'),
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
			'CheckinInfos' => array(self::HAS_MANY, 'CheckinInfo', 'room_id'),
			'GuestLedgers' => array(self::HAS_MANY, 'GuestLedger', 'room_id'),
			'Floor' => array(self::BELONGS_TO, 'HmsFloor', 'mst_floor_id'),
			'Roomtype' => array(self::BELONGS_TO, 'HmsRoomType', 'mst_roomtypeid'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mst_room_id' => Yii::t('views', 'Mst Room'),
			'mst_room_name' => Yii::t('views', 'Room Name'),
			'mst_floor_id' => Yii::t('views', 'Floor'),
			'mst_roomtypeid' => Yii::t('views', 'Room Type'),
			'mst_room_remarks' => Yii::t('views', 'Room Remarks'),
			'mst_room_adults' => Yii::t('views', 'Adults'),
			'mst_room_childs' => Yii::t('views', 'Childs'),
			'mst_room_status' => Yii::t('views', 'Room Status'),
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
		
		$hotel_branch_id = yii::app()->user->branch_id;
		$criteria->condition="t.branch_id = $hotel_branch_id";
		$criteria->compare('mst_room_id',$this->mst_room_id);
		$criteria->compare('mst_room_name',$this->mst_room_name, true);
		//$criteria->compare('mst_floor_id',$this->mst_floor_id);
		$criteria->compare('Floor.description',$this->mst_floor_id, true);
		//$criteria->compare('mst_roomtypeid',$this->mst_roomtypeid);
		$criteria->compare('Roomtype.room_name',$this->mst_roomtypeid, true);
		$criteria->compare('mst_room_remarks',$this->mst_room_remarks,true);
		$criteria->compare('mst_room_adults',$this->mst_room_adults);
		$criteria->compare('mst_room_childs',$this->mst_room_childs);
		$criteria->compare('mst_room_status',$this->mst_room_status,true);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->with=array('Floor'=>array('select'=>'Floor.description'), 'Roomtype'=>array('select'=>'Roomtype.room_name'));
		//$criteria->with=array('Roomtype');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
		));
	}
}