<?php

namespace app\modules\experience\models;

/**
 * This is the ActiveQuery class for [[CarModel]].
 *
 * @see CarModel
 */
class CarModelQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return CarModel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CarModel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
