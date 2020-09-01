<?php

use modava\video\VideoModule;

return [
    'videoName' => 'Video',
    'videoVersion' => '1.0',
    'status' => [
        '0' => Yii::t('backend', 'Tạm ngưng'),
        '1' => Yii::t('backend', 'Hiển thị'),
    ],
    'type' => [
        '1' => Yii::t('backend', 'Youtube'),
        '2' => Yii::t('backend', 'Source'),
    ]
];
