<?php

namespace app\modules\experience\controllers\frontend;

use app\modules\contact\models\Contact;
use app\modules\experience\models\CarTrial;
use app\modules\experience\models\fake\ExperienceMetaFake;
use krok\meta\MetaInterface;
use krok\system\components\frontend\Controller;
use yii\base\Module;
use yii\helpers\ArrayHelper;

/**
 * Class StaticController
 * @package app\modules\experience\controllers\frontend
 */
class StaticController extends Controller
{

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCart($carTrialId = null)
    {
        $model = CarTrial::findOne(["id" => $carTrialId]);
        return $this->render('cart', [
            "model" =>  $model
        ]);
    }
}
