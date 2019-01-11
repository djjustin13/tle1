<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="apple-touch-icon" href="/icons/180x180.png">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta name="apple-mobile-web-app-title" content="Awareness010 ">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>TLE</title>
        <link rel="manifest" href="/manifest.json">
        <link rel="stylesheet" href="{{ asset('css/app.css')  }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
	

    </head>
    <body>
        <div id="app">
            <main-app></main-app>
        </div>
        <script src="{{ asset('js/app.js')  }}"></script>
    </body>
</html>
 