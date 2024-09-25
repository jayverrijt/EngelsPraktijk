@extends('admin.layouts.db')
@section('dbContent')
    @php
        $querys = \DB::table('system')->get();

    @endphp
    <table id="customers">
        <tr class="">
            <th>ID</th>
            <th>Foreign</th>
            <th>Username</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Country</th>
            <th>City</th>
            <th>Continent</th>
            <th>Birthday</th>
            <th>About</th>
        </tr>
        @foreach($querys as $query)
            <tr>
                <td>{{$query->id}}</td>
                <td>{{$query->foreign}}</td>
                <td>{{$query->username}}</td>
                <td>{{$query->phone}}</td>
                <td>{{$query->gender}}</td>
                <td>{{$query->country}}</td>
                <td>{{$query->city}}</td>
                <td>{{$query->continent}}</td>
                <td>{{$query->birthday}}</td>
                <td>{{$query->about}}</td>
        @endforeach

    </table>
@endsection
