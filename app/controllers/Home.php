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
     * Route: docs/policies
     *
     * @return void
     */
    public function getPolicies()
    {
        $document = \HTML::markdown($this->getDocument('policies', 'markdown'));
        return \View::make('document', ['document' => $document, 'title' => 'Policies']);
    }
    /**
     * docs/*
     *
     * @return void
     */
    private function getDocument($name, $type)
    {
        $extensions = [
            'markdown' => 'md',
        ];

        if (!isset($extensions[$type])) {
            return '';
        }

        $path = __DIR__.'/../files/'.$name.'.'.$extensions[$type];
        $document = \File::get($path);
        return $document;
    }
}
