<?php
namespace Controller;

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
     * @access   public
     * @return \Controller\Authorized
     */
    public function __construct()
    {
        parent::__construct();
        // Check if the user is logged in
        $this->beforeFilter('auth', array('except' => $this->whitelist));
    }
}
