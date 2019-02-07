<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="keywords" content="Manfred,Manfred047,Laravel,Quasar,Vue,SPA,API">
        <meta name="twitter:title" content="Laravel - Quasar by Manfred047">
        <meta name="description" content="Laravel - Quasar by Manfred047">
        <meta property="og:title" content="Laravel - Quasar by Manfred047">
        <meta property="og:description" content="Laravel - Quasar by Manfred047">

        <title>Laravel - Quasar by Manfred047</title>

        <link rel="shortcut icon" type="image/jpg" href="{{ asset('img/logo.jpg') }}">

        <noscript>
            <style>html{display:none;}</style>
            <meta http-equiv="refresh" content="0.0; url={{url('/nojs')}}">
        </noscript>
        <style type="text/css" rel="stylesheet" id='antiClickjack'>body{display:none !important;}</style>
        <script type="text/javascript" charset="UTF-8" src="{{ mix(Master::getScriptMap()->js->secure) }}"></script>
        <link type="text/css" href="{{ mix(Master::getScriptMap()->css->main) }}" rel="stylesheet">
        <link type="text/css" href="{{ mix(Master::getScriptMap()->css->app) }}" rel="stylesheet">
    </head>
    <body>
        <div id="app" v-cloak></div>
        @include('app-scripts')
        <script type="text/javascript" charset="UTF-8" src="{{ mix(Master::getScriptMap()->js->bootstrap) }}"></script>
        <script type="text/javascript" charset="UTF-8" src="{{ mix(Master::getScriptMap()->js->app) }}"></script>
    </body>
</html>
