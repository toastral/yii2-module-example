<?php

namespace app\modules\experience\models;

/**
 * This is the ActiveQuery class for [[CarTrial]].
 *
 * @see CarTrial
 */
class CarTrialQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return CarTrial[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CarTrial|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
