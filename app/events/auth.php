<?php

Event::listen(
    'auth.login',
    function ($user, $remember) {
        /* PAYLOAD:
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
        // return false;
    }
);
