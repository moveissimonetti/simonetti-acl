<?php

return [
    'simonetti_api' => [
        'endpoint' => [
            'oauth' => 'http://auth.simonetti.dev/oauth',
            'validate' => 'http://auth.simonetti.dev/validate/permission/%s',
        ],
        'credentials' => [
            'client_id' => 1,
            'client_secret' => 'YWRtaW4gZG8gc2lzdGVtYQ',
            'grant_type' => 'password'
        ]
    ],
    'rabbit_mq' => [
        'host' => '127.0.0.1',
        'port' => 5672,
        'username' => 'guest',
        'password' => 'guest'
    ],
    'cache' => [
        'adapter' => [
            'name' => 'Memcached',
            'options' => [
                'ttl' => 3600 * 8, // 8 horas
                'servers' => [
                    ['127.0.0.1', 11211]
                ],
            ]
        ],
        'plugins' => [
            'Serializer'
        ]
    ],
];