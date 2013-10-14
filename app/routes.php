<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get(
    '/',
    array(
        'as' => 'home',
        'uses' => 'Controller\Home@getIndex',
    )
);

Route::group(
    array('prefix' => 'docs'),
    function () {
        Route::get(
            'policies',
            array(
                'as' => 'policies',
                'uses' => 'Controller\Home@getPolicies',
            )
        );
    }
);

Route::group(
    array('prefix' => 'users'),
    function () {
        Route::get(
            'login',
            array(
                'as' => 'login',
                'uses' => 'Controller\Users@getLogin',
            )
        )->before('guest');

        Route::post('login', 'Controller\Users@postLogin');

        Route::get(
            'logout',
            array(
                'as' => 'logout',
                'uses' => 'Controller\Users@getLogout',
            )
        );
    }
);

Route::resource('users', 'Controller\Users');
