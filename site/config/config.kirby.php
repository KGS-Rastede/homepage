<?php
// https://getkirby.com/docs/guide/configuration#multi-environment-setup
return [
    'email' => [
        'transport' => [
            'type' => 'smtp',
            'host' => 'localhost',
            'port' => 1025,
            'security' => false,
        ],
    ],
];
