<?php
namespace Hogebrandt;

/**
 * Notification.
 *
 * Deals with alerts and notifications
 *
 * @package  SecurityApplication
 * @author Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright Copyright (c) 2013, Marie Hogebrandt
 * @license http://opensource.org/licenses/MIT MIT
 */

class Notification
{
    protected static $types = [
        'alert' => [
            'critical', // Showstopper warning
            'debug',
            'error', // Something went wrong
            'info',
            'notice', // No issues, but you should be aware...
            'warning', // Things didn't go fully according to plan
            'success',
        ],
    ];

    public static function has($type)
    {
        if ($type == 'alert') {
            foreach (self::$types['alert'] as $alertType) {
                if (\Session::has('alert_'.$alertType)) {
                    return $alertType;
                }
            }
        }

        return false;
    }
}
