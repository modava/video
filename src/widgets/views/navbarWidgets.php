<?php

use modava\video\VideoModule;
use yii\helpers\Url;

?>
<ul class="nav nav-tabs nav-sm nav-light mb-10">
    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left<?php if (Yii::$app->controller->id == 'video') echo ' active' ?>"
           href="<?= Url::toRoute(['/video/video']); ?>">
            <i class="ion ion-ios-locate"></i><?= Yii::t('backend', 'Video'); ?>
        </a>
    </li>
    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left<?php if (Yii::$app->controller->id == 'video-category') echo ' active' ?>"
           href="<?= Url::toRoute(['/video/video-category']); ?>">
            <i class="ion ion-ios-locate"></i><?= Yii::t('backend', 'Video category'); ?>
        </a>
    </li>
    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left<?php if (Yii::$app->controller->id == 'video-type') echo ' active' ?>"
           href="<?= Url::toRoute(['/video/video-type']); ?>">
            <i class="ion ion-ios-locate"></i><?= Yii::t('backend', 'Video type'); ?>
        </a>
    </li>
</ul>
