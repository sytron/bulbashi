<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.

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
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),

	// application components
	'components'=>array(

        'db'=>$dbconf,

        // uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);