@extends('admin.layouts.db')
@section('dbContent')
    @php
        $querys = \DB::table('country')->get();

    @endphp
    <table id="customers">
        <tr class="">
            <th>ID</th>
            <th>Name</th>
            <th>Code</th>
            <th>Continent ID</th>
        </tr>
        @foreach($querys as $querys)
            <tr>
                <td>{{$querys->id}}</td>
                <td>{{$querys->name}}</td>
                <td>{{$querys->code}}</td>
                <td>{{$querys->continent_id}}</td>
            </tr>
        @endforeach

    </table>
@endsection
