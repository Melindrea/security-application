<?php

return [
    'labels' => [
        'main' => [
            'levels' => 1,
            'start' => 0,
            'role' => 'menubar',
        ],
        'submenu' => [
            'levels' => 2,
            'start' => 1,
            'role' => 'menu',
        ]
    ],

    'items' => [
        'home' => [],
        'users.index' => [
            'items' => [
                'login' => [
                    'condition' => 'Auth::guest',
                ],
                'logout' => [
                    'condition' => 'Auth::check',
                    'query' => [
                        's' => csrf_token(),
                    ],
                ],
                'users.create' => [
                    'condition' => 'Auth::guest',
                ],
            ],
        ],
        'external' => [
            'url' => 'http://example.com',
        ],
        'document.policies' => [
            'virtual' => true,
        ],
    ],
];
