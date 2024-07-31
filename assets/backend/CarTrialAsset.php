<?php

namespace app\modules\experience\assets\backend;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class CarTrialAsset extends AssetBundle
{

    public $sourcePath = '@app/modules/experience/assets/backend/dist';

    /**
     * @var array
     */
    public $css = [
        'image.css',
    ];

    /**
     * @var array
     */
    public $js = [
    ];

    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
    ];

}
