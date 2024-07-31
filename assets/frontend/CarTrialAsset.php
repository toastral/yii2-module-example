<?php

namespace app\modules\experience\assets\frontend;

use app\assets\AppAsset;
use yii\web\AssetBundle;

class CarTrialAsset extends AssetBundle
{

    public $sourcePath = '@app/modules/experience/assets/frontend/dist';

    /**
     * @var array
     */
    public $css = [];

    /**
     * @var array
     */
    public $js = [
        'car-trial.js',
        'more-cars.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        AppAsset::class,
    ];

}
