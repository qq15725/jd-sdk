<?php

return [
    'appkey' => env('JD_APPKEY'),
    'appsecret' => env('JD_APPSECRET'),
    'log' => [
        'driver' => 'daily',
        'path' => app()->storagePath('logs/jd.log'),
        'level' => app()->environment() == 'production' ? 'info' : 'debug',
        'days' => 3
    ],
];