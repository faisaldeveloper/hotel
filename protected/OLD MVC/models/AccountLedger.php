<?php
class AccountLedger extends CActiveRecord
{
	
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	public function tableName(){
		return 'account_ledger';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dr, cr, amount', 'required'),
			array('dr, cr, amount', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, dr, cr, amount, created_date, updated_date', 'safe', 'on'=>'search'),
			array('chkin_id', 'safe', 'on'=>'register')
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
			'cr0' => array(self::BELONGS_TO, 'AccountName', 'cr'),
			'dr0' => array(self::BELONGS_TO, 'AccountName', 'dr'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'dr' => 'Dr',
			'cr' => 'Cr',
			'amount' => 'Amount',
			'chkin_id' => 'Folio No',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
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
		$criteria->compare('dr0.name',$this->dr, true);
		$criteria->compare('cr0.name',$this->cr, true);
		$criteria->compare('amount',$this->amount);		
		$criteria->compare('t.created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);		
		$criteria->with = array('cr0'=>array('select'=>'cr0.name'), 'dr0'=>array('select'=>'dr0.name'));	
		return new CActiveDataProvider($this, array('criteria'=>$criteria,));
	}
	///////////////////////
	 public function beforeSave(){	
	 	$branch_id = yii::app()->user->branch_id;	 
			$ad = DayEnd::model()->find("branch_id= $branch_id");
		if($this->isNewRecord)
			$this->created_date = $ad->active_date;			
		else 	$this->updated_date = $ad->active_date." 00:00:00";	
			
		return parent::beforeSave();
	} 
	///////////////////////////////////
}