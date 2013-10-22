<?php
namespace Model;

class Message extends \Eloquent
{
    protected $guarded = array();

    protected static $rules = array(
        'subject' => 'required|min:3|max:128',
        'content' => 'required|min:3|max:500',
    );

    /**
     * Array used by FactoryMuff to create Test objects
     */
    public static $factory = array(
        'subject' => 'string',
        'type_id' => 'integer',
        'content' => 'text',
        'user_id' => 'factory|Model\User', // Will be the id of an existent User.
    );

    public function user()
    {
        return $this->belongsTo('Model\User');
    }
}
