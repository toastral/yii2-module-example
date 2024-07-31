<?php

namespace app\modules\experience\models;

use app\modules\product\models\Product;
use app\modules\product\models\ProductSpecification;
use app\modules\product\models\ProductSpecificationLink;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CarTrialProductSearch
 */
class CarTrialProductSearch extends CarTrial
{
    public $modelId;
    public $brandId;
    public $productId;
    public $specificationId;
    public $typeSearch;
    public $carTestId;
    public $rawSql;
    protected $dataProvider;
    protected $pageSize;

    const typeSearchProduct = 1;
    const typeSearchBrand = 2;
    const typeSearchCarTest = 3;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modelId', 'brandId', 'productId', 'carTestId', 'specificationId', 'typeSearch'], 'integer'],
            [['modelId', 'brandId', 'productId', 'specificationId', 'carTestId'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CarTrial::find();

        $query->select(new \yii\db\Expression("CONCAT(" . CarTrial::tableName() .  ".[[productId]], '-', " . CarTrial::tableName() . ".[[component]]) AS productComponentKey"))
            ->groupBy('productComponentKey')
            ->where([CarTrial::tableName() . '.[[hidden]]' => 0])
            ->joinWith('activeProductRelation');

        $pageSize = CarTrial::PAGE_LIMIT_DEFAULT;
        if ($this->typeSearch == self::typeSearchCarTest) {
            $pageSize = CarTrial::PAGE_LIMIT_CART;
            $query->orderBy(new \yii\db\Expression('RAND()'));
        }

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => $pageSize],
        ]);

        if ($this->load($params) && $this->validate()) {
            if ($this->typeSearch == self::typeSearchProduct) {
                if (!empty($this->productId)) {
                    $query->andWhere([CarTrial::tableName() . '.[[productId]]' => $this->productId]);
                } else { // Селект с продуктами не выбран
                    if (!empty($this->specificationId)) {
                        $specificationIds = [$this->specificationId];
                    } else { // Селект с типами не выбран
                        $specificationIds = ProductSpecification::getIdsByExtId('base-class-sm');
                    }
                    $query->leftJoin(['psl' => ProductSpecificationLink::tableName()], 'psl.[[productId]] = ' . CarTrial::tableName() . '.[[productId]]');
                    $query->andWhere(['psl.specificationId' => $specificationIds]);
                }
            }

            if ($this->typeSearch == self::typeSearchBrand) {

                if ($this->modelId) {
                    $query->joinWith('carTestRelation.carModel')
                        ->andWhere([CarModel::tableName() . '.[[id]]' => $this->modelId]);
                }

                if ($this->brandId) {
                    $query->joinWith('carTestRelation.carBrand')
                        ->andWhere([CarBrand::tableName() . '.[[id]]' => $this->brandId]);
                }
            }
       }

        $this->rawSql = $query->createCommand()->rawSql;
        return $dataProvider;
    }


    /**
     * @param $params
     * @return array
     */
    public function getStructuredData($params)
    {
        $this->dataProvider = $this->search($params);

        $uniqueKeys = array_map(function ($item) {
            return $item['productComponentKey'];
        }, $this->dataProvider->getModels());

        // Разбиваем ключи на productId и component
        $productComponents = [];
        foreach ($uniqueKeys as $key) {
            list($productId, $component) = explode('-', $key);
            if (!isset($productComponents[$productId])) {
                $productComponents[$productId] = [];
            }
            $productComponents[$productId][] = $component;
        }

        // Получаем все соответствующие продукты
        $products = Product::find()
            ->where(['id' => array_keys($productComponents)])
            ->all();

        // Структурирование данных о продуктах
        $structuredData = [];
        foreach ($products as $product) {
            $structuredData[$product->id] = [
                'productId' => $product->id,
                'title' => $product->title,
                'announce' => $product->announce,
                'src' => $product->src,
                'components' => $productComponents[$product->id] ?? [],
                "page" => $this->dataProvider->pagination->page+1,
            ];
        }

        return $structuredData;
    }

    /**
     * @return mixed
     */
    public function getDataProvider()
    {
        return $this->dataProvider;
    }

}
