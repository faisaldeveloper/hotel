<?php
/**
 * This is the model class for table "hms_guest_status".
 *
 * The followings are the available columns in table 'hms_guest_status':
 * @property integer $guest_status_id
 * @property string $status_description
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property HmsCheckinInfo[] $hmsCheckinInfos
 * @property HmsBranches $branch
 */
class GuestStatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GuestStatus the static model class
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
		return 'hms_guest_status';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status_description, branch_id', 'required'),
			array('branch_id', 'numerical', 'integerOnly'=>true),
			array('status_description', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('guest_status_id, status_description, branch_id', 'safe', 'on'=>'search'),
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
			'hmsCheckinInfos' => array(self::HAS_MANY, 'HmsCheckinInfo', 'guest_status_id'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'guest_status_id' =>  Yii::t('views', 'Guest Status'),
			'status_description' =>  Yii::t('views', 'Status Description'),
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
		//$criteria->compare('guest_status_id',$this->guest_status_id);
		$criteria->compare('status_description',$this->status_description,true);
		//$criteria->compare('branch_id',$this->branch_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}