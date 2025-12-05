<?php

return [

    'features' => [
        // ADD OFFLINE MODE
        // shows offline page when user is offline
        'offline_support' => true,

        // ADD NOTIFICATIONS SUPPORT
        // enables push notifications and background push
        'notifications' => true,
        
        // SHOULD APP BE INSTALLABLE
        // allows users to install the PWA on their device
        'install' => true,
    ],

    'notifications' => [
        'public_key' => env('VAPID_PUBLIC_KEY'),
    ],

    'manifest' => [
        'name' => env('PWA_NAME', env('APP_NAME', 'Laravel')),
        'short_name' => env('PWA_SHORT_NAME', env('APP_NAME', 'Laravel')),

        // Application start URL
        'start_url' => env('APP_URL').'/dashboard',

        // DISPLAY MODE
        // options: fullscreen, standalone, minimal-ui, browser
        'display' => 'standalone',
    
        // used on the splash screen when the application is launched
        'background_color' => '#262626',

        // primary color of the application
        'theme_color' => '#262626',

        // ICONS
        'icons' => [
            [
                'src' => 'https://placehold.co/512x512?text=PWA',
                'sizes' => '512x512',
                'type' => 'image/png',
                'purpose' => 'any maskable',
            ],
            [
                'src' => 'https://placehold.co/192x192?text=PWA',
                'sizes' => '192x192',
                'type' => 'image/png',
                'purpose' => 'any maskable',
            ],
            
        ],
        
        // SHORTCUTS
        // quick links available from the app icon
        // may not be supported on all platforms
        'shortcuts' => [
            // [
            //     'name' => 'Open Inbox',
            //     'url' => '/inbox',
            //     'icons' => [],
            // ],
        ],

        // Whether to prefer related applications over the web app
        'prefer_related_applications' => false,
    ],

    'theme_colors' => [
        'light' => '#ffffff',
        'dark' => '#262626',
    ],

];