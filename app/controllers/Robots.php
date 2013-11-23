<?php
/**
 * Robots Controller File.
 *
 * Creates a robots.txt based on config
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

namespace Controller;

/**
 * Robots Controller.
 *
 * Creates a robots.txt based on config
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */
class Robots extends Base
{

    /**
     * Route: /robots.txt
     *
     * @return void
     */
    public function getIndex()
    {
        $rules = \Config::get('sitemap.robots');

        $content = '';
        foreach ($rules as $rule) {
            $content .= 'User-agent: ' . $rule['user-agent'] . PHP_EOL;
            foreach ($rule['disallow'] as $disallow) {
                $content .= 'Disallow: ' . $disallow . PHP_EOL;
            }
            $content .= PHP_EOL;
        }
        return \Response::make($content, 200, array('Content-Type' => 'text/plain'));
    }
}
