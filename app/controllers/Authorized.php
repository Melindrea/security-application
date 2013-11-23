<?php
/**
 * Authorized Controller File.
 *
 * Base for protected controllers, inherits Base, no direct routes.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

namespace Controller;

/**
 * Authorized Controller.
 *
 * Base for protected controllers, inherits Base, no direct routes.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */
class Authorized extends Base
{
    /**
     * Let's whitelist all the methods we want to allow guests to visit!
     *
     * @access   protected
     * @var      array
     */
    protected $whitelist = array();

    /**
     * List the methods that _require_ a user to be guest
     *
     * @access   protected
     * @var      array
     */
    protected $guestlist = array();

    /**
     * Initializer.
     *
     * Runs the Auth-filter before actions not whitelisted,
     * Runs the Guest-filter before actions guestlisted.
     *
     * @return \Controller\Authorized
     */
    public function __construct()
    {
        parent::__construct();
        // Check if the user is logged in
        $this->beforeFilter('auth', array('except' => $this->whitelist));

        // Check if the user is logged out
        $this->beforeFilter('guest', array('only' => $this->guestlist));
    }
}
