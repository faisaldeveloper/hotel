<?php

class RequireLogin extends CBehavior
{
	
	public function attach($owner){
    	$owner->attachEventHandler('onBeginRequest', array($this, 'handleBeginRequest'));
	}
	
	public function handleBeginRequest($event){
		
		//if (Yii::app()->user->isGuest){ // && (!isset($_GET['r']) || $_GET['r'] != 'site/login')) {
		//if (Yii::app()->user->isGuest && !in_array($_SERVER['REQUEST_URI'],array('/site/login'))) {	
		//if (Yii::app()->user->isGuest && !in_array($_SERVER['PATH_INFO'], Yii::app()->user->loginUrl )) {
		if(strstr($_SERVER['REQUEST_URI'], "/hmcontrol")){}
		else{	
		if (Yii::app()->user->isGuest && !strstr($_SERVER['REQUEST_URI'], "/site/login")) {				
				Yii::app()->user->loginRequired(); 			
		}	
		}
	}
}

?>