<?php

namespace app\modules\lead\services;

use app\modules\lead\forms\CreateForm;
use app\modules\lead\models\Lead;
use app\modules\lead\repositories\LeadRepository;

class LeadService
{
	private $leads;

	public function __construct(LeadRepository $leads)
	{
		$this->leads = $leads;
	}

	public function create(CreateForm $form): Lead
	{
		$lead = Lead::create($form->getCreatedBy(), $form->name, $form->source_id, $form->status);
		$this->leads->save($lead);

		return $lead;
	}
}