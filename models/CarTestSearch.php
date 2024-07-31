<?php

namespace app\modules\experience\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CarTestSearch represents the model behind the search form about `app\modules\experience\models\CarTest`.
 */
class CarTestSearch extends CarTest
{
    public $brandName; // Для фильтрации по названию бренда
    public $modelName; // Для фильтрации по названию модели
    public $engineTypeFilter;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'car_brand_id', 'car_model_id', 'year', 'engine_type', 'gearbox', 'mileage', 'owner_age', 'hidden'], 'integer'],
            [['name', 'generation', 'modification', 'engine_model', 'mode', 'region', 'features', 'owner_name', 'owner_city', 'owner_review'], 'safe'],
            [['brandName', 'modelName', 'engineTypeFilter'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CarTest::find();
        $query->joinWith(['carBrand', 'carModel']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            CarTest::tableName() . '.[[id]]' => $this->id,
            'car_brand_id' => $this->car_brand_id,
            'car_model_id' => $this->car_model_id,
            'year' => $this->year,
            'engine_type' => $this->engine_type,
            'gearbox' => $this->gearbox,
            'mileage' => $this->mileage,
            'owner_age' => $this->owner_age,
            'hidden' => $this->hidden,
        ]);

        $query->andFilterWhere(['like', CarTest::tableName() .'.[[name]]', $this->name])
            ->andFilterWhere(['like', 'generation', $this->generation])
            ->andFilterWhere(['like', 'modification', $this->modification])
            ->andFilterWhere(['like', 'engine_model', $this->engine_model])
            ->andFilterWhere(['like', 'mode', $this->mode])
            ->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'features', $this->features])
            ->andFilterWhere(['like', 'owner_name', $this->owner_name])
            ->andFilterWhere(['like', 'owner_city', $this->owner_city])
            ->andFilterWhere(['like', 'owner_review', $this->owner_review]);

        if (!empty($this->brandName)) {
            $query->andFilterWhere(['like', CarBrand::tableName() . '.[[name]]', $this->brandName]);
        }

        if (!empty($this->modelName)) {
            $query->andFilterWhere(['like', CarModel::tableName() . '.[[name]]', $this->modelName]);
        }

        $query->andFilterWhere([
            'engine_type' => $this->engineTypeFilter,
        ]);


        return $dataProvider;
    }
}
