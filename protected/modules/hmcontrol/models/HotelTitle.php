<?php

/**
 * This is the model class for table "hotel_title".
 *
 * The followings are the available columns in table 'hotel_title':
 * @property integer $id
 * @property string $title
 * @property string $application_title
 * @property string $website
 * @property string $logo_image
 * @property string $bg_image
 *
 * The followings are the available model relations:
 * @property HmsBranches[] $hmsBranches
 * @property User[] $users
 */
class HotelTitle extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return HotelTitle the static model class
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
		return 'hotel_title';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, application_title, website', 'required'),
			array('title, application_title, website, bg_image', 'length', 'max'=>50),
			array('logo_image', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('title, application_title', 'safe', 'on'=>'search'),
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
			'hmsBranches' => array(self::HAS_MANY, 'HmsBranches', 'hotel_id'),
			'users' => array(self::HAS_MANY, 'User', 'hotel_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'application_title' => 'Application Title',
			'website' => 'Website',
			'logo_image' => 'Logo Image',
			'bg_image' => 'Bg Image',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('application_title',$this->application_title,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('logo_image',$this->logo_image,true);
		$criteria->compare('bg_image',$this->bg_image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}