@extends('admin.layouts.db')
@section('dbContent')
    @php
        $querys = \DB::table('friendrequest')->get();

    @endphp
    <table id="customers">
        <tr class="">
            <th>ID</th>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @foreach($querys as $query)
            <tr>
                <td>{{$query->id}}</td>
                <td>{{$query->sender}}</td>
                <td>{{$query->receiver}}</td>
                <td>{{$query->status}}</td>
                <td style="display: inline-flex; width: 100%">
                    <form method="get" action="{{route('admin.dashboard-db-view.delete', ['id' => $query->id])}}">
                        <button type="submit" class="buttonStyle" style="background-color: red" name="table" value="{{$val}}"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach


    </table>
@endsection
