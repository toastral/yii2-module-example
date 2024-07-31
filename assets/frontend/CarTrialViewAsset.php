<?php

namespace app\modules\experience\assets\frontend;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class CarTrialViewAsset extends AssetBundle
{

    public $sourcePath = '@app/modules/experience/assets/frontend/dist';

    /**
     * @var array
     */
    public $css = [
        'car-trial.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'car-trial-view.js',
        'more-cars.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
    ];

}
