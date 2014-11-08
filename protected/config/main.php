<?php


return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Elodger Hotel Demo',
	//'theme'=>'shadow_dancer - Copy',
	'theme'=>'shadow_dancer - Copy',
	'timeZone'=>"Asia/Karachi",
	//'language'=>'ar',

	// preloading 'log' component
	//'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',		
		
		
		'application.extensions.compositekey.CCompositeUniqueKeyValidator',
		'application.modules.srbac.controllers.SBaseController',
		//'application.extensions.yiiopenflashchart.EOFC2',
		//'ext.cssmenu.CssMenu',
		
		//'ext.bootstrap-theme.widgets.*',
       // 'ext.bootstrap-theme.helpers.*',
       // 'ext.bootstrap-theme.behaviors.*',		
		//'ext.quickdlgs.*',		
		
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'page',
		'hmcontrol',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'backup',
		
		
		
		'srbac' => array(
		'userclass'=>'User', //default: User
		'userid'=>'id', //default: userid
		'username'=>'username', //default:username
		'delimeter'=>'@', //default:-
		'debug'=>false, //default :false
		'pageSize'=>10, // default : 15
		'superUser' =>'Authority', //default: Authorizer
		'css'=>'srbac.css', //default: srbac.css
		//'layout'=>'application.views.layouts.main', //default: application.views.layouts.main,
		//'layout'=>'application.modules.admin.views.layouts.admin', //default: application.views.layouts.main,
		
		'notAuthorizedView'=> 'srbac.views.authitem.unauthorized', // default:
		//srbac.views.authitem.unauthorized, must be an existing alias
		'alwaysAllowed'=>array( //default: array()
		'SiteLogin','SiteLogout','SiteIndex','SiteAdmin',
		'SiteError', 'SiteContact'),
		'userActions'=>array('Show','View','List'), //default: array()
		'listBoxNumberOfLines' => 15, //default : 10 
		 'imagesPath' => 'srbac.images', // default: srbac.images 
		 'imagesPack'=>'noia', //default: noia 
		 'iconText'=>true, // default : false 
		 'header'=>'srbac.views.authitem.header', //default : srbac.views.authitem.header,
		//must be an existing alias 
		'footer'=>'srbac.views.authitem.footer', //default: srbac.views.authitem.footer,
		//must be an existing alias 
		'showHeader'=>true, // default: false 
		'showFooter'=>true, // default: false
		'alwaysAllowedPath'=>'srbac.components', // default: srbac.components
		// must be an existing alias 
		),
		
	),

	// application components
	'components'=>array(
		
		'clientScript' => array(
        'class'=>'ext.NLSClientScript.NLSClientScript', 
        'includePattern'=>'/\/jquery|bootstrap\.min/', //javacsript regexp, if set, only the matched urls will be filtered
        //'excludePattern'=>'/\/raw/'      //javacsript regexp, if set, the matched urls won't be filtered
        ),
  
  	  /* 'bootstrap'=>array(
         'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
       ), */
	  //////////////////
	  	 'widgetFactory'=>array(
		  'class'=>'ext.theme.EWidgetFactory',
		
		  'widgets' => array(
		  'CGridView'=>array(                   
				    'htmlOptions'=>array('cellspacing'=>'0','cellpadding'=>'0'),
					'itemsCssClass'=>'mcetable',
					'pagerCssClass'=>'pager-class',					
					//'cssFile' => Yii::app()->request->baseUrl.'/css/gridview/styles.css',
					'cssFile' => '/hotel/css/bootstrap/css/gridview_css.css',
                ),
			'CListView'=>array(
                    'htmlOptions'=>array('cellspacing'=>'0','cellpadding'=>'0'),
					'itemsCssClass'=>'item-class',
					'pagerCssClass'=>'pager-class'
                ),
			'CDetailView'=>array(
					'cssFile'=>'tables.css',
                    'htmlOptions'=>array('cellspacing'=>'0','cellpadding'=>'0','class'=>'detail-view'),			
                ),			 	
			'CJuiWidget' => array(
			  'themeUrl'=>'/hotel/css/themes', // example
			  'theme'=>'hmslayout', // base cupertino dark-hive start ui-lightness black-tie excite-bike
			  
			), 
		  ),
		), 
		///////////////////
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl' => array('/site/login'), 
		),
		
		
		//'cssmenu'=>array(
		//),	
		
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				
				
			),
		),
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		//odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=C:\accounts.mdb;Uid=Admin
		'db'=>array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=hotel',
			//'connectionString' => 'odbc:hms_db',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'enableProfiling' => true,
            'enableParamLogging' => true,
		),
		
		
		'authManager'=>array(
		// Path to SDbAuthManager in srbac module if you want to use case insensitive
		//access checking (or CDbAuthManager for case sensitive access checking)
		'class'=>'application.modules.srbac.components.SDbAuthManager',
		// The database component used
		'connectionID'=>'db',
		// The itemTable name (default:authitem)
		'itemTable'=>'items',
		// The assignmentTable name (default:authassignment)
		'assignmentTable'=>'assignments',
		// The itemChildTable name (default:authitemchild)
		'itemChildTable'=>'itemchildren',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		/* 'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',					
				),
				
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'info',
					'categories'=>'application.controllers.UserController',
					'logFile'=>'user.log',					
				),
				
				//uncoment if want profiler
				
				//array(
                //    'class' => 'application.extensions.pqp.PQPLogRoute',
                //    'categories' => 'application.*, exception.*',
                //),
				
				// uncomment the following to show log messages on web pages
				
				//array(
				//	'class'=>'CWebLogRoute',
				//),
				
			),
		), //log */
	),
	
	'behaviors' => array(
    	'onBeginRequest' => array('class' => 'application.components.RequireLogin')
	),
	
	
	
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'faisal.shahzad786@gmail.com',
		
	),
);