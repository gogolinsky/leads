<?php

namespace app\modules\lead\helpers;

use app\modules\lead\models\Lead;

class LeadHelper
{
	public static function getStatuses()
	{
		return [
			Lead::STATUS_ACTIVE => 'Активный',
			Lead::STATUS_DRAFT => 'Черновик',
		];
	}

	public static function getStatusKeys()
	{
		return array_keys(self::getStatuses());
	}
}