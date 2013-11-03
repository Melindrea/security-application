<?php
namespace Hogebrandt;

/**
 * Shortcode class.
 *
 * Allows for using shortcodes on the lines of {shortcode param1="this"
 * param2="that"}
 *
 * @package  SecurityApplication
 * @author Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright Copyright (c) 2013, Marie Hogebrandt
 * @license http://opensource.org/licenses/MIT MIT
 */

class Shortcode
{
    public static function parseText($text)
    {
        // Process any shortcodes
        // $pattern = '/\[\[[^\]]+\]\]/';
        // preg_match_all($pattern, $text, $matches);
        // print_r($matches);

        $regexp = '\[\[\s[^\]]*([^\" \]]*?)\\1[^>]*>(.*)\[\[\/.(.*)\]\]';
  preg_match_all('/$regexp/siU', $text, $matches, PREG_SET_ORDER);
    print_r($matches);


        $parsedText = $text;

        return $parsedText;
    }

    public static function parseCode($match)
    {

    }

    public static function doShortcode($name, $params)
    {
        // Check that the shortcode is registered, if not return false
        return false;

    }
}
