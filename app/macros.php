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
        $typo = new \Typography();
        $typographed = $typo->process($markdown);
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

        if (\Auth::check()) {
            $bodyClasses[] = 'logged-in';
        }

        return join(' ', $bodyClasses);
    }
);

/*
|--------------------------------------------------------------------------
| Stylesheet macro
|--------------------------------------------------------------------------
|
| Overrides the ugly style function from the HTML class
|
*/
HTML::macro(
    'stylesheet',
    function ($url, $attributes = array('type' => null, 'media' => null)) {
        $url = Config::get('app.assets.style').$url;
        return HTML::style($url, $attributes);
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
    function ($ua) { ?>
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create',{{ $ua }});ga('send','pageview');
        </script>
    <?php }
);

/*
|--------------------------------------------------------------------------
| Flash macro
|--------------------------------------------------------------------------
|
| Creates a message that will fade once it's been up for a few moments
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
| Creates a cookie message that needs to be clicked away
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
