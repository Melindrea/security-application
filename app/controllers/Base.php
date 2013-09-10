<?php
namespace Controller;

class Base extends \Controller
{

    /**
     * Initializer.
     *
     * @access   public
     * @return \Controller\Base
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = \View::make($this->layout);
        }
    }
}
