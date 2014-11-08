<?php
/**
 * This is the model class for table "report_text".
 *
 * The followings are the available columns in table 'report_text':
 * @property integer $id
 * @property integer $report_id
 * @property string $description
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property HmsBranches $branch
 * @property ReportTable $report
 */
class ReportText extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReportText the static model class
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
		return 'report_text';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('report_id, description, branch_id', 'required'),
			array('report_id, branch_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, report_id, description, branch_id', 'safe', 'on'=>'search'),
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
			'report' => array(self::BELONGS_TO, 'ReportTable', 'report_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'report_id' => 'Report',
			'description' => 'Description',
			'branch_id' => 'Branch',
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
		$criteria->compare('report_id',$this->report_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('branch_id',$this->branch_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}