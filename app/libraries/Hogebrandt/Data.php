<?php
namespace Hogebrandt;

/**
 * Data loader.
 *
 * Loads data for controllers
 *
 * @package  SecurityApplication
 * @author Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright Copyright (c) 2013, Marie Hogebrandt
 * @license http://opensource.org/licenses/MIT MIT
 */

class Data
{
    protected static $extensions = [
        'markdown' => 'md',
        'json' => 'json',
    ];

    public static function loadDocument($name, $type, $action = 'content')
    {
        if (!isset(self::$extensions[$type])) {
            return null;
        }

        $path = __DIR__.'/../../metadata/texts/'.$name.'.'.self::$extensions[$type];

        if ($action == 'content') {
            return \File::get($path);
        } elseif ($action == 'lastmodified') {
            if (file_exists($path)) {
                return filemtime($path);
            } else {
                return null;
            }
        }
        return null;
    }

    public static function get($name = null)
    {
        if (!$name) {
            $name = str_replace('.', '/', \Site::currentRouteName());
        }
        $path = __DIR__.'/../../metadata/pages/'.$name.'.json';

        if (!file_exists($path)) {
            return null;
        }
        $content = \File::get($path);
        return json_decode($content, true);

    }

    public static function create($name, $values = array())
    {
        $path = __DIR__.'/../../metadata/pages/'.$name.'.json';

        if (file_exists($path)) {
            // Assume we're wanting to update it
            $file = self::get($name);
        }
    }

    public static function loadMedia($slug)
    {
        $path = __DIR__.'/../../metadata/media/library.json';

        if (!file_exists($path)) {
            // TODO: Throw exception
            return null;
        }

        $content = \File::get($path);
        $library = json_decode($content, true);

        if (!isset($library[$slug])) {
            return null;
        }
        return $library[$slug];
    }

    public static function loadGallery($slug)
    {
        $path = __DIR__.'/../../metadata/media/galleries.json';

        if (!file_exists($path)) {
            // TODO: Throw exception
            return null;
        }

        $content = \File::get($path);
        $gallery = json_decode($content, true);

        if (!isset($gallery[$slug])) {
            return null;
        }
        return $gallery[$slug];
    }
}
