<?php

namespace app\modules\experience\models;

/**
 * This is the ActiveQuery class for [[CarBrand]].
 *
 * @see CarBrand
 */
class CarBrandQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return CarBrand[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CarBrand|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
