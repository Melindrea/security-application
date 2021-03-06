<?php
/**
 * Base Model File.
 *
 * Base class for models.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

namespace Model;

/**
 * Base Model.
 *
 * Base class for models.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */
class Base extends \Eloquent
{
    /**
     * Errors returned by validation.
     *
     * @var MessageBag
     */
    public $errors;

    /**
     * Sets up event listener for the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::saving(
            function ($model) {
                return $model->validate();
            }
        );

        /*
            Http://stackoverflow.com/questions/16757616/laravel-4-how-to-listen-to-a-model-event
            static::creating(function($model) { }); // *
            static::created(function($model) { });
            static::updating(function($model) { }); // *
            static::updated(function($model) { });
            static::saving(function($model) { });  // *
            static::saved(function($model) { });
            static::deleting(function($model) { }); // *
            static::deleted(function($model) { });

            Returning false from functions marked * will cancel the operation
        */

    }

    /**
     * Rules for validating the values for the model.
     *
     * @return boolean
     */
    public function validate()
    {
        $validation = \Validator::make($this->attributes, static::$rules);


        if ($validation->passes()) {
            return true;
        }

        $this->errors = $validation->messages();

        return false;
    }

    public static function idFromName($name)
    {
        $models = array_fetch(static::all()->toArray(), 'name');
        $id = (\Utilities::getIdInArray($models, $name) + 1);

        return $id;
    }
}
