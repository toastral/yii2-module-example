<?php

namespace app\modules\experience\models;

use app\modules\product\models\Product;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CarTrialSearch represents the model behind the search form about `app\modules\experience\models\CarTrial`.
 */
class CarTrialSearch extends CarTrial
{
    public $carTestName;
    public $productName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['componentName', 'productName', 'carTestName' ], 'string'],
            [['id', 'component'], 'integer'],
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
        $query = CarTrial::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'component' => $this->component,
        ]);

        if (!empty($this->componentName)) {
            $query->andFilterWhere(['like', '[[componentName]]', $this->componentName]);
        }

        if (!empty($this->carTestName)) {
            $query->joinWith('carTestRelation');
            $query->andFilterWhere(['like', CarTest::tableName() . '.[[name]]', $this->carTestName]);
        }

        if (!empty($this->productName)) {
            $query->joinWith('productRelation');
            $query->andFilterWhere(['like', Product::tableName() . '.[[title]]', $this->productName]);
        }

        return $dataProvider;
    }
}
