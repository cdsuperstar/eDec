<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">

    <script>
        window.Laravel = {!! json_encode([ 'csrfToken' => csrf_token(), ]) !!};
    </script>

</head>
<body>

<div id="app">
<app></app>
</div>

<q-btn>adddcc</q-btn>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
