<?php
namespace Model;

class Message extends \Eloquent
{
    protected $guarded = array();

    protected static $rules = array(
        'subject' => 'required|min:3|max:128',
        'content' => 'required|min:3|max:500',
    );

    public function user()
    {
        return $this->belongsTo('Model\User');
    }
}
