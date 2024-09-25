@extends("admin/layouts/admins")

@section('content')
    <form method="get" action="{{route('admin.dashboard-admins-change-general-email-update', ['id' => $id])}}">
        <input type="text" name="email" placeholder="First Name">
        <input type="submit" value="Submit">
    </form>
@endsection
