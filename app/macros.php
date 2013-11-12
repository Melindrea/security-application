<?php
/*
|--------------------------------------------------------------------------
| Honeypot macro
|--------------------------------------------------------------------------
|
| The Honeypot is used to give better ideas of whether someone's a real
| person or not
|
*/
Form::macro(
    'honeypot',
    function ($honeypotName, $honeypotTimeName) {
        return \View::make('partials.honeypot')
        ->with('honeypotName', $honeypotName)
        ->with('honeypotTimeName', $honeypotTimeName);
    }
);

/*
|--------------------------------------------------------------------------
| Markdown macro
|--------------------------------------------------------------------------
|
| The name is slightly a misnomer, it runs several functions on the given string
| to clean/transform it to be displayed
|
*/
HTML::macro(
    'markdown',
    function ($text) {
        $cleaned = \Purifier::clean($text);
        $markdown = \Markdown::defaultTransform($cleaned);
        $shortcode = \Shortcode::parseText($markdown);
        $typo = new \Typography();
        $typographed = $typo->process($shortcode);

        return $typographed;
    }
);

/*
|--------------------------------------------------------------------------
| Bodyclass macro
|--------------------------------------------------------------------------
|
| Returns the automatic bodyclasses
|
*/
HTML::macro(
    'bodyClasses',
    function ($customClasses = array()) {
        $bodyClasses = array();

        if (!is_array($customClasses)) {
            $customClasses = explode(' ', $customClasses);
        }

        $bodyClasses = array_merge($bodyClasses, $customClasses);

        $bodyClasses[] = \Route::currentRouteName();

        if (\Config::get('virtual.route')) {
            $bodyClasses[] = \Site::currentRouteName();
        }


        if (\Auth::check()) {
            $bodyClasses[] = 'logged-in';
        }

        return join(
            ' ',
            array_map(
                function ($item) {
                    return Site::slugify($item);
                },
                $bodyClasses
            )
        );
    }
);

/*
|--------------------------------------------------------------------------
| Documentclass macro
|--------------------------------------------------------------------------
|
| Returns the classes for the document wrapper
|
*/
HTML::macro(
    'documentClasses',
    function ($customClasses = array()) {
        $documentClasses = array();

        if (!is_array($customClasses)) {
            $customClasses = explode(' ', $customClasses);
        }

        $documentClasses = array_merge($documentClasses, $customClasses);

        if (HTML::menu('submenu')) {
            $documentClasses[] = 'submenu';
        }

        if (count($documentClasses) > 0) {
            $classes = join(' ', $documentClasses);
            return ' class="'.$classes.'"';
        }

        return false;
    }
);

/*
|--------------------------------------------------------------------------
| Meta macro
|--------------------------------------------------------------------------
|
| Returns the description
|
*/
HTML::macro(
    'meta',
    function () {
        $data = Data::get();

        $meta = '';
        $metaArray = Config::get('site.meta');
        if ($data) {
            $metaArray = array_merge($metaArray, $data['meta']);
        }

        foreach ($metaArray as $name => $content) {
            if (is_array($content)) {
                $content = join(
                    ', ',
                    array_map(
                        function ($item) {
                            return trans($item);
                        },
                        $content
                    )
                );
            } else {
                $content = trans($content);
            }
            $meta .= sprintf('<meta name="%1$s" content="%2$s">'.PHP_EOL, $name, $content);
        }

        return $meta;
    }
);

/*
|--------------------------------------------------------------------------
| Menu macro
|--------------------------------------------------------------------------
|
| Returns a menu based on label
|
*/
HTML::macro(
    'menu',
    function ($label) {
        $currentRouteName = \Site::currentRouteName();
        $menu = Config::get('menu');
        if (!isset($menu['labels'][$label])) {
            return false;
        }

        $config = $menu['labels'][$label];
        $items = $menu['items'];

        if ($config['start'] == 1) {
            if (!isset($items[$currentRouteName])) {
                return false;
            } elseif (!isset($items[$currentRouteName]['items'])) {
                return false;
            }

            $items = $items[$currentRouteName]['items'];
        }

        $itemsArr = [];
        foreach ($items as $routeName => $item) {
            $condition = true;
            $attributes = [];

            if (isset($item['condition'])) {
                $condition = call_user_func($item['condition']);
            }

            if ($condition) {
                $temp = [];

                if (isset($item['url'])) {
                    $temp['url'] = $item['url'];
                } else {
                    $params = (isset($item['query']) && is_array($item['query'])) ? $item['query'] : [];

                    if (isset($item['virtual']) && $item['virtual']) {
                        $parts = explode('.', $routeName);
                        $params['file'] = $parts[1];
                        $temp['url'] = Site::route($parts[0], $params);
                    } else {
                        $temp['url'] = Site::route($routeName, $params);
                    }
                }

                $temp['label'] = trans('site.'.$routeName.'.menu');
                $attributes['id'] = \Site::slugify($routeName).'-menuitem';
                $attributes['role'] = 'menuitem';

                $attributes['aria-selected'] = ($routeName == $currentRouteName) ? 'true' : 'false';

                if (isset($item['attributes'])) {
                    $attributes = array_merge($attributes, $item['attributes']);
                }
                $temp['attributes'] = $attributes;

                $itemsArr[] = View::make('partials.menu.item', $temp);
            }
        }

        return View::make('partials.menu')
        ->with('items', $itemsArr)
        ->with('label', $label)
        ->with('active', \Site::slugify($currentRouteName.'-menuitem'))
        ->with('role', $config['role']);
    }
);

