<?php
namespace app\modules\experience\behaviors;

use yii\base\Behavior;
use app\modules\experience\models\CarTest;

/**
 * Поведение для CarTest
 */
class CarTestBehavior extends Behavior
{
    public function events()
    {
        return [
            CarTest::EVENT_AFTER_UPDATE => 'afterUpdate',
        ];
    }

    /**
     * @param $event
     * @return void
     */
    public function afterUpdate($event): void
    {
        /** @var CarTest $model */
        $model = $event->sender;
        if ($model->hidden > 0) {
            $model->updateHiddenInCarTrials();
        }
    }
}
