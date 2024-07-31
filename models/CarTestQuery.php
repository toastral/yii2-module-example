<?php

namespace app\modules\experience\models;

/**
 * This is the ActiveQuery class for [[CarTest]].
 *
 * @see CarTest
 */
class CarTestQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return CarTest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CarTest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }


    public function active()
    {
        return $this->where(["hidden" => 0]);
    }
}
