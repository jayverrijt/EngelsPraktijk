<!DOCTYPE html>
<html lang="en">
<head>
    <title>EngelsPraktijk CMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/cms/global.css')}}">
    <link rel="stylesheet" href="{{asset('css/cms/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/app/landing.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Scripts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="containerScope">
    <div class="containerTop">
        <section class="sectionText" style="font-size: 1.25rem; left: 1%; position:absolute;"><a style="text-decoration: none; color: #fff; font-size: 1.25rem" href="../admin/dashboard">CMS | </a><a href="../dashboard"  style="text-decoration: none; color: #fff; font-size: 1.25rem" >EngelsPraktijk</a></section>
        <section style="right: 1%; position:absolute; font-size: 1rem; color: #fff; top: 15%" class="sectionText"><a style="text-decoration: none; color: #fff; font-size: 1rem; font-weight: 400" href="{{route('logoff')}}"><i class="fa-fw fas fa-sign-out-alt"></i></a></section>
    </div>
    <div class="containerLeft" id="containerLeft">
        <ul class="containerLeftUl" id="containerLeftUl">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-fw fa-home"></i></a></li>
            <li><a href="{{route('admin.dashboard-db')}}"><i class="fa fa-fw fa-database"></i></a></li>
            <li><a href="{{route('admin.cards')}}"><i class="fa fa-fw fa-sd-card"></i></a></li>
            <li><a href="{{route('admin.dashboard-users')}}"><i class="fa fa-fw fa-users"></i></a></li>
            <li><a href="{{route('admin.dashboard-admins')}}"><i class="fa fa-fw fa-shield-alt"></i></a></li>
        </ul>
    </div>
    <div class="containerBottom" id="containerBottom">
        <section style="text-align: center"><p>Copyright © <?php echo date('Y')?> Praktijkschool Eindhoven</p></section>
    </div>
    <div class="yield" id="yield">
        @yield('content')
    </div>
</div>
</body>
<script src="{{asset('js/cms/launch.js')}}"></script>
</html>
