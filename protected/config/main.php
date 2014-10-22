<?php
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Dcms - Design Club',
    'theme'=>'dcms-main',
    'language' => 'ru',
	'preload'=>array('log'),

	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.extensions.bootstrap.widgets.*',
        'application.modules.admin.models.ItemType',
        'application.modules.comments.models.*',
	),

    'modules'=>array(
        'admin',
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'gii',
            'ipFilters' => array('*', '::1'),
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
        ),
    ),

	'components'=>array(
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
		'user'=>array(
			'allowAutoLogin'=>true,
            'loginUrl'=>'/autch/login'
            
		),
  		'swiftMailer' => array(
            'class' => 'ext.swiftMailer.SwiftMailer',
        ),
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
        'phpThumb'=>array(
			'class'=>'ext.EPhpThumb.EPhpThumb',
			'options'=>array()
		),

	   'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName' => false,
			'rules'=>array(
                '/'=>'site/index',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=dcms',
			'emulatePrepare' => true,
			'username' => 'dcms',
			'password' => 'dcmsadmin',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),

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
	'params'=>array(
		'email'=>'webmaster@mail.ru',
        'adminEmail'=>'webmaster@mail.ru',
	),
);
