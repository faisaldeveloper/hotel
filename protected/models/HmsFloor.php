<?php
/**
 * This is the model class for table "hms_floor".
 *
 * The followings are the available columns in table 'hms_floor':
 * @property integer $floor_id
 * @property string $description
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property HmsBranches $branch
 * @property HmsRoomMaster[] $hmsRoomMasters
 */
class HmsFloor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return HmsFloor the static model class
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
		return 'hms_floor';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, branch_id', 'required'),
			array('branch_id', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('floor_id, description, branch_id', 'safe', 'on'=>'search'),
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
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
			'hmsRoomMasters' => array(self::HAS_MANY, 'HmsRoomMaster', 'mst_floor_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'floor_id' =>  Yii::t('views', 'Floor'),
			'description' =>  Yii::t('views', 'Description'),
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
		$criteria->compare('floor_id',$this->floor_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('branch_id',$this->branch_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}