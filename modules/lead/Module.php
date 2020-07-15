<?php

namespace app\modules\lead;

use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

class Module extends \yii\base\Module implements BootstrapInterface
{
	public function bootstrap($app)
	{
		$app->get('urlManager')->rules[] = new GroupUrlRule([
			'rules' => [
				'GET /leads' => '/lead/frontend/index',
				'POST /leads' => '/lead/frontend/create',
			],
		]);
	}
}
