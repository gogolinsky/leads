<?php

namespace app\modules\lead\forms;

use app\modules\lead\models\Lead;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * @property int $source_id
 * @property string $status
 */
class SearchForm extends Model
{
	public $source_id;
	public $status;

	public function rules()
	{
		return [
			[['source_id'], 'integer'],
			[['status'], 'string', 'max' => 255],
		];
	}

	public function formName()
	{
		return '';
	}

	public function search($params): ActiveDataProvider
	{
		$query = Lead::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => ['defaultPageSize' => 2],
		]);

		$this->load($params);

		if (!$this->validate()) {
			return $dataProvider;
		}

		$query->andFilterWhere(['source_id' => $this->source_id]);
		$query->andFilterWhere(['status' => $this->status]);

		return $dataProvider;
	}
}
