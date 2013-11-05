<?php
namespace Controller;

/**
 * Feed Controller.
 *
 * Controller setting up the feed, using https://github.com/RoumenDamianoff/laravel4-feed
 *
 * @package  SecurityApplication
 * @author Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright Copyright (c) 2013, Marie Hogebrandt
 * @license http://opensource.org/licenses/MIT MIT
 */
class Feed extends Base
{

     protected $extensions = ['atom', 'rss'];

     /**
     * Route: /feed
     *
     * @return void
     */
    public function getIndex($ext)
    {
        if (!in_array($ext, $this->extensions)) {
            return \Redirect::route('home')
            ->with('flash_warning', trans('messages.feed.error'));
        }
        $feed =  \Feed::make();

        // set your feed's title, description, link, pubdate and language
        $feed->title = trans('feed.title');
        $feed->description = trans('feed.description');
        $feed->logo = \Config::get('app.url').'/'.\Config::get('site.logo');
        $feed->link = \URL::route('feed', ['ext' => $ext]);
        // $feed->pubdate = $posts[0]->created;
        $feed->lang = \App::getLocale();

        // foreach ($posts as $post)
        // {
        //     // set item's title, author, url, pubdate and description
        //     $feed->add($post->title, $post->author, URL::to($post->slug), $post->created, $post->description);
        // }

        // show your feed (options: 'atom' (recommended) or 'rss')
        return $feed->render($ext);
    }
}
