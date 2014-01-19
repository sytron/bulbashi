<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
if( strpos($_SERVER['SERVER_NAME'], 'sglubokov') === false ) {
	$dbconf = array(
			'connectionString' => 'mysql:host=sklad;dbname=sklad',
			'emulatePrepare' => true,
			'username' => 'mysql',
			'password' => 'mysql',
			'charset' => 'utf8',
		);
} else {
	$dbconf = array(
			'connectionString' => 'mysql:host=baze.zenon.net;dbname=vh44706;port=64000',
			'emulatePrepare' => true,
			'username' => 'vh44706',
			'password' => 'aH6Xi9W8',
			'charset' => 'utf8',
		);
}

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Склад Масло+',
    'theme'=>'bootstrap',

	// preloading 'log' component
	'preload'=>array(
        'log',
        'bootstrap',
    ),

    'sourceLanguage' => 'en',
    'language' => 'ru',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'12',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths' => array(
              'bootstrap.gii'
            ),
		),

	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap',
            'responsiveCss' => true,
            'fontAwesomeCss' => true,
        ),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		), */

		'db'=>$dbconf,

        'cache'=>array(
            //'class'=>'system.caching.CFileCache',
            'class'=>'system.caching.CDummyCache',
        ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);