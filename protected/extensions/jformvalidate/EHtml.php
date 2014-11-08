<?php
class EHtml extends CHtml {
	
	protected static $CS=null;
	public static function getJValidateInstance(){
		if( self::$CS == null)
			self::$CS = Yii::app()->jformvalidate;
		return self::$CS;
	}
	/**
	 * @deprecated 
	 */
	public static function form($action='',$method='post',$htmlOptions=array())
	{
		return self::beginForm($action,$method,$htmlOptions);		
	}	
	public static function beginForm($action='',$method='post',$htmlOptions=array()){
		list($action,$method,$htmlOptions) = self::getJValidateInstance()->beginForm($action,$method,$htmlOptions);
		return parent::beginForm($action,$method,$htmlOptions);
	}	

	public static function endForm(){
		self::getJValidateInstance()->endForm();
		return parent::endForm();
	}	
	public static function activeTextField($model,$attribute,$htmlOptions=array()){
		
		self::getJValidateInstance()->activeTextField($model,$attribute,$htmlOptions);
		return parent::activeTextField($model,$attribute,$htmlOptions);
	}
	
	public static function activePasswordField($model,$attribute,$htmlOptions=array()){		
		self::getJValidateInstance()->activePasswordField($model,$attribute,$htmlOptions);
		return parent::activePasswordField($model,$attribute,$htmlOptions);
	}
	public  static function activeCheckBox($model,$attribute,$htmlOptions=array()){
		
		self::getJValidateInstance()->activeCheckBox($model,$attribute,$htmlOptions);
		return parent::activeCheckBox($model,$attribute,$htmlOptions);
	}
	public static function activeCheckBoxList($model, $attribute, $data, $htmlOptions=array()){
		
		self::getJValidateInstance()->activeCheckBoxList($model, $attribute, $data, $htmlOptions);
		return parent::activeCheckBoxList($model, $attribute, $data, $htmlOptions);			
	}
	public static function activeRadioButtonList($model, $attribute, $data, $htmlOptions=array()){
		
		self::getJValidateInstance()->activeRadioButtonList($model, $attribute, $data, $htmlOptions);
		return parent::activeRadioButtonList($model, $attribute, $data, $htmlOptions);
	}
	public static function activeDropDownList($model, $attribute, $data, $htmlOptions=array()){
		
		self::getJValidateInstance()->activeDropDownList($model, $attribute, $data, $htmlOptions);
		return parent::activeDropDownList($model, $attribute, $data, $htmlOptions);
	}
	public static function activeListBox($model, $attribute, $data, $htmlOptions=array()){
		
		self::getJValidateInstance()->activeListBox($model, $attribute, $data, $htmlOptions);
		return parent::activeListBox($model, $attribute, $data, $htmlOptions);
	}
	public static function activeTextArea($model, $attribute, $htmlOptions=array ( )){
		
		self::getJValidateInstance()->activeTextArea($model, $attribute, $htmlOptions);
		return parent::activeTextArea($model, $attribute, $htmlOptions);	
	}
	public static function ajaxSubmitButton($label,$url,$ajaxOptions=array(),$htmlOptions=array()){
		
		if( self::getJValidateInstance()->isEnabled()){
			list($label,$htmlOptions) = self::getJValidateInstance()->ajaxSubmitButton($label,$url,$ajaxOptions,$htmlOptions);
			return parent::button($label,$htmlOptions);
		}else {
			return parent::ajaxSubmitButton($label,$url,$ajaxOptions,$htmlOptions);
		}		
	}
	
	public static function setScenario($scenario)
	{
		self::getJValidateInstance()->setScenario($scenario);		
	}
	public static function setOptions($opt){
		self::getJValidateInstance()->setOptions($opt);
	}	
}
?>
