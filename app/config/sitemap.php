<?php
return [
    'virtual' => [
        'document' => [
            'policies' => [
                'type' => 'markdown',
            ],
        ],
    ],
    'home' => [],
    'users.index' => [],
    'login' => [
        'path' => 'users',
    ],
    'robots' => [
        [
            'user-agent' => '*',
            'disallow' => [
                '/',
            ],
        ],
    ],
];
