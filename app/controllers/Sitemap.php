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
        $documents = \Config::get('files');
        foreach ($documents as $file => $config) {
            $lastmodified = $this->getFile($file, $config['type'], 'lastmodified');

            if ($lastmodified && !isset($config['no-index'])) {
                $temp = [];
                $temp['loc'] = \URL::route('document', ['file' => $file]);
                $temp['lastmod'] = date('c', $lastmodified);
                $temp['priority'] = (isset($config['priority'])) ? $config['priority'] : 0.5;
                $temp['changefreq'] = 'monthly';
                $urls[] = $temp;
            }
        }

        foreach ($urls as $item) {
            $sitemap->add($item['loc'], $item['lastmod'], $item['priority'], $item['changefreq']);
        }

        return $sitemap->render($ext);
    }
}
