@extends("admin/layouts/admins")
@section("content")
    <form method="get" action="{{route('admin.dashboard-adduser')}}">
        <input type="text" name="adminUsername" placeholder="Username">
        <input type="email" name="adminEmail" placeholder="Email">
        <input type="password" name="adminPassword" placeholder="Password">
        <input type="submit" value="Add">
    </form>
@endsection
