<?php

namespace app\modules\experience\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CarModelSearch represents the model behind the search form about `app\modules\experience\models\CarModel`.
 */
class CarModelSearch extends CarModel
{
    public $brandName; // Для фильтрации по названию бренда
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'car_brand_id', 'start', 'end'], 'integer'],
            [['name', 'brandName'], 'safe'],
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
        $query = CarModel::find();
        $query->joinWith(['carBrand']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            CarModel::tableName() . '.[[id]]' => $this->id,
            'car_brand_id' => $this->car_brand_id,
            'start' => $this->start,
            'end' => $this->end,
        ]);

        $query->andFilterWhere(['like', CarModel::tableName() . '.[[name]]', $this->name]);

        if (!empty($this->brandName)) {
            $query->andFilterWhere(['like', CarBrand::tableName() . '.[[name]]', $this->brandName]);
        }


        return $dataProvider;
    }
}
