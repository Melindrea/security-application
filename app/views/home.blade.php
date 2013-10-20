@extends('layouts.master')

@section('content')
    <h1>Home page</h1>

    <p>This is the front page of the system. You do not need to be logged
        in to view it.</p>

    <p>This is obviously not the correct view for the actual project, but
        one that is created to give easy access to the prototype system.</p>

    <h2>Links</h2>

    <ul>
        <li><a href="{{URL::route('login')}}">Login</a></li>
        <li><a href="{{URL::route('logout')}}">Logout</a></li>
        <li><a href="{{URL::route('users.create')}}">Register</a></li>
        <li><a href="{{URL::route('messages.index')}}">Messages</a></li>
    </ul>
@stop
