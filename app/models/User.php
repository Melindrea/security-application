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
     * Array used by FactoryMuff to create Test objects
     */
    public static $factory = array(
        'display_name' => 'string',
        'username' => 'string',
        'email' => 'email',
        'password' => '123456',
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
                $user->username = strtolower(htmlspecialchars($user->username));
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

    public function messages()
    {
        return $this->hasMany('Model\Message');
    }

    /**
     * Get the roles a user has
     */
    public function roles()
    {
        return $this->belongsToMany('Model\Role');
    }

    /**
     * Find out if user has a specific role
     *
     * $return boolean
     */
    protected function isRole($name)
    {
        echo "is something! ".$name;
        // return in_array($name, array_fetch($this->roles->toArray(), 'name'));
    }

    protected function makeRole($name)
    {
        if (!$this->isRole($name)) {
            $assignedRole = Role::idFromName($name);

            $this->roles()->attach($assignedRole);
        }
        echo "tihii ".$name;
    }

    protected function removeRole($name)
    {
        // if ($this->isRole($name)) {
        //     $assignedRole = Role::idFromName($name);

        //     $this->roles()->detach($assignedRole);
        // }
        echo "remove something! ".$name;
    }

    public function __call($method, $args)
    {
        $type = '';
        $arg = '';
        $roleMethods = ['make', 'is', 'removeAs'];

        // foreach ($roleMethods as $roleMethod) {
        //     $roleMethodLength = sizeof($roleMethod);
        //     $methodBit = substr($method, 0, $roleMethodLength);
        //     if ($methodBit == $roleMethod) {
        //         $arg = strtolower(substr($method, $roleMethodLength));
        //         $type = 'Role';
        //         break;
        //     }
        // }
        echo $method.'<br>';
        if (($methodBit = substr($method, 0, 4)) == 'make') {
            $arg = strtolower(substr($method, 4));
            $type = 'Role';
        } elseif (($methodBit = substr($method, 0, 2)) == 'is') {
            $arg = strtolower(substr($method, 2));
            $type = 'Role';
        } elseif (($methodBit = substr($method, 0, 8)) == 'removeAs') {
            $arg = strtolower(substr($method, 8));
            $type = 'Role';
        }
        $methodToCall = $methodBit.$type;
        $this->$methodToCall($arg);
        return false;
    }
}
