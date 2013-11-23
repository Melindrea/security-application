<?php
/**
 * Base Controller File.
 *
 * The base for all the controllers, no direct routes.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

namespace Controller;

/**
 * Base Controller.
 *
 * The base for all the controllers, no direct routes.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
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

    protected function loadFile($name, $type, $action = 'content')
    {
        $extensions = [
            'markdown' => 'md',
        ];

        if (!isset($extensions[$type])) {
            return '';
        }

        $path = __DIR__ . '/../data/files/' . $name . '.' . $extensions[$type];

        if ($action == 'content') {
            return \File::get($path);
        } elseif ($action == 'lastmodified') {
            if (file_exists($path)) {
                return filemtime($path);
            } else {
                return null;
            }
        }
        return null;
    }
}
