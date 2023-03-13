<?php
/**
 * Created by PhpStorm.
 * User: connor
 * Date: 30/11/17
 * Time: 23:29
 */

namespace app\assets;


use yii\web\AssetBundle;

class HighlightAsset extends AssetBundle
{
    public $sourcePath = '@bower/highlights';

    public $js = [
        'highlight.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];

    public $publishOptions = ['forceCopy' => YII_DEBUG];
}