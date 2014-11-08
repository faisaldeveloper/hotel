<?php
/**
 * This is the model class for table "hms_reservation_status".
 *
 * The followings are the available columns in table 'hms_reservation_status':
 * @property integer $res_id
 * @property string $res_description
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property HmsReservationInfo[] $hmsReservationInfos
 * @property HmsBranches $branch
 */
class ReservationStatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReservationStatus the static model class
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
		return 'hms_reservation_status';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('res_description, branch_id', 'required'),
			array('branch_id', 'numerical', 'integerOnly'=>true),
			array('res_description', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('res_id, res_description, branch_id', 'safe', 'on'=>'search'),
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
			'hmsReservationInfos' => array(self::HAS_MANY, 'HmsReservationInfo', 'reservation_status'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'res_id' => Yii::t('views', 'Res'),
			'res_description' => Yii::t('views', 'Res Description'),
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
		$criteria->compare('res_id',$this->res_id);
		$criteria->compare('res_description',$this->res_description,true);
		$criteria->compare('branch_id',$this->branch_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}