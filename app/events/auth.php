<?php
/**
 * Events/Auth File.
 *
 * Returns all the events associated with the Authorization.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

Event::listen(
    'auth.login',
    function ($user, $remember) {
        /*
            PAYLOAD:
            array(
                array(
                    'username' => 'something',
                    'password' => 'something',
                ),
                true, //Remember
                true, //Login
            );
        */

        // Add a login attempt object, successful set to 'false'
        // Return true/false
        Log::info(
            'User login',
            array(
             'ip' => \Request::getClientIP(),
             'user' => 'Marie',
             'successful' => true,
             'userVariable' => $user,
             'remember' => $remember,
             )
        );
    }
);

Event::listen(
    'auth.failed',
    function ($username) {
        // $count = \Model\User::where('username', '=', $username)->count();

        // $exists = ($count > 0);
        Log::info(
            'User login',
            array(
             'ip' => \Request::getClientIP(),
             'user' => $username,
             'successful' => false,
             'exists' => false,
             )
        );
    }
);
