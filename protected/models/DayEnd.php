<?php
/**
 * This is the model class for table "day_end".
 *
 * The followings are the available columns in table 'day_end':
 * @property integer $id
 * @property string $today_date
 * @property string $active_date
 * @property string $night_post
 * @property string $date
 * @property integer $branch_id
 */
class DayEnd extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DayEnd the static model class
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
		return 'day_end';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('today_date, active_date, date, branch_id', 'required'),
			array('branch_id', 'numerical', 'integerOnly'=>true),
			array('night_post', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, today_date, active_date, night_post, date, branch_id', 'safe', 'on'=>'search'),
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
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('views', 'ID'),
			'today_date' => Yii::t('views', 'Today Date'),
			'active_date' => Yii::t('views', 'Active Date'),
			'night_post' => Yii::t('views', 'Night Post'),
			'date' => Yii::t('views', 'Date'),
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
		$criteria->compare('id',$this->id);
		$criteria->compare('today_date',$this->today_date,true);
		$criteria->compare('active_date',$this->active_date,true);
		$criteria->compare('night_post',$this->night_post,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('branch_id',$this->branch_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}