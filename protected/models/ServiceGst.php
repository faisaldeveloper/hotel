<?php
/**
 * This is the model class for table "hms_service_gst".
 *
 * The followings are the available columns in table 'hms_service_gst':
 * @property integer $gst_id
 * @property integer $gst_service_id
 * @property integer $gst_percent
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property HmsServices $gstService
 * @property HmsBranches $branch
 */
class ServiceGst extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ServiceGst the static model class
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
		return 'hms_service_gst';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gst_service_id, gst_percent, branch_id', 'required'),
			array('gst_service_id, gst_percent, branch_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gst_id, gst_service_id, gst_percent, branch_id', 'safe', 'on'=>'search'),
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
			'gstService' => array(self::BELONGS_TO, 'Services', 'gst_service_id'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'gst_id' => Yii::t('views', 'Gst'),
			'gst_service_id' => Yii::t('views', 'Gst Service'),
			'gst_percent' => Yii::t('views', 'Gst Percent'),
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
		$criteria->compare('gst_id',$this->gst_id);
		$criteria->compare('gst_service_id',$this->gst_service_id);
		$criteria->compare('gst_percent',$this->gst_percent);
		$criteria->compare('branch_id',$this->branch_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}