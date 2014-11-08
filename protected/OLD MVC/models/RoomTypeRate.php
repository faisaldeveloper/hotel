<?php
/**
 * This is the model class for table "hms_room_type_rate".
 *
 * The followings are the available columns in table 'hms_room_type_rate':
 * @property integer $room_type_rate_id
 * @property integer $room_type_id
 * @property integer $rate_type_id
 * @property integer $room_rate
 * @property integer $company_id
 * @property string $room_rate_status
 * @property string $room_comments
 * @property integer $comp_allow_gst
 * @property integer $branch_id
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property HmsRateType $rateType
 * @property HmsRoomType $roomType
 * @property HmsCompanyInfo $company
 * @property HmsBranches $branch
 * @property User $user
 */
class RoomTypeRate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RoomTypeRate the static model class
	 */
	public $label;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hms_room_type_rate';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('room_type_id, rate_type_id, room_rate, room_rate_status, room_comments, comp_allow_gst, branch_id, user_id', 'required'),
			array('room_rate','required'),
			array('room_type_id, rate_type_id, room_rate, company_id, comp_allow_gst, branch_id, user_id', 'numerical', 'integerOnly'=>true),
			array('room_rate_status', 'length', 'max'=>30),
			array('room_comments', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('room_type_rate_id, room_type_id, rate_type_id, room_rate, company_id, room_rate_status, room_comments, comp_allow_gst, branch_id, user_id, comp_id', 'safe', 'on'=>'search'),
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
			'rateType' => array(self::BELONGS_TO, 'RateType', 'rate_type_id'),
			'roomType' => array(self::BELONGS_TO, 'HmsRoomType', 'room_type_id'),
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'branch' => array(self::BELONGS_TO, 'HmsBranches', 'branch_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'room_type_rate_id' => Yii::t('views', 'Room Type Rate'),
			'room_type_id' => Yii::t('views', 'Room Type'),
			'rate_type_id' => Yii::t('views', 'Rate Type'),
			'room_rate' => Yii::t('views', 'Room Rate'),
			'company_id' => Yii::t('views', 'Company'),
			'room_rate_status' => Yii::t('views', 'Room Rate Status'),
			'room_comments' => Yii::t('views', 'Room Comments'),
			'comp_allow_gst' => Yii::t('views', 'Comp Allow Gst'),
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
		$criteria=new CDbCriteria();		
		$hotel_branch_id = yii::app()->user->branch_id;
		$criteria->condition="branch_id = $hotel_branch_id";		
		$criteria->compare('room_type_rate_id',$this->room_type_rate_id);
		$criteria->compare('room_type_id',$this->room_type_id);		
		$criteria->compare('rateType.rate_name',$this->rate_type_id,TRUE);		
		$criteria->compare('room_rate',$this->room_rate);		
		//$criteria->compare('company_id',$this->company_id);
		$criteria->compare('company.comp_name',$this->company_id, true);		
		$criteria->compare('room_rate_status',$this->room_rate_status,true);
		$criteria->compare('room_comments',$this->room_comments,true);
		$criteria->compare('comp_allow_gst',$this->comp_allow_gst);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('user_id',$this->user_id);
		//$criteria->with=array('company','rateType');		
		return new CActiveDataProvider($this, array('criteria'=>$criteria,));
	}
	
	public function admin(){
		
		$criteria=new CDbCriteria();		
		$hotel_branch_id = yii::app()->user->branch_id;
		$criteria->condition="branch_id = $hotel_branch_id";
		
				
		$criteria->compare('room_type_rate_id',$this->room_type_rate_id);
		$criteria->compare('room_type_id',$this->room_type_id);		
		$criteria->compare('rateType.rate_name',$this->rate_type_id,TRUE);		
		$criteria->compare('room_rate',$this->room_rate);		
		//$criteria->compare('company_id',$this->company_id);
		$criteria->compare('company.comp_name',$this->company_id, true);		
		$criteria->compare('room_rate_status',$this->room_rate_status,true);
		$criteria->compare('room_comments',$this->room_comments,true);
		$criteria->compare('comp_allow_gst',$this->comp_allow_gst);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('user_id',$this->user_id);
		//$criteria->with=array('company','rateType');		
		return new CActiveDataProvider($this,  array(
    	'criteria'=>array(
			'condition'=>'branch_id >='. $hotel_branch_id,
			//'order'=>'create_time DESC',
			//'with'=>array('author'),
			 'group'=>'company_id',
    	),
    'pagination'=>array(
        'pageSize'=>10,
    ),
	));
}
/////////////////////////////////	
	function search2(){
	
	return new CActiveDataProvider('Company', array(
    'criteria'=>array(
        //'condition'=>'id >= 1',
        //'order'=>'create_time DESC',
        //'with'=>array('author'),
    ),
    'pagination'=>array(
        'pageSize'=>1,
    ),
	));
	
	}
}