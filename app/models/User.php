<?php
namespace Model;

use \Illuminate\Auth\UserInterface;
use \Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return Crypt::decrypt($this->email);
    }

    /**
     * Set the password.
     *
     * @return void
     */
    public function setPasswordAttribute()
    {
        $this->password = Hash::make($this->password);
    }

    /**
     * Rules for validating the values for the model.
     *
     * @return boolean
     */
    public static function validate($input)
    {
        $rules = array(
            'un_field' => 'required|min:3|max:128|unique:users,username',
            'display_name' => 'required|min:3|max:128',
            'email'     => 'required|between:3,64|email|confirmed',
            'password'  =>'required|min:10',
            'agree_terms' => 'required',
        );

        return \Validator::make($input, $rules);
    }
}
