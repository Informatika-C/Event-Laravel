<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
    | Supported: "pusher", "ably", "redis", "log", "null"
    |
    */

    // 'default' => env('BROADCAST_DRIVER', 'null'),
    'default' => 'pusher',

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over websockets. Samples of
    | each available type of connection are provided inside this array.
    |
    */

    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
            // 'key' => env('PUSHER_APP_KEY'),
            'key' => '5726d38269f2fc29d7d5',
            // 'secret' => env('PUSHER_APP_SECRET'),
            'secret' => 'b65933eced00104cc8f8',
            // 'app_id' => env('PUSHER_APP_ID'),
            'app_id' => '1726200',
            'options' => [
                // 'cluster' => env('PUSHER_APP_CLUSTER'),
                'cluster' => 'ap1',
                // 'host' => env('PUSHER_HOST') ?: 'api-' . env('PUSHER_APP_CLUSTER', 'mt1') . '.pusher.com',
                // 'port' => env('PUSHER_PORT', 443),
                // 'scheme' => env('PUSHER_SCHEME', 'https'),
                // 'encrypted' => true,
                // 'useTLS' => env('PUSHER_SCHEME', 'https') === 'https',
                'useTLS' => true,
            ],
            'client_options' => [
                // Guzzle client options: https://docs.guzzlephp.org/en/stable/request-options.html
            ],
        ],

        'ably' => [
            'driver' => 'ably',
            'key' => env('ABLY_KEY'),
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
