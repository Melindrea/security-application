<?php
/**
 * Notification Class File.
 *
 * Deals with alerts and notifications.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

namespace Hogebrandt;

/**
 * Notification Class.
 *
 * Deals with alerts and notifications.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */
class Notification
{
    protected static $types = [
        'alert' => [
             // Showstopper warning
            'critical',
            'debug',
            // Something went wrong
            'error',
            'info',
            // No issues, but you should be aware...
            'notice',
            // Things didn't go fully according to plan
            'warning',
            'success',
        ],
    ];

    public static function has($type)
    {
        if ($type == 'alert') {
            foreach (self::$types['alert'] as $alertType) {
                if (\Session::has('alert_' . $alertType)) {
                    return $alertType;
                }
            }
        }

        return false;
    }
}
