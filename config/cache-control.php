<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cache Control Headers
    |--------------------------------------------------------------------------
    |
    | Here you may define the cache control headers for different types of assets
    | The key is the file extension and the value is the cache duration in seconds
    |
    */
    'extensions' => [
        'css' => 31536000,  // 1 year
        'js' => 31536000,   // 1 year
        'jpg' => 2592000,   // 30 days
        'jpeg' => 2592000,  // 30 days
        'png' => 2592000,   // 30 days
        'gif' => 2592000,   // 30 days
        'ico' => 2592000,   // 30 days
        'svg' => 2592000,   // 30 days
        'woff' => 31536000, // 1 year
        'woff2' => 31536000,// 1 year
        'ttf' => 31536000,  // 1 year
        'eot' => 31536000,  // 1 year
    ],
];
