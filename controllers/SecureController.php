<?php

namespace app\controllers;

use app\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\web\Controller;

class SecureController extends Controller
{
	public $enableCsrfValidation = false;

	public function behaviors()
	{
		$behaviors = parent::behaviors();
		$behaviors['authenticator'] = [
			'class' => HttpBasicAuth::class,
			'auth' => function ($username, $password) {
				$user = User::findByUsername($username);

				if ($user->validatePassword($password)) {
					return $user;
				}

				return null;
			},
		];

		return $behaviors;
	}
}
