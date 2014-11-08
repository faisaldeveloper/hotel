<?php
/**
* Yii JsStyledAlertWidget
* Widget replaces javascript alert() function to its own, that you can stylize by html & css
* 
* 
* ===Installation===
* just put JsStyledAlertWidget directory to yor extensions dir (/protected/extensions).
* If you wont to use themes, just place JsStyledAlertWidget/views to themes/<your_theme>/views/JsStyledAlertWidget
* 
* ===Usage===
* Just place:
* <?$this->widget('ext.JsStyledAlert.JsStyledAlertWidget');?>
* to your layout file somewhere inside "BODY" tag.
* 
* ===Stylizing===  
* Edit files in protected/extensions/JsStyledAlertWidget/views/ (or in themes/<your_theme>/views/JsStyledAlertWidget if you use themes):
* html: JsStyledAlertWidget.php
* css: assets/StyledAlert.css
* js: assets/StyledAlert.js
* If you wont to use images, put them to assets directory & include in html using $assetPath in SRC attribute: <IMG SRC='<?=$assetPath>/img/image1.jpg'>
* To define backgroud-image in css, use relative paths.
* 
* Preserve element id's when you edit html, else you will need to correct js
* 
* 
* 
* @author Vitaliy Stepanenko <mail@vitaliy.in>
* @version 1.0
* 08.11.2010
*/
class JsStyledAlertWidget extends CWidget {
    
    protected function publishAssets()
    {
       return Yii::app()->assetManager->publish(
            $this->getViewPath() . DIRECTORY_SEPARATOR . 'assets',
            false,
            -1,
            YII_DEBUG
       );             
    }
    
    /**
    * Render widget html, publish assets & include scripts/css
    * 
    */
    public function run() {                                     
        $cs=Yii::app()->clientScript;   
        $cs->registerCoreScript('jquery');  
        
        $assetPath=$this->publishAssets();
        
        $cs->registerCssFile($assetPath.'/StyledAlert.css');         
        $cs->registerScriptFile($assetPath.'/StyledAlert.js',CClientScript::POS_HEAD);   
        $this->render('JsStyledAlertWidget',array('assetPath'=>$assetPath));   
    }
}