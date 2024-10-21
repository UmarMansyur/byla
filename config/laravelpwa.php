<?php

return [
    'name' => 'ByLa',
    'manifest' => [
        'name' => env('APP_NAME', 'My PWA App'),
        'short_name' => 'ByLa',
        'start_url' => '/login',
        'background_color' => '#ffffff',
        'theme_color' => '#533dea',
        'display' => 'standalone',
        'orientation'=> 'portrait',
        'status_bar'=> 'black',
        'icons' => [
            '48x48' => [
                'path' => '/assets/app/icons/icon-48-48.png',
                'purpose' => 'any'
            ],
            '72x72' => [
                'path' => '/assets/app/icons/icon-72-72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/assets/app/icons/icon-96-96.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/assets/app/icons/icon-144-144.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/images/icons/icon-192-192.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/images/icons/icon-512x512.png',
                'purpose' => 'any'
            ],
        ],
        'shortcuts' => [
            [
                'name' => 'Login',
                'description' => 'Login',
                'url' => '/login',
                'icons' => [
                    "src" => "/images/icons/icon-72x72.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Register',
                'description' => 'Register',
                'url' => '/register'
            ]
        ],
        'custom' => []
    ]
];
