@extends('admin/layouts/admins')
@section('content')
    <form method="GET" action="{{route('admin.dashboard-admins-change-password-update', ['id' => $id])}}">
        <input type="password" name="old-password" placeholder="Current Password">
       <input type="password" name="new-password" placeholder="New password">
       <input type="password" name="confirm-new-pass" placeholder="Confirm new password">
       <button type="submit">Change password</button>

    </form>

@endsection
