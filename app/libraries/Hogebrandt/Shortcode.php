<?php
/**
 * Shortcode Class File.
 *
 * Allows for using shortcodes on the lines of
 * {media[alt="test"|"something else"|"a third parameter"]}content.jpg{/media}/
 * {media[alt="test"|"something else"|"a third parameter"]}/
 * {media}temp{/media}/
 * {media}/
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

namespace Hogebrandt;

/**
 * Shortcode Class File.
 *
 * Allows for using shortcodes on the lines of
 * {media[alt="test"|"something else"|"a third parameter"]}content.jpg{/media}/
 * {media[alt="test"|"something else"|"a third parameter"]}/
 * {media}temp{/media}/
 * {media}/
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

class Shortcode
{
    public static function parseText($text)
    {
        // Process any shortcodes
        $regexp = self::getRegex();
        preg_match_all('/' . $regexp . '/siU', $text, $matches, PREG_SET_ORDER);

        if (count($matches) > 0) {
            $originals = [];
            $shortcodes = [];
            foreach ($matches as $match) {
                $originals[] = $match[0];
                $name = $match[1];
                $parameters = [];

                if (count($match) > 3) {
                    $parameters[] = $match[3];
                }

                if (count($match) > 2) {
                    $parameters = array_merge($parameters, self::parseParameters($match[2]));
                }
                $shortcodes[] = self::make($name, $parameters);
            }

            return str_replace($originals, $shortcodes, $text);
        }

        return $text;
    }

    protected static function parseParameters($parameters)
    {
        $arr = [];
        $parametersArray = explode('|', str_replace(['[', ']'], '', $parameters));
        foreach ($parametersArray as $item) {
            $temp = explode('=', $item);
            if (count($temp) > 1) {
                $arr[] = str_replace('"', '', $temp[1]);
            } else {
                $arr[] = str_replace('"', '', $item);
            }
        }
        return $arr;
    }

    public static function exists($name)
    {
        return (\Config::get('shortcodes.' . $name));
    }

    public static function make($name, $params = false)
    {
        // Check that the shortcode is registered, if not return false
        // return false;
        $shortcode = \Config::get('shortcodes.' . $name);
        if ($shortcode) {
            if (isset($shortcode['function']) && is_callable($shortcode['function'])) {
                $function = $shortcode['function'];

                return call_user_func_array($function, $params);
            }
        }
        return '';
    }

    public static function add($name, $function, $default = [])
    {
        if (is_callable($function)) {
            $content = [
                'default-parameters' => $default,
                'function' => $function,
            ];
            \Config::set('shortcodes.' . $name, $content);
        }
    }

    public static function remove($name)
    {
        // Not possible to start with
    }

    /**
     * Retrieve the shortcode regular expression for searching.
     *
     * The regular expression combines the shortcode tags in the regular expression
     * in a regex class.
     *
     * The regular expression contains 6 different sub matches to help with parsing.
     *
     * 1 - An extra [ to allow for escaping shortcodes with double [[]]
     * 2 - The shortcode name
     * 3 - The shortcode argument list
     * 4 - The self closing /
     * 5 - The content of a shortcode when it wraps some content.
     * 6 - An extra ] to allow for escaping shortcodes with double [[]]
     *
     * @return string The shortcode search regular expression
     */
    protected static function getRegex()
    {
        $shortcodes = \Config::get('shortcodes');
        $tagnames = array_keys($shortcodes);
        $tagregexp = implode('|', array_map('preg_quote', $tagnames));

        // WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
        // Also, see shortcode_unautop() and shortcode.js.
            return '{(' . $tagregexp . ')(\[.*\])?}(.*)?({\/(' . $tagregexp . ')})?\/';
            // Capital '{'                   // Starting /{
            // . "($tagregexp)"          // The specific tags
            // . '(\[.*\])?'             // Parameters are contained in []
            // . '}'                     // Ending } of the first tag
            // . '('                     // The items following the first tag are optional
            // . '(.*)'                  // Content
            // . '{\/'                    // Start of endtag
            // . "($tagregexp)"          // Ending the tags
            // . '}'                     // Ending } if there's an endtag
            // . ')?'
            // . '\/';                    // Ending /
    }
}
