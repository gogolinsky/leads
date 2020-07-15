<?php

namespace app\modules\lead\forms;

use app\modules\lead\helpers\LeadHelper;
use yii\base\Model;

/**
 * @property string $status
 * @property string $name
 * @property int $source_id
 */
class CreateForm extends Model
{
	private $created_by;

	public $status;
	public $name;
	public $source_id;

	public function __construct(int $owner, $config = [])
	{
		parent::__construct($config);
		$this->created_by = $owner;
	}

	public function rules()
	{
		return [
			[['name', 'created_by', 'source_id'], 'required'],
			[['name', 'status'], 'string', 'max' => 255],
			[['status'], 'in', 'range' => LeadHelper::getStatusKeys()],
			[['created_by', 'source_id'], 'integer'],
		];
	}

	public function getCreatedBy()
	{
		return $this->created_by;
	}
}