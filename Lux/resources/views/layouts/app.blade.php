<!DOCTYPE html>
<!--
    Written by Sam Dahles <sam.dahles@falcongroup.ltd>. Published under CC-BY-NC-ND 4.0 <https://creativecommons.org/licenses/by-nc-nd/4.0/>.
-->
<html>
    <head>
        <title>Lux - {{ ucfirst(Route::currentRouteName()) }}</title>

        <link rel="icon" type="image/png" href="./favicon.png" />

        <meta name="charset" content="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
        <meta name="robots" content="noindex, nofollow" />

        <meta name="application-name" content="Lux" />

        <link rel="apple-touch-startup-image" sizes="any" href="{{ asset('images/lux_white.svg') }}" />

        <meta name="HandheldFriendly" content="true" />
        <meta name="mobile-web-app-capable" content="yes" />
        <meta name="theme-color" content="#161618" />

        <meta name="apple-mobile-web-app-title" content="Lux">
        <meta name="apple-mobile-web-app-status-bar-style" content="#161618" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <link rel="apple-touch-icon" href="{{ asset('images/lux-white.svg') }}" />

        <meta name="msapplication-TileColor" content="#161618" />

        <script src="{{ asset('js/swiped-events.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}" />

        @yield('head')
    </head>
    <body>
        @yield('body')
    </body>
</html>
