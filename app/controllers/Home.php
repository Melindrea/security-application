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
        $config = \Config::get('sitemap.documents.'.$file);

        if (!$config) {
            \App::abort(404);
        }
        // $document = \HTML::markdown($this->loadFile($file, $config['type']));
        $document = \HTML::markdown(\Data::loadDocument($file, $config['type']));
        return \View::make('document')
        ->with('document', $document)
        ->with('title', $config['title']);
    }
}
