<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Form Language Lines
    |--------------------------------------------------------------------------
    |
    | Hints, messages and labels
    |
    */

    'honeypot' => array(
        'label' => 'Leave this empty',
    ),

    'display_name' => array(
        'label' => 'Display Name',
        'placeholder' => 'Online handle',
        'hint' => 'This will be displayed as your public identity',
    ),

    'email' => array(
        'label' => 'E-mail',
        'placeholder' => 'you@name.com',
        'hint' => 'Your e-mail will not be shared with third part or displayed,
            but will be used for authenticating yourself, as well as (limited
            and optional) communication and (optional) gravatar',
    ),

    'password' => array(
        'label' => 'Password',
        'placeholder' => 'Secure Password',
        'hint' => 'This will be shown in clear text while registering (but no
            where else) so ensure no one else can see it. For a secure password
            you are required to use 10 characters, at least one capital letter,
            one lowercase letter and one number. You are recommended to use a
            special character as well',
        'error' => 'Password and/or e-mail is wrong',
    ),

    'remember_me' => array(
        'label' => 'Keep me logged in',
        'hint' => 'Do not check this if you are on a shared/public computer.
            It uses a cookie which will be valid for up to 14 days',
    ),

    'register' => array(
        'label' => 'Register',
    ),

    'login' => array(
        'label' => 'Login',
    ),

    'required_fields' => 'Required Fields',

);
