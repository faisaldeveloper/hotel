<?php
/**
 * This is the model class for table "hms_floor".
 *
 * The followings are the available columns in table 'hms_floor':
 * @property integer $floor_id
 * @property string $description
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property HmsBranches $branch
 * @property HmsRoomMaster[] $hmsRoomMasters
 */
class SplitMergeFolio extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return HmsFloor the static model class
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
		return 'split_merge_folio';
	}
}