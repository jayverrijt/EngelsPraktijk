@extends('admin.layouts.db')
@section('dbContent')
    @php
        $querys = \DB::table('sold')->get();

    @endphp
    <table id="customers">
        <tr class="">
            <th>ID</th>
            <th>Foreign</th>
            <th>Buyer</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @foreach($querys as $query)
            <tr>
                <td>{{$query->id}}</td>
                <td>{{$query->foreign}}</td>
                <td>{{$query->buyer}}</td>
                <td>{{$query->status}}</td>
                <td style="display: inline-flex; width: 100%">
                    <form method="get" action="{{route('admin.dashboard-db-view.delete', ['id' => $query->id])}}">
                        <button type="submit" class="buttonStyle" style="background-color: red" name="table" value="{{$val}}"><i class="fas fa-trash"></i></button>
                    </form>
                </td>

        @endforeach

    </table>
@endsection
