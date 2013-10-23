<?php

namespace Controller;

/**
 * Messages Controller.
 *
 * A REST-ful resource, alongside routes with the base of users.
 *
 * @author Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright Copyright (c) 2013, Marie Hogebrandt
 * @license http://opensource.org/licenses/MIT MIT
 */
class Messages extends Authorized
{

    /**
     * Let's whitelist all the methods we want to allow guests to visit!
     *
     * @access   protected
     * @var      array
     */
    protected $whitelist = array(
        'index',
    );

    protected $message;

    public function __construct(\Model\Message $message)
    {
        parent::__construct();
        $this->message = $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $messages = $this->message->all();
        return \View::make('messages.index')
        ->with('messages', $messages);
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
            return \Redirect::route('messages.index')
            ->with('flash_warning', trans('messages.post.failed'));
        }

        $post['subject'] = htmlspecialchars(\Input::get('subject'));
        $post['content'] = \Input::get('content');
        $post['type_id'] = 1; //TODO: Make message types matter
        $post['user_id'] = \Auth::user()->id;

        $message = new \Model\Message($post);

        if ($message->save()) {
            return \Redirect::route('messages.index')
            ->with('flash_notice', trans('messages.message.successful'));
        } else {
            return \Redirect::back()->withInput()->withErrors($message->errors);
        }
    }
}
