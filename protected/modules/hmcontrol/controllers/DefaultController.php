<?php

class DefaultController extends CController
{
	//public $layout='//default/layouts/main';
	//public $layout='//admin/layouts/main';
	
	public function actionIndex()
	{		
		if(yii::app()->user->isGuest)$this->redirect('site/login');
		else
			$this->render('index');
	}
}