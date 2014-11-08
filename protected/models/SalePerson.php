<?php
/**
 * This is the model class for table "hms_sale_person".
 *
 * The followings are the available columns in table 'hms_sale_person':
 * @property integer $sale_person_id
 * @property string $sale_person_name
 * @property integer $sale_person_comm
 * @property string $is_active
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property HmsCheckinInfo[] $hmsCheckinInfos
 * @property HmsReservationInfo[] $hmsReservationInfos
 * @property HmsBranches $branch
 */
class SalePerson extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SalePerson the static model class
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
		return 'hms_sale_person';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sale_person_name, sale_person_comm, is_active, branch_id', 'required'),
			array('sale_person_comm, branch_id', 'numerical', 'integerOnly'=>true),
			array('sale_person_name', 'length', 'max'=>30),
			array('is_active', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sale_person_id, sale_person_name, sale_person_comm, is_active, branch_id', 'safe', 'on'=>'search'),
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
			'hmsCheckinInfos' => array(self::HAS_MANY, 'HmsCheckinInfo', 'sale_person_id'),
			'hmsReservationInfos' => array(self::HAS_MANY, 'HmsReservationInfo', 'sale_person_id'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sale_person_id' => Yii::t('views', 'Sale Person'),
			'sale_person_name' => Yii::t('views', 'Sale Person Name'),
			'sale_person_comm' => Yii::t('views', 'Sale Person Comm'),
			'is_active' => Yii::t('views', 'Is Active'),
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
		$criteria->condition="branch_id = $hotel_branch_id";
		$criteria->compare('sale_person_id',$this->sale_person_id);
		$criteria->compare('sale_person_name',$this->sale_person_name,true);
		$criteria->compare('sale_person_comm',$this->sale_person_comm);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('branch_id',$this->branch_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}