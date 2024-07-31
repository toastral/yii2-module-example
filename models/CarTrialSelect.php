<?php

namespace app\modules\experience\models;

use app\modules\product\models\Product;
use app\modules\product\models\ProductSpecification;
use app\modules\product\models\ProductSpecificationLink;
use yii\helpers\ArrayHelper;

class CarTrialSelect
{
    /**
     * Получает список продуктов для использования в элементе select.
     * @param $specificationId
     * @return array
     */
    public static function getProductOptions($specificationId = null)
    {
        $query = CarTrial::find()
            ->select(CarTrial::tableName() . '.[[productId]]')
            ->joinWith('activeProductRelation')
            ->where([CarTrial::tableName() . '.[[hidden]]' => 0])
            ->distinct();

        if ($specificationId) {
            $query->innerJoin(ProductSpecificationLink::tableName(), CarTrial::tableName(). '.[[productId]]' . ' = ' . ProductSpecificationLink::tableName() . '.[[productId]]')
                ->andWhere([ ProductSpecificationLink::tableName() . '.[[specificationId]]' => $specificationId]);
        }

        $productIds = $query->column();

        $products = Product::find()
            ->select('id, title')
            ->where(['id' => $productIds])
            ->asArray()
            ->all();

        // Возвращаем массив в формате id => title
        return ArrayHelper::map($products, 'id', 'title');
    }

    /**
     * @return array
     */
    public static function getProductSpecificationsOptions()
    {
        $specifications = ProductSpecification::find()
            ->alias('child')
            ->select('child.[[id]], child.[[title]]')
            ->leftJoin(['parent' => ProductSpecification::tableName()], 'child.[[parentId]] = parent.[[id]]')
            ->joinWith('productSpecificationLinks as psl')
            ->where(['parent.[[extId]]' => 'base-class-sm', 'psl.productId' => CarTrial::getActiveProductIds()])
            ->distinct()
            ->asArray()
            ->all();

        return $specifications;
    }


    /**
     * @return array
     */
    public static function getCarBrandOptions()
    {
        $carBrands = CarTrial::find()
            ->select(CarBrand::tableName() . '.[[id]]' . ','.  CarBrand::tableName() . '.[[name]]')
            ->innerJoin(CarTest::tableName(), CarTest::tableName() . '.[[id]]' .  ' = ' .  CarTrial::tableName() . '.[[carTestId]]')
            ->innerJoin(CarBrand::tableName(), CarBrand::tableName() . '.[[id]]' .  ' =  ' . CarTest::tableName() . '.[[car_brand_id]]')
            ->where([
                CarTrial::tableName() . '.[[hidden]]' => 0,
                CarTest::tableName() . '.[[hidden]]' => 0
            ])
            ->distinct()
            ->asArray()
            ->all();

        $options = ArrayHelper::map($carBrands, 'id', 'name');

        return $options;
    }

    /**
     * @param $carBrandId
     * @return array
     */
    public static function getCarModelsOptions($carBrandId)
    {
        if (!$carBrandId) {
            return [];
        }

        $carModels = CarTest::find()
            ->alias('ct') // car_test
            ->joinWith('carModel cm')
            ->where([
                'ct.car_brand_id' => $carBrandId,
                'ct.hidden' => 0
            ])
            ->select(['cm.id', 'cm.name'])
            ->distinct()
            ->asArray()
            ->all();

        $options = ArrayHelper::map($carModels, 'id', 'name');

        return $options;
    }



}
