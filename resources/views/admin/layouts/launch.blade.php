@extends("admin/dashboard")
@section('content')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="{{asset('css/cms/launch.css')}}">
    <div class="container" id="dashContainer">
        <div class="locationBar">
            <p style="margin-left: 1%"><a href="{{route('admin.dashboard')}}">Home</a> / Dashboard</p>
            <hr style="width: 100%; color: black">
        </div>
        <div class="locationBody">
        </div>
    </div>


@endsection
