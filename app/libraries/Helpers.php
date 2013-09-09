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

        return join(' ', $bodyClasses);
    }
}
