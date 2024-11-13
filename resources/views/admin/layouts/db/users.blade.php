@extends('admin.layouts.db')
@section('dbContent')
    @php
        $querys = \DB::table('users')->get();

    @endphp
    <table id="customers">
        <tr class="">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Email_Verified_at</th>
            <th>Type</th>
            <th>Remember Token</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        @foreach($querys as $query)
            <tr>
                <td>{{$query->id}}</td>
                <td>{{$query->name}}</td>
                <td>{{$query->email}}</td>
                <td>{{$query->email_verified_at}}</td>
                <td>{{$query->type}}</td>
                <td>{{$query->remember_token}}</td>
                <td>{{$query->created_at}}</td>
                <td>{{$query->updated_at}}</td>
            </tr>
        @endforeach

    </table>
@endsection
