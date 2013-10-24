<?php
namespace Controller;

/**
 * Home Controller.
 *
 * Controller that deals with various routes that have a route starting from
 * root.
 *
 * @package  SecurityApplication
 * @author Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright Copyright (c) 2013, Marie Hogebrandt
 * @license http://opensource.org/licenses/MIT MIT
 */
class Home extends Base
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
        $config = \Config::get('sitemap.virtual.document.'.$file);

        if (!$config) {
            \App::abort(404);
        }
        \Config::set('virtual.route', $file);
        $document = \HTML::markdown(\Data::loadDocument($file, $config['type']));
        $data = \Data::get('document/'.$file);

        $title = ($data && isset($data['page-title'])) ? trans($data['page-title']) : false;
        return \View::make('document')
        ->with('document', $document)
        ->with('title', $title);
    }
}
