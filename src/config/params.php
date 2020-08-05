<?php
use modava\video\VideoModule;

return [
    'availableLocales' => [
        'vi' => 'Tiếng Việt',
        'en' => 'English',
        'jp' => 'Japan',
    ],
    'videoName' => 'Video',
    'videoVersion' => '1.0',
    'status' => [
        '0' => VideoModule::t('video', 'Tạm ngưng'),
        '1' => VideoModule::t('video', 'Hiển thị'),
    ]
];
