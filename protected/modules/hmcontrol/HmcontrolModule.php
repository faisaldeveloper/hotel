<?php

class HmcontrolModule extends CWebModule{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'hmcontrol.models.*',
			'hmcontrol.components.*',
		));
		//$this->layout = 'admin/main';
		
		$this->layoutPath = Yii::getPathOfAlias('hmcontrol.views.layouts');
		$this->layout = 'admin'; //hmcontrol/views/layouts
		
		//$this->setbasePath('application.modules.hmcontrol');
		

	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
