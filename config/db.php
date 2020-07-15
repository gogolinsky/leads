<?php

use Cekurte\Environment\Environment;

return [
	'class' => yii\db\Connection::class,
	'dsn' => 'sqlite:' . __DIR__ . '/../databases/' . Environment::get('DB_NAME'),
	'charset' => 'utf8',

	'enableSchemaCache' => YII_ENV_PROD,
	'schemaCacheDuration' => 60,
	'schemaCache' => 'cache',
];