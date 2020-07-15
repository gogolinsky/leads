<?php

namespace app\modules\lead\controllers;

use app\controllers\SecureController;
use app\modules\lead\forms\CreateForm;
use app\modules\lead\repositories\LeadRepository;
use app\modules\lead\services\LeadService;
use DomainException;
use Yii;
use yii\helpers\Json;
use yii\rest\Serializer;
use yii\web\ServerErrorHttpException;

class FrontendController extends SecureController
{
	private $leads;
	private $service;
	private $serializer;

	public function __construct(
		$id,
		$module,
		LeadRepository $leads,
		LeadService $service,
		Serializer $serializer,
		$config = []
	)
	{
		parent::__construct($id, $module, $config);
		$this->leads = $leads;
		$this->service = $service;
		$this->serializer = $serializer;
	}

	public function actionIndex()
	{
		$provider = $this->leads->getProvider(Yii::$app->request->get());

		return $this->serializer->serialize($provider);
	}

	public function actionCreate()
	{
		$leadForm = new CreateForm(Yii::$app->user->id);

		if ($leadForm->load(Yii::$app->request->getBodyParams(), '') && $leadForm->validate()) {
			try {
				$lead = $this->service->create($leadForm);
				Yii::$app->response->setStatusCode(201);

				return $lead;
			} catch (DomainException $e) {
				Yii::$app->errorHandler->logException($e);
			}
		}

		throw new ServerErrorHttpException('Failed to create the object.');
	}
}
