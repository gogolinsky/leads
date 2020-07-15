<?php

namespace app\modules\lead\forms;

use app\modules\lead\models\Lead;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * @property int $created_by
 * @property string $status
 */
class SearchForm extends Model
{
	public $created_by;
	public $status;

	public function rules()
	{
		return [
			[['created_by'], 'integer'],
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

		$query->andFilterWhere(['created_by' => $this->created_by]);
		$query->andFilterWhere(['status' => $this->status]);

		return $dataProvider;
	}
}
