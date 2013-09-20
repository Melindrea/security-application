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
    );

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        echo "users/index";
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
        //No view
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
        return \View::make('users.login');
    }

    /**
     * Login. No route
     *
     * @return Response
     */
    public function postLogin()
    {
        $data = array();
        // $errors = new \MessageBag();
        // if ($old = \Input::old('errors'))  {
        //     $errors = $old;
        // }
        // $data = [
        //     'errors' => $errors
        // ];

        $validator = \Validator::make(\Input::all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->passes()) {
            $credentials = [
                'email' => \Input::get('email'),
                'password' => \Input::get('password')
            ];

            $rememberMe = (\Input::get('remember-me') == 'yes') ? true : false;
            if (\Auth::attempt($credentials)) {
                // TODO: Reroute to profile
                // return \Redirect::intended('/');
                return \Redirect::to('/');
            }
        }

        // $data['errors'] = new \MessageBag([
        //     'password' => [
        //         trans('forms.password.error')
        //     ]
        // ]);

        $data['email'] = \Input::get('email');
        if (\Auth::check()) {
            echo "Yay!";
        } else {
            echo "nope...";
        }
        // return \Redirect::route('login')
        //   ->withInput($data);
    }
}
