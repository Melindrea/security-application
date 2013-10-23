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
        'home' => [
            'route' => 'home',
        ],
        'users' => [
            'route' => 'users.index',
            'items' => [
                'login' => [
                    'condition' => 'Auth::guest',
                    'route' => 'login',
                ],
                'logout' => [
                    'condition' => 'Auth::check',
                    'route' => 'logout',
                    'query' => [
                        's' => csrf_token(),
                    ],
                ],
                'users.create' => [
                    'condition' => 'Auth::guest',
                    'route' => 'users.create',
                ],
            ],
        ],
        'external' => [
            'route' => 'http://example.com',
        ]
    ],
];
