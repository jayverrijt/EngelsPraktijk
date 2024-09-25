@extends("admin/layouts/admins")

@section('content')
    <form method="get" action="{{route('admin.dashboard-admins-change-general-name-update', ['id' => $id])}}">
        <input type="text" name="firstname" placeholder="First Name">
        <input type="text" name="lastname" placeholder="Last Name">
        <input type="submit" value="Submit">
    </form>
@endsection
