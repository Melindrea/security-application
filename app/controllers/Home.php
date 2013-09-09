<?php
namespace Controller;

class Home extends Base
{

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |   Route::get('/', 'HomeController@index');
    |
    */

    public function index()
    {
        $bodyClasses = \Library\Html\Helpers::bodyClasses('index');
        return \View::make('home')
        ->with('bodyClasses', $bodyClasses);
    }
}
