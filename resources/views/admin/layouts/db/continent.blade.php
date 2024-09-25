@extends('admin.layouts.db')
@section('dbContent')
    @php
        $querys = \DB::table('continent')->get();

    @endphp
    <table id="customers">
        <tr class="">
            <th>ID</th>
            <th>Name</th>
        </tr>
        @foreach($querys as $query)
            <tr>
                <td>{{$query->id}}</td>
                <td>{{$query->name}}</td>
            </tr>
        @endforeach

    </table>
@endsection
