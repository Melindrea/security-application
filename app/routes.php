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
        'uses' => 'Controller\Documents@getIndex',
    )
);
Route::get(
    'docs/{file}',
    array(
        'as' => 'document',
        'uses' => 'Controller\Documents@getDocument',
    )
);

Route::get(
    'sitemap.{ext}',
    array(
        'as' => 'sitemap',
        'uses' => 'Controller\Sitemap@getIndex',
    )
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


Route::resource('messages', 'Controller\Messages', array('only' => array('index', 'store')));
