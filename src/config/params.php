<?php
use modava\video\VideoModule;

return [
    'videoName' => 'Video',
    'videoVersion' => '1.0',
    'status' => [
        '0' => VideoModule::t('video', 'Tạm ngưng'),
        '1' => VideoModule::t('video', 'Hiển thị'),
    ]
];
