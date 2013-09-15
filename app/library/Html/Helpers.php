<?php
namespace Library\Html;

class Helpers
{
    public static function bodyClasses($customClasses = array())
    {
        $bodyClasses = array();

        if (!is_array($customClasses)) {
            $customClasses = explode(' ', $customClasses);
        }

        $bodyClasses = array_merge($bodyClasses, $customClasses);

        $bodyClasses[] =\Route::currentRouteName();

        return join(' ', $bodyClasses);
    }

    public static function typographyTransform($text)
    {
        $typo = new \Typography();
        $transformed = $typo->process($text);
        return $transformed;
    }

    public static function toHtml($text)
    {
        $cleaned = \Purifier::clean($text);
        $markdown = \Markdown::defaultTransform($cleaned);
        $typographed = self::typographyTransform($markdown);
        return $typographed;
    }
}
