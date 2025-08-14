<?php

return [

    // 'paths' => ['api/*', 'sanctum/csrf-cookie', 'auth/*'],
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'logout', 'auth/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:8000', 'http://localhost:8000'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,
];
