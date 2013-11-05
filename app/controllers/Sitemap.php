<?php
namespace Controller;

/**
 * Sitemap Controller.
 *
 * Controller setting up the sitemap, using https://github.com/RoumenDamianoff/laravel4-sitemap
 *
 * @package  SecurityApplication
 * @author Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright Copyright (c) 2013, Marie Hogebrandt
 * @license http://opensource.org/licenses/MIT MIT
 */
class Sitemap extends Base
{

     protected $extensions = ['xml', 'html', 'txt', 'ror-rss', 'ror-rdf'];

     /**
     * Route: /sitemap
     *
     * @return void
     */
    public function getIndex($ext)
    {
        if (!in_array($ext, $this->extensions)) {
            return \Redirect::route('home')
            ->with('flash_warning', trans('messages.sitemap.error'));
        }
        $sitemap =  \App::make('sitemap');

        $urls = [];

        // Static documents
        $pages = \Config::get('sitemap');
        foreach ($pages as $key => $items) {
            if ($key == 'robots') {
                continue;
            } elseif ($key == 'virtual') {
                foreach ($items as $type => $documents) {
                    foreach ($documents as $file => $config) {
                        $lastmodified = \Data::loadDocument($file, $config['type'], 'lastmodified');

                        if ($lastmodified && \Site::index($type.'/'.$file)) {
                            $temp = [];
                            $temp['loc'] = \URL::route('document', ['file' => $file]);
                            $temp['lastmod'] = date('c', $lastmodified);
                            $temp['priority'] = (isset($config['priority'])) ? $config['priority'] : 0.5;
                            $temp['changefreq'] = 'monthly';
                            $urls[] = $temp;
                        }
                    }
                }
            } else {
                $path = __DIR__.'/../views/';
                $file = $key;
                $config = $items;
                if (isset($config['path'])) {
                    $path .= $config['path'].'/'.$file;
                } elseif (strpos($file, '.') !== false) {
                    $path .= str_replace('.', '/', $file);
                } else {
                    $path .= $file;
                }
                $path .= '.blade.php';
                if (file_exists($path) && \Site::index($file)) {
                    $temp = [];
                    $temp['loc'] = \URL::route($file);
                    $temp['lastmod'] = date('c', filemtime($path));
                    $temp['priority'] = (isset($config['priority'])) ? $config['priority'] : 0.5;
                    $temp['changefreq'] = 'monthly';
                    $urls[] = $temp;
                }
            }
        }

        foreach ($urls as $item) {
            $sitemap->add($item['loc'], $item['lastmod'], $item['priority'], $item['changefreq']);
        }

        return $sitemap->render($ext);
    }
}
