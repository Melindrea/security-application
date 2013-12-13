<?php
/**
 * Wrapper to Mobile Detect.
 *
 * Uses https://github.com/serbanghita/Mobile-Detect for RESS.
 * https://github.com/serbanghita/Mobile-Detect/wiki/Code-examples.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

namespace Hogebrandt;

/**
 * Wrapper to Mobile Detect.
 *
 * Uses https://github.com/serbanghita/Mobile-Detect for RESS.
 * https://github.com/serbanghita/Mobile-Detect/wiki/Code-examples.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */
class MobileDetect
{
    public static function __callStatic($name, $arguments)
    {
        $detect = new \Mobile_Detect();
        // Note: value of $name is case sensitive.
        call_user_func_array(array($detect, $name), $arguments);
    }
}
