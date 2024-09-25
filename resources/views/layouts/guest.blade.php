<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>EngelsPraktijk</title>

        <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
        <link rel="favorite icon" href="{{ asset('favicon.png') }}">
        <!-- Scripts -->
        <link rel="stylesheet" href="{{asset('css/auth.css')}}">
        <link rel="stylesheet" href="{{asset('css/global.css')}}">
        <link rel="stylesheet" href="{{asset('css/landing.css')}}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="containerScope">
        <div class="container zoneleft">
        <!--
            <img src="" alt="Logo Placeholder" class="logoLookzAuth">
        -->
        </div>
        <div class="container zoneright">
            <div class="container zoneTop"></div>
            <div class="container zoneBottom">
                {{{$slot}}}
            </div>
        </div>
    </div>
    <div class="footerLocation">
        <div>
            <a class="footerHref" href="/">© HealtyWaveZ <?php echo date('Y')?></a>
            <a class="footerHref">|</a>
            <a class="footerHref" href="https://4people.nl">4People Communications</a>
            <a class="footerHref">|</a>
            <a class="footerHref">The Netherlands</a>
            <a class="footerHref">|</a>
            <a class="footerHref" href="/">Privacy Policy</a>
            <a class="footerHref">|</a>
            <a class="footerHref" href="/">Cookie Policy</a>
        </div>
    </div>
    </body>
</html>
