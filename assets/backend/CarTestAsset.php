<?php

namespace app\modules\experience\assets\backend;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class CarTestAsset extends AssetBundle
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
        'car-test.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
    ];

}
