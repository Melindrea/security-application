<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>security application</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link href='//fonts.googleapis.com/css?family=Libre+Baskerville:400,700,400italic|Quattrocento+Sans:700,700italic' rel='stylesheet'>
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        {{ HTML::asset('header-css') }}

        {{ HTML::ga('UA-XXXXXX-X') }}

        @section('head')
        {{ HTML::asset('header-js') }}
        @show
    </head>
        <body class="{{ HTML::bodyClasses() }}">
        {{ HTML::flash() }}

        {{ HTML::menu('main') }}

        @yield('content')

        {{ HTML::asset('footer-js') }}
        {{ HTML::cookies() }}
    </body>
</html>
