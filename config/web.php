<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'news',
    'basePath' => dirname(__DIR__),
    'name' => 'News',
	'sourceLanguage' => 'en-US',
	'language' => 'ru-RU',
    'bootstrap' => [
    	\app\bootstrap\SetUp::class,
    	'log',
    	'lead',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
	'modules' => [
		'lead' => \app\modules\lead\Module::class,
	],
    'components' => [
        'request' => [
	        'parsers' => [
		        'application/json' => \yii\web\JsonParser::class,
	        ],
        ],
	    'response' => [
		    'format' => 'json',
		    'formatters' => [
			    'json' => [
				    'class' => \yii\web\JsonResponseFormatter::class,
				    'prettyPrint' => YII_DEBUG,
				    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
			    ],
		    ],
	    ],
        'cache' => \yii\caching\FileCache::class,
        'user' => [
	        'identityClass' => \app\models\User::class,
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\swiftmailer\Mailer::class,
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            	//
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = \yii\debug\Module::class;
}

return $config;
