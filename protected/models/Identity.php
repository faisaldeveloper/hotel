<?php
/**
 * This is the model class for table "hms_identity".
 *
 * The followings are the available columns in table 'hms_identity':
 * @property integer $identity_id
 * @property string $identity_description
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property HmsGuestDoc[] $hmsGuestDocs
 * @property HmsBranches $branch
 * @property HmsReservationInfo[] $hmsReservationInfos
 */
class Identity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Identity the static model class
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
		return 'hms_identity';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identity_description, branch_id', 'required'),
			array('branch_id', 'numerical', 'integerOnly'=>true),
			array('identity_description', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('identity_id, identity_description, branch_id', 'safe', 'on'=>'search'),
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
			'hmsGuestDocs' => array(self::HAS_MANY, 'HmsGuestDoc', 'identity_id'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
			'hmsReservationInfos' => array(self::HAS_MANY, 'HmsReservationInfo', 'client_identity_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'identity_id' =>  Yii::t('views', 'Identity'),
			'identity_description' =>  Yii::t('views', 'Identity Description'),
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
		
		//$hotel_branch_id = yii::app()->user->branch_id;
		//$criteria->condition="branch_id = $hotel_branch_id";
		//$criteria->compare('identity_id',$this->identity_id);
		$criteria->compare('identity_description',$this->identity_description,true);
		//$criteria->compare('branch_id',$this->branch_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}