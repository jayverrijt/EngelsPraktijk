@extends('admin.layouts.db')
@section('dbContent')
    @php
        $querys = \DB::table('shops')->get();

    @endphp
    <table id="customers">
        <tr class="">
            <th>ID</th>
            <th>Type</th>
            <th>Name</th>
            <th>Url</th>
            <th>Continent</th>
            <th>Actions</th>
        </tr>
        @foreach($querys as $query)
            <tr>
                <td>{{$query->id}}</td>
                <td>{{$query->type}}</td>
                <td>{{$query->name}}</td>
                <td>{{$query->url}}</td>
                <td>{{$query->continent}}</td>
                <td style="display: inline-flex; width: 100%">
                    <form method="get" action="{{route('admin.dashboard-db-view.delete', ['id' => $query->id])}}">
                        <button type="submit" class="buttonStyle" style="background-color: red" name="table" value="{{$val}}"><i class="fas fa-trash"></i></button>
                    </form>
                </td>

        @endforeach

    </table>
@endsection
