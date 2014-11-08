<?php
/**
 * This is the model class for table "hms_rate_type".
 *
 * The followings are the available columns in table 'hms_rate_type':
 * @property integer $rate_type_id
 * @property string $rate_name
 * @property integer $days
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property HmsBranches $branch
 * @property HmsRoomTypeRate[] $hmsRoomTypeRates
 */
class RateType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RateType the static model class
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
		return 'hms_rate_type';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rate_name, days, branch_id', 'required'),
			array('days, branch_id', 'numerical', 'integerOnly'=>true),
			array('rate_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rate_type_id, rate_name, days, branch_id', 'safe', 'on'=>'search'),
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
			'hmsRoomTypeRates' => array(self::HAS_MANY, 'HmsRoomTypeRate', 'rate_type_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rate_type_id' => Yii::t('views', 'Rate Type'),
			'rate_name' => Yii::t('views', 'Rate Name'),
			'days' => Yii::t('views', 'Days'),
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
		$criteria->compare('rate_type_id',$this->rate_type_id);
		$criteria->compare('rate_name',$this->rate_name,true);
		$criteria->compare('days',$this->days);
		$criteria->compare('branch_id',$this->branch_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}