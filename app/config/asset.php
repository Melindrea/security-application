<?php
/**
 * Config Asset.
 *
 * Configuration for the asset pipeline.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

return [
    'header-css' => [
        '/assets/styles/*.main.css' => [],
    ],
    'footer-js' => [
        '/assets/scripts/*.main.js' => [],
    ],
    'header-js' => [
        '/assets/scripts/*.head.js' => [],
    ],
];
