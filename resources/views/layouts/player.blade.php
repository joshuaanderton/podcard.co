<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <script src="{{ asset('js/player.js') }}?v=5" defer></script>
        <link href="{{ asset('css/player.css') }}?v=5" rel="stylesheet">
        <link rel="shortcut icon" href="https://s3-us-west-2.amazonaws.com/upscribe/media/favicon.png"/>
    </head>
    <body>
        @yield('content')
    </body>
</html>
