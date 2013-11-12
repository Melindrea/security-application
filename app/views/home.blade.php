@extends('layouts.master')

@section('content')
    <h1>Home page</h1>

    {{ HTML::markdown('This is the front page of the system. You do not need to be logged in to view it.

This is obviously not the correct view for the actual project, but one that is created to give easy access to the prototype system.

{media[alt="test"|"something else"|"a third parameter"]}content.jpg{/media}/
{media[alt="test"|"something else"|"a third parameter"]}/
') }}

    <h2>Links</h2>

    <ul>
        @if (Auth::guest())
            <li><a href="{{Site::route('login')}}">Login</a></li>
            <li><a href="{{Site::route('users.create')}}">Register</a></li>
        @else
            <li><a href="{{Site::route('logout')}}?s={{ csrf_token() }}">Logout</a></li>
        @endif
        <li><a href="{{Site::route('messages.index')}}">Messages</a></li>
    </ul>
    Test?
    {{ HTML::gallery('gallery-1') }}
@stop
