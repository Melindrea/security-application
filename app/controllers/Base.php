<?php
namespace Controller;

/**
 * Base Controller.
 *
 * The base for all the controllers, no direct routes.
 *
 * @package  SecurityApplication
 * @author Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright Copyright (c) 2013, Marie Hogebrandt
 * @license http://opensource.org/licenses/MIT MIT
 */
class Base extends \Controller
{

    /**
     * Initializer.
     *
     * Runs the CSRF-filter on action "post"
     *
     * @return \Controller\Base
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
    }
}
