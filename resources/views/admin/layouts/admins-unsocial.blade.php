@extends('admin/layouts/admins')

@section('content')
    <form method="GET" action="{{route('admin.dashboard-admins-change-unsocial-update', ['id' => $id])}}">
        <input type="password" name="new-password" placeholder="New password">
        <input type="password" name="confirm-new-pass" placeholder="Confirm new password">
        <button type="submit">Add Password</button>

    </form>

@endsection
