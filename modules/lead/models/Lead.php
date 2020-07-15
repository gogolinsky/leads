<?php

namespace app\modules\lead\models;

use app\modules\lead\helpers\LeadHelper;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $source_id
 * @property int $created_at
 * @property int $created_by
 * @property string $name
 * @property string $status
 */
class Lead extends ActiveRecord
{
	const STATUS_ACTIVE = 'active';
	const STATUS_DRAFT = 'draft';

    public static function tableName()
    {
        return 'leads';
    }

	public function rules()
	{
		return [
			[['source_id', 'created_at', 'created_by', 'name', 'status'], 'required'],
			[['source_id', 'created_at', 'created_by'], 'integer'],
			[['name', 'status'], 'string', 'max' => 255],
			[['status'], 'in', 'range' => LeadHelper::getStatusKeys()],
		];
	}

	public static function create(int $created_by, string $name, int $source_id, ?string $status)
	{
		$lead = new self();
		$lead->name = $name;
		$lead->created_at = time();
		$lead->source_id = $source_id;
		$lead->created_by = $created_by;
		$lead->status = empty($status) ? self::STATUS_ACTIVE : $status;

		return $lead;
	}

	public function edit(string $name)
	{
		$this->name = $name;
	}
}
