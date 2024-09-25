<!DOCTYPE html>
<html lang="nl">
<head>
    <title>EngelsPraktijk</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="favorite icon" href="{{ asset('favicon.png') }}">
    <!-- Scripts -->
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
    <link rel="stylesheet" href="{{asset('css/global.css')}}">
    <link rel="stylesheet" href="{{asset('css/landing.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="containerScope">
    <div class="container zoneleft">
      <!--
        <img src="" alt="HealthyWaveZ Logo Placeholder" class="logoLookzLanding">
    -->
    </div>
    <div class="container zoneright">
        <div class="zoneTop">
            <h1 class="HeaderLookz">EngelsPraktijk</h1>
        </div>
        <div class="zoneBottom">
            <div class="container">
                <br>
                @yield('login')
            </div>
        </div>
    </div>
</div>
</body>
</html>
