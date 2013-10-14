@extends('layouts.master')

@section('content')
    <h1>Policies</h1>

    <h2>Table of Contents</h2>
    <ul>
        <li><a href="#cookies">Cookies</a></li>
        <li><a href="#privacy">Privacy</a></li>
    </ul>

    <h2 id="cookies">Cookies</h2>
    <p>Cookies are small textfiles that stores bits of information, generally to track a user through one particular site, or as they move through the internet.</p>

    <p>You can in your browser turn off cookies, or add settings so that you will be notified when sites try to place a cookie on your computer.</p>

    <h3>Cookies on this site</h3>
    <p>When registrering you are required to allow cookies, as they are used to track sessions, but you are not required to keep being logged in or anything like that. If you are not logged in you will see a message about cookies, as allowing them is vital to the base functionality of this site (in particular user accounts). Important to know is that <strong>no cookies or information from cookies are shared with third-part</strong>.</p>

    <dl class="dictionary">
        <dt><var>laravel_session</var></dt>
        <dd>This particular cookie is a so-called <dfn>session cookie</dfn>, which is active until the particular browser session (generally as the browser is closed) is terminated. It tracks a unique user as they move through the site, including keeping track on whether they're logged in.</dd>
        <dt><var>remember_*</var></dt>
        <dd>This cookie tracks whether a particular user is wanting to be remembered across browser sessions. It is persistant, but if you clear your cookies and remove it, all that means is that you are no longer logged in next time you visit the site. Even if you have checked <em>remember me</em> when logging in, the cookie will be purged once you logout.</dd>
    </dl>

    <h2 id="#privacy">Privacy</h2>
    <p>No personal information such as name or e-mail is stored automatically, nor is it shared with any kind of third-party.</p>

    <p>Anonymous statistics are sent to <a href="http://www.google.com/analytics">Google Analytics</a> to help optimising the site for the users.</p>

    <p>Information gathered through registration is stored safely and only sent across a safe connection. Both E-mail and password are encrypted, though you are also recommended to ensure the strength of your password.</p>

    <p>E-mail is not used without explicit permission of the user, with the exception of rare and important information from the administration.</p>
@stop
