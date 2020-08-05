<?php

namespace modava\video\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class VideoCustomAsset extends AssetBundle
{
    public $sourcePath = '@videoweb';
    public $css = [
        'css/customVideo.css',
    ];
    public $js = [
        'js/customVideo.js'
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_END
    );
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
