@extends('admin.layouts.db')
@section('dbContent')
    @php
        $querys = \DB::table('friends')->get();

    @endphp
    <table id="customers">
        <tr class="">
            <th>ID</th>
            <th>User1</th>
            <th>User2</th>
            <th>Actions</th>
        </tr>
        @foreach($querys as $query)
            <tr>
                <td>{{$query->id}}</td>
                <td>{{$query->user1}}</td>
                <td>{{$query->user2}}</td>
                <td style="display: inline-flex; width: 100%">
                    <form method="get" action="{{route('admin.dashboard-db-view.delete', ['id' => $query->id])}}">
                        <button type="submit" class="buttonStyle" style="background-color: red" name="table" value="{{$val}}"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>
@endsection
