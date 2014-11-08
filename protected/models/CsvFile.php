<?php
/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class CsvFile extends CFormModel
{
	public $csvdata;	
	public function rules()
	{
		return array(
			// username and password are required
			array('csvdata', 'required'),
			// rememberMe needs to be a boolean			
		);
	}
	
}
