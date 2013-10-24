<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="{{ App::getLocale() }}"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="{{ App::getLocale() }}"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="{{ App::getLocale() }}"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="{{ App::getLocale() }}"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ Site::title() }}</title>
        {{ HTML::meta() }}
        <meta name="viewport" content="width=device-width">
        <link href='//fonts.googleapis.com/css?family=Libre+Baskerville:400,700,400italic|Quattrocento+Sans:700,700italic' rel='stylesheet'>
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        @section('head-css')
        {{ HTML::asset('header-css') }}
        @show

        @section('analytics')
        {{ HTML::ga('UA-XXXXXX-X') }}
        @show

        @section('head-js')
        {{ HTML::asset('header-js') }}
        @show
    </head>
        <body class="{{ HTML::bodyClasses() }}">
        {{ HTML::flash() }}

        <header>
        @section('header')
        {{ HTML::menu('main') }}
        @show
        </header>

        @yield('content')
        <footer>
        @section('footer')
        @show
        </footer>
        {{ HTML::asset('footer-js') }}
        {{ HTML::cookies() }}
    </body>
</html>