/*
|--------------------------------------------------------------------------
| Asset macro
|--------------------------------------------------------------------------
|
| Links to assets based on name rather than URL
|
*/
HTML::macro(
    'asset',
    function ($section) {
        $paths = require __DIR__.'/../bootstrap/paths.php';
        $assets = Config::get('asset');

        $markup = '';
        if (isset($assets[$section])) {
            foreach ($assets[$section] as $key => $attributes) {
                $file = $paths['public'].$key;
                $files = glob($file);
                if (count($files) > 0) {
                    $parts = explode('.', basename($files[0]));
                    $key = str_replace('*', $parts[0], $key);
                    if (ends_with($key, '.css')) {
                        $default = [
                            'type' => null,
                            'media' => null,
                        ];
                        $attributes = array_merge($default, $attributes);
                        $markup .= HTML::style($key, $attributes);
                    } elseif (ends_with($key, '.js')) {
                        $markup .= HTML::script($key, $attributes);
                    }
                }
            }
        }
        return $markup;
    }
);

/*
|--------------------------------------------------------------------------
| Media macro
|--------------------------------------------------------------------------
|
| Links to media based on name and viewport width
|
*/
HTML::macro(
    'media',
    function ($item) {
        // Should load metadata about an item in the media library
        // and spit out a link based on what it is
        $markup = '';

        return $markup;
    }
);

/*
|--------------------------------------------------------------------------
| Google Analytics macro
|--------------------------------------------------------------------------
|
| Inserts the Universal GA to enable tracking
|
*/
HTML::macro(
    'ga',
    function ($ua) {
        return View::make('partials.analytics.ga')
        ->with('ua', $ua);
    }
);

/*
|--------------------------------------------------------------------------
| Flash macro
|--------------------------------------------------------------------------
|
| Creates a message that will fade once it's been up for a few moments,
| using JavaScript
|
*/
HTML::macro(
    'flash',
    function () {
        $flashTypes = array('notice', 'error');

        foreach ($flashTypes as $flashType) {
            if (Session::has('flash_'.$flashType)) {
                return View::make('partials.flash')
                ->with('classes', 'flash flash-'.$flashType)
                ->with('content', Session::get('flash_'.$flashType));
            }
        }
    }
);

/*
|--------------------------------------------------------------------------
| Cookie macro
|--------------------------------------------------------------------------
|
| Creates a cookie message that needs to be clicked away, using JavaScript
|
*/
HTML::macro(
    'cookies',
    function () {
        if (Auth::guest()) {
            return HTML::notification('cookies', true);
        }
    }
);

/*
|--------------------------------------------------------------------------
| Notification macro
|--------------------------------------------------------------------------
|
| Creates a message that needs to be clicked away
|
*/
HTML::macro(
    'notification',
    function ($content, $save = false) {
        return View::make('partials.notification')
        ->with('content', View::make('partials.notifications.'.$content));
    }
);

/*
|--------------------------------------------------------------------------
| Link macro
|--------------------------------------------------------------------------
|
| Makes a better link
|
*/
HTML::macro(
    'alink',
    function ($url, $title = null, $attributes = array(), $secure = null) {
        if (starts_with($url, 'http')) {
            if (isset($attributes['rel'])) {
                $attributes['rel'] = $attributes['rel'] . ' external';
            } else {
                $attributes['rel'] = 'external';
            }
        }
        return HTML::link($url, $title, $attributes, $secure);
    }
);

/*
|--------------------------------------------------------------------------
| Thumbnail macro
|--------------------------------------------------------------------------
|
| Creates a figure element for a thumbnail, which is a media element with a
| link and optionally caption
|
*/
HTML::macro(
    'thumbnail',
    function ($slug) {
        $fileData = Data::loadMedia(strtolower($slug));

        $data['slug'] = $slug;
        $data['alt'] = $fileData['alt'];
        $data['caption'] = (isset($fileData['caption'])) ? $fileData['caption'] : false;
        $path = Config::get('media.directories.'.$fileData['type']);
        if (isset($fileData['url'])) {
            $data['large'] = $fileData['url'];
            $data['linkAttributes'] = ' class="mfp-iframe"';
        } else {
            $data['large'] = $path.'/'.$slug.'-'.$fileData['original-size'].'.'.$fileData['extension'];
        }
        $data['thumbnail'] = $path.'/'.$slug.'-thumbnail.'.$fileData['extension'];
        $data['attributes'] = [
            'width' => Config::get('media.sizes.thumbnail.width'),
            'height' => Config::get('media.sizes.thumbnail.height'),
        ];
        return View::make('partials.thumbnail', $data);
    }
);

/*
|--------------------------------------------------------------------------
| Gallery macro
|--------------------------------------------------------------------------
|
| Creates a gallery based on a slug
|
*/
HTML::macro(
    'gallery',
    function ($slug) {
        $items = Data::loadGallery(strtolower($slug));

        $data['slug'] = $slug;
        $data['items'] = $items;

        return View::make('partials.gallery', $data);
    }
);

/*
|--------------------------------------------------------------------------
| Require Directory Function
|--------------------------------------------------------------------------
|
| Function to require all files in a given directory
|
*/
// function requireDir($directory = null)
// {
//     if ($handle = opendir($directory)) {
//         while (false !== ($entry = readdir($handle))) {
//             if (!is_dir($entry)) {
//                 require $directory.'/'.$entry;
//             }
//         }
//         closedir($handle);
//     }
// }
