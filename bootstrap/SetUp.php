<?php

namespace app\bootstrap;

use Yii;
use yii\base\BootstrapInterface;
use yii\rest\Serializer;

class SetUp implements BootstrapInterface
{
	public function bootstrap($app)
	{
		$container = Yii::$container;

		$container->setSingleton(Serializer::class, function () {
			return new Serializer(['collectionEnvelope' => 'items']);
		});
	}
}