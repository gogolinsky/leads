<?php

namespace app\commands;

use app\modules\lead\forms\CreateForm;
use app\modules\lead\services\LeadService;
use Faker\Factory;
use yii\console\Controller;
use yii\helpers\Console;

class LeadController extends Controller
{
	const TOTAL_COUNT = 100;

	private $service;

	public function __construct($id, $module, LeadService $service, $config = [])
	{
		parent::__construct($id, $module, $config);
		$this->service = $service;
	}

	public function actionPopulate()
	{
		$faker = Factory::create('ru_RU');

		Console::startProgress($progress = 1, $total = self::TOTAL_COUNT);

		for ($i = 1; $i <= self::TOTAL_COUNT; $i++) {
			$form = new CreateForm(100);
			$form->source_id = rand(1, 3);
			$form->name = $faker->firstName . ' ' . $faker->lastName;
			$form->status = $faker->randomElement(['active', 'draft']);
			$lead = $this->service->create($form);
			Console::updateProgress($progress++, $total, 'Lead #' . $lead->id);
		}
	}
}