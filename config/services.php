<?php

return [

    'moysklad' => [
        'login' => env('MOYSKLAD_LOGIN'),
        'password' => env('MOYSKLAD_PASSWORD')
    ],
    'cdek' => [
        'login' => env('CDEK_CLIENT_ID'),
        'password' => env('CDEK_CLIENT_SECRET'),
        'url' => env('CDEK_CLIENT')
    ]
];
