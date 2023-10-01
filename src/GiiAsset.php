<?php

declare(strict_types=1);

namespace yii\gii;

use yii\web\AssetBundle;

/**
 * This declares the asset files required by Gii.
 */
class GiiAsset extends AssetBundle
{
    public $sourcePath = '@yii/gii/assets';
    public $css = [
        'css/main.css',
    ];
    public $js = [
        'js/bs4-native.min.js',
        'js/gii.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
