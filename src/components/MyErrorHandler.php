<?php
namespace modava\video\components;

class MyErrorHandler extends \yii\web\ErrorHandler
{
    public $errorView = '@modava/video/views/error/error.php';

}
