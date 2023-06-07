<?php

return [
    'app' => [
        'app_name' => \App\Helper\ConfigHelper::getEnv('app.app_name', 'test'),//项目名称
        'debug' => \App\Helper\ConfigHelper::getEnv('app.debug', true), //是否调试状态，调试会热重载等
    ],
];