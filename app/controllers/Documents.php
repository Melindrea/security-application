<?php
/**
 * Documents Controller File.
 *
 * Controller that deals with various routes that are mainly documents
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

namespace Controller;

/**
 * Documents Controller.
 *
 * Controller that deals with various routes that are mainly documents
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */
class Documents extends Base
{

    /**
     * Route: /
     *
     * @return void
     */
    public function getIndex()
    {
        return \View::make('home');
    }

    /**
     * Route: docs/{file}
     *
     * @return void
     */
    public function getDocument($file)
    {
        $config = \Config::get('sitemap.virtual.document.' . $file);

        if (!$config) {
            \App::abort(404);
        }
        \Config::set('virtual.route', $file);
        $document = \View::make(
            'partials.markdown',
            array(
             'content' => \Data::loadDocument($file, $config['type']),
            )
        );
        $data = \Data::get('document/' . $file);

        $title = ($data && isset($data['page-title'])) ? trans($data['page-title']) : false;
        return \View::make('document')
        ->with('document', $document)
        ->with('title', $title);
    }
}
