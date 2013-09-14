<?php
namespace Controller;

/**
 * Home Controller.
 *
 * Controller that deals with various routes that have a route starting from
 * root.
 *
 * @author Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright Copyright (c) 2013, Marie Hogebrandt
 * @license http://opensource.org/licenses/MIT MIT
 */
class Home extends Base
{

     /**
     * Route: /
     *
     * @return \View
     */
    public function index()
    {
        $bodyClasses = \Library\Html\Helpers::bodyClasses('index');
        return \View::make('home')
        ->with('bodyClasses', $bodyClasses);
    }
}
