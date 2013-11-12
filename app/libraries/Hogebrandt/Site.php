<?php
namespace Hogebrandt;

/**
 * Site class.
 *
 * Various help functions to render the site
 *
 * @package  SecurityApplication
 * @author Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright Copyright (c) 2013, Marie Hogebrandt
 * @license http://opensource.org/licenses/MIT MIT
 */

class Site
{
    public static function slugify($item)
    {
        $item = str_replace('.', '-', $item);
        $item = \Str::slug($item);

        return $item;
    }

    public static function title()
    {
        $data = Data::get();

        if ($data && $data['site-title']) {
            $title = sprintf(
                \Config::get('site.title.pattern'),
                trans($data['site-title']),
                trans('site.meta.title'),
                \Config::get('site.title.divider')
            );
        } else {
            $title = trans('site.meta.title');
        }

        return $title;
    }

    public static function index($file)
    {
        $data = Data::get($file);
        if ($data === null) {
            return true;
        }
        if (!isset($data['meta']) || !isset($data['meta']['robots'])) {
            return true;
        }

        if (in_array('noindex', $data['meta']['robots'])) {
            return false;
        }
        return true;
    }

    public static function route($routename, $param = [], $absolute = false)
    {
        return \URL::route($routename, $param, $absolute);
    }

    public static function currentRouteName()
    {
        $name = \Route::currentRouteName();
        if ($virtual = \Config::get('virtual.route')) {
            $name .= '.'.$virtual;
        }
        return $name;
    }
}
