<?php

return [
    'api_key' => env('TYPESENSE_API_KEY', 'xyz'),
    'nodes' => [
        [
            'host' => env('TYPESENSE_HOST', 'localhost'),
            'port' => env('TYPESENSE_PORT', 8108),
            'protocol' => env('TYPESENSE_PROTOCOL', 'http'),
        ],
    ],
];
