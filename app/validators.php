<?php

// We add a custom validator to validate the honeypot text and time check fields
Validator::extend(
    'honeypot',
    function ($attribute, $value, $parameters) {
        // We want the value to be empty, empty means it wasn't a spammer
        return $value == '';
    }
);

Validator::extend(
    'honeytime',
    function ($attribute, $value, $parameters) {
        // The timestamp is encrypted so let's decrypt it
        $value = Crypt::decrypt($value);

        // The current time should be greater than the time the form was built + the speed option
        return (is_numeric($value) && time() > ($value + $parameters[0]));
    }
);
