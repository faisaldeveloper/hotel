<?php
/**
 * This is the model class for table "hms_exchange_rate".
 *
 * The followings are the available columns in table 'hms_exchange_rate':
 * @property integer $excange_rate_id
 * @property integer $country_id
 * @property integer $exchabge_rate
 * @property integer $branch_id
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Country $country
 * @property User $user
 * @property HmsBranches $branch
 */
class ExchangeRate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ExchangeRate the static model class
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
		return 'hms_exchange_rate';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country_id, exchabge_rate,sign, branch_id, user_id', 'required'),
			array('country_id, exchabge_rate, branch_id, user_id', 'numerical', 'integerOnly'=>true),
			array('sign','length','max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('excange_rate_id, country_id, exchabge_rate, branch_id, user_id', 'safe', 'on'=>'search'),
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
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'excange_rate_id' => Yii::t('views', 'Excange Rate'),
			'country_id' => Yii::t('views', 'Country'),
			'sign' => Yii::t('views', 'Sign'),
			'exchabge_rate' => Yii::t('views', 'Exchabge Rate'),
			'branch_id' => Yii::t('views', 'Branch'),
			'user_id' => Yii::t('views', 'User'),
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
		$criteria->compare('excange_rate_id',$this->excange_rate_id);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('exchabge_rate',$this->exchabge_rate,true);
		$criteria->compare('sign',$this->sign,true);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('user_id',$this->user_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}