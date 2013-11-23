<?php
namespace Hogebrandt;

/**
 * Various utilities.
 *
 * A mixed back of functions (for now)
 *
 * @package  SecurityApplication
 * @author Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright Copyright (c) 2013, Marie Hogebrandt
 * @license http://opensource.org/licenses/MIT MIT
 */

class Utilities
{
    /**
     * Get key in array with corresponding value
     *
     * @return int
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
