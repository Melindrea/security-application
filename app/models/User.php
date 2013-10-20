<?php
namespace Model;

use \Illuminate\Auth\UserInterface;
use \Illuminate\Auth\Reminders\RemindableInterface;

class User extends Base implements UserInterface, RemindableInterface
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
     * The attributes that may not be mass updated.
     *
     * @var array
     */
    protected $guarded = array();

    /**
     * Rules for validating a user.
     *
     * @var array
     */
    protected static $rules = array(
        'username' => 'required|min:3|max:128|unique:users',
        'display_name' => 'required|min:3|max:128',
        'email'     => 'required|between:3,64|email|confirmed',
        'password'  =>'required|min:10',
        'agree_terms' => 'required',
    );

    /**
     * Sets up event listener for the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(
            function ($user) {
                $user->username = htmlspecialchars($user->username);
                $user->display_name = htmlspecialchars($user->display_name);
                $user->email = \Crypt::encrypt($user->email);
                $user->password = \Hash::make($user->password);
                unset($user->email_confirmation);
                unset($user->agree_terms);
                unset($user->remember_me);
            }
        );

        static::created(
            function ($user) {
                // Send welcome e-mail
            }
        );


        static::created(
            function ($user) {
                // Log creation of user
            }
        );
    }

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
        return \Crypt::decrypt($this->email);
    }

    // /**
    //  * Set the password.
    //  *
    //  * @return void
    //  */
    // public function setPasswordAttribute()
    // {
    //     $this->password = \Hash::make($this->password);
    // }
}
