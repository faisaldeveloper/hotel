<?php
//header('Location: /hotel/site/login');

if(Yii::app()->user->id>0){
Yii::app()->language = 'en';//Yii::app()->user->language;
}
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	public $myMenu;
	public $auth; //faisal code
	
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public static function encrypt($value, $key = "top secret key"){
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $text = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $value, MCRYPT_MODE_ECB, $iv);
   return trim($text);
	}

	public static function decrypt($value,$key = "top secret key"){
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $text = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $value, MCRYPT_MODE_ECB, $iv);
   return trim($text);
	}
	
	public function init() {
    	//$this->attachBehavior('bootstrap', new BController($this));  
		//$this->loadAuth();  
		
		
	}
	
	/////////faisal code
/* 	protected function loadAuth(){
        $auth=new CPhpAuthManager;

//we are creating a default role sothat every one including anonymous will get the role.
        $auth->defaultRoles=array('backoffice');

//we are creating items in the name of every menu item.
        $auth->createOperation('Dashboard');
        $auth->createOperation('Setup');
        $auth->createOperation('Rooms');       
        $auth->createOperation('login','login','return Yii::app()->user->isGuest;');//declaring a business rule.
        $auth->createOperation('logout');

//creating default role 'global'                
        $backoffice=$auth->createRole('backoffice');
        $backoffice->addChild('Dashboard');
        $backoffice->addChild('Setup');
        $backoffice->addChild('Rooms');

//creating role 'registered' and adding child 'global'          
        $frontdesk=$auth->createRole('frontdesk');
        $frontdesk->addChild('Dashboard');
        $frontdesk->addChild('Setup');
        $frontdesk->addChild('Rooms');

//creating role 'admin' and adding children 'global' and 'registered'           
        $admin=$auth->createRole('auditor');
        $admin->addChild('frontdesk');
        $admin->addChild('backoffice');
        
//assigning roles       
        if(!Yii::app()->user->isGuest)
                $auth->assign(Yii::app()->user->role,Yii::app()->user->id);
        return $this->auth=$auth;
                
}       
 */
	
	///end of faisal code
}