<?php
/**
 * This is the model class for table "account_name".
 *
 * The followings are the available columns in table 'account_name':
 * @property integer $id
 * @property string $name
 * @property integer $guest_comp_id
 * @property integer $account_type_id
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property AccountLedger[] $accountLedgers
 * @property AccountLedger[] $accountLedgers1
 * @property AccountType $accountType
 */
class AccountName extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AccountName the static model class
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
		return 'account_name';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, guest_comp_id', 'required'),
			array('guest_comp_id, account_type_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, guest_comp_id, account_type_id, created_date', 'safe', 'on'=>'search'),
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
			'accountLedgers' => array(self::HAS_MANY, 'AccountLedger', 'cr'),
			'accountLedgers1' => array(self::HAS_MANY, 'AccountLedger', 'dr'),
			'accountType' => array(self::BELONGS_TO, 'AccountType', 'account_type_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'guest_comp_id' => 'Guest Comp',
			'account_type_id' => 'Account Type',
			'created_date' => 'Created Date',
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
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('guest_comp_id',$this->guest_comp_id);
		$criteria->compare('accountType.name',$this->account_type_id, true);
		$criteria->compare('t.created_date',$this->created_date,true);
		
		$criteria->with = array('accountType'=>array('select'=>'accountType.name'));
		
		return new CActiveDataProvider($this, array('criteria'=>$criteria,));
	}
}