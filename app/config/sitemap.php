<?php
/**
 * Config Sitemap.
 *
 * Sitemap.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */
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
