<?php
/**
 * Various Utilities File.
 *
 * A mixed bag of functions (for now).
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

namespace Hogebrandt;

/**
 * Various Utilities File.
 *
 * A mixed bag of functions (for now).
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

class Utilities
{
    /**
     * Get key in array with corresponding value
     *
     * @return int
     * @throws UnexpectedValueException If $term does not exist in $array
     */
    public static function getIdInArray($array, $term)
    {
        foreach ($array as $key => $value) {
            if ($value == $term) {
                return $key;
            }
        }

        throw new UnexpectedValueException;
    }
}
