<?php
/**
 * This is the model class for table "hms_room_type".
 *
 * The followings are the available columns in table 'hms_room_type':
 * @property integer $room_type_id
 * @property string $room_name
 * @property integer $adults
 * @property integer $childs
 * @property integer $room_rate
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property HmsRoomMaster[] $hmsRoomMasters
 * @property HmsBranches $branch
 * @property HmsRoomTypeRate[] $hmsRoomTypeRates
 */
class HmsRoomType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return HmsRoomType the static model class
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
		return 'hms_room_type';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('room_name, adults, childs, room_rate, branch_id', 'required'),
			array('adults, childs, room_rate, branch_id', 'numerical', 'integerOnly'=>true),
			array('room_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('room_type_id, room_name, adults, childs, branch_id', 'safe', 'on'=>'search'),
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
			'hmsRoomMasters' => array(self::HAS_MANY, 'HmsRoomMaster', 'mst_roomtypeid'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
			'hmsRoomTypeRates' => array(self::HAS_MANY, 'HmsRoomTypeRate', 'room_type_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'room_type_id' =>  Yii::t('views', 'Room Type'),
			'room_name' =>  Yii::t('views', 'Room Name'),
			'adults' =>  Yii::t('views', 'Adults'),
			'childs' =>  Yii::t('views', 'Childs'),
			'room_rate' =>  Yii::t('views', 'Room Rate'),
			'branch_id' =>  Yii::t('views', 'Branch'),
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
		$criteria->condition="branch_id = $hotel_branch_id";
		$criteria->compare('room_type_id',$this->room_type_id);
		$criteria->compare('room_name',$this->room_name,true);
		$criteria->compare('adults',$this->adults);
		$criteria->compare('childs',$this->childs);
		$criteria->compare('room_rate',$this->room_rate);
		$criteria->compare('branch_id',$this->branch_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}