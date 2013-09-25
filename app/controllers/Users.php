<?php
namespace Controller;

/**
 * Users Controller.
 *
 * A REST-ful resource, alongside routes with the base of users.
 *
 * @author Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright Copyright (c) 2013, Marie Hogebrandt
 * @license http://opensource.org/licenses/MIT MIT
 */
class Users extends Authorized
{
    /**
     * Let's whitelnputst all the methods we want to allow guests to visit!
     *
     * @access   protected
     * @var      array
     */
    protected $whitelist = array(
        'create',
        'getLogin',
        'postLogin',
        'getLogout',
        'store',
    );

    /**
     * List the methods that require a user to be guest
     *
     * @access   protected
     * @var      array
     */
    protected $guestlist = array(
        'create',
        'getLogin',
        'postLogin',
    );

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = \Model\User::all();

        foreach ($users as $user) {
            echo $user->display_name.'<br>';
            echo \Crypt::decrypt($user->email).'<br>';
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return \View::make('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $honeypot = \Validator::make(
            \Input::all(),
            array(
                'username' => 'honeypot',
                'username_time' => 'honeytime:5',
            )
        );

        if (!$honeypot->passes()) {
            // Most likely bot
            return \Redirect::route('home')
            ->with('flash_warning', trans('messages.register.failed'));
        }

        // $input =\Input::all();
        // $validation =\Model\User::validate($input);
        // if ($validation->passes()) {
        //     \Model\User::create(
        //         array(
        //             'display_name'=> \Input::get('display_name'),
        //             'username'=> \Input::get('un_field'),
        //             'email'=>     \Crypt::encrypt(\Input::get('email')),
        //             'password'=>  \Hash::make(\Input::get('password')),
        //         )
        //     );

        //     return \Redirect::route('home')
        //     ->with('flash_notice', trans('messages.register.successful'));
        // } else {
        //     return \Redirect::to('users/create')
        //     ->withErrors($validation->messages()->all());
        // }
        // https://tutsplus.com/lesson/validating-with-models-and-event-listeners/
        $user = new \Model\User(\Input::all());

        if ($user->save()) {
            return \Redirect::route('home')
            ->with('flash_notice', trans('messages.register.successful'));
        } else {
            Event::fire('user.login.failed', array($user));
            return \Redirect::back()->withInput()->withErrors($user->errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        echo "users/1";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        echo "users/1/edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //No view
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //No view
    }

    /**
     * Login. Route: users/login
     *
     * @return Response
     */
    public function getLogin()
    {
        // http://forums.laravel.io/viewtopic.php?id=1652
        // http://www.karlvalentin.de/1903/write-your-own-auth-driver-for-laravel-4.html
        // http://firmanw.com/writing-a-custom-authentication-driver-for-laravel/
        return \View::make('users.login');
    }

    /**
     * Login. No route
     *
     * @return Response
     */
    public function postLogin()
    {
        $validator = \Validator::make(
            \Input::all(),
            array(
                'username' => 'required',
                'password' => 'required',
            )
        );

        if ($validator->passes()) {
            $credentials = [
                'username' => \Input::get('username'),
                'password' => \Input::get('password')
            ];

            $rememberMe = (\Input::get('remember-me') == 'yes') ? true : false;
            if (\Auth::attempt($credentials)) {
                // TODO: Reroute to profile
                return \Redirect::intended('home')
                    ->with('flash_notice', trans('messages.login.successful'));
            }
        }

        $data['username'] = \Input::get('username');
        return \Redirect::route('login')
          ->withInput($data)
          ->with('flash_warning', trans('messages.login.failed'));
    }

    /**
     * Logout. Route: users/logout
     *
     * @return Response
     */
    public function getLogout()
    {
        \Auth::logout();

        return \Redirect::route('home')
            ->with('flash_notice', trans('messages.logout.successful'));
    }
}
