<?php
/**
 * Model Capability File.
 *
 * Each capability can belong to several roles.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

namespace Model;

/**
 * Model Capability.
 *
 * Each capability can belong to several roles.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */
class Capability extends Base
{
    /**
     * Get roles with a certain capability
     */
    public function roles()
    {
        return $this->belongsToMany('Model\Capability');
    }
}
