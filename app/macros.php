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
