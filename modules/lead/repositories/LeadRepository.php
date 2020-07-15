<?php

namespace app\modules\lead\repositories;

use app\modules\lead\models\Lead;
use app\modules\lead\forms\SearchForm;
use DomainException;
use yii\data\ActiveDataProvider;

class LeadRepository
{
	public function get($id): Lead
	{
		$lead = Lead::findOne($id);

		if (empty($lead)) {
			throw new DomainException("Lead $id does not exists");
		}

		return $lead;
	}

	public function save(Lead $lead)
	{
		if (!$lead->save()) {
			throw new DomainException('Saving error: ' . json_encode($lead->errors));
		}
	}

	public function getProvider($params): ActiveDataProvider
	{
		$searchModel = new SearchForm();
		$provider = $searchModel->search($params);

		return  $provider;
	}
}