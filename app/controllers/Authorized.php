<?php
namespace Controller;

/**
 * Authorized Controller.
 *
 * Base for protected controllers, inherits Base, no direct routes.
 *
 * @package  SecurityApplication
 * @author Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright Copyright (c) 2013, Marie Hogebrandt
 * @license http://opensource.org/licenses/MIT MIT
 */
class Authorized extends Base
{
    /**
     * Let's whitelist all the methods we want to allow guests to visit!
     *
     * @access   protected
     * @var      array
     */
    protected $whitelist = array(); // Actions for guests

    /**
     * Initializer.
     *
     * Runs the Auth-filter before actions not whitelisted,
     * Runs the CSRF-filter on action "post".
     *
     * @return \Controller\Authorized
     */
    public function __construct()
    {
        parent::__construct();
        // Check if the user is logged in
        $this->beforeFilter('auth', array('except' => $this->whitelist));
    }
}
