<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $css = [
        'css/site.css',
    ];

    /**
     * {@inheritdoc}
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
