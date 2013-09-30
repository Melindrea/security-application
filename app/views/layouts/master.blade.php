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
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        {{ HTML::stylesheet('main.min.css') }}

        @include('partials.ga', array('ua' => 'UA-XXXXXX-X'))

        @section('head')
        {{ HTML::script(Config::get('app.assets.script').'head.min.js') }}
        @show
    </head>
        <body class="{{ HTML::bodyClasses() }}">
        @include('partials.flash')

        @yield('content')

        {{ HTML::script(Config::get('app.assets.script').'main.min.js') }}
    </body>
</html>
